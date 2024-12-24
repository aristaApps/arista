<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $userCount = User::count(); // Menghitung total user
        return view('dashboard', compact('userCount')); // Pastikan nama view sesuai
    }
}
