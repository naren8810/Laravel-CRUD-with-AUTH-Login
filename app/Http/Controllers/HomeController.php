<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alluser;

class HomeController extends Controller
{
    public function home_view()
    {
        $allusers = Alluser::all();

        return view('home', compact('allusers'));
    }

    public function add_user_view()
    {
        return view('allusers/adduser');
    }
    
    public function edit_user_view()
    {
        return view('allusers/edituser');
    }
}
