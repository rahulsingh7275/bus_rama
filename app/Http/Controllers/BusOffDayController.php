<?php

namespace App\Http\Controllers;

use App\Models\BusOffDay;
use App\Models\Bus;
use Illuminate\Http\Request;

class BusOffDayController extends Controller
{
    // Display a list of bus off days
    public function index()
    {
        $busOffDays = BusOffDay::with('bus')->get(); // Retrieve all bus off days with their related bus data
        return view('bus_off_days.index', compact('busOffDays')); // Pass the data to the view
    }

    // Show the form to create a new bus off day
    public function create()
    {
        $buses = Bus::all();
        return view('bus_off_days.create', compact('buses'));
    }

    // Store the new bus off day in the database
    public function store(Request $request)
    {
        $request->validate([
            'bus_id' => 'required|exists:buses,id',
            'off_date' => 'required|date|after_or_equal:today', // Allow today or future date
        ]);

        BusOffDay::create($request->all());

        return redirect()->route('bus-off-days.index')->with('success', 'Bus off day created successfully.');
    }

    // Show the form to edit an existing bus off day
    public function edit(BusOffDay $busOffDay)
    {
        $buses = Bus::all();
        return view('bus_off_days.edit', compact('busOffDay', 'buses'));
    }

    // Update the bus off day in the database
    public function update(Request $request, BusOffDay $busOffDay)
    {
        $request->validate([
            'bus_id' => 'required|exists:buses,id',
            'off_date' => 'required|date|after_or_equal:today', // Allow today or future date
        ]);

        $busOffDay->update($request->all());

        return redirect()->route('bus-off-days.index')->with('success', 'Bus off day updated successfully.');
    }

    // Delete a bus off day from the database
    public function destroy(BusOffDay $busOffDay)
    {
        $busOffDay->delete();

        return redirect()->route('bus-off-days.index')->with('success', 'Bus off day deleted successfully.');
    }
}