<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Brand;
use App\Models\ProductType;
use App\Models\Space;
use App\Models\Color;
use App\Models\Material;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('brand', 'productType')->latest()->get();
        return view('backend.pages.products.index', compact('products'));
    }

    public function create()
    {
        $brands = Brand::all();
        $productTypes = ProductType::all();
        $spaces = Space::all();
        $colors = Color::all();
        $materials = Material::all();
        return view('backend.pages.products.create', compact('brands', 'productTypes', 'spaces', 'colors', 'materials'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'nullable|numeric',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:10240',
            'visual_images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:10240',
            'usp_images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:10240',
            'gallery_images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:10240',
        ]);

        $data = $request->except([
            'spaces', 'colors', 'materials', 'thumbnail',
            'visual_images', 'usp_images', 'gallery_images',
        ]);
        $data['slug'] = Str::slug($request->name);

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $this->uploadImage($request->file('thumbnail'));
        }

        $product = Product::create($data);

        if ($request->has('spaces')) $product->spaces()->sync($request->spaces);
        if ($request->has('colors')) $product->colors()->sync($request->colors);
        if ($request->has('materials')) $product->materials()->sync($request->materials);

        $this->storeDetailImages($product, $request);

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    public function edit(Product $product)
    {
        $product->load(['visualImages', 'uspImages', 'galleryImages']);
        $brands = Brand::all();
        $productTypes = ProductType::all();
        $spaces = Space::all();
        $colors = Color::all();
        $materials = Material::all();
        return view('backend.pages.products.create', compact('product', 'brands', 'productTypes', 'spaces', 'colors', 'materials'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'nullable|numeric',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:10240',
            'visual_images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:10240',
            'usp_images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:10240',
            'gallery_images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:10240',
        ]);

        $data = $request->except([
            'spaces', 'colors', 'materials', 'thumbnail',
            'visual_images', 'usp_images', 'gallery_images',
            'remove_visual', 'remove_usp', 'remove_gallery',
        ]);
        $data['slug'] = Str::slug($request->name);

        if ($request->hasFile('thumbnail')) {
            $this->deleteOldThumbnail($product->thumbnail, $product->id);
            $data['thumbnail'] = $this->uploadImage($request->file('thumbnail'));
        }

        $product->update($data);

        if ($request->has('spaces')) $product->spaces()->sync($request->spaces);
        if ($request->has('colors')) $product->colors()->sync($request->colors);
        if ($request->has('materials')) $product->materials()->sync($request->materials);

        $this->removeDetailImages($request);
        $this->storeDetailImages($product, $request);

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        $this->deleteOldThumbnail($product->thumbnail, $product->id);
        foreach ($product->images as $image) {
            $this->deleteImageFile($image->path);
        }
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }

    protected function storeDetailImages(Product $product, Request $request): void
    {
        $this->appendImages($product, ProductImage::TYPE_VISUAL, $request->file('visual_images', []), 2);
        $this->appendImages($product, ProductImage::TYPE_USP, $request->file('usp_images', []), 2);
        $this->appendImages($product, ProductImage::TYPE_GALLERY, $request->file('gallery_images', []), null);
    }

    protected function appendImages(Product $product, string $type, array $files, ?int $maxTotal): void
    {
        $files = array_filter($files);
        if (empty($files)) {
            return;
        }

        $currentCount = $product->images()->where('type', $type)->count();
        $sort = (int) $product->images()->where('type', $type)->max('sort_order');

        foreach ($files as $file) {
            if ($maxTotal !== null && $currentCount >= $maxTotal) {
                break;
            }

            $product->images()->create([
                'type' => $type,
                'path' => $this->uploadImage($file),
                'sort_order' => ++$sort,
            ]);
            $currentCount++;
        }
    }

    protected function removeDetailImages(Request $request): void
    {
        $ids = array_merge(
            $request->input('remove_visual', []),
            $request->input('remove_usp', []),
            $request->input('remove_gallery', [])
        );

        if (empty($ids)) {
            return;
        }

        $images = ProductImage::whereIn('id', $ids)->get();
        foreach ($images as $image) {
            $this->deleteImageFile($image->path);
            $image->delete();
        }
    }

    protected function uploadImage($file): string
    {
        $dir = public_path('uploads/products');
        if (!File::isDirectory($dir)) {
            File::makeDirectory($dir, 0755, true);
        }

        $filename = Str::random(40) . '.' . $file->getClientOriginalExtension();
        $file->move($dir, $filename);

        return 'uploads/products/' . $filename;
    }

    /** @deprecated Use uploadImage() */
    protected function uploadThumbnail($file): string
    {
        return $this->uploadImage($file);
    }

    protected function deleteImageFile(?string $path): void
    {
        if (!$path) {
            return;
        }

        $candidates = [
            public_path($path),
            storage_path('app/public/' . $path),
        ];

        foreach ($candidates as $file) {
            if (File::exists($file)) {
                File::delete($file);
                return;
            }
        }
    }

    protected function deleteOldThumbnail(?string $path, ?int $exceptProductId = null): void
    {
        if (!$path) {
            return;
        }

        $query = Product::where('thumbnail', $path);
        if ($exceptProductId) {
            $query->where('id', '!=', $exceptProductId);
        }
        if ($query->exists()) {
            return;
        }

        $this->deleteImageFile($path);
    }
}
