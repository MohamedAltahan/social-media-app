<div id="comment-list">
    <div class="card">
        <input type="hidden" id="post_id" value="{{ $postId }}">
        <h4 class="widget-title">All comments</h4>
        <div class="widget-body">
            <ul class="like-page-list-wrapper">
                @forelse ($comments as $comment)
                    <li class="unorder-list border border-dark p-1">
                        <!-- profile picture end -->
                        <div class="profile-thumb">
                            <a href="{{ route('time-line.index', $comment->user->id) }}">
                                <figure class="profile-thumb-small">
                                    <img src="{{ asset('uploads/' . $comment->user->avatar) }}" alt="profile picture" />
                                </figure>
                            </a>
                        </div>
                        <!-- profile picture end -->

                        <div class="unorder-list-info">
                            <h3 class="list-title">
                                <a
                                    href="{{ route('time-line.index', $comment->user->id) }}">{{ $comment->user->name }}</a>
                            </h3>
                            <h6 class="mx-4">{{ $comment->body }}</h6>
                            <p class="list-subtitle">
                                {{ \Carbon\Carbon::createFromTimeStamp(strtotime($comment->created_at))->diffForHumans() }}
                            </p>
                        </div>
                    </li>
                @empty
                    <div class="d-flex justify-content-center">
                        <h5 class="text-danger ">{{ __('No comments yet') }}</h5>
                    </div>
                @endforelse
            </ul>
        </div>
    </div>
</div>
