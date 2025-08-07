@extends('admin.layouts.master')
@section('title', 'Add Book')
@section('content')
<div class="page-content">

    <!-- Breadcrumb -->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Books</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Add Book</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <a href="{{ route('admin.books.index') }}" class="btn btn-primary">Back to List</a>
        </div>
    </div>

    <div class="card">
        <div class="card-body p-4">
            <h5 class="card-title">Add New Book</h5>
            <hr />
            <form method="POST" action="{{ route('admin.books.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                    <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror"
                        value="{{ old('title') }}" required>
                    @error('title')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="isbn" class="form-label">ISBN <span class="text-danger">*</span></label>
                    <input type="text" name="isbn" id="isbn" class="form-control @error('isbn') is-invalid @enderror"
                        value="{{ old('isbn') }}" required>
                    @error('isbn')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="cover_image" class="form-label">Cover Image</label>
                    <input type="file" name="cover_image" id="cover_image" class="form-control @error('cover_image') is-invalid @enderror">
                    @error('cover_image')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="publication_year" class="form-label">Publication Year</label>
                    <input type="number" name="publication_year" id="publication_year" min="0" max="{{ date('Y') }}"
                        class="form-control @error('publication_year') is-invalid @enderror" value="{{ old('publication_year') }}">
                    @error('publication_year')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="publisher" class="form-label">Publisher</label>
                    <input type="text" name="publisher" id="publisher" class="form-control @error('publisher') is-invalid @enderror"
                        value="{{ old('publisher') }}">
                    @error('publisher')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="total_copies" class="form-label">Total Copies</label>
                    <input type="number" name="total_copies" id="total_copies" min="1" class="form-control @error('total_copies') is-invalid @enderror"
                        value="{{ old('total_copies', 1) }}">
                    @error('total_copies')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="available_copies" class="form-label">Available Copies</label>
                    <input type="number" name="available_copies" id="available_copies" min="0" class="form-control @error('available_copies') is-invalid @enderror"
                        value="{{ old('available_copies', 1) }}">
                    @error('available_copies')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="category_name" class="form-label">Category Name</label>
                    <input type="text" name="category_name" id="category_name" class="form-control @error('category_name') is-invalid @enderror"
                        value="{{ old('category_name') }}">
                    @error('category_name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="border border-3 p-4 rounded">
                    <button type="submit" class="btn btn-primary">Add Book</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
