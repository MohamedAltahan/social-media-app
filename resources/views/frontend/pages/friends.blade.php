@extends('frontend.layout.master')
@section('content')
    <div class="main-wrapper pt-80">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-9 order-9">
                    <aside class="widget-area">
                        <!-- widget single item start -->
                        <div class="card widget-item">
                            <h4 class="widget-title">users</h4>
                            <div class="widget-body">
                                <ul class="like-page-list-wrapper">
                                    @if (isset($friends))
                                        @forelse ($friends as $friend)
                                            <li class="unorder-list border border-dark p-1">
                                                <!-- profile picture end -->
                                                <div class="profile-thumb">
                                                    <a href="{{ route('time-line.index', $friend->id) }}">
                                                        <figure class="profile-thumb-small">
                                                            <img src="{{ asset('uploads/' . $friend->avatar) }}"
                                                                alt="profile picture" />
                                                        </figure>
                                                    </a>
                                                </div>
                                                <!-- profile picture end -->
                                                <div class="unorder-list-info">
                                                    <h3 class="list-title">
                                                        <a href="{{ route('time-line.index', $friend->id) }}">
                                                            {{ $friend->name }}</a>
                                                    </h3>
                                                </div>
                                            </li>
                                        @empty
                                            <div class="d-flex justify-content-center">
                                                <h5 class="text-danger ">{{ __('Nothing ^__^') }}</h5>
                                            </div>
                                        @endforelse
                                    @endif

                                </ul>
                            </div>
                        </div>
                        <!-- widget single item end -->
                    </aside>
                </div>
            </div>
        </div>
    </div>
@endsection
