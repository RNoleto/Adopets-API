<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Animals;
use Illuminate\Http\Request;

class AnimalsController extends Controller
{
    //Função para listar todos os animais
    public function index()
    {
        $animals = Animals::all();
        return response()->json($animals);
    }

    //Função para criar um novo animal
    public function store(Request $request)
    {
        $request->validate([
            'animal' => 'required|string|max:255',
            'ref_id_specie' => 'required|integer',
            'ref_id_breed' => 'required|integer',
        ]);

        // $animals = Animals::create([
        //     'animal' => $request->animal,
        //     'ref_id_user' => $request->ref_id_user,
        // ]);
        $animals = Animals::create($request->all());
        return response()->json($animals, 201);
    }
}
