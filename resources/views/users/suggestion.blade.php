@extends('layouts.app')

@section('title', 'Home')

@section('content')

<div class="container mx-auto w-75 bg-white">
    <p class="fw-bold text-secondary my-3">Suggested</p>
    @foreach ($suggested_users as $user)
        <div class="row align-items-center mb-3">
            <div class="col-auto">
                {{-- Avatar --}}
                <a href="#" class="">
                    @if ($user->avatar)
                        <img src="{{ $user->avatar }}" alt="{{ $user->name }}" class="rounded-circle avatar-sm">
                    @else
                        <i class="fa-solid fa-circle-user text-secondary icon-sm"></i>
                    @endif
                </a>
            </div>
            <div class="col ps-0 text-truncate">
                {{-- Name of the user --}}
                <a href="{{ route('profile.show', $user->id) }}" class="text-decoration-none text-dark fw-bold">{{ $user->name }}</a>
            </div>
            <div class="col-auto">
                {{-- Follow Button --}}
                <form action="{{ route('follow.store', $user->id) }}" method="post">
                    @csrf
                    <button type="submit" class="btn border-0 rounded-2 btn-primary p-1 text-white text-bold">Follow</button>
                </form>
            </div>
        </div>
    @endforeach
</div>
@endsection