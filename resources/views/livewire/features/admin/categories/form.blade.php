<div class="modal fade show" style="display: block; background-color: rgba(0,0,0,0.5);" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $category_id ? 'Edit Category' : 'Create New Category' }}</h5>
                <button type="button" class="btn-close" wire:click="closeModal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form wire:submit.prevent="store">
                    <div class="mb-3">
                        <label for="name" class="form-label">Category Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" wire:model.lazy="name" placeholder="Enter category name">
                        @error('name') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="newImage" class="form-label">Category Image</label>
                        <input type="file" class="form-control @error('newImage') is-invalid @enderror" id="newImage" wire:model="newImage">
                        <div wire:loading wire:target="newImage" class="text-muted">Uploading...</div>

                        @if ($newImage)
                            <img src="{{ $newImage->temporaryUrl() }}" width="100" class="mt-2 rounded">
                        @elseif ($image)
                            <img src="{{ asset('storage/' . $image) }}" width="100" class="mt-2 rounded">
                        @endif

                        @error('newImage') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="is_active" wire:model="is_active">
                        <label class="form-check-label" for="is_active">Is Active</label>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" wire:click="closeModal">Cancel</button>
                <button type="button" class="btn btn-primary" wire:click.prevent="store()">
                    <span wire:loading wire:target="store" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    {{ $category_id ? 'Update' : 'Save' }}
                </button>
            </div>
        </div>
    </div>
</div>
