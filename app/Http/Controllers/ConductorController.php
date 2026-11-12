<?php

namespace App\Http\Controllers;

use App\Models\Conductor;
use App\Models\Bus;
use App\Models\User;
use Illuminate\Http\Request;

class ConductorController extends Controller
{
    public function index() {
        $conductors = Conductor::get();
        return view('conductors.index', compact('conductors'));
    }

    public function create() {
        $buses = Bus::all();
        return view('conductors.create', compact('buses'));
    }

    public function store(Request $request) {
        $request->validate([
            'bus_id' => 'required|exists:buses,id',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|max:255',
        ]);
        $user = new User;
        $user->role = 'conductor';
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->save();
        if($user->save()){
            Conductor::create(['bus_id'=>$request->bus_id,'user_id'=>$user->id]);
        }

        return redirect()->route('conductors.index')->with('success', 'Conductor created successfully.');
    }

    public function edit(Conductor $conductor) {
        $buses = Bus::all();
        return view('conductors.edit', compact('conductor', 'buses'));
    }

    public function update(Request $request, Conductor $conductor) {
        // Validate the request data
        $request->validate([
            'bus_id' => 'required|exists:buses,id',
            'name' => 'required|string|max:255',
            'password' => 'nullable' // Add validation for the password (optional and confirmed)
        ]);
    
        // Update the conductor's bus assignment
        $conductor->bus_id = $request->bus_id;
        $conductor->save();
    
        // Find the user associated with the conductor
        $user = User::find($conductor->user_id);
        $user->name = $request->name;
    
        // Check if a password is provided, if so, hash it and update
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }
    
        $user->save();
    
        // Redirect back with a success message
        return redirect()->route('conductors.index')->with('success', 'Conductor updated successfully.');
    }
    

    // public function destroy(Conductor $conductor) {
    //     $conductor->delete();

    //     return redirect()->route('conductors.index')->with('success', 'Conductor deleted successfully.');
    // }
}