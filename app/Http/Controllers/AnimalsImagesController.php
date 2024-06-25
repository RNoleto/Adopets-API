<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\AnimalsImagesRequest;
use App\Models\AnimalsImages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AnimalsImagesController extends Controller
{
    public function index()
    {
        $files = AnimalsImages::all();

        return response()->json($files);
    }

    public function upload(AnimalsImagesRequest $request)
    {
        $validatedData = $request->validated();

        $file = $request->file('file');
        $name = $file->getClientOriginalName();
        $path = $file->store('files', 'public');

        $file = AnimalsImages::create([
            'name' => $name,
            'path' => $path,
            'ref_id_animal' => $validatedData['ref_id_animal'],
        ]);

        return response()->json(['file' => $file, 'message' => 'Arquivo enviado com sucesso'], 200);
    }

    public function download(AnimalsImages $file)
    {
        return Storage::disk('public')->download($file->path);
    }
}
