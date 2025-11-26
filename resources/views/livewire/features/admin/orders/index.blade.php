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
                                <th>Order Status</th>
                                <th>Payment Status</th>
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
                                        @php
                                            $statusColors = [
                                                'new' => 'info',
                                                'processing' => 'primary',
                                                'shipped' => 'warning',
                                                'delivered' => 'success',
                                                'cancelled' => 'danger',
                                            ];
                                            $statusColor =
                                                $statusColors[strtolower($order->status ?? 'new')] ?? 'secondary';
                                        @endphp
                                        <span class="badge bg-light-{{ $statusColor }}">
                                            {{ ucfirst($order->status ?? 'New') }}
                                        </span>
                                    </td>
                                    <td>
                                        @php
                                            $paymentColors = [
                                                'pending' => 'warning',
                                                'paid' => 'success',
                                                'failed' => 'danger',
                                                'refunded' => 'info',
                                            ];
                                            $paymentColor =
                                                $paymentColors[strtolower($order->payment_status ?? 'pending')] ??
                                                'secondary';
                                        @endphp
                                        <span class="badge bg-light-{{ $paymentColor }}">
                                            {{ ucfirst($order->payment_status ?? 'Pending') }}
                                        </span>
                                    </td>
                                    <td>
                                        <button wire:click="viewOrderProofs({{ $order->id }})"
                                            class="btn btn-info btn-sm">
                                            <i class="bi bi-eye"></i> View Proofs
                                        </button>
                                        <button wire:click="edit({{ $order->id }})"
                                            class="btn btn-primary btn-sm">Edit</button>
                                        <button wire:click="$dispatch('delete-prompt', { id: {{ $order->id }} })"
                                            class="btn btn-danger btn-sm">Delete</button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">No orders found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-3 d-flex justify-content-end">
                    {{ $orders->links() }}
                </div>
            </div>
        </div>
    </section>

    {{-- Proof Viewing Modal --}}
    @if ($showProofModal && $viewingOrder)
        <div class="modal fade show d-block" tabindex="-1" style="background-color: rgba(0,0,0,0.5);">
            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">
                            <i class="bi bi-file-image"></i> Order Proofs - #{{ $viewingOrder->id }}
                        </h5>
                        <button type="button" class="btn-close btn-close-white" wire:click="closeProofModal"></button>
                    </div>
                    <div class="modal-body">
                        {{-- Order Info --}}
                        <div class="card mb-3">
                            <div class="card-body">
                                <h6 class="card-title">Order Information</h6>
                                <div class="row">
                                    <div class="col-md-6">
                                        <p class="mb-1"><strong>Customer:</strong> {{ $viewingOrder->user->name }}
                                        </p>
                                        <p class="mb-1"><strong>Order Date:</strong>
                                            {{ $viewingOrder->created_at->format('d M Y, H:i') }}</p>
                                        <p class="mb-1"><strong>Payment Method:</strong>
                                            {{ ucfirst($viewingOrder->payment_method) }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="mb-1"><strong>Status:</strong>
                                            @php
                                                $statusColors = [
                                                    'new' => 'info',
                                                    'processing' => 'primary',
                                                    'shipped' => 'warning',
                                                    'delivered' => 'purple',
                                                    'completed' => 'success',
                                                    'cancelled' => 'danger',
                                                ];
                                                $statusColor =
                                                    $statusColors[strtolower($viewingOrder->status ?? 'new')] ??
                                                    'secondary';
                                            @endphp
                                            <span
                                                class="badge bg-{{ $statusColor }}">{{ ucfirst($viewingOrder->status) }}</span>
                                        </p>
                                        <p class="mb-1"><strong>Payment Status:</strong>
                                            @php
                                                $paymentColors = [
                                                    'pending' => 'warning',
                                                    'paid' => 'success',
                                                    'failed' => 'danger',
                                                ];
                                                $paymentColor =
                                                    $paymentColors[
                                                        strtolower($viewingOrder->payment_status ?? 'pending')
                                                    ] ?? 'secondary';
                                            @endphp
                                            <span
                                                class="badge bg-{{ $paymentColor }}">{{ ucfirst($viewingOrder->payment_status) }}</span>
                                        </p>
                                        <p class="mb-1"><strong>Total:</strong> Rp
                                            {{ number_format($viewingOrder->grand_total, 0, ',', '.') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Payment Proof (for transfer method) --}}
                        @if ($viewingOrder->payment_method == 'transfer')
                            <div class="card mb-3">
                                <div class="card-header bg-light">
                                    <h6 class="mb-0"><i class="bi bi-receipt"></i> Payment Proof</h6>
                                </div>
                                <div class="card-body">
                                    @if ($viewingOrder->payment_proof)
                                        <div class="text-center">
                                            <img src="{{ asset('storage/' . $viewingOrder->payment_proof) }}"
                                                alt="Payment Proof" class="img-fluid rounded border"
                                                style="max-height: 400px;">
                                            <p class="mt-2 text-muted mb-0">
                                                <i class="bi bi-check-circle text-success"></i> Payment proof uploaded
                                            </p>
                                        </div>
                                    @else
                                        <div class="alert alert-warning mb-0">
                                            <i class="bi bi-exclamation-triangle"></i> No payment proof uploaded yet
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @else
                            <div class="alert alert-info mb-3">
                                <i class="bi bi-info-circle"></i> Payment method is
                                {{ ucfirst($viewingOrder->payment_method) }} - No payment proof required
                            </div>
                        @endif

                        {{-- Receipt Proof --}}
                        <div class="card">
                            <div class="card-header bg-light">
                                <h6 class="mb-0"><i class="bi bi-box-seam"></i> Receipt Proof</h6>
                            </div>
                            <div class="card-body p-3">
                                @if ($viewingOrder->receipt_proof)
                                    <div class="text-center">
                                        <img src="{{ asset('storage/' . $viewingOrder->receipt_proof) }}"
                                            alt="Receipt Proof" class="img-fluid rounded border"
                                            style="max-height: 400px;">
                                        <p class="mt-3 text-muted mb-0">
                                            <i class="bi bi-check-circle text-success"></i> Customer confirmed receipt
                                        </p>
                                    </div>
                                @else
                                    <div class="alert alert-warning mb-0">
                                        <i class="bi bi-exclamation-triangle"></i>
                                        @if ($viewingOrder->status == 'delivered')
                                            Waiting for customer to confirm receipt
                                        @else
                                            Order not yet delivered
                                        @endif
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="closeProofModal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endif

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
