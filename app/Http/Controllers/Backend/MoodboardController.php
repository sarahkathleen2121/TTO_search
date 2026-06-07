<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Moodboard;
use Illuminate\Support\Facades\Storage;

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
            $data['image'] = $request->file('image')->store('moodboards', 'public');
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
            // Delete old image if exists
            if ($moodboard->image && Storage::disk('public')->exists($moodboard->image)) {
                Storage::disk('public')->delete($moodboard->image);
            }
            $data['image'] = $request->file('image')->store('moodboards', 'public');
        }

        $moodboard->update($data);

        return redirect()->route('moodboards.index')->with('success', 'Moodboard updated successfully.');
    }

    public function destroy(Moodboard $moodboard)
    {
        // Delete image if exists
        if ($moodboard->image && Storage::disk('public')->exists($moodboard->image)) {
            Storage::disk('public')->delete($moodboard->image);
        }

        $moodboard->delete();

        return redirect()->route('moodboards.index')->with('success', 'Moodboard deleted successfully.');
    }
}
