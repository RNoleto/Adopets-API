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
            'name' => 'required|string|max:255',
            'gender' => 'required|string|in:M,F', // Exemplo de validação para sexo
            'birth' => 'required|date', // Exemplo de validação para data de nascimento
            'ref_id_specie' => 'required|integer',
            'ref_id_breed' => 'required|integer',
            'ref_id_user' => 'required|integer', // Inclua a validação para ref_id_user se necessário
        ]);

        // Crie o animal usando apenas os campos validados
        $animal = new Animals();
        $animal->name = $request->name;
        $animal->gender = $request->gender;
        $animal->birth = $request->birth;
        $animal->ref_id_specie = $request->ref_id_specie;
        $animal->ref_id_breed = $request->ref_id_breed;
        $animal->ref_id_user = $request->ref_id_user; // Se necessário

        $animal->save();

        return response()->json($animal, 201);
    }
}
