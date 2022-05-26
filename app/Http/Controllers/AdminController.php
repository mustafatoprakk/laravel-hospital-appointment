<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $doctors = Doctor::all();
        return view("admin.doctors", compact("doctors"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.create_doctor");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $doctor = new Doctor();

        $image = $request->image;
        $imagename = time() . "." . $image->getClientOriginalExtension();
        $request->image->move('doctorimage', $imagename);
        $doctor->image = $imagename;

        $doctor->name = $request->name;
        $doctor->phone = $request->phone;
        $doctor->room = $request->room;
        $doctor->specialty = $request->specialty;
        $doctor->save();

        return redirect()->back()->with("message", "Doctor created");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $doctor = Doctor::find($id);
        unlink("doctorimage/" . $doctor->image);
        $doctor->delete();
        return redirect()->back()->with("message", "Doctor deleted.");
    }

    // appointment
    public function appointment()
    {
        $appointments = Appointment::all();
        $doctors = Doctor::all();
        $users = User::all();
        return view("admin.appointment", compact("appointments", "doctors", "users"));
    }
    public function cancelAppointment($id)
    {
        Appointment::find($id)->update([
            "status" => "canceled",
        ]);

        return redirect()->back()->with("message", "Appointment canceled");
    }
    public function approved($id)
    {
        Appointment::find($id)->update([
            "status" => "approved",
        ]);

        return redirect()->back()->with("message", "Appointment confirmed");
    }
}
