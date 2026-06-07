<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Color;

class ColorController extends Controller
{
    private $viewData = ['title' => 'Manage Colors', 'singleName' => 'Color', 'route' => 'colors', 'hasColor' => true];

    public function index()
    {
        $items = Color::latest()->get();
        return view('backend.pages.categories.index', array_merge($this->viewData, ['items' => $items]));
    }

    public function create()
    {
        return view('backend.pages.categories.create', $this->viewData);
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255', 'hex_code' => 'required|string|max:20']);
        Color::create(['name' => $request->name, 'hex_code' => $request->hex_code]);
        return redirect()->route($this->viewData['route'].'.index')->with('success', 'Created successfully.');
    }

    public function edit(Color $color)
    {
        return view('backend.pages.categories.create', array_merge($this->viewData, ['item' => $color]));
    }

    public function update(Request $request, Color $color)
    {
        $request->validate(['name' => 'required|string|max:255', 'hex_code' => 'required|string|max:20']);
        $color->update(['name' => $request->name, 'hex_code' => $request->hex_code]);
        return redirect()->route($this->viewData['route'].'.index')->with('success', 'Updated successfully.');
    }

    public function destroy(Color $color)
    {
        $color->delete();
        return redirect()->route($this->viewData['route'].'.index')->with('success', 'Deleted successfully.');
    }
}
