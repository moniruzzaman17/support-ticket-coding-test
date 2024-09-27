@extends('frontend.layouts.app')
@section('content')
<div class="container mt-4">
    <div class="row w-100 m-auto">
        <div class="col-12 col-md-4">
            @include('frontend.dashboard.partials.sidebar')
        </div>
        <div class="col-12 col-md-8">
            <div class="card">
                <div class="card-body">
                <h5 class="card-title w-100 d-flex justify-content-between">
                    <span>View Ticket #{{ $ticket->ticket_number }}</span>
                    @if($ticket->status == "open")
                        <span class="badge bg-success">Open</span>
                    @elseif ($ticket->status == "in_progress")
                    <span class="badge bg-info">In-Progress</span>
                    @else
                    <span class="badge bg-secondary">Closed</span>
                    @endif
                </h5>
                <hr>
                <i style="font-size: 11px">{{ $ticket->created_at->format('Y-m-d H:i:s A') }}</i>
                <h5 class="card-subtitle mt-3 mb-2 text-muted">
                    Subject: {{ $ticket->subject }}
                </h5>
                <div class="mail-body w-100 mt-4">
                    {!! $ticket->message !!}
                </div>
                </div>
            </div>
           @forelse ($ticket->response as $response) 
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title w-100 d-flex justify-content-between">
                        <span>Response From {{ $response->user->name??"Myself" }}</span>
                        <i style="font-size: 11px;">{{ $response->created_at->format('Y-m-d H:i:s A') }}</i>
                    </h5>
                    <hr>
                    <div class="mail-body w-100 mt-4">
                        {!! $response->message !!}
                    </div>
                </div>
            </div>
           @empty
               
           @endforelse
           @if($ticket->status !== "closed")
           <form action="{{ route('tickets.storeResponse') }}" method="POST" class="mt-4" id="responseForm">
               @csrf
               <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
               <div class="mb-3">
                   <label for="message" class="form-label fw-bold">Write your response</label>
                   <textarea id="editor" class="form-control" name="message" rows="12" required>{!! old('message') !!}</textarea>
               </div>
               <div class="border-top pt-3 clearfix">
                 <button type="submit" class="btn btn-primary float-end">Reply</button>
               </div>
           </form>
           @endif
        </div>
    </div>
</div>
@endsection