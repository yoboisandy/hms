<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            // 'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $user = User::create([
            // 'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);



        return response()
            ->json(['message' => 'Registered Sucessfully']);
    }



    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'Invalid login details'
            ], 401);
        }

        $user = User::where('email', $request['email'])->firstOrFail();

        $token = $user->createToken('auth_token')->plainTextToken;

        $role = User::where('email', $request['email'])->get('role')->firstOrFail();

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'role' => $role->role,
            'user' => Auth::user(),
        ]);
    }

    public function logout(Request $request)
    {
        if (!empty($request->token) && auth()->user()) {
            auth()->user()->tokens()->where('id', $request->token)->delete();
        }


        return response()->json(['message' => 'You have successfully logged out and the token was successfully deleted']);
    }
}
