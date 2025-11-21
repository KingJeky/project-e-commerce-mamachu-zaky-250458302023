<div>
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Category Management</h3>
                    <p class="text-subtitle text-muted">A page for managing product categories.</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first"></div>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title">Categories</h5>
                <button wire:click="create()" class="btn btn-primary">
                    <i class="bi bi-plus-circle"></i> Add New Category
                </button>
            </div>

            <div class="card-body">

                @if (session()->has('message'))
                    <div x-data="{ show: true }"
                         x-init="setTimeout(() => show = false, 2000)"
                         x-show="show"
                         class="alert alert-success alert-dismissible fade show"
                         role="alert">
                        {{ session('message') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if ($isOpen)
                    @include('livewire.features.admin.categories.form')
                @endif

                <div class="mb-3">
                    <input wire:model.live.debounce.300ms="search"
                           type="text"
                           class="form-control"
                           placeholder="Search categories by name...">
                </div>

                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                        </thead>

                        <tbody>
                        @forelse ($categories as $index => $category)
                            <tr>
                                <td>{{ $categories->firstItem() + $index }}</td>

                                <td>
                                    @if ($category->image)
                                        <img src="{{ asset('storage/' . $category->image) }}"
                                             width="60"
                                             class="rounded">
                                    @else
                                        <span class="text-muted">No Image</span>
                                    @endif
                                </td>

                                <td>{{ $category->name }}</td>
                                <td>{{ $category->slug }}</td>

                                <td>
                                    <span class="badge {{ $category->is_active ? 'bg-success' : 'bg-danger' }}">
                                        {{ $category->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>

                                <td class="flex gap-2">
                                    <button wire:click="edit({{ $category->id }})"
                                            class="btn btn-info flex items-center justify-center px-2 py-1 h-5">
                                        <i class="bi bi-pencil"></i>
                                    </button>

                                    <button class="btn btn-danger flex items-center justify-center px-2 py-1 h-5"
                                            x-data
                                            x-on:click.prevent="
                                                Swal.fire({
                                                    title: 'Yakin hapus kategori?',
                                                    text: 'Data yang dihapus tidak bisa dikembalikan!',
                                                    icon: 'warning',
                                                    showCancelButton: true,
                                                    confirmButtonColor: '#d33',
                                                    cancelButtonColor: '#3085d6',
                                                    confirmButtonText: 'Ya, hapus!'
                                                }).then((result) => {
                                                    if (result.isConfirmed) {
                                                        $wire.delete({{ $category->id }});
                                                    }
                                                });
                                            ">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No categories found.</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination FIX --}}
                <div class="mt-3 d-flex justify-content-end">
                    {{ $categories->links('vendor.pagination.bootstrap-5') }}
                </div>

            </div>
        </div>
    </section>
</div>
