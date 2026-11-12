<?php

namespace App\Http\Controllers;

use App\Models\Bus;
use App\Models\BusStation;
use App\Models\BusStopage;
use Illuminate\Http\Request;

class BusController extends Controller
{
    public function index() {
        $buses = Bus::all();
        return view('buses.index', compact('buses'));
    }

    public function create() {
        $busStations = BusStation::all();
        return view('buses.create',compact('busStations'));
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Bus::create($request->all());

        return redirect()->route('buses.index')->with('success', 'Bus created successfully.');
    }

    public function edit(Bus $bus) {
        $busStations = BusStation::all();
        return view('buses.edit', compact('bus','busStations'));
    }

    public function update(Request $request, Bus $bus) {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $bus->fill($request->all());
        $bus->save(); // This should trigger the updated event

        return redirect()->route('buses.index')->with('success', 'Bus updated successfully.');
    }

    public function destroy(Bus $bus) {
        $bus->delete();

        return redirect()->route('buses.index')->with('success', 'Bus deleted successfully.');
    }

}