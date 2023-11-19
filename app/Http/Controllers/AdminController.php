<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Inertia\Inertia;
use App\Models\User;

class AdminController extends Controller
{
    
    public function index(Request $request)
    {
        //select id, name, lastname, email, role from users where identification = %$request->term%
        if ($request->term) {
            $user = User::where('identification', 'LIKE', '%'.$request->term.'%')->get();
            return $user;
        } else {
            $user = [];
        }

        return Inertia::render('Admin/Index', [
            'users' => $user,
        ]);

    }

    public function update(Request $request)
    {
        $user = User::find($request->id);
        $user->rol = $request->rol;

        $user->save();
    }
}
