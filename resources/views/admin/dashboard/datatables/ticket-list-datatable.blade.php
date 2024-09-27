<div class="row w-100 mb-2 mt-4">
    <div class="col-12 col-md-6">
        <div class="mb-3">
          <label for="category" class="form-label">Category <span class="text-danger">*</span></label>
          <select id="category" class="form-select" name="category" required="">
            <option selected disabled>-- Select Category --</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}">
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
        </div>
    </div>
    <div class="col-12 col-md-6">
        <label for="priority" class="form-label">Priority <span class="text-danger">*</span></label>
        <select id="priority" class="form-select" name="priority" required="">
          <option selected disabled>-- Select Priority --</option>
          <option value="low">Low</option>
          <option value="medium">Medium</option>
          <option value="high">High</option>
        </select>
    </div>
</div>
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
                url: "{{ route('admintickets.list') }}",
                type: 'POST',
                data: function (d) {
                    d.category = $('#category').val();
                    d.priority = $('#priority').val();
                },
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'ticket_number', name: 'ticket_number' },
                { data: 'category', name: 'category' },
                { data: 'subject', name: 'subject' },
                { data: 'status', name: 'status' },
                { data: 'last_update', name: 'last_update' },
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

        var table = $('#tickets-table').DataTable();

        $('#category').on('change', function() {
            table.draw();
        });

        $('#priority').on('change', function() {
            table.draw();
        });
    });
</script>
@endpush
