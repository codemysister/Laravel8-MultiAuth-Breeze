<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function Index()
    {
        return view('admin.admin_login');
    }

    public function Login(Request $request)
    {
        $arr = $request->all();

        if (Auth::guard('admin')->attempt(['email' => $arr['email'], 'password' => $arr['password']])) {
            return redirect()->route('admin.dashboard')->with('message', 'Login Successfully');
        } else {
            return redirect()->back()->with('message', 'Invalid Username and Password');
        }
    }

    public function Dashboard()
    {
        return view('admin.index');
    }

    public function Logout()
    {
        Auth::guard('admin')->logout();
        return Redirect()->route('admin.admin_form')->with('message', 'Logout Successfully');
    }

    public function Registration()
    {
        return view('admin.admin_registration');
    }

    public function RegistrationCreate(Request $request)
    {
        Admin::insert([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'created_at' => Carbon::now()
        ]);

        return Redirect()->route('admin.admin_form')->with('message', 'Create Account Successfully');
    }
}
