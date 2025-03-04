<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function user($id, $nama) {
        return view('user')
        -> with('id', $id)
        -> with('nama', $nama);
    }
}
