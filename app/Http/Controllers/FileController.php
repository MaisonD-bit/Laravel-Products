<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function upload()
    {
        return view('products.upload');
    }

    public function storeToStorage(Request $request)
    {
        // Validate the uploaded file
        $valid = $request->validate([
            'uploadFile' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        // Store the file in the 'public/file-uploads' directory
        $file = $request->file('uploadFile');
        $path = $file->store('file-uploads', 'public'); // Ensure 'public' disk is used
    
        // Generate the public URL for the stored file
        $url = Storage::url($path);
    
        // Pass the URL to the view
        return view('products.upload')->with(compact('url'));
    }
}