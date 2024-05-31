<div class="widget-body">
    <ul class="like-page-list-wrapper">
        @forelse ($postLikes as $postLike)
            <li class="unorder-list border border-dark p-1">
                <!-- profile picture end -->
                <div class="profile-thumb">
                    <a href="{{ route('time-line.index', $postLike->user->id) }}">
                        <figure class="profile-thumb-small">
                            <img src="{{ asset('uploads/' . $postLike->user->avatar) }}" alt="profile picture" />
                        </figure>
                    </a>
                </div>
                <!-- profile picture end -->

                <div class="unorder-list-info">
                    <h3 class="list-title">
                        <a href="{{ route('time-line.index', $postLike->user->id) }}">{{ $postLike->user->name }}</a>
                    </h3>
                </div>
            </li>
        @empty
            <div class="d-flex justify-content-center">
                <h5 class="text-danger ">{{ __('No likes yet') }}</h5>
            </div>
        @endforelse
    </ul>
</div>
