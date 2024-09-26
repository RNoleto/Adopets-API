<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Vaccines;
use Illuminate\Http\Request;

class VaccinesController extends Controller
{
    public function index()
    {
        $vaccines = Vaccines::whereNull('deleted_at')->get();
        return response()->json($vaccines);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'date' => 'required|date',
            'ref_id_animal' => 'required|integer',
        ]);

        $vaccine = new Vaccines();
        $vaccine->name = $request->name;
        $vaccine->date = $request->date;
        $vaccine->ref_id_animal = $request->ref_id_animal;

        $vaccine->save();

        return response()->json($vaccine, 201);
    }

    public function show($id)
    {
        $vaccine = Vaccines::find($id);

        if (!$vaccine) {
            return response()->json(['message' => 'Vacina não encontrada'], 404);
        }

        return response()->json($vaccine);
    }

    public function getByPetId($petId)
    {
        $vaccines = Vaccines::where('ref_id_animal', $petId)->whereNull('deleted_at')->get();

        if ($vaccines->isEmpty()) {
            return response()->json(['message' => 'Nenhuma vacina encontrada para este pet'], 404);
        }

        return response()->json($vaccines);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'date' => 'required|date',
            'ref_id_animal' => 'required|integer',
        ]);

        $vaccine = Vaccines::find($id);

        if (!$vaccine) {
            return response()->json(['message' => 'Vacina não encontrada'], 404);
        }

        $vaccine->name = $request->name;
        $vaccine->date = $request->date;
        $vaccine->ref_id_animal = $request->ref_id_animal;

        $vaccine->save();

        return response()->json($vaccine);
    }

    public function destroy($id)
    {
        $vaccine = Vaccines::find($id);

        if (!$vaccine) {
            return response()->json(['message' => 'Vacina não encontrada'], 404);
        }

        $vaccine->delete();

        return response()->json(['message' => 'Vacina deletada com sucesso']);
    }
}
