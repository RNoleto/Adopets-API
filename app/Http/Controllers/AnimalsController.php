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
            'gender' => 'required|string|max:6',
            'birth' => 'required|date', 
            'specie' => 'required|string',
            'breed' => 'required|string',
            'chip_number' => 'nullable|regex:/^\d{1,20}$/',
            'status' => 'required|integer',
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
        $animal->status = $validatedData['status'];
        $animal->ref_id_user = $validatedData['ref_id_user'];
        
        $animal->save();

        return response()->json($animal, 201);
    }

    public function show($id)
    {
        $animal = Animals::find($id);

        if(!$animal){
            return response()->json(['message' => 'Animal não encontrado'], 404);
        }

        return response()->json($animal);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'gender' => 'required|string|max:6',
            'birth' => 'required|date', 
            'specie' => 'required|string',
            'breed' => 'required|string',
            'chip_number' => 'nullable|regex:/^\d{1,20}$/',
            'status' => 'required|integer|in:0,1',
            'ref_id_user' => 'required|integer',
        ]);

        $animal = Animals::find($id);
        if(!$animal){
            return response()->json(['message' => 'Animal não encontrado'], 404);
        }

        $animal->name = $request->name;
        $animal->gender = $request->gender;
        $animal->birth = $request->birth;
        $animal->specie = $request->specie;
        $animal->breed = $request->breed;
        $animal->chip_number = $request->chip_number;
        $animal->status = $request->status;
        $animal->ref_id_user = $request->ref_id_user;

        $animal->save();

        return response()->json($animal);
    }

    public function delete($id)
    {
        $animal = Animals::find($id);

        if(!$animal){
            return response()->json(['message' => 'Animal não encontrado'], 404);
        }

        $animal->ativo = '0';
        $animal->save();

        $animal->delete();
        
        return response()->json(['message' => 'Animal deletado com sucesso']);
    }
}
