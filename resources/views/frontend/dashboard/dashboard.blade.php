<div class="container mt-4">
    <div class="row w-100 m-auto">
        <div class="col-12 col-md-4">
            @include('frontend.dashboard.partials.sidebar')
        </div>
        <div class="col-12 col-md-8">
            <div class="infoBoxWrapper">
                <div class="row no-gutters">
                    <div class="col-6 col-md-3">
                        <a href="" class="infoBox">
                            <i class="fas fa-ticket-alt"></i>
                            <div class="stat">{{ $totalTickets }}</div>
                            <div class="title">Total Ticket</div>
                            <div class="highlight bg-color-blue"></div>
                        </a>
                    </div>
                    <div class="col-6 col-md-3">
                        <a href="" class="infoBox">
                            <i class="fas fa-folder-open"></i>
                            <div class="stat">{{ $openTickets }}</div>
                            <div class="title">Open Ticket</div>
                            <div class="highlight bg-color-green"></div>
                        </a>
                    </div>
                    <div class="col-6 col-md-3">
                        <a href="" class="infoBox">
                            <i class="fas fa-comments"></i>
                            <div class="stat">{{ $inProgressTickets }}</div>
                            <div class="title">In Progress</div>
                            <div class="highlight bg-color-red"></div>
                        </a>
                    </div>
                    <div class="col-6 col-md-3">
                        <a href="" class="infoBox">
                            <i class="fas fa-check-circle"></i>
                            <div class="stat">{{ $closedTickets }}</div>
                            <div class="title">Closed</div>
                            <div class="highlight bg-color-gold"></div>
                        </a>
                    </div>
                </div>
            </div>
            @include('frontend.dashboard.datatables.ticket-list-datatable')
        </div>
    </div>
</div>