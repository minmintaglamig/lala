<!-- resources/views/admin/driver/partials/delete-modal.blade.php -->
<div id="deleteModal{{ $driver->id }}" class="fixed inset-0 z-50 hidden overflow-y-auto bg-black bg-opacity-50"
    aria-hidden="true">
    <div class="flex items-center justify-center min-h-screen px-4 py-6">
        <div class="w-full max-w-md bg-white rounded-lg shadow-xl" role="dialog" aria-modal="true">
            <!-- Modal Header -->
            <div class="flex items-center justify-between px-6 py-4 text-white bg-red-600 rounded-t-lg">
                <h2 class="text-lg font-semibold">Confirm Deletion</h2>
                <button onclick="closeModal('deleteModal{{ $driver->id }}')"
                    class="text-xl font-bold text-white hover:text-gray-200">&times;</button>
            </div>

            <!-- Modal Body -->
            <div class="px-6 py-4 text-gray-800">
                Are you sure you want to delete <strong>{{ $driver->name }}</strong> ({{ $driver->driver_id }})?
            </div>

            <!-- Modal Footer -->
            <div class="flex justify-end px-6 py-4 space-x-3 border-t rounded-b-lg">
                <form action="{{ route('admin.driver.destroy', $driver->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-4 py-2 text-white bg-red-600 rounded hover:bg-red-700">
                        Yes, Delete
                    </button>
                </form>
                <button onclick="closeModal('deleteModal{{ $driver->id }}')"
                    class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">
                    Cancel
                </button>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>
    function openModal(id) {
        const modal = document.getElementById(id);
        if (modal) {
            modal.classList.remove('hidden');
            modal.setAttribute('aria-hidden', 'false');
        }
    }

    function closeModal(id) {
        const modal = document.getElementById(id);
        if (modal) {
            modal.classList.add('hidden');
            modal.setAttribute('aria-hidden', 'true');
        }
    }
</script>
@endpush