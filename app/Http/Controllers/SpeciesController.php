<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Species;
use Illuminate\Http\Request;

class SpeciesController extends Controller
{
    // Função para listar todas as espécies de animais
    public function index()
    {
        $species = Species::all();
        return response()->json($species);
    }

    // Função para criar uma nova espécie de animal
    public function store(Request $request)
    {
        $request->validate([
            'specie' => 'required|string|max:255',
            // Adicione outras regras de validação conforme necessário
        ]);

        $species = Species::create([
            'specie' => $request->specie,
            'ref_id_user' => $request->ref_id_user,
        ]);

        // $species = Species::create($request->all());
        return response()->json($species, 201);
    }
}
