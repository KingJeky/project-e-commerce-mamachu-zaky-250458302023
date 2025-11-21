<div>
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>User Management</h3>
                    <p class="text-subtitle text-muted">A page for managing users.</p>
                </div>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title">Users</h5>
                <button wire:click="create()" class="btn btn-primary"><i class="bi bi-plus-circle"></i> Add New User</button>
            </div>
            <div class="card-body">

                @if($isOpen)
                    @include('livewire.features.admin.users.form')
                @endif

                <div class="mb-3">
                    <input wire:model.live.debounce.300ms="search" type="text" class="form-control" placeholder="Search users by name or email...">
                </div>

                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Joined At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                                    @forelse ($users as $index => $user)
                                        <tr>
                                            <td>{{ $users->firstItem() + $index }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                <span
                                                    class="badge {{ $user->role === 'admin' ? 'bg-primary' : 'bg-success' }}">{{ ucfirst($user->role) }}</span>
                                            </td>
                                            <td>{{ $user->created_at->format('d F Y') }}</td>
                                    <td class="flex gap-2">
                                        <button wire:click="edit({{ $user->id }})" class="btn btn-info flex items-center justify-center px-2 py-1 h-5">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <button class="btn btn-danger flex items-center justify-center px-2 py-1 h-5"
                                                x-data
                                                x-on:click.prevent="
                                                    Swal.fire({
                                                        title: 'Yakin hapus pengguna?',
                                                        text: 'Data yang dihapus tidak bisa dikembalikan!',
                                                        icon: 'warning',
                                                        showCancelButton: true,
                                                        confirmButtonColor: '#d33',
                                                        cancelButtonColor: '#3085d6',
                                                        confirmButtonText: 'Ya, hapus!'
                                                    }).then((result) => {
                                                        if (result.isConfirmed) {
                                                            $wire.delete({{ $user->id }});
                                                        }
                                                    });
                                                ">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">No users found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-3 d-flex justify-content-end">
                    {{ $users->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </section>
</div>
