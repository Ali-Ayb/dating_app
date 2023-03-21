<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

use App\Models\User;

class AuthController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('auth:api', ['except' => ['login', 'register']]);
    // }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        $credentials = $request->only('email', 'password');

        $token = Auth::attempt($credentials);
        if (!$token) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
            ], 401);
        }

        $user = Auth::user();

        return response()->json([
            'status' => 'success',
            'user' => $user,
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ]);
    }

    function signup(Request $request)
    {
        $user = new User;

        if ($request->email && $request->password && $request->name) {
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);

            $user->location = $request->location;
            $user->birth_date = $request->birth_date;
            $user->optional_img1 = $request->optional_img1;
            $user->optional_img2 = $request->optional_img2;
            $user->optional_img3 = $request->optional_img3;
            $user->gender = $request->gender;
            $user->bio = $request->bio;

            $user->profile_img = $request->profile_img ? $request->profile_img : "NA";

            $image_data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $user->profile_img));

            $filename = uniqid() . '.jpg';

            Storage::disk('public')->put('images/' . $filename, $image_data);


            if ($user->save()) {
                return response()->json([
                    "status" => 'success',
                    "data" => $user
                ]);
            }
        }
        return response()->json([
            "status" => 0,
            "data" => "Error -Some Data is missing"
        ], 400);
    }

    // public function register(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'email' => 'required|string|email|max:255|unique:users',
    //         'password' => 'required|string|min:6',
    //     ]);

    //     $user = User::create([
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'email' => $request->email,
    //         'password' => Hash::make($request->password),
    //     ]);

    //     $token = Auth::login($user);
    //     return response()->json([
    //         'status' => 'success',
    //         'message' => 'User created successfully',
    //         'user' => $user,
    //         'authorisation' => [
    //             'token' => $token,
    //             'type' => 'bearer',
    //         ]
    //     ]);
    // }

    // public function me()
    // {
    //     return response()->json(auth()->user());
    // }

    public function logout()
    {
        Auth::logout();
        return response()->json([
            'status' => 'success',
            'message' => 'Successfully logged out',
        ]);
    }

    public function refresh()
    {
        return response()->json([
            'status' => 'success',
            'user' => Auth::user(),
            'authorisation' => [
                'token' => Auth::refresh(),
                'type' => 'bearer',
            ]
        ]);
    }
}
