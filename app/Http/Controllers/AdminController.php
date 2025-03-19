<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function home() {
        $listadmin = User::where('role', 'admin')->get();
        return view('admin.home', compact('listadmin'));
    }
}
