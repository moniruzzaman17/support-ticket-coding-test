<!-- Modal -->
  <div class="modal fade" id="statusChangeModal" tabindex="-1" role="dialog" aria-labelledby="statusChangeModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <form action="" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-header">
            <h5 class="modal-title" id="statusChangeModalTitle">Change Status</h5>
            <button type="button" class="close closeModal" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="ticket_id" id="ticketID">
                <div class="col">
                    <label for="status" class="form-label">Select Status</label>
                    <select id="status" class="form-select" name="status" required>
                        <option value="open">Open</option>
                        <option value="in_progress">In Progress</option>
                        <option value="closed">Closed</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary closeModal" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
      </div>
    </div>
  </div>
  @push('scripts')
      <script>
        $(document).ready(function() {
            $('.closeModal').on('click', function() {
                $('#statusChangeModal').modal('hide');
            });
        });
    
        $('#statusChangeModal').on('hidden.bs.modal', function() {
            $('#ticketID').val('');

            $('#status').empty();
            $('#status').append(new Option('Open', 'open'));
            $('#status').append(new Option('In Progress', 'in_progress'));
            $('#status').append(new Option('Closed', 'closed'));
        });
      </script>
  @endpush