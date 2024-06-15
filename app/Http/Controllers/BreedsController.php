<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Breeds;
use Illuminate\Http\Request;

class BreedsController extends Controller
{
    //Função para listar todas as raças de animais
    public function index()
    {
        $breeds = Breeds::all();
        return response()->json($breeds);
    }

    //Função para criar uma nova raça de animal
    public function store(Request $request)
    {
        $request->validate([
            'breed' => 'required|string|max:255',
            'ref_id_specie' => 'required|integer',
            'origin' => 'string|max:255',
            'average_weight' => 'numeric',
            'lifespan' => 'numeric',
            'story' => 'string',
            // 'ref_id_user' => 'required|integer',
        ]);

        $breeds = Breeds::create($request->all());
        return response()->json($breeds, 201);
    }
    public function show($id)
    {
        $breed = Breeds::find($id);

        if (!$breed) {
            return response()->json(['message' => 'Raça não encontrada'], 404);
        }

        return response()->json($breed);
    }
}
