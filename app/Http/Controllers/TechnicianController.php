<?php

namespace App\Http\Controllers;

use App\Models\Technician;
use App\Http\Requests\StoreTechnicianRequest;
use App\Http\Requests\UpdateTechnicianRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TechnicianController extends Controller
{
    public function home(){
        $data = [
            'pageTitle' => 'Home'
        ];
        return view('technician.back.pages.home', $data);
    }

    public function LogoutHandler(Request $request)
    {
        Auth::guard('technician')->logout(); // Cierra la sesión del guard 'admin'
        $request->session()->invalidate(); // Invalida la sesión
        $request->session()->regenerateToken(); // Regenera el token CSRF

        if (!Auth::guard('technician')->check()) {
            session()->flash('success', 'You are logged out !!!');
        } else {
            session()->flash('fail', 'Logout failed. Try again.');
        }

        return redirect()->route('tLogin');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTechnicianRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Technician $technician)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Technician $technician)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTechnicianRequest $request, Technician $technician)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Technician $technician)
    {
        //
    }
}
