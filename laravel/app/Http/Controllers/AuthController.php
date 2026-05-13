<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // app.post((req, res) => {})
    public function register(Request $request): JsonResponse
    {
        $data = $request->validate([
            'name' => 'required|max:255|string',
            'email' => 'required|unique:users|email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'email' => $data['email'],
            'name' => $data['name'],
            'password' => Hash::make($data['password']),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'user' => $user,
            'token_type' => "Bearer"
        ], 201);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function login(Request $request)
    {
        // валидация полей email, password (из требований оставить только "обязательное поле" и тип данных)
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $data['email'])->first();

        if (!$user || !Hash::check($data['password'], $user->password)) {
            return response()->json([
                'message' => 'Почта или пароль неправильные'
            ], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'user' => $user,
            'token_type' => "Bearer"
        ], 200);

        // проверьте наличие юзера (идентично с JS) и верните 401 если его нет с сообщением (message) "Почта или пароль неправильный"
    }

    /**
     * Store a newly created resource in storage.
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Сессия успешно уничтожена'], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
