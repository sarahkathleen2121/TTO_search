<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Industry;
use Illuminate\Support\Str;

class IndustryController extends Controller
{
    private $viewData = ['title' => 'Manage Industries', 'singleName' => 'Industry', 'route' => 'industries'];

    public function index()
    {
        $items = Industry::latest()->get();
        return view('backend.pages.categories.index', array_merge($this->viewData, ['items' => $items]));
    }

    public function create()
    {
        return view('backend.pages.categories.create', $this->viewData);
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255']);
        Industry::create(['name' => $request->name, 'slug' => Str::slug($request->name)]);
        return redirect()->route($this->viewData['route'].'.index')->with('success', 'Created successfully.');
    }

    public function edit(Industry $industry)
    {
        return view('backend.pages.categories.create', array_merge($this->viewData, ['item' => $industry]));
    }

    public function update(Request $request, Industry $industry)
    {
        $request->validate(['name' => 'required|string|max:255']);
        $industry->update(['name' => $request->name, 'slug' => Str::slug($request->name)]);
        return redirect()->route($this->viewData['route'].'.index')->with('success', 'Updated successfully.');
    }

    public function destroy(Industry $industry)
    {
        $industry->delete();
        return redirect()->route($this->viewData['route'].'.index')->with('success', 'Deleted successfully.');
    }
}
