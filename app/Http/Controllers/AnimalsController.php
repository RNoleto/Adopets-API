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
       $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'gender' => 'required|string|in:M,F',
            'birth' => 'required|date', 
            'specie' => 'required|string',
            'breed' => 'required|string',
            'chip_number' => 'nullable|integer',
            'ref_id_user' => 'required|integer',
        ]);

        // Crie o animal usando apenas os campos validados
        $animal = new Animals();
        $animal->name = $validatedData['name'];
        $animal->gender = $validatedData['gender'];
        $animal->birth = $validatedData['birth'];
        $animal->specie = $validatedData['specie'];
        $animal->breed = $validatedData['breed'];
        $animal->chip_number = $validatedData['chip_number'] ? $validatedData['chip_number'] : null;
        $animal->ref_id_user = $validatedData['ref_id_user'];
        
        $animal->save();

        return response()->json($animal, 201);
    }
}
