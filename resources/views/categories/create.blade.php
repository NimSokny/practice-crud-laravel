@extends('layouts.app')
@section('title')
    <title>Create Categories</title>
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <form action="{{ route('categories.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control" id="name">
                    </div>
                    <div class="mb-3">
                        <label for="is_active" class="form-label">Is Active</label>
                        <input type="hidden" name="is_active" value="0">
                        <select name="is_active" class="form-select" id="is_active">
                            <option value="1" {{ old('is_active', '1') == '1' ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <div class="form-floating">
                            <textarea name="description" class="form-control" id="description">{{ old('description') }}</textarea>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Create</button>
                    <a href="{{ route('categories.index') }}" class="btn btn-secondary">Back</a>
                </form>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
@endsection
