<?php

namespace App\Http\Controllers;

use App\Models\BusPickupDropPoint;
use App\Models\BusStation;
use Illuminate\Http\Request;

class BusPickupDropPointController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            abort_unless($request->user()->role === 'admin', 403);

            return $next($request);
        });
    }

    public function index()
    {
        $pickupDropPoints = BusPickupDropPoint::with('busStation')->orderBy('id')->get();

        return view('bus_pickup_drop_points.index', compact('pickupDropPoints'));
    }

    public function create()
    {
        $stations = BusStation::orderBy('name')->get();

        return view('bus_pickup_drop_points.create', compact('stations'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'bus_station_id' => 'required|exists:bus_stations,id',
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
        ]);

        BusPickupDropPoint::create($validated);

        return redirect()->route('bus_pickup_drop_points.index')
            ->with('success', 'Pickup/drop point created successfully.');
    }

    public function edit(BusPickupDropPoint $busPickupDropPoint)
    {
        $stations = BusStation::orderBy('name')->get();

        return view('bus_pickup_drop_points.edit', compact('busPickupDropPoint', 'stations'));
    }

    public function update(Request $request, BusPickupDropPoint $busPickupDropPoint)
    {
        $validated = $request->validate([
            'bus_station_id' => 'required|exists:bus_stations,id',
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
        ]);

        $busPickupDropPoint->update($validated);

        return redirect()->route('bus_pickup_drop_points.index')
            ->with('success', 'Pickup/drop point updated successfully.');
    }

    public function destroy(BusPickupDropPoint $busPickupDropPoint)
    {
        $busPickupDropPoint->delete();

        return redirect()->route('bus_pickup_drop_points.index')
            ->with('success', 'Pickup/drop point deleted successfully.');
    }
}
