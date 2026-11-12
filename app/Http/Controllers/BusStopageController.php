<?php

namespace App\Http\Controllers;

use App\Models\Bus;
use App\Models\BusStopage;
use Illuminate\Http\Request;

class BusStopageController extends Controller
{
    public function index() {
        $stopages = BusStopage::orderBy('id','ASC')->get();
        return view('bus_stopages.index', compact('stopages'));
    }

    public function create() {
        $buses = Bus::all();
        return view('bus_stopages.create',compact('buses'));
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        BusStopage::create($request->all());

        return redirect()->route('bus_stopages.index')->with('success', 'Bus stopage created successfully.');
    }

    public function edit(BusStopage $busStopage) {
        $buses = Bus::all();
        return view('bus_stopages.edit', compact('busStopage','buses'));
    }

    public function update(Request $request, BusStopage $busStopage) {
        $request->validate([
            'name' => 'required|string|max:255',
            'bus_id' => 'required',
        ]);

        $busStopage->update($request->all());

        return redirect()->route('bus_stopages.index')->with('success', 'Bus stopage updated successfully.');
    }

    public function destroy(BusStopage $busStopage) {
        $busStopage->delete();

        return redirect()->route('bus_stopages.index')->with('success', 'Bus stopage deleted successfully.');
    }
}