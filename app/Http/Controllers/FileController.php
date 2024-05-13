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
        $input = $request->validated();
        $file = $input['file'];
        $name = $file->getClientOriginalName();
        $path = $file->store('files', 'public');

        File::query()->create([
            'name' => $name,
            'path' => $path,
        ]);

        return response()->json(['message' => 'Arquivo enviado com sucesso'], 200);
    }

    public function download(File $file)
    {
        return Storage::disk('public')
            ->download($file->path);
    }
}
