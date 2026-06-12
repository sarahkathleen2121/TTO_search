<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Brand;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::latest()->get();
        return view('backend.pages.brands.index', compact('brands'));
    }

    public function create()
    {
        return view('backend.pages.brands.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image',
            'bg_image' => 'nullable|image',
        ]);
        $data = $request->only('name');
        $data['slug'] = Str::slug($request->name);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $dir = public_path('uploads/brands');
            if (!\Illuminate\Support\Facades\File::isDirectory($dir)) {
                \Illuminate\Support\Facades\File::makeDirectory($dir, 0755, true);
            }
            $filename = Str::random(40) . '.' . $file->getClientOriginalExtension();
            $file->move($dir, $filename);
            $data['image'] = 'uploads/brands/' . $filename;
        }

        if ($request->hasFile('bg_image')) {
            $file = $request->file('bg_image');
            $dir = public_path('uploads/brands');
            if (!\Illuminate\Support\Facades\File::isDirectory($dir)) {
                \Illuminate\Support\Facades\File::makeDirectory($dir, 0755, true);
            }
            $filename = Str::random(40) . '.' . $file->getClientOriginalExtension();
            $file->move($dir, $filename);
            $data['bg_image'] = 'uploads/brands/' . $filename;
        }

        Brand::create($data);
        return redirect()->route('brands.index')->with('success', 'Brand created successfully.');
    }

    public function edit(Brand $brand)
    {
        return view('backend.pages.brands.create', compact('brand'));
    }

    public function update(Request $request, Brand $brand)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image',
            'bg_image' => 'nullable|image',
        ]);
        $data = $request->only('name');
        $data['slug'] = Str::slug($request->name);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $dir = public_path('uploads/brands');
            if (!\Illuminate\Support\Facades\File::isDirectory($dir)) {
                \Illuminate\Support\Facades\File::makeDirectory($dir, 0755, true);
            }
            $filename = Str::random(40) . '.' . $file->getClientOriginalExtension();
            $file->move($dir, $filename);
            $data['image'] = 'uploads/brands/' . $filename;
        }

        if ($request->hasFile('bg_image')) {
            $file = $request->file('bg_image');
            $dir = public_path('uploads/brands');
            if (!\Illuminate\Support\Facades\File::isDirectory($dir)) {
                \Illuminate\Support\Facades\File::makeDirectory($dir, 0755, true);
            }
            $filename = Str::random(40) . '.' . $file->getClientOriginalExtension();
            $file->move($dir, $filename);
            $data['bg_image'] = 'uploads/brands/' . $filename;
        }

        $brand->update($data);
        return redirect()->route('brands.index')->with('success', 'Brand updated successfully.');
    }

    public function destroy(Brand $brand)
    {
        $brand->delete();
        return redirect()->route('brands.index')->with('success', 'Brand deleted successfully.');
    }
}
