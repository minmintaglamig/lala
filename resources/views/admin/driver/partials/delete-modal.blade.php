<div class="modal fade" id="deleteModal{{ $driver->id }}" tabindex="-1"
    aria-labelledby="deleteModalLabel{{ $driver->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="text-white modal-header bg-danger">
                <h5 class="modal-title">Confirm Deletion</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete <strong>{{ $driver->name }}</strong> ({{ $driver->driver_id }})?
            </div>
            <div class="modal-footer">
                <form action="{{ route('admin.driver.destroy', $driver->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit">Yes, Delete</button>
                </form>
                <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>