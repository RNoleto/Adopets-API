<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\FileRequest;
use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function upload(FileRequest $request)
    {
        $validatedData = $request->validated();

        $file = $request->file('file');
        $name = $file->getClientOriginalName();
        $path = $file->store('files', 'public');

        $file = File::create([
            'name' => $name,
            'path' => $path,
            'ref_id_breed' => $validatedData['ref_id_breed'],
        ]);

        return response()->json(['file' => $file, 'message' => 'Arquivo enviado com sucesso'], 200);
    }

    public function download(File $file)
    {
        return Storage::disk('public')
            ->download($file->path);
    }
}
