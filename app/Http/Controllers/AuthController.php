<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login_view()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // dd($request->all());

        //validate 
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        //login user here
        if (\Auth::attempt($request->only('email', 'password'))) {
            return redirect('home');
        }

        return redirect('login')->withError('Invalid Login');
    }

    public function register_view()
    {
        return view('auth.register');
    }

    public function profile_view()
    {
        $auth_admin_user_id = \Auth::user()->id;
        if (isset($auth_admin_user_id) && !empty($auth_admin_user_id)) {
            $adminuserdata = User::find($auth_admin_user_id);
            // dd($adminuserdata);
            // echo '<pre>';print_r($adminuserdata);echo '</pre>';die('developer is working');
        }
        return view('auth.profile');
    }

    public function update(User $user, Request $request)
    {

        //validate 
        $v = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id . ',id',
        ]);

        if ($v->fails()) {
            return redirect()->back()->withErrors($v->errors());
        } else {

            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'updated_at' => now()
            ]);

            return redirect('profile')->with('success', 'Profile updated successfully!');
        }
    }

    public function register(Request $request)
    {
        // dd($request->all());

        //validate
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users|email',
            'password' => 'required|confirmed'
        ]);

        //save in db
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => \Hash::make($request->password)
        ]);

        //login user here
        if (\Auth::attempt($request->only('email', 'password'))) {
            return redirect('home');
        }

        return redirect('register')->withError('Error');
    }

    public function logout()
    {
        \Session::flush();
        \Auth::logout();
        return redirect('');
    }
}
