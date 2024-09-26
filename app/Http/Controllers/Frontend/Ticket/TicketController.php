<?php

namespace App\Http\Controllers\Frontend\Ticket;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ticket;
use Yajra\DataTables\DataTables;

class TicketController extends Controller
{
    public function showNewTicketForm() {
        return view('frontend.ticket.create-ticket');
    }

    public function showTickets(Request $request)
    {
        if ($request->ajax()) {
            $tickets = Ticket::latest()->get();

            return DataTables::of($tickets)
                ->addIndexColumn()
                ->editColumn('status', function ($ticket) {
                    return ucfirst($ticket->status);
                })
                ->editColumn('last_update', function ($ticket) {
                    return $ticket->updated_at->format('Y-m-d H:i:s');
                })
                ->addColumn('action', function($row){
                    $btn = '<a href="tickets/' . $row->id . '" class="btn btn-sm btn-primary">View</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
}
