<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Material;
use Illuminate\Support\Str;

class MaterialController extends Controller
{
    private $viewData = ['title' => 'Manage Materials', 'singleName' => 'Material', 'route' => 'materials'];

    public function index()
    {
        $items = Material::latest()->get();
        return view('backend.pages.categories.index', array_merge($this->viewData, ['items' => $items]));
    }

    public function create()
    {
        return view('backend.pages.categories.create', $this->viewData);
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255']);
        Material::create(['name' => $request->name, 'slug' => Str::slug($request->name)]);
        return redirect()->route($this->viewData['route'].'.index')->with('success', 'Created successfully.');
    }

    public function edit(Material $material)
    {
        return view('backend.pages.categories.create', array_merge($this->viewData, ['item' => $material]));
    }

    public function update(Request $request, Material $material)
    {
        $request->validate(['name' => 'required|string|max:255']);
        $material->update(['name' => $request->name, 'slug' => Str::slug($request->name)]);
        return redirect()->route($this->viewData['route'].'.index')->with('success', 'Updated successfully.');
    }

    public function destroy(Material $material)
    {
        $material->delete();
        return redirect()->route($this->viewData['route'].'.index')->with('success', 'Deleted successfully.');
    }
}
