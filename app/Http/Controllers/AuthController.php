<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|unique:users,email',
            'password' => 'required|string|confirmed'
        ]);

        $novoUsuario = [
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password'])
        ];

        $user = User::create($novoUsuario);

        if ($user) {
            return Response()->json([
                'status' => true,
                'message' => 'Usuário cadastro com sucesso!',
                'usuario' => $user
            ]);
        }

        return Response()->json([
            'status' => false,
            'message' => 'Não foi possivel cadastrar novo usuário!'
        ], 500);
    }

    public function login(Request $request)
    {
        $fields = $request->validate([
            'email' => 'required',
            'password' => 'required|string'
        ]);

        $user = User::where('email', $fields['email'])->first();

        if (!$user || !Hash::check($fields['password'], $user->password)) {
            return response()->json([
                'status' => false,
                'message' => 'E-mail/senha inválido(s)!'
            ], 401);
        }

        $token = $user->createToken('UsuarioLogado')->plainTextToken;

        return Response()->json([
            'status' => true,
            'usuario' => $user,
            'token' => $token
        ]);
    }

    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();

        return response()->json([
            'status' => true,
            'message' => 'Usuário deslogado com sucesso!'
        ]);
    }
}
