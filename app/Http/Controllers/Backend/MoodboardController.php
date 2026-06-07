<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Moodboard;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class MoodboardController extends Controller
{
    public function index()
    {
        $moodboards = Moodboard::latest()->get();
        return view('backend.pages.moodboards.index', compact('moodboards'));
    }

    public function create()
    {
        return view('backend.pages.moodboards.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:4096',
            'status' => 'required|boolean',
        ]);

        $data = $request->only(['title', 'description', 'status']);

        if ($request->hasFile('image')) {
            $data['image'] = $this->uploadImage($request->file('image'));
        }

        Moodboard::create($data);

        return redirect()->route('moodboards.index')->with('success', 'Moodboard created successfully.');
    }

    public function edit(Moodboard $moodboard)
    {
        return view('backend.pages.moodboards.create', compact('moodboard'));
    }

    public function update(Request $request, Moodboard $moodboard)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:4096',
            'status' => 'required|boolean',
        ]);

        $data = $request->only(['title', 'description', 'status']);

        if ($request->hasFile('image')) {
            $this->deleteOldImage($moodboard->image);
            $data['image'] = $this->uploadImage($request->file('image'));
        }

        $moodboard->update($data);

        return redirect()->route('moodboards.index')->with('success', 'Moodboard updated successfully.');
    }

    public function destroy(Moodboard $moodboard)
    {
        $this->deleteOldImage($moodboard->image);
        $moodboard->delete();

        return redirect()->route('moodboards.index')->with('success', 'Moodboard deleted successfully.');
    }

    protected function uploadImage($file): string
    {
        $dir = public_path('uploads/moodboards');
        if (!File::isDirectory($dir)) {
            File::makeDirectory($dir, 0755, true);
        }

        $filename = Str::random(40) . '.' . $file->getClientOriginalExtension();
        $file->move($dir, $filename);

        return 'uploads/moodboards/' . $filename;
    }

    protected function deleteOldImage(?string $path): void
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
}
