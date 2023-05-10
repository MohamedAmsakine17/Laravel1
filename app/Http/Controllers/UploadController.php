<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\TemporaryFiles;

class UploadController extends Controller
{
    public function store(Request $request)
    {
        if($request->hasFile('file'))
        {
            $file = $request->file('file');
            $filename = $file->getClientOriginalName();
            $folder = uniqid() . '-' . now()->timestamp;
            $file->storeAs('files/tmp/'.$folder,$filename);

            TemporaryFiles::create([
               'filename' => $filename,
               'folder' => $folder, 
            ]);

            return $folder;
        }
        if($request->hasFile('img1'))
        {
            $file = $request->file('img1');
            $filename = $file->getClientOriginalName();
            $folder = uniqid() . '-' . now()->timestamp;
            $file->storeAs('files/tmp/'.$folder,$filename);

            TemporaryFiles::create([
               'filename' => $filename,
               'folder' => $folder, 
            ]);

            return $folder;
        }
        if($request->hasFile('img2'))
        {
            $file = $request->file('img2');
            $filename = $file->getClientOriginalName();
            $folder = uniqid() . '-' . now()->timestamp;
            $file->storeAs('files/tmp/'.$folder,$filename);

            TemporaryFiles::create([
               'filename' => $filename,
               'folder' => $folder, 
            ]);

            return $folder;
        }
        if($request->hasFile('img3'))
        {
            $file = $request->file('img3');
            $filename = $file->getClientOriginalName();
            $folder = uniqid() . '-' . now()->timestamp;
            $file->storeAs('files/tmp/'.$folder,$filename);

            TemporaryFiles::create([
               'filename' => $filename,
               'folder' => $folder, 
            ]);

            return $folder;
        }
        if($request->hasFile('img4'))
        {
            $file = $request->file('img4');
            $filename = $file->getClientOriginalName();
            $folder = uniqid() . '-' . now()->timestamp;
            $file->storeAs('files/tmp/'.$folder,$filename);

            TemporaryFiles::create([
               'filename' => $filename,
               'folder' => $folder, 
            ]);

            return $folder;
        }
        return '';
    }
}