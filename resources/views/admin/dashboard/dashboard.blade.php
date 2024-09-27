<div class="container mt-4">
    <div class="row w-100 m-auto">
        <div class="col-12 col-md-4">
            @include('admin.dashboard.partials.sidebar')
        </div>
        <div class="col-12 col-md-8">
            <div class="infoBoxWrapper">
                <div class="row no-gutters">
                    <div class="col-6 col-md-3">
                        <a href="" class="infoBox">
                            <i class="fas fa-ticket-alt"></i>
                            <div class="stat">{{ $totalCustomers??0 }}</div>
                            <div class="title">Total Customer</div>
                            <div class="highlight bg-color-blue"></div>
                        </a>
                    </div>
                    <div class="col-6 col-md-3">
                        <a href="" class="infoBox">
                            <i class="fas fa-folder-open"></i>
                            <div class="stat">{{ $totalCategories??0 }}</div>
                            <div class="title">Total Category</div>
                            <div class="highlight bg-color-green"></div>
                        </a>
                    </div>
                    <div class="col-6 col-md-3">
                        <a href="" class="infoBox">
                            <i class="fas fa-comments"></i>
                            <div class="stat">{{ $totalTickets??0 }}</div>
                            <div class="title">Total Ticket</div>
                            <div class="highlight bg-color-red"></div>
                        </a>
                    </div>
                    <div class="col-6 col-md-3">
                        <a href="" class="infoBox">
                            <i class="fas fa-check-circle"></i>
                            <div class="stat">{{ $totalClosedTickets??0 }}</div>
                            <div class="title">Total Closed Ticket</div>
                            <div class="highlight bg-color-gold"></div>
                        </a>
                    </div>
                </div>
            </div>            
            @include('admin.dashboard.datatables.ticket-list-datatable')
        </div>
    </div>
</div>