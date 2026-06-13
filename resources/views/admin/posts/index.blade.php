@extends('layouts.app')

@section('title', 'Admin: Users')

@section('content')

<table class="table table-hover align-middle bg-white border text-secondary">
    <thead class="small table-success text-secondary">
        <tr>
            <th></th>
            <th></th>
            <th>CATEGORY</th>
            <th>OWNER</th>
            <th>CREATED AT</th>
            <th>STATUS</th>
            <th></th>
        </tr>
    </thead>

    <tbody>
        @foreach ($all_posts as $post)
            <tr>
                <td>
                    {{ $post->id }}
                </td>
                <td>
                    <img src="{{ $post->image }}" alt="post id{{ $post->id}}" class="grid-img">
                </td>
                <td class="text-end">
                    {{-- @foreach ($post->categoryPost as $category_post)
                        <div class="badge bg-secondary bg-opacity-50">
                            {{ $category_post->category->name }}
                        </div>
                    @endforeach --}}
                    @forelse ($post->categoryPost as $category_post)
                        <span class="badge bg-secondary bg-opacity-50">
                            {{ $category_post->category->name }}
                        </span>
                    @empty
                        <div class="badge bg-dark text-wrap">Uncategorized</div>
                    @endforelse
                </td>
                <td>
                    {{ $post->user->name }}
                </td>
                <td>
                    {{ $post->created_at}}
                </td>
                <td>
                    @if ($post->trashed())
                        {{-- The $user->trashed() True or False --}}
                        <i class="fa-solid fa-circle text-secondary"></i> &nbsp; Hide
                    @else
                        <i class="fa-solid fa-circle text-success"></i> &nbsp; Visible
                    @endif

                </td>
                <td>
                    @if (Auth::user()->id !== $post->user->id)
                        <div class="dropdown">
                            <button class="btn btn-sm" data-bs-toggle="dropdown">
                                <i class="fa-solid fa-ellipsis"></i>
                            </button>

                            <div class="dropdown-menu">
                                @if ($post->trashed())
                                    <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#activate-user-{{ $post->id }}">
                                        <i class="fa-solid fa-user-check"></i> Visible {{ $post->id }}
                                    </button>
                                @else
                                    <button class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#deactivate-user-{{ $post->id }}">
                                        <i class="fa-solid fa-user-slash"></i> Hide {{ $post->id }}
                                    </button>
                                @endif
                            </div>
                        </div>
                        {{-- Includ modal here --}}
                        @include('admin.posts.modal.status')
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<div class="d-flex justify-content-center">
    {{ $all_posts->links() }}
</div>

@endsection