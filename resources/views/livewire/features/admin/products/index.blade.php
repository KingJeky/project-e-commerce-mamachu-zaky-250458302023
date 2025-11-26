<div>
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Product Management</h3>
                    <p class="text-subtitle text-muted">A page for managing products.</p>
                </div>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title">Products</h5>
                <button wire:click="create()" class="btn btn-primary"><i class="bi bi-plus-circle"></i> Add New
                    Product</button>
            </div>
            <div class="card-body">
                @if ($isOpen)
                    @include('livewire.features.admin.products.form')
                @endif

                @if ($showImageModal)
                    <div class="modal fade show" style="display: block; background-color: rgba(0,0,0,0.5);"
                        tabindex="-1" role="dialog">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Product Images</h5>
                                    <button type="button" class="btn-close" wire:click="closeImageModal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    @if (!empty($viewingImages))
                                        <div id="productImageCarousel" class="carousel slide" data-bs-ride="carousel">
                                            <div class="carousel-inner">
                                                @foreach ($viewingImages as $index => $image)
                                                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                                        <img src="{{ asset('storage/' . $image) }}"
                                                            class="d-block w-100"
                                                            style="max-height: 500px; object-fit: contain;"
                                                            alt="Product Image">
                                                    </div>
                                                @endforeach
                                            </div>
                                            <button class="carousel-control-prev" type="button"
                                                data-bs-target="#productImageCarousel" data-bs-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Previous</span>
                                            </button>
                                            <button class="carousel-control-next" type="button"
                                                data-bs-target="#productImageCarousel" data-bs-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Next</span>
                                            </button>
                                        </div>
                                    @else
                                        <p>No images for this product.</p>
                                    @endif
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        wire:click="closeImageModal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                @if ($showStatusModal && $viewingStatusProduct)
                    <div class="modal fade show" style="display: block; background-color: rgba(0,0,0,0.5);"
                        tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Status for: {{ $viewingStatusProduct->name }}</h5>
                                    <button type="button" class="btn-close" wire:click="closeStatusModal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <ul class="list-group">
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Is Active
                                            <span
                                                class="badge {{ $viewingStatusProduct->is_active ? 'bg-success' : 'bg-danger' }}">
                                                {{ $viewingStatusProduct->is_active ? 'Yes' : 'No' }}
                                            </span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Is Featured
                                            <span
                                                class="badge {{ $viewingStatusProduct->is_featured ? 'bg-success' : 'bg-secondary' }}">
                                                {{ $viewingStatusProduct->is_featured ? 'Yes' : 'No' }}
                                            </span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            In Stock
                                            <span
                                                class="badge {{ $viewingStatusProduct->in_stock ? 'bg-success' : 'bg-warning' }}">
                                                {{ $viewingStatusProduct->in_stock ? 'Yes' : 'No' }}
                                            </span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        wire:click="closeStatusModal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="mb-3">
                    <input wire:model.live.debounce.300ms="search" type="text" class="form-control"
                        placeholder="Search products by name...">
                </div>

                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($products as $index => $product)
                                <tr>
                                    <td>{{ $products->firstItem() + $index }}</td>
                                    <td>
                                        @if ($product->images && !empty($product->images))
                                            <button wire:click="viewImages({{ $product->id }})"
                                                class="btn btn-sm btn-outline-primary">View Images</button>
                                        @else
                                            <span class="text-muted">No Image</span>
                                        @endif
                                    </td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->category->name ?? 'N/A' }}</td>
                                    <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                                    <td>
                                        <button wire:click="viewStatus({{ $product->id }})"
                                            class="btn btn-sm btn-outline-info">
                                            View Status
                                        </button>
                                    </td>
                                    <td class="flex gap-2">
                                        <button wire:click="edit({{ $product->id }})"
                                            class="btn btn-info flex items-center justify-center px-2 py-1 h-5">
                                            <i class="bi bi-pencil"></i>
                                        </button>

                                        <button class="btn btn-danger flex items-center justify-center px-2 py-1 h-5"
                                            x-data
                                            x-on:click.prevent="
                                            Swal.fire({
                                                title: 'Yakin hapus produk?',
                                                text: 'Data yang dihapus tidak bisa dikembalikan!',
                                                icon: 'warning',
                                                showCancelButton: true,
                                                confirmButtonColor: '#d33',
                                                cancelButtonColor: '#3085d6',
                                                confirmButtonText: 'Ya, hapus!'
                                            }).then((result) => {
                                                if (result.isConfirmed) {
                                                    $wire.delete({{ $product->id }});
                                                }
                                            });
                                        ">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">No products found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-3 d-flex justify-content-end">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </section>
</div>
