@extends('layouts.app')

@section('title', 'Admin: Categories')

@section('content')

<form action="{{ route('admin.categories.store') }}" method="post">
    @csrf
    <div class="row gx-2 mb-4">
        <div class="col-4">
            <input type="text" name="name" class="form-control" placeholder="Add a category..." autofocus>
            @error('name')
                <p class="text-danger small">{{ $message }}</p>
            @enderror
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary">
                <i class="fasolid fa-plus"></i> Add
            </button>
        </div>
    </div>
</form>

<div class="row">
    <div class="col-7">
        <table class="table table-hover align-middle bg-white border table-sm text-secondary text-center">
            <thead class="table-warning small text-secondary">
                <tr>
                    <th>#</th>
                    <th>NAME</th>
                    <th>COUNT</th>
                    <th>LAST UPDATED</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($all_categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td class="text-dark">{{ $category->name }}</td>
                        <td>{{ $category->categoryPost->count() }}</td>
                        <td>{{ $category->updated_at }}</td>
                        <td>
                            {{-- Edit Button --}}
                            <button class="btn btn-outline-warning btn-sm me-2" data-bs-toggle="modal" data-bs-target="#edit-category-{{ $category->id }}" title="Edit">
                                <i class="fa-solid fa-pen"></i>
                            </button>
                            {{-- Delete Button --}}
                            <button class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete-category-{{ $category->id }}" title="delete">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </td>
                    </tr>
                    {{-- Include the modal here --}}
                    @include('admin.categories.modal.action')
                @empty
                    <tr>
                        <td colspan="5" class="lead text-muted text-center">No categories found.</td>
                    </tr>
                @endforelse
                <tr>
                    <td></td>
                    <td class="text-dark">
                        Uncategorized
                        <p class="xsmall mb-0 text-muted">Hidden posts are not include.</p>
                    </td>
                    <td>{{ $uncategorized_count }}</td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

@endsection

{{-- <div class="w-75 text-start">
    <form action="#" method="post" class="d-flex">
        <input type="text" class="form-control my-2 w-75 align-start" placeholder="Add a category...">
        <button type="submit" class="btn btn-primary mx-2 my-2">+ Add</button>
    </form>
    <table class="table table-hover align-middle bg-white border text-secondary">
        <thead class="small table-success text-secondary">
            <tr>
                <th>#</th>
                <th>NAME</th>
                <th>COUNT</th>
                <th>LAST UPDATE</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
    
        <tbody>
            @foreach ($all_categories as $category)
                <tr>
                    <td>
                        {{ $category->id }}
                    </td>
                    <td>
                        {{ $category->name }}
                    </td>
                    <td>
                        00
                    </td>
                    <td>
                        {{ $category->updated_at }}
                    </td>
                    <td>
                        <i class="fa-solid fa-pen"></i>
                    </td>
                    <td>
                        <i class="fa-solid fa-trash"></i>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div> --}}