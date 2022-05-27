<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
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

    //appointemnt
    public function goToAppointment()
    {
        $doctors = Doctor::all();
        return view("user.appointment", compact("doctors"));
    }
    public function createAppointment(Request $request)
    {
        if (Auth::id()) {
            $user_id = Auth::user()->id;
        }

        Appointment::create([
            "name" => $request->name,
            "email" => $request->email,
            "phone" => $request->phone,
            "doctor_id" => $request->doctor,
            "date" => $request->date,
            "message" => $request->message,
            "status" => "In progress",
            "user_id" => $user_id
        ]);

        return redirect()->back()->with("message", "Appointment request successfuly. We will contact with you soon.");
    }
    public function appointment()
    {
        $appointments = Appointment::where("user_id", Auth::user()->id)->get();
        $doctors = Doctor::all();
        return view("user.appointment_list", compact("appointments", "doctors"));
    }
    public function cancelAppointment($id)
    {
        $appointemrnt = Appointment::find($id);
        $appointemrnt->delete();
        return redirect()->back()->with("message", "Appointment deleted");
    }
}
