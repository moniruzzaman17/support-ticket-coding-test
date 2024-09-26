<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;

class WelcomeController extends Controller
{
    public function index(Request $request) {
        if (Auth::guard('customer')->check()) {
            $customer = Auth::guard('customer')->user();
            
            $totalTickets = $customer->tickets()->count();
            $openTickets = $customer->tickets()->where('status', 'open')->count();
            $inProgressTickets = $customer->tickets()->where('status', 'in_progress')->count();
            $closedTickets = $customer->tickets()->where('status', 'closed')->count();
        }
        else{
            $totalTickets = 0;
            $openTickets = 0;
            $inProgressTickets = 0;
            $closedTickets = 0;
        }

        return view('frontend.welcome', compact('totalTickets', 'openTickets', 'inProgressTickets', 'closedTickets'));
    }
}
