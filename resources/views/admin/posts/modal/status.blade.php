{{-- Deactivate --}}
<div class="modal fade" id="deactivate-user-{{ $post->id }}">
    <div class="modal-dialog">
        <div class="modal-content border-danger">
            <div class="modal-header border-danger">
                <h3 class="h5 modal-title text-danger">
                    <i class="fa-solid fa-user-slash"></i> Hidden Post
                </h3>
            </div>
            <div class="modal-body">
                Are you sure you want to hidden post? <span class="fw-bold">{{ $post->name }}</span>
                <div class="mt-3">
                    <img src="{{ $post->image }}" alt="post id {{ $post->id }}" class="w-50">
                    <p class="mt-1 text-muted">{{ $post->description }}</p>
                </div>
            </div>
            <div class="modal-footer border-0">
                <form action="{{ route('admin.posts.deactivate', $post->id)}}" method="post">
                    @csrf
                    @method('DELETE')

                    <button type="button" class="btn btn-outline-danger btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger btn-sm">Hidden</button>
                    
                </form>
            </div>
        </div>
    </div>
</div>
{{-- Activate --}}
<div class="modal fade" id="activate-user-{{ $post->id }}">
    <div class="modal-dialog">
        <div class="modal-content border-success">
            <div class="modal-header border-success">
                <h3 class="h5 modal-little text-success">
                    <i class="fa-solid fa-user-check"></i> Display post
                </h3>
            </div>
            <div class="modal-body">
                Are you sure you want to display post? <span class="fw-bold">{{ $post->name }}</span>
                <div class="mt-3">
                    <img src="{{ $post->image }}" alt="post id {{ $post->id }}" class="w-50">
                    <p class="mt-1 text-muted">{{ $post->description }}</p>
                </div>
            </div>
            <div class="modal-footer border-0">
                <form action="{{ route('admin.posts.activate', $post->id)}}" method="post">
                    @csrf
                    @method('PATCH')
                    <button type="button" class="btn btn-outline-success btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success btn-sm">Display</button>
                </form>
            </div>
        </div>
    </div>
</div>