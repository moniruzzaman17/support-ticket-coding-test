<div class="table-responsive mt-4">
    <table class="table table-bordered table-hover w-100" id="tickets-table">
        <thead style="background-color: #F2F2F2;">
            <tr>
                <th>SL</th>
                <th>Ticket No</th>
                <th>Category</th>
                <th>Subject</th>
                <th>Status</th>
                <th>Last Update</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>
</div>
@push('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        $('#tickets-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('tickets.list') }}",
                type: 'GET',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'ticket_no', name: 'ticket_no' },
                { data: 'category_name', name: 'category_name' },
                { data: 'subject', name: 'subject' },
                { data: 'status', name: 'status' },
                { data: 'updated_at', name: 'updated_at' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ],
            lengthMenu: [
                [5, 10, 30, 50, -1],
                [5, 10, 30, 50, "All"]
            ],
            pageLength: 5,
            dom: "<'row'<'col-sm-4'l><'col-sm-4 d-flex justify-content-center'B><'col-sm-4'f>>" +
                 "<'row'<'col-sm-12'tr>>" +
                 "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            buttons: ['excel', 'print'],
            language: {
                search: '<div class="input-group">' +
                        '<span class="input-group-text">' +
                        '<i class="fas fa-search"></i>' +
                        '</span>' +
                        '_INPUT_' +
                        '</div>'
            },
            responsive: true
        });
    });
</script>
@endpush
