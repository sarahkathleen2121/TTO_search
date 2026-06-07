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
        ]);

        $data = $request->except(['industries', 'spaces', 'colors', 'materials', 'thumbnail']);
        $data['slug'] = Str::slug($request->name);

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('products', 'public');
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
        ]);

        $data = $request->except(['industries', 'spaces', 'colors', 'materials', 'thumbnail']);
        $data['slug'] = Str::slug($request->name);

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('products', 'public');
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
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
