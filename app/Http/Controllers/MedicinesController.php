<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Medicines;
use Illuminate\Http\Request;

class MedicinesController extends Controller
{
    public function index()
    {
        $medicines = Medicines::whereNull('deleted_at')->get();
        return response()->json($medicines);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'medicine' => 'required|string|max:255',
            'date' => 'required|date',
            'ref_id_animal' => 'required|integer',
        ]);

        $medicine = new Medicines();
        $medicine->name = $request->name;
        $medicine->medicine = $request->medicine;
        $medicine->date = $request->date;
        $medicine->ref_id_animal = $request->ref_id_animal;

        $medicine->save();

        return response()->json($medicine, 201);
    }

    public function show($id)
    {
        $medicine = Medicines::find($id);

        if(!$medicine){
            return response()->json(['message' => 'Medicamento não encontrado'], 404);
        }

        return response()->json($medicine);
    }

    public function getByPetId($petId)
    {
        $medicines = Medicines::where('ref_id_animal', $petId)->whereNull('deleted_at')->get();

        if($medicines->isEmpty()){
            return response()->json(['message' => 'Nenhum medicamento encontrado para este pet'], 404);
        }

        return response()->json($medicines);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'medicine' => 'required|string|max:255',
            'date' => 'required|date',
            'ref_id_animal' => 'required|integer',
        ]);

        $medicine = Medicines::find($id);

        if (!$medicine) {
            return response()->json(['message' => 'Vacina não encontrada'], 404);
        }

        $medicine->name = $request->name;
        $medicine->local = $request->local;
        $medicine->date = $request->date;
        $medicine->ref_id_animal = $request->ref_id_animal;

        $medicine->save();

        return response()->json($medicine);
    }


    public function destroy($id)
    {
        $medicine = Medicines::find($id);

        if (!$medicine) {
            return response()->json(['message' => 'Medicamento não encontrada'], 404);
        }

        $medicine->delete();

        return response()->json(['message' => 'Medicamento deletado com sucesso']);
    }

}
