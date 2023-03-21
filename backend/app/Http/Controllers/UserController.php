<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class UserController extends Controller
{
    function getMales()
    {
        $users = User::where('gender', 'male')->get();

        return response()->json([
            'success' => true,
            'data' => $users
        ]);

        // $id = Auth::id();
        // echo $id;

        // $id = Auth::user();
    }

    function test()
    {

        $id = Auth::id();
        echo $id;
    }

    function getFemales()
    {
        $users = User::where('gender', 'female')->get();

        return response()->json([
            'success' => true,
            'data' => $users
        ]);

        // $id = Auth::id();
        // echo $id;

        // $id = Auth::user();
    }
}
