<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogCategory;
use Illuminate\Support\Str;

class BlogCategoryController extends Controller
{
    public function index()
    {
        $categories = BlogCategory::latest()->get();
        return view('backend.pages.blog_categories.index', compact('categories'));
    }

    public function create()
    {
        return view('backend.pages.blog_categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:blog_categories,name',
        ]);
        
        $data = $request->only('name');
        $data['slug'] = Str::slug($request->name);

        BlogCategory::create($data);
        return redirect()->route('blog-categories.index')->with('success', 'Category created successfully.');
    }

    public function edit($id)
    {
        $category = BlogCategory::findOrFail($id);
        return view('backend.pages.blog_categories.create', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = BlogCategory::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255|unique:blog_categories,name,' . $category->id,
        ]);

        $data = $request->only('name');
        $data['slug'] = Str::slug($request->name);

        $category->update($data);
        return redirect()->route('blog-categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy($id)
    {
        $category = BlogCategory::findOrFail($id);
        $category->delete();
        return redirect()->route('blog-categories.index')->with('success', 'Category deleted successfully.');
    }
}
