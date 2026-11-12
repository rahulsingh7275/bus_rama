<?php

namespace App\Http\Controllers;

use App\Models\PaymentSetting;
use App\Models\WebsiteSetting;
use Illuminate\Http\Request;

class WebsiteSettingController extends Controller
{
    public function edit()
    {
        // Retrieve the first (or only) record from website_setting
        $setting = WebsiteSetting::first();
        $gateway_list = PaymentSetting::select('gateway')->distinct('gateway')->get();
        $gateway_mode_list = PaymentSetting::select('mode')->distinct('mode')->get();
        
        return view('website_setting', compact('setting','gateway_list','gateway_mode_list'));
    }

    public function update(Request $request)
    {
        // Validate the form data
        $request->validate([
            'company_name' => 'required|string|max:255',
            'company_contact' => 'required|string|max:255',
            'company_email' => 'required|string|max:255',
            'company_address' => 'required|string|max:255',
            'ticket_prefix' => 'required|string|max:255',
            // 'payment_gateway' => 'required|string|max:255',
            // 'payment_gateway_mode' => 'required|string|max:255',
            // 'payment_gateway_contact' => 'required|string|max:10',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // Validate the logo
        ]);

        // Update or create the website setting
        $setting = WebsiteSetting::first();
        if(!$setting){
            $setting = new WebsiteSetting;
        }
        $setting->company_name = $request->company_name;
        $setting->company_contact = $request->company_contact;
        $setting->company_email = $request->company_email;
        $setting->company_address = $request->company_address;
        $setting->ticket_prefix = $request->ticket_prefix;
        // $setting->payment_gateway = $request->payment_gateway;
        // $setting->payment_gateway_mode = $request->payment_gateway_mode;
        // $setting->payment_gateway_contact = $request->payment_gateway_contact;

        if ($request->hasFile('logo')) {
            // Store the logo and get the path
            $setting->logo = $request->file('logo')->store('logos', 'public');
        }

        $setting->save();

        return redirect()->back()->with('success', 'Settings updated successfully');
    }
}