<?php
namespace App\Http\Controllers;

use App\Models\PaymentSetting;
use Illuminate\Http\Request;

class PaymentSettingsController extends Controller
{
    public function index()
    {
        $settings = PaymentSetting::all();
        return view('payment_settings.index', compact('settings'));
    }

    public function create()
    {
        return view('payment_settings.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'gateway' => 'required|string',
            'mode' => 'required|string',
            'key_id' => 'required|string',
            'key_secret' => 'required|string',
        ]);

        PaymentSetting::create($request->all());
        return redirect()->route('payment-settings.index')->with('success', 'Payment setting added successfully');
    }

    public function edit(PaymentSetting $paymentSetting)
    {
        return view('payment_settings.edit', compact('paymentSetting'));
    }

    public function update(Request $request, PaymentSetting $paymentSetting)
    {
        $request->validate([
            'gateway' => 'required|string',
            'mode' => 'required|string',
            'key_id' => 'required|string',
            'key_secret' => 'required|string',
        ]);

        $paymentSetting->update($request->all());
        return redirect()->route('payment-settings.index')->with('success', 'Payment setting updated successfully');
    }

    public function destroy(PaymentSetting $paymentSetting)
    {
        $paymentSetting->delete();
        return redirect()->route('payment-settings.index')->with('success', 'Payment setting deleted successfully');
    }
}
