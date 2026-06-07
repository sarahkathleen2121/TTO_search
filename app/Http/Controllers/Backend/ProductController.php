<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Brand;
use App\Models\ProductType;
use App\Models\Industry;
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
        $industries = Industry::all();
        $spaces = Space::all();
        $colors = Color::all();
        $materials = Material::all();
        return view('backend.pages.products.create', compact('brands', 'productTypes', 'industries', 'spaces', 'colors', 'materials'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'nullable|numeric',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:10240',
        ]);

        $data = $request->except(['industries', 'spaces', 'colors', 'materials', 'thumbnail']);
        $data['slug'] = Str::slug($request->name);

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $this->uploadThumbnail($request->file('thumbnail'));
        }

        $product = Product::create($data);

        if ($request->has('industries')) $product->industries()->sync($request->industries);
        if ($request->has('spaces')) $product->spaces()->sync($request->spaces);
        if ($request->has('colors')) $product->colors()->sync($request->colors);
        if ($request->has('materials')) $product->materials()->sync($request->materials);

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    public function edit(Product $product)
    {
        $brands = Brand::all();
        $productTypes = ProductType::all();
        $industries = Industry::all();
        $spaces = Space::all();
        $colors = Color::all();
        $materials = Material::all();
        return view('backend.pages.products.create', compact('product', 'brands', 'productTypes', 'industries', 'spaces', 'colors', 'materials'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'nullable|numeric',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:10240',
        ]);

        $data = $request->except(['industries', 'spaces', 'colors', 'materials', 'thumbnail']);
        $data['slug'] = Str::slug($request->name);

        if ($request->hasFile('thumbnail')) {
            $this->deleteOldThumbnail($product->thumbnail, $product->id);
            $data['thumbnail'] = $this->uploadThumbnail($request->file('thumbnail'));
        }

        $product->update($data);

        if ($request->has('industries')) $product->industries()->sync($request->industries);
        if ($request->has('spaces')) $product->spaces()->sync($request->spaces);
        if ($request->has('colors')) $product->colors()->sync($request->colors);
        if ($request->has('materials')) $product->materials()->sync($request->materials);

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        $this->deleteOldThumbnail($product->thumbnail, $product->id);
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }

    /**
     * Upload thumbnail directly to public/uploads/products/ (no symlink needed).
     */
    protected function uploadThumbnail($file): string
    {
        $dir = public_path('uploads/products');
        if (!File::isDirectory($dir)) {
            File::makeDirectory($dir, 0755, true);
        }

        $filename = Str::random(40) . '.' . $file->getClientOriginalExtension();
        $file->move($dir, $filename);

        return 'uploads/products/' . $filename;
    }

    /**
     * Delete thumbnail file only when no other product still uses the same path.
     */
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
}

