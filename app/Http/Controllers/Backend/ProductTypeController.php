<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ProductType;
use Illuminate\Support\Str;

class ProductTypeController extends Controller
{
    private $viewData = ['title' => 'Manage Product Types', 'singleName' => 'Product Type', 'route' => 'product-types'];

    public function index()
    {
        $items = ProductType::latest()->get();
        return view('backend.pages.categories.index', array_merge($this->viewData, ['items' => $items]));
    }

    public function create()
    {
        return view('backend.pages.categories.create', $this->viewData);
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255']);
        ProductType::create(['name' => $request->name, 'slug' => Str::slug($request->name)]);
        return redirect()->route($this->viewData['route'].'.index')->with('success', 'Created successfully.');
    }

    public function edit(ProductType $product_type)
    {
        return view('backend.pages.categories.create', array_merge($this->viewData, ['item' => $product_type]));
    }

    public function update(Request $request, ProductType $product_type)
    {
        $request->validate(['name' => 'required|string|max:255']);
        $product_type->update(['name' => $request->name, 'slug' => Str::slug($request->name)]);
        return redirect()->route($this->viewData['route'].'.index')->with('success', 'Updated successfully.');
    }

    public function destroy(ProductType $product_type)
    {
        $product_type->delete();
        return redirect()->route($this->viewData['route'].'.index')->with('success', 'Deleted successfully.');
    }
}
