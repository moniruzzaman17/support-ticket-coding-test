<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Customer;
use App\Models\Category;
use App\Models\Ticket;
use App\Models\TicketResponse;
use Yajra\DataTables\DataTables;
use App\Mail\TicketClosed;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    public function index(Request $request) {
        if (Auth::guard('administrator')->check()) {
            $totalCustomers = Customer::count();
            $totalCategories = Category::count();
            $totalTickets = Ticket::count();
            $totalClosedTickets = Ticket::where('status', 'closed')->count();

            $categories = Category::all();

        } else {
            $totalCustomers = 0;
            $totalCategories = 0;
            $totalTickets = 0;
            $totalClosedTickets = 0;

            $categories = 0;
        }
        return view('admin.welcome', compact('totalCustomers', 'totalCategories', 'totalTickets', 'totalClosedTickets', 'categories'));
    }
    public function showTickets(Request $request)
    {
        if ($request->ajax()) {
            $tickets = Ticket::with('category');

            if ($request->has('category') && $request->category) {
                $tickets->where('category_id', $request->category);
            }
        
            if ($request->has('priority') && $request->priority) {
                $tickets->where('priority', $request->priority);
            }
            $tickets = $tickets->latest()->get();

            return DataTables::of($tickets)
                ->addIndexColumn()
                ->editColumn('status', function ($ticket) {
                    return ucfirst($ticket->status);
                })
                ->editColumn('last_update', function ($ticket) {
                    return $ticket->updated_at->format('Y-m-d H:i:s');
                })
                ->editColumn('ticket_number', function ($ticket) {
                    return "#".$ticket->ticket_number;
                })
                ->editColumn('category', function ($ticket) {
                    return $ticket->category->name;
                })
                ->editColumn('status', function ($ticket) {
                    if ($ticket->status == "open") {
                        $status = '<span class="badge bg-success statusBar" data="'.$ticket->status .'" data-id="'. $ticket->id .'">Open</span>';
                    }
                    elseif ($ticket->status == "in_progress") {
                        $status = '<span class="badge bg-primary statusBar" data="'.$ticket->status .'" data-id="'. $ticket->id .'">In Progress</span>';
                    }
                    else {
                        $status = '<span class="badge bg-secondary statusBar" data="'.$ticket->status .'" data-id="'. $ticket->id .'">Closed</span>';
                    }
                    return $status;
                })
                ->addColumn('action', function($row){
                    $btn = '<a href="' . route('admintickets.show', ['ticket_id'=>$row->id]) . '" class="btn btn-sm btn-primary">View</a>';
                    return $btn;
                })
                ->rawColumns(['action','status'])
                ->make(true);
        }
    }
    public function viewTicket($ticket_id) {
        $ticket = Ticket::with('customer', 'response', 'response.user')->where('id', $ticket_id)->first();
        return view('admin.ticket.view-ticket', compact('ticket'));
    }
    
    public function storeResponse(Request $request) {
        $request->validate([
            'ticket_id' => 'required|exists:tickets,id',
            'response_from' => 'required|exists:users,id',
            'message' => 'required',
        ]);
    
        TicketResponse::create([
            'ticket_id' => $request->ticket_id,
            'response_from' => $request->response_from,
            'message' => $request->message,
        ]);
    
        return redirect()->back()->with('success', 'Response submitted successfully.');
    }

    public function updateStatus(Request $request)
    {
        $request->validate([
            'ticket_id' => 'required|exists:tickets,id',
            'status' => 'required|in:open,in_progress,closed',
        ]);

        $ticket = Ticket::with('customer')->findOrFail($request->ticket_id);

        $ticket->status = $request->status;
        $ticket->save();

        if ($ticket->status == 'closed') {
            $customerEmail = $ticket->customer->email;
            Mail::to($customerEmail)->send(new TicketClosed($ticket));
        }
        
        return redirect()->back()->with('success', 'Ticket status updated successfully.');
    }
}
