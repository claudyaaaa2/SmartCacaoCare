<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;


class UserController extends Controller
{
    public function index()
    {
        $users = User::where('role', 'user')
                     ->withCount('hasilAnalisis')
                     ->latest()
                     ->get();

        return view('admin.user.index', compact('users'));
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('admin.user.index')
                         ->with('success', 'User berhasil dihapus!');
    }
}