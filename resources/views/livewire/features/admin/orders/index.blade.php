<div>
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Order Management</h3>
                    <p class="text-subtitle text-muted">A page for managing customer orders.</p>
                </div>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title">Orders</h5>
                <button wire:click="create" class="btn btn-primary">Add New Order</button>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <input wire:model.live.debounce.300ms="search" type="text" class="form-control"
                        placeholder="Search orders by customer name or order ID...">
                </div>

                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Customer</th>
                                <th>Order Date</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($orders as $order)
                                <tr>
                                    <td>#{{ $order->id }}</td>
                                    <td>{{ $order->user->name }}</td>
                                    <td>{{ $order->created_at->format('d F Y') }}</td>
                                    <td>Rp {{ number_format($order->grand_total, 0, ',', '.') }}</td>
                                    <td>
                                        <span
                                            class="badge bg-light-{{ strtolower($order->status) == 'paid' ? 'success' : (strtolower($order->status) == 'pending' ? 'warning' : 'danger') }}">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <button wire:click="edit({{ $order->id }})"
                                            class="btn btn-primary btn-sm">Edit</button>
                                        <button wire:click="$dispatch('delete-prompt', { id: {{ $order->id }} })"
                                            class="btn btn-danger btn-sm">Delete</button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">No orders found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-3 d-flex justify-content-end">
                    {{ $orders->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </section>

    @include('livewire.features.admin.orders.form')
</div>

@push('scripts')
    <script>
        document.addEventListener('livewire:init', () => {
            const formModal = new bootstrap.Modal(document.getElementById('form-modal'));

            // Listener untuk menampilkan modal
            Livewire.on('show-modal', () => {
                formModal.show();
            });

            // Listener untuk menyembunyikan modal
            Livewire.on('hide-modal', () => {
                formModal.hide();
            });

            // Listener untuk konfirmasi hapus
            Livewire.on('delete-prompt', ({
                id
            }) => {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        @this.call('delete', id);
                    }
                })
            });
        });
    </script>
@endpush
