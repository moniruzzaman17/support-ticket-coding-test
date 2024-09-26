<?php

namespace App\Http\Controllers\Frontend\Ticket;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function showNewTicketForm() {
        return view('frontend.ticket.create-ticket');
    }
}
