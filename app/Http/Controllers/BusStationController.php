<?php

namespace App\Http\Controllers;

use App\Models\BusStation;
use Illuminate\Http\Request;

class BusStationController extends Controller
{
    public function index() {
        $stations = BusStation::orderBy('id','ASC')->get();
        return view('bus_stations.index', compact('stations'));
    }

    public function create() {
        return view('bus_stations.create');
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
        ]);

        BusStation::create($request->all());

        return redirect()->route('bus_stations.index')->with('success', 'Bus Station created successfully.');
    }

    public function edit(BusStation $busStation) {
        return view('bus_stations.edit', compact('busStation'));
    }

    public function update(Request $request, BusStation $busStation) {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
        ]);

        $busStation->update($request->all());

        return redirect()->route('bus_stations.index')->with('success', 'Bus Station updated successfully.');
    }

    public function destroy(BusStation $busStation) {
        $busStation->delete();

        return redirect()->route('bus_stations.index')->with('success', 'Bus Station deleted successfully.');
    }
}