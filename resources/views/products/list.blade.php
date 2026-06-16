@extends('layouts.app')
@section('title')
    <title>List Product</title>
@endsection
@section('content')
    <div class="container">
        <a href="{{ route('products.create') }}" class="btn btn-info mb-3">Create</a>
        <table class="table text-center align-middle">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Is Active</th>
                    <th>Category</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $index => $product)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $product->name }}</td>
                        <td>
                            @if ($product->image_url)
                                <img src="{{ $product->image_url }}" alt="{{ $product->name }}" width="70" class="img-thumbnail">
                            @else
                                No image
                            @endif
                        </td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->stock }}</td>
                        <td>{{ $product->is_active ? 'Active' : 'Inactive' }}</td>
                        <td>{{ $product->category?->name }}</td>
                        <td>
                            <a href="" data-bs-toggle="modal" data-bs-target="#product{{ $product->id }}">
                                <i class="fa-solid fa-eye text-success"></i>
                            </a>
                            |
                            <a href="{{ route('products.edit', $product->id) }}">
                                <i class="fa-solid fa-pen-to-square text-info"></i>
                            </a>
                            |
                            <a href="" data-bs-toggle="modal" data-bs-target="#deleteProduct{{ $product->id }}">
                                <i class="fa-solid fa-trash text-danger"></i>
                            </a>
                            @include('products.show')
                            @include('products.delete')
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
