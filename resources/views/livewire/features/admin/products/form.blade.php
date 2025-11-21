<div class="modal fade show" style="display: block; background-color: rgba(0,0,0,0.5);" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $product_id ? 'Edit Product' : 'Create New Product' }}</h5>
                <button type="button" class="btn-close" wire:click="closeModal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form wire:submit.prevent="store">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name" class="form-label">Product Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" wire:model.lazy="name" placeholder="Enter product name">
                                @error('name') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="price" class="form-label">Price</label>
                                <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" wire:model.lazy="price" placeholder="Enter price">
                                @error('price') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="category_id" class="form-label">Category</label>
                                <select class="form-control @error('category_id') is-invalid @enderror" id="category_id" wire:model="category_id">
                                    <option value="">Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="brand_id" class="form-label">Brand</label>
                                <select class="form-control @error('brand_id') is-invalid @enderror" id="brand_id" wire:model="brand_id">
                                    <option value="">Select Brand</option>
                                    @foreach($brands as $brand)
                                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                                @error('brand_id') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" wire:model.lazy="description" rows="3"></textarea>
                    </div>

                    <div class="row">
                        @foreach ([1, 2, 3] as $i)
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="newImage{{ $i }}" class="form-label">Image {{ $i }}</label>
                                    <input type="file" class="form-control @error('newImage' . $i) is-invalid @enderror" id="newImage{{ $i }}" wire:model="newImage{{ $i }}">
                                    <div wire:loading wire:target="newImage{{ $i }}" class="text-muted">Uploading...</div>

                                    @php
                                        $newImage = 'newImage' . $i;
                                        $existingImage = $images[$i - 1] ?? null;
                                    @endphp

                                    <div class="mt-2">
                                        @if ($this->$newImage)
                                            <img src="{{ $this->$newImage->temporaryUrl() }}" width="100" class="rounded">
                                        @elseif ($existingImage)
                                            <img src="{{ asset('storage/' . $existingImage) }}" width="100" class="rounded">
                                        @endif
                                    </div>
                                    @error('newImage' . $i) <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="is_active" wire:model="is_active">
                                <label class="form-check-label" for="is_active">Is Active</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="is_featured" wire:model="is_featured">
                                <label class="form-check-label" for="is_featured">Is Featured</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="in_stock" wire:model="in_stock">
                                <label class="form-check-label" for="in_stock">In Stock</label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" wire:click="closeModal">Cancel</button>
                <button type="button" class="btn btn-primary" wire:click.prevent="store()">
                    <span wire:loading wire:target="store" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    {{ $product_id ? 'Update' : 'Save' }}
                </button>
            </div>
        </div>
    </div>
</div>
