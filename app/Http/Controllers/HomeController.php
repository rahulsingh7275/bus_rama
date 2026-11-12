<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\AssignOp\ShiftLeft;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::user()->role === 'user') {
            $tickets = Ticket::with(['fromStation', 'toStation', 'bus'])->orderBy('id','desc')
            ->where('user_id',Auth::user()->id)
            ->withTrashed()
            ->get();
            return view('home',compact('tickets'));
        }else{
            return redirect('admin/dashboard');
        }
    }
    public function adminDashboard()
    {
        $user = Auth::user();
        $allowed_buses = $user->conductorBusesList();
        $tickets['completed_tickets'] = Ticket::whereIn('bus_id',$allowed_buses)->whereNotNull('payment_id')->whereDate('travel_date', '<', Carbon::now())->count();
        $tickets['paid_tickets'] = Ticket::whereIn('bus_id',$allowed_buses)->whereNotNull('payment_id')->whereDate('travel_date', '>=', Carbon::now())->count();
        $tickets['unpaid_tickets'] = Ticket::whereIn('bus_id',$allowed_buses)->whereNull('payment_id')->count();
        $tickets['cancelled_tickets'] = Ticket::whereIn('bus_id',$allowed_buses)->whereNotNull('deleted_at')->withTrashed()->count();
        $tickets['all_tickets'] = Ticket::whereIn('bus_id',$allowed_buses)->withTrashed()->count();
        return view('tickets.admin-dashboard',$tickets);
    }
    public function profile()
    {
        return view('profile');
    }
    public function welcome()
    {
        return view('welcome');
    }
    public function contactUs()
    {
        return view('contact-us');
    }
    public function aboutUs()
    {
        return view('about-us');
    }
    public function galleryPage()
    {
        return view('gallery-page');
    }
    public function cancellationRefund()
    {
        return view('cancellation-refund');
    }
    public function security()
    {
        return view('security');
    }
    public function privacyPolicy()
    {
        return view('privacy-policy');
    }
    public function termsServices()
    {
        return view('terms-services');
    }
    public function shippingPolishing()
    {
        return view('shippingPolishing');
    }
    public function faqs()
    {
        return view('faqs');
    }
}
