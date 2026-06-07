<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Space;
use Illuminate\Support\Str;

class SpaceController extends Controller
{
    private $viewData = ['title' => 'Manage Spaces', 'singleName' => 'Space', 'route' => 'spaces'];

    public function index()
    {
        $items = Space::latest()->get();
        return view('backend.pages.categories.index', array_merge($this->viewData, ['items' => $items]));
    }

    public function create()
    {
        return view('backend.pages.categories.create', $this->viewData);
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255']);
        Space::create(['name' => $request->name, 'slug' => Str::slug($request->name)]);
        return redirect()->route($this->viewData['route'].'.index')->with('success', 'Created successfully.');
    }

    public function edit(Space $space)
    {
        return view('backend.pages.categories.create', array_merge($this->viewData, ['item' => $space]));
    }

    public function update(Request $request, Space $space)
    {
        $request->validate(['name' => 'required|string|max:255']);
        $space->update(['name' => $request->name, 'slug' => Str::slug($request->name)]);
        return redirect()->route($this->viewData['route'].'.index')->with('success', 'Updated successfully.');
    }

    public function destroy(Space $space)
    {
        $space->delete();
        return redirect()->route($this->viewData['route'].'.index')->with('success', 'Deleted successfully.');
    }
}
