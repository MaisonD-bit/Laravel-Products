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
        $valid = $request->validate([
            'uploadFile' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        $file = $request->file('uploadFile');
        $path = $file->store('file-uploads', 'public'); 
    
        $url = Storage::url($path);
    
        return view('products.upload')->with(compact('url'));
    }
}