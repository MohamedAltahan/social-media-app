<div class="col-lg-8 order-1 order-lg-2">
    <!-- share box start -->
    <div class="card card-small">
        <div class="share-box-inner">

            <!-- profile picture end -->
            <div class="profile-thumb">
                <a href="#">
                    <figure class="profile-thumb-middle">
                        <img src="{{ asset('uploads/' . Auth::user()->avatar) }}" alt="profile picture">
                    </figure>
                </a>
            </div>
            <!-- profile picture end -->

            <!-- share content box start -->
            <div class="share-content-box w-100">
                <form class="share-text-box">
                    <textarea name="share" class="share-text-field" aria-disabled="true" placeholder="Say Something"
                        data-bs-toggle="modal" data-bs-target="#add-new-post" id="email"></textarea>
                    <button class="btn-share" type="button">share</button>
                </form>
            </div>
            <!-- share content box end -->

            <!-- Modal start for posts -->
            <div class="modal fade" id="add-new-post" aria-labelledby="textbox">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Share post</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <form class="share-text-box" action="{{ route('post.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body custom-scroll">
                                <textarea name="body" class="share-field-big custom-scroll" placeholder="Say Something"></textarea>
                            </div>
                            <div class="modal-footer">
                                <label style="margin-right: 160px;" for="file" class="btn btn-primary"><i
                                        class="fa-solid fa-paperclip"></i>
                                    Select photo</label>
                                <input accept="image/*" id="file" type="file" name="post_image"
                                    style="display:none">
                                <button type="button" class="post-share-btn" data-bs-dismiss="modal"> cancel </button>
                                <button type="submit" class="post-share-btn"> post</button>
                        </form>

                    </div>
                </div>
            </div>
            <!-- Modal start for comments -->

        </div>
        <!-- Modal end -->

    </div>
</div>
<!-- share box end -->

@foreach ($posts as $post)
    <!-- post status start -->
    <div class="card">
        <!-- post title start -->
        <div class="post-title d-flex align-items-center">
            <!-- profile picture end -->
            <div class="profile-thumb">
                <a href="#">
                    <figure class="profile-thumb-middle">
                        <img src="{{ asset('uploads/' . $post->user->avatar) }}" alt="profile picture" />
                    </figure>
                </a>
            </div>
            <!-- profile picture end -->

            <div class="posted-author">
                <h6 class="author">
                    <a href="profile.html">{{ $post->user->name }}</a>
                </h6>
                <span
                    class="post-time">{{ \Carbon\Carbon::createFromTimeStamp(strtotime($post->created_at))->diffForHumans() }}</span>
            </div>

            <div class="post-settings-bar">
                <span></span>
                <span></span>
                <span></span>
                <div class="post-settings arrow-shape">
                    <ul>
                        <li><button>edit post</button></li>
                        <li><button>delete post</button></li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- post title start -->
        <div class="post-content">
            <p class="post-desc">{{ $post->body }} </p>

            @if (isset($post->image))
                <div class="post-thumb-gallery">
                    <figure class="post-thumb img-popup">
                        <a href="{{ asset('uploads/' . $post->image->name) }}">
                            <img src="{{ asset('uploads/' . $post->image->name) }}" alt="" />
                        </a>
                    </figure>
                </div>
            @endif

            <div class="post-meta">

                <div id="like_btn{{ $post->id }}">
                    @if (in_array($post->id, $myLikes))
                        <button class="post-like rounded btn btn-primary"data-id="{{ $post->id }}"
                            data-likebtn="{{ $post->id }}" data-url="{{ route('like.store') }}">
                            <i style="font-size: 20px" class="fa-regular fa-thumbs-up"></i>
                            <span>like</span>
                        </button>
                    @else
                        <button class="post-like rounded" data-id="{{ $post->id }}"
                            data-url="{{ route('like.store') }}">
                            <i style="font-size: 20px" class="fa-regular fa-thumbs-up"></i>
                            <span>like</span>
                        </button>
                    @endif
                </div>

                <button class="post-meta-like mx-3 show-like" data-url="{{ route('like.show', $post->id) }}">
                    <span>{{ $post->likes_count }}</span>
                    <span> people like this</span>
                </button>

                <ul class="comment-share-meta">

                    <li>
                        <button class="post-comment" data-id="{{ $post->id }}"
                            data-url="{{ route('comment.show', $post->id) }}">
                            <i class="bi bi-chat-bubble"></i>
                            <span>{{ $post->comments_count }} comments</span>
                        </button>
                    </li>

                </ul>
            </div>
        </div>
    </div>
@endforeach
<!-- post status end -->
</div>


<!-- Modal for comments-->
<div class="modal fade " id="comments-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">All comments</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form>
                @csrf
                <div class="modal-body">
                    <h5>Add comment</h5>
                    <div class="my-3">
                        <textarea class="form-control" id="comment_body" name="body" placeholder="write comment here" autofocus></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="add-comment-btn"
                        data-url="{{ route('comment.store') }}">Add comment</button>
                </div>
            </form>

            <div class="show-comments"></div>
        </div>
    </div>
</div>

<!-- Modal for post likes -->
<div class="modal fade " id="likes-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">People likes this post</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="show-likes px-2"></div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>

@push('scripts')
    <script src="{{ asset('js/comment.js') }}"></script>
    <script src="{{ asset('js/add-comment.js') }}"></script>
    <script src="{{ asset('js/like-post.js') }}"></script>
@endpush
