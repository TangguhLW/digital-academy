<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class PageController extends Controller
{
    public function prosedur()
    {
        return view('pages.prosedur');
    }

    public function about()
    {
        $recentUsers = User::where('role', 'siswa')->latest()->take(3)->get();
        $totalUsers = User::where('role', 'siswa')->count();
        return view('pages.about', compact('recentUsers', 'totalUsers'));
    }
}
