@extends('layouts.app')

@section('title')
    <title>Edit Product</title>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>

            <div class="col-md-6">
                <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <!-- Product Name -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Product Name</label>
                        <input type="text" name="name" class="form-control" id="name"
                            value="{{ old('name', $product->name) }}">
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" name="image" class="form-control" id="image">
                        @if ($product->image_url)
                            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" width="90" class="img-thumbnail mt-2">
                        @endif
                    </div>

                    <!-- Price -->
                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" name="price" class="form-control" id="price" step="0.01"
                            value="{{ old('price', $product->price) }}">
                    </div>

                    <!-- Quantity -->
                    <div class="mb-3">
                        <label for="stock" class="form-label">Stock</label>
                        <input type="number" name="stock" class="form-control" id="stock"
                            value="{{ old('stock', $product->stock) }}">
                    </div>

                    <div class="mb-3">
                        <label for="is_active" class="form-label">Is Active</label>
                        <input type="hidden" name="is_active" value="0">
                        <select name="is_active" class="form-select" id="is_active">
                            <option value="1" {{ old('is_active', $product->is_active) == '1' ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ old('is_active', $product->is_active) == '0' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>

                    <!-- Category -->
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Category</label>
                        <select name="category_id" id="category_id" class="form-select">
                            <option value="">-- Select Category --</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        Update
                    </button>
                    <a href="{{ route('products.index') }}" class="btn btn-secondary">Back</a>
                </form>
            </div>

            <div class="col-md-3"></div>
        </div>
    </div>
@endsection
