<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function index()
    {
        return view('images.index');
    }

    public function show()
    {
        return Image::query()->latest()->pluck('name')->toArray();
    }

    public function store(Request $request)
    {
        // validate incoming file
        if (!$request->has('image')) {
            return response()->json(['error' => 'No image file is found.'], 400);
        }

        // validate request
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        // save file in storage
        $path = $request->file('image')->store('images', 'public');

        if (!$path) {
            return response()->json(['error' => 'Image file could not be saved.'], 500);
        }

        $file = $request->file('image');

        $image = new Image();
        $image->name = $file->hashName();
        $image->extension = $file->extension();
        $image->size = $file->getSize();
        $image->saveQuietly();

        return $image->name;
    }
}
