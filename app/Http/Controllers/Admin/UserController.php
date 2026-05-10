<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('role', '!=', 'admin')->get(); // Mengambil data petani saja
        return view('admin.users.index', compact('users'));
    }

    public function destroy($id)
    {
        User::destroy($id);
        return redirect()->back()->with('success', 'User berhasil dihapus');
    }
}
