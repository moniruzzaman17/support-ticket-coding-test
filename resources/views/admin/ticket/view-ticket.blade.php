@extends('admin.layouts.app')
@section('content')
<div class="container mt-4">
    <div class="row w-100 m-auto">
        <div class="col-12 col-md-4">
            @include('admin.dashboard.partials.sidebar')
        </div>
        <div class="col-12 col-md-8">
            <div class="card">
                <div class="card-body">
                <h5 class="card-title w-100 d-flex justify-content-between">
                    <span>View Ticket #{{ $ticket->ticket_number }}</span>
                    <span class="badge bg-info"><i class="fas fa-info-circle"></i>&nbsp;{{ $ticket->priority }}</span>
                    @if($ticket->status == "open")
                        <span class="badge bg-success statusBar" data="{{ $ticket->status }}" data-id="{{ $ticket->id }}">Open</span>
                    @elseif ($ticket->status == "in_progress")
                    <span class="badge bg-info statusBar" data="{{ $ticket->status }}" data-id="{{ $ticket->id }}">In-Progress</span>
                    @else
                    <span class="badge bg-secondary statusBar" data="{{ $ticket->status }}" data-id="{{ $ticket->id }}">Closed</span>
                    @endif
                </h5>
                <hr>
                <h5 class="mb-1"><strong>From :</strong> {{ $ticket->customer->name }}</h5>
                <h5 class="mb-1"><strong>Email :</strong> {{ $ticket->customer->email }}</h5>
                <i style="font-size: 12px"><i class="fas fa-clock"></i>&nbsp;{{ $ticket->created_at->format('Y-m-d H:i:s A') }}</i>
                <h5 class="card-subtitle mt-3 mb-2 text-muted">
                    Subject: {{ $ticket->subject }}
                </h5>
                <div class="mail-body w-100 mt-4">
                    {!! $ticket->message !!}
                </div>
                </div>
            </div>
           @forelse ($ticket->response as $response) 
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title w-100 d-flex justify-content-between">
                        <span>Response From {{ $response->user?$response->user->name: $ticket->customer->name }}</span>
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
            <form action="{{ route('admintickets.storeResponse') }}" method="POST" class="mt-4" id="responseForm">
                @csrf
                <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
                <input type="hidden" name="response_from" value="{{ Auth::guard('administrator')->user()->id }}">
                <div class="mb-3">
                    <label for="message" class="form-label fw-bold">Write your response</label>
                    <textarea id="editor" class="form-control" name="message" rows="12" required>{!! old('message') !!}</textarea>
                </div>
                <div class="border-top pt-3 clearfix">
                  <button type="submit" class="btn btn-primary float-end">Reply</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection