@extends('frontend.layout.master')
@section('content')
    <div class="main-wrapper">
        <div class="profile-banner-large bg-img" data-bg="{{ asset('uploads/' . @$user->cover) }}">
        </div>

        <div class="profile-menu-area bg-white">
            <div class="container">
                <div class="row align-items-center">

                    <div class="col-md-4 col-md-4">
                        <div class="profile-picture-box">
                            <figure class="profile-picture" style="width: 200px">
                                <a href="{{ route('time-line.index', Auth::user()->id) }}">
                                    <img src="{{ asset('uploads/' . @$user->avatar) }}" alt="profile picture">
                                </a>
                            </figure>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-4">
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
                    @elseif (Auth::user()->id != request('id') && $friendship == 'sent')
                        <div class="col-lg-2 col-md-3 d-none d-md-block">
                            <div class="profile-edit-panel">
                                <a href="#" class="edit-btn add-friend-btn" data-id="{{ request('id') }}"
                                    data-url="{{ route('friend.store') }}">Request Sent</a>
                            </div>
                        </div>
                    @elseif (Auth::user()->id != request('id') && $friendship == 'accept')
                        <div class="row" style="margin-left: 70%">
                            <div class="profile-edit-panel col-md-1 m-1">
                                <a href="#" class="edit-btn add-friend-btn" data-id="{{ request('id') }}"
                                    data-url="{{ route('friend.store') }}">accept request</a>
                            </div>

                            <div class="profile-edit-panel col-md-1 m-1">
                                <a href="#" class="edit-btn delete-friend-btn"
                                    data-url="{{ route('friend.destroy', request('id')) }}">Cancel request</a>
                            </div>

                        </div>
                    @elseif (Auth::user()->id != request('id') && $friendship == 'friend')
                        <div class="col-lg-2 col-md-3 d-none d-md-block">
                            <div class="profile-edit-panel">
                                <a href="#" class="edit-btn add-friend-btn" data-id="{{ request('id') }}"
                                    data-url="{{ route('friend.store') }}"> click to unfriend</a>
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
