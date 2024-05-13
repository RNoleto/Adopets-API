<?php

namespace App\Http\Controllers;

use App\Events\UserRegistered;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{

    //Função para listar todos os usuarios
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }

    public function __invoke(RegisterRequest $request)
    {
        $input = $request->validated();

        // Hash da senha antes de armazená-la no banco de dados
        $input['password'] = Hash::make($input['password']);


        $user = User::query()->create($input);

        UserRegistered::dispatch($user);
        return new UserResource($user);
    }
}
