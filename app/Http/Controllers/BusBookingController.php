<?php

namespace App\Http\Controllers;

use App\Models\Bus;
use App\Models\BusStation;
use Illuminate\Http\Request;

class BusBookingController extends Controller
{
    public function search_buses(Request $request){
        $buses = Bus::with([
            'fromStation.busPickupDropPoints',
            'toStation.busPickupDropPoints',
            'stopages',
        ])->get();
        $stations = BusStation::all();
        return view('buses.search-buses', compact('buses','stations'));
    }
    public function admin(Request $request){
        return view('admin.complaint.complaints');
    }
}