<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Animals;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        //listar todos os usuários
        $users = User::all();
        return response()->json($users);
    }

    public function show($id)
    {
        //Buscar um usuário pelo ID
        $user = User::find($id);

        if(!$user){
            return response()->json(['message' => 'Usuário não encontrado'], 404);
        }

        return response()->json($user);
    }

    public function animals($id)
    {
        //Buscar animais pertencentes ao usuário pelo ID
        $user = User::find($id);
        $animals = Animals::where('ref_id_user', $user->id)->get();
        if($animals->isEmpty()){
            return response()->json(['message' => 'Nenhum animal cadastrado por esse usuário'], 404);
        }
        return response()->json($animals);
    }

}
