<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminController extends Controller
{
    
    public function index()
    {
        //Go to de route /Admin/Index and show the view Admin/Index
        return Inertia::render('Admin/Index');

    }
}
