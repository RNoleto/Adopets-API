<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Vaccines;
use Illuminate\Http\Request;

class VaccinesController extends Controller
{
    public function index()
    {
        $vaccines = Vaccines::all();
        return response()->json($vaccines);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'local' => 'required|string|max:255',
            'date' => 'required|date',
            'ref_id_animal' => 'required|integer',
        ]);

        $vaccine = new Vaccines();
        $vaccine->name = $request->name;
        $vaccine->local = $request->local;
        $vaccine->date = $request->date;
        $vaccine->ref_id_animal = $request->ref_id_animal;

        $vaccine->save();

        return response()->json($vaccine, 201);
    }
}
