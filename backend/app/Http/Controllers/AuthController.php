<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public $model = User::class;

    public function register(Request $request)
    {
        $data = $request->validate($this->model::$validationRegisterInDatabase);
        $user = $this->model::where('email', $data['email'])->where('phone', $data['phone'])->whereNull('password')->first();
        if ($user) {
            $user['name'] = $data['name'];
            $user['permission_id'] = 2;
            $user['password'] = Hash::make($data['password']);
            $user->save();

            return response()->json(['success' => true], 201);
        }
        $data = $request->validate($this->model::$validationRegister);
        $this->model::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'permission_id' => 2,
            'password' => Hash::make($data['password'])
        ]);

        return response()->json(['success' => true], 201);
    }

    public function login(Request $request)
    {
        $data = $request->validate($this->model::$validationLogin);
        if (!Auth::attempt($request->only(['email', 'password']))) {
            return response()->json([
                'success' => false,
                'message' => 'Email and Password does not match.',
            ], 401);
        }
        $user = $this->model::where('email', $data['email'])->first();
        return response()->json([
            'success' => true,
            'token' => $user->createToken("api_token")->plainTextToken
        ], 200);
    }

    public function logout()
    {
        $user = Auth::user();
        $user->currentAccessToken()->delete();
        return response()->json(['success' => true], 200);
    }
}
