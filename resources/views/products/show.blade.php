<div class="modal fade" id="product{{ $product->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">View Detail</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        {{ $product->name }}
                    </div>
                    <div class="col-md-12">
                        @if ($product->image_url)
                            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" width="120" class="img-thumbnail">
                        @else
                            No image
                        @endif
                    </div>
                    <div class="col-md-12">
                        {{ $product->price }}
                    </div>
                    <div class="col-md-12">
                        {{ $product->stock }}
                    </div>
                    <div class="col-md-12">
                        {{ $product->is_active ? 'Active' : 'Inactive' }}
                    </div>
                    <div class="col-md-12">
                        {{ $product->category?->name }}
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
