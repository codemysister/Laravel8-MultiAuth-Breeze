<?php

namespace App\Http\Controllers;

use App\Models\Seller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class SellerController extends Controller
{
    public function Index()
    {
        return view('seller.seller_login');
    }

    public function Login(Request $request)
    {
        $arr = $request->all();


        if (Auth::guard('seller')->attempt(['email' => $arr['email'], 'password' => $arr['password']])) {
            return redirect()->route('seller.dashboard')->with('message', 'Login Successfully');
        } else {
            return redirect()->back()->with('message', 'Invalid Username and Password');
        }
    }

    public function Dashboard()
    {
        return view('seller.index');
    }

    public function Logout()
    {
        Auth::guard('seller')->logout();
        return Redirect()->route('seller.seller_form')->with('message', 'Logout Successfully');
    }

    public function Registration()
    {
        return view('seller.seller_registration');
    }

    public function RegistrationCreate(Request $request)
    {
        Seller::insert([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'created_at' => Carbon::now()
        ]);

        return Redirect()->route('seller.seller_form')->with('message', 'Create Account Successfully');
    }
}
