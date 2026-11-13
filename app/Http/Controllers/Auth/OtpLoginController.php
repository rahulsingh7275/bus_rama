<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\LoginOtp;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class OtpLoginController extends Controller
{
    // Show login page
    public function showLogin(Request $request)
    {
        $mobile = old('mobile', $request->session()->get('otp_mobile'));
        $resendAvailableAt = null;
        $resendMobile = null;

        if ($mobile) {
            $user = User::where('mobile', $mobile)->first();
            $otpRecord = $user
                ? LoginOtp::where('user_id', $user->id)->latest()->first()
                : null;

            if ($otpRecord) {
                $resendAvailableAt = $otpRecord->updated_at->copy()->addSeconds(60)->timestamp;
                $resendMobile = $user->mobile;
            }
        }

        return view('auth.otp-login', compact('mobile', 'resendAvailableAt', 'resendMobile'));
    }

    // Generate and send OTP
    public function sendOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobile' => 'required|digits:10'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)
                         ->withInput();
        }

        $user = User::where('mobile', $request->mobile)->first();

        if (!$user) {
            return back()->with('error', 'Mobile number is not registered.');
        }

        $existingOtp = LoginOtp::where('user_id', $user->id)->latest()->first();
        if ($existingOtp && Carbon::now()->lt($existingOtp->updated_at->copy()->addSeconds(60))) {
            $resendAvailableAt = $existingOtp->updated_at->copy()->addSeconds(60)->timestamp;

            return back()->withInput()
                         ->with('otp_mobile', $user->mobile)
                         ->with('resendAvailableAt', $resendAvailableAt)
                         ->with('error', 'Please wait before requesting another OTP.');
        }

        $otp = (string) random_int(100000, 999999);

        DB::transaction(function () use ($user, $otp) {

            // Remove previous OTP
            LoginOtp::where('user_id', $user->id)->delete();

            // Save new OTP as a hash
            LoginOtp::create([
                'user_id' => $user->id,
                'otp_hash' => Hash::make($otp),
                'expires_at' => Carbon::now()->addMinutes(5)
            ]);
        });

        /*
         * Send OTP using SMS Gateway here.
         *
         * Example:
         * $this->sendSms($user->mobile, $otp);
         */

        // For development only, do not expose OTP in production.
        // Integrate your SMS provider before enabling real login.

        $request->session()->put('otp_mobile', $user->mobile);

        return redirect()->route('otp.verify.page', $user->id)
                         ->with('success', 'OTP sent successfully.'.$otp);
    }

    // Show OTP verification page
    public function showVerify($userId)
    {
        $otpRecord = LoginOtp::where('user_id', $userId)
                            ->latest()
                            ->first();

        $resendAvailableAt = $otpRecord
            ? $otpRecord->updated_at->copy()->addSeconds(60)->timestamp
            : Carbon::now()->timestamp;

        return view('auth.otp-verify', compact(
            'userId',
            'resendAvailableAt'
        ));
    }

    // Verify OTP
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'otp' => 'required|digits:6'
        ]);

        $user = User::findOrFail($request->user_id);

        $otpRecord = LoginOtp::where('user_id', $user->id)
                             ->latest()
                             ->first();

        if (!$otpRecord) {
            return back()->with('error', 'OTP not found. Please request again.');
        }

        if ($otpRecord->is_verified) {
            return back()->with('error', 'OTP already used.');
        }

        if (Carbon::now()->greaterThan($otpRecord->expires_at)) {
            return back()->with('error', 'OTP expired. Please request again.');
        }

        if (!Hash::check($request->otp, $otpRecord->otp_hash)) {
            return back()->with('error', 'Invalid OTP.');
        }

        // Mark OTP as verified
        $otpRecord->update([
            'is_verified' => true
        ]);

        // Login user
        Auth::login($user);

        // Regenerate session ID
        $request->session()->regenerate();

        return redirect()->intended('/home');
    }

    public function resendOtp($userId)
    {
        $user = User::findOrFail($userId);

        $otpRecord = LoginOtp::where('user_id', $user->id)
                            ->latest()
                            ->first();

        if (!$otpRecord) {
            return back()->with('error', 'Please request a new OTP.');
        }

        // Check 60 seconds cooldown
        $availableAt = $otpRecord->updated_at->copy()->addSeconds(60);

        if (Carbon::now()->lt($availableAt)) {

            $remaining = Carbon::now()->diffInSeconds($availableAt);

            return back()->with(
                'error',
                "Please wait {$remaining} seconds before requesting another OTP."
            );
        }

        // Generate new OTP
        $otp = (string) random_int(100000, 999999);

        $otpRecord->update([
            'otp_hash' => Hash::make($otp),
            'expires_at' => Carbon::now()->addMinutes(5),
            'is_verified' => false
        ]);

        // Send OTP using SMS Gateway
        // $this->sendSms($user->mobile, $otp);

        return back()->with('success', 'New OTP sent successfully.'.$otp);
    }

}