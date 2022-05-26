<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    public function redirect()
    {
        if (Auth::id()) {
            if (Auth::user()->usertype == 0) {
                $doctors = Doctor::all();
                return view("user.home", compact("doctors"));
            } else {
                return view("admin.home");
            }
        } else {
            return redirect()->back();
        }
    }


    public function index()
    {
        if (Auth::id()) {
            return redirect("home");
        } else {
            $doctors = Doctor::all();
            return view("user.home", compact("doctors"));
        }
    }
}
