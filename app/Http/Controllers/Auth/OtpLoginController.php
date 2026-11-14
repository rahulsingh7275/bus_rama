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
use Illuminate\Support\Facades\Log;
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
    // public function sendOtp(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'mobile' => 'required|digits:10'
    //     ]);

    //     if ($validator->fails()) {
    //         return back()->withErrors($validator)
    //                      ->withInput();
    //     }

    //     $user = User::where('mobile', $request->mobile)->first();

    //     if (!$user) {
    //         return back()->with('error', 'Mobile number is not registered.');
    //     }

    //     $existingOtp = LoginOtp::where('user_id', $user->id)->latest()->first();
    //     if ($existingOtp && Carbon::now()->lt($existingOtp->updated_at->copy()->addSeconds(60))) {
    //         $resendAvailableAt = $existingOtp->updated_at->copy()->addSeconds(60)->timestamp;

    //         return back()->withInput()
    //                      ->with('otp_mobile', $user->mobile)
    //                      ->with('resendAvailableAt', $resendAvailableAt)
    //                      ->with('error', 'Please wait before requesting another OTP.');
    //     }

    //     $otp = (string) random_int(100000, 999999);

    //     DB::transaction(function () use ($user, $otp) {

    //         // Remove previous OTP
    //         LoginOtp::where('user_id', $user->id)->delete();

    //         // Save new OTP as a hash
    //         LoginOtp::create([
    //             'user_id' => $user->id,
    //             'otp_hash' => Hash::make($otp),
    //             'expires_at' => Carbon::now()->addMinutes(5)
    //         ]);
    //     });

    //     /*
    //      * Send OTP using SMS Gateway here.
    //      *
    //      * Example:
    //      * $this->sendSms($user->mobile, $otp);
    //      */

    //     // For development only, do not expose OTP in production.
    //     // Integrate your SMS provider before enabling real login.

    //     $request->session()->put('otp_mobile', $user->mobile);

    //     return redirect()->route('otp.verify.page', $user->id)
    //                      ->with('success', 'OTP sent successfully.'.$otp);
    // }

    // // Show OTP verification page
    // public function showVerify($userId)
    // {
    //     $otpRecord = LoginOtp::where('user_id', $userId)
    //                         ->latest()
    //                         ->first();

    //     $resendAvailableAt = $otpRecord
    //         ? $otpRecord->updated_at->copy()->addSeconds(60)->timestamp
    //         : Carbon::now()->timestamp;

    //     return view('auth.otp-verify', compact(
    //         'userId',
    //         'resendAvailableAt'
    //     ));
    // }

    // Verify OTP
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'access_token' => 'required|string',
        ]);

        $authKey = config('services.msg91.auth_key');
        if (!$authKey) {
            Log::error('MSG91 auth key is not configured.');

            return response()->json([
                'status' => false,
                'message' => 'MSG91 is not configured. Please contact support.',
            ], 500);
        }

        $caBundle = config('services.msg91.ca_bundle');
        if ($caBundle && !is_readable($caBundle)) {
            Log::error('MSG91 CA bundle is not readable.', ['path' => $caBundle]);

            return response()->json([
                'status' => false,
                'message' => 'MSG91 connection is not configured correctly. Please contact support.',
            ], 500);
        }

        $curl = curl_init();
        if ($curl === false) {
            Log::error('Unable to initialize cURL for MSG91 verification.');

            return response()->json([
                'status' => false,
                'message' => 'Unable to initialize MSG91 connection.',
            ], 500);
        }

        $curlOptions = [
            CURLOPT_URL => 'https://control.msg91.com/api/v5/widget/verifyAccessToken',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_CONNECTTIMEOUT => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_FOLLOWLOCATION => false,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_POST => true,
            CURLOPT_SSL_VERIFYPEER => true,
            CURLOPT_SSL_VERIFYHOST => 2,
            CURLOPT_POSTFIELDS => json_encode([
                'authkey' => $authKey,
                'access-token' => $request->access_token,
            ]),
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json',
                'Accept: application/json',
            ],
        ];

        if ($caBundle) {
            $curlOptions[CURLOPT_CAINFO] = $caBundle;
        }

        curl_setopt_array($curl, $curlOptions);

        $response = curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $curlError = curl_error($curl);
        $curlErrorNumber = curl_errno($curl);

        curl_close($curl);

        if ($response === false) {
            Log::error('MSG91 verification request failed.', [
                'curl_errno' => $curlErrorNumber,
                'curl_error' => $curlError,
            ]);

            return response()->json([
                'status' => false,
                'message' => 'MSG91 connection error.',
            ], 500);
        }

        $result = json_decode($response, true);
        // MSG91 verification response check
        if (
            $httpCode !== 200 ||
            !is_array($result) ||
            ($result['type'] ?? '') !== 'success'
        ) {
            Log::warning('MSG91 rejected access-token verification.', [
                'http_code' => $httpCode,
            ]);

            return response()->json([
                'status' => false,
                'message' => 'OTP token verification failed.',
            ], 401);
        }

        // Verified mobile number
        $verifiedMobile = $result['message'] ?? null;

        if (!is_string($verifiedMobile) && !is_numeric($verifiedMobile)) {
            return response()->json([
                'status' => false,
                'message' => 'Mobile number not received from MSG91.',
            ], 401);
        }

        $mobile = preg_replace('/\D+/', '', (string) $verifiedMobile);
        if (strlen($mobile) === 12 && substr($mobile, 0, 2) === '91') {
            $mobile = substr($mobile, 2);
        }

        if (strlen($mobile) !== 10) {
            return response()->json([
                'status' => false,
                'message' => 'MSG91 returned an invalid mobile number.',
            ], 401);
        }

        // Find existing user
        $user = User::where('mobile', $mobile)->first();

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'User not registered.',
            ], 404);
        }


        // Login user
        Auth::login($user);

        // Regenerate session ID
        $request->session()->regenerate();

        return response()->json([
            'status' => true,
            'redirect' => redirect()->intended('/home')->getTargetUrl(),
        ]);
    }

    // public function resendOtp($userId)
    // {
    //     $user = User::findOrFail($userId);

    //     $otpRecord = LoginOtp::where('user_id', $user->id)
    //                         ->latest()
    //                         ->first();

    //     if (!$otpRecord) {
    //         return back()->with('error', 'Please request a new OTP.');
    //     }

    //     // Check 60 seconds cooldown
    //     $availableAt = $otpRecord->updated_at->copy()->addSeconds(60);

    //     if (Carbon::now()->lt($availableAt)) {

    //         $remaining = Carbon::now()->diffInSeconds($availableAt);

    //         return back()->with(
    //             'error',
    //             "Please wait {$remaining} seconds before requesting another OTP."
    //         );
    //     }

    //     // Generate new OTP
    //     $otp = (string) random_int(100000, 999999);

    //     $otpRecord->update([
    //         'otp_hash' => Hash::make($otp),
    //         'expires_at' => Carbon::now()->addMinutes(5),
    //         'is_verified' => false
    //     ]);

    //     // Send OTP using SMS Gateway
    //     // $this->sendSms($user->mobile, $otp);

    //     return back()->with('success', 'New OTP sent successfully.'.$otp);
    // }

}