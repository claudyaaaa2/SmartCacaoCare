<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\HasilAnalisis;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $totalAnalisis = HasilAnalisis::where('user_id', Auth::id())->count();

        $riwayatTerbaru = HasilAnalisis::where('user_id', Auth::id())
                            ->latest()
                            ->take(3)
                            ->get();

        return view('user.dashboard', compact(
            'totalAnalisis',
            'riwayatTerbaru'
        ));
    }
}