<div class="modal fade" id="detail-post-{{ $post->id }}">
    <div class="modal-dialog">
        <div class="modal-content border-danger">
            <div class="modal-header border-primary">
                <h3 class="h5 modal-title text-primary">
                     Users who have clicked "Like"
                </h3>
            </div>
            {{-- ここから下の部分を修正　like_usersをしっかり定義する　ポップアップ部分を作る --}}
            <div class="modal-body">
                @foreach ($like_users as $user)
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
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>