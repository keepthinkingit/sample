<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;
use App\Http\Requests;

class UsersController extends Controller
{
    public function create()
    {
        return view('users.create');
    }
}
