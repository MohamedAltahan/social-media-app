@extends('frontend.layout.master')
@section('content')
    <div class="main-wrapper">
        <div class="profile-banner-large bg-img" data-bg="{{ asset('uploads/' . @$user->cover) }}">
        </div>

        <div class="profile-menu-area bg-white">
            <div class="container">
                <div class="row align-items-center">

                    <div class="col-md-3 col-md-3">
                        <div class="profile-picture-box">
                            <figure class="profile-picture" style="width: 200px">
                                <a href="profile.html">
                                    <img src="{{ asset('uploads/' . @$user->avatar) }}" alt="profile picture">
                                </a>
                            </figure>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 offset-lg-1">
                        <div class="profile-menu-wrapper">
                            <div class="main-menu-inner header-top-navigation">
                                <nav>
                                    <ul class="main-menu">
                                        <li>
                                            <h4 style="margin-right: 80px;">{{ $user->name }}</h4>
                                        </li>
                                        <li><a href="{{ route('friend.show', request('id')) }}">friends</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>

                    @if (Auth::user()->id != request('id') && !$friendship)
                        <div class="col-lg-2 col-md-3 d-none d-md-block">
                            <div class="profile-edit-panel">
                                <a href="#" class="edit-btn add-friend-btn" data-id="{{ request('id') }}"
                                    data-url="{{ route('friend.store') }}">Add
                                    friend</a>
                            </div>
                        </div>
                    @elseif (Auth::user()->id != request('id') && $friendship->status == 'pending')
                        <div class="col-lg-2 col-md-3 d-none d-md-block">
                            <div class="profile-edit-panel">
                                <a href="#" class="edit-btn add-friend-btn" data-id="{{ request('id') }}"
                                    data-url="{{ route('friend.store') }}">Request Sent</a>
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>
        <div class="container">
            <div class="row justify-content-center">
                @include('frontend.layout.sections.time-line')
                <div class="col-lg-3 order-3">
                    <aside class="widget-area">
                        <!-- widget single item start -->
                        <div class="card widget-item">
                            <h4 class="widget-title">Bio</h4>
                            <div class="widget-body">
                                <ul class="like-page-list-wrapper">
                                    <div class="d-flex justify-content-center">
                                        <h5 class="text-danger ">{{ $user->bio }}</h5>
                                    </div>
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
@push('scripts')
    <script src="{{ asset('js/friend-request.js') }}"></script>
@endpush
