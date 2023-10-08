<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

/*
|
| Nama  : Davin Wahyu Wardana
| NIM   : 6706223003
| Kelas : D3IF-4603
|
*/

class UserController extends Controller
{
    public function index() {
        $users = User::all();
        return view('user.daftarPengguna', compact('users'));
    }

    public function showUser($username) {
        $user = User::where('username', $username)->firstOrFail();
        return view('user.infoPengguna', compact('user'));
    }

    public function create()
    {
    return view('user.registrasi');
    }
}
