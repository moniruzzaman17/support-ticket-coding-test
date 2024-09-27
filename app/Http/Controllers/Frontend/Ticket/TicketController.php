<?php

namespace App\Http\Controllers\Frontend\Ticket;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\TicketResponse;
use App\Models\Customer;
use App\Models\Category;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;


class TicketController extends Controller
{
    public function showNewTicketForm() {
        $categories = Category::all();
        return view('frontend.ticket.create-ticket', compact('categories'));
    }

    public function showTickets(Request $request)
    {
        if ($request->ajax()) {
            $tickets = Ticket::with('category')->where('customer_id', Auth::guard('customer')->user()->id)->latest()->get();

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
                        $status = '<span class="badge bg-success">Open</span>';
                    }
                    elseif ($ticket->status == "in_progress") {
                        $status = '<span class="badge bg-primary">In Progress</span>';
                    }
                    else {
                        $status = '<span class="badge bg-secondary">Closed</span>';
                    }
                    return $status;
                })
                ->addColumn('action', function($row){
                    $btn = '<a href="' . route('tickets.show', ['ticket_id'=>$row->id]) . '" class="btn btn-sm btn-primary">View</a>';
                    return $btn;
                })
                ->rawColumns(['action','status'])
                ->make(true);
        }
    }

    public function storeNewTicket(Request $request) {
        $request->validate([
            'subject' => 'required|string|max:255',
            'category' => 'required|integer',
            'priority' => 'required|string|in:low,medium,high',
            'message' => 'required|string',
        ]);
    
        // Check if customer already exists
        $customer = Customer::where('email', $request->email)->first();
    
        if ($customer) {
            $customer->update([
                'name' => $request->name,
            ]);
        } else {
            $customer = Customer::create([
                'name' => $request->name,
                'email' => $request->email
            ]);
        }
    
        // Generate the ticket number
        $ticketNumber = $this->generateTicketNumber();
    
        $ticket = Ticket::create([
            'customer_id' => $customer->id,
            'category_id' => $request->category,
            'subject' => $request->subject,
            'priority' => $request->priority,
            'message' => $request->message,
            'ticket_number' => $ticketNumber,
            'admin_id' => null
        ]);

        // Send mail to admin
        Mail::send('emails.ticket-notification', ['ticket' => $ticket], function($message) use ($request) {
            $message->to('moon.mn717@gmail.com')
                    ->subject($request->subject);
        });

        return redirect()->back()->with('success', 'Ticket submitted successfully.');
    }

    protected function generateTicketNumber()
    {
        $currentYear = now()->format('y');
        $currentMonth = now()->format('m');
        
        $ticketPrefix = $currentYear . $currentMonth;
        $lastTicket = Ticket::where('ticket_number', 'like', "$ticketPrefix%")
                            ->orderBy('ticket_number', 'desc')
                            ->first();

        if ($lastTicket) {
            $lastTicketNumber = (int) substr($lastTicket->ticket_number, 4);
            $newTicketNumber = $lastTicketNumber + 1;
        } else {
            $newTicketNumber = 1;
        }
        $ticketNumber = $ticketPrefix . str_pad($newTicketNumber, 3, '0', STR_PAD_LEFT);
        return $ticketNumber;
    }
    
    public function viewTicket($ticket_id) {
        $ticket = Ticket::with('response', 'response.user')->where('id', $ticket_id)->first();
        return view('frontend.ticket.view-ticket', compact('ticket'));
    } 

    public function storeResponse(Request $request) {
        $request->validate([
            'ticket_id' => 'required|exists:tickets,id',
            'message' => 'required',
        ]);
    
        TicketResponse::create([
            'ticket_id' => $request->ticket_id,
            'message' => $request->message,
        ]);
    
        return redirect()->back()->with('success', 'Response submitted successfully.');
    }
}
