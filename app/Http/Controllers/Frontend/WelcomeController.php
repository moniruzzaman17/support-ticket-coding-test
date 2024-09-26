<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;

class WelcomeController extends Controller
{
    public function index(Request $request) {
        $customer = Auth::guard('customer')->user();
        
        $totalTickets = $customer->tickets()->count();
        $openTickets = $customer->tickets()->where('status', 'open')->count();
        $inProgressTickets = $customer->tickets()->where('status', 'in_progress')->count();
        $closedTickets = $customer->tickets()->where('status', 'closed')->count();

        return view('frontend.welcome', compact('totalTickets', 'openTickets', 'inProgressTickets', 'closedTickets'));
    }
}
