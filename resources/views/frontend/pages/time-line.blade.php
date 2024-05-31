@extends('frontend.layout.master')
@section('content')
    <div class="main-wrapper">
        <div class="profile-banner-large bg-img" data-bg="{{ asset('uploads/' . Auth::user()->cover) }}">
        </div>
        <div class="profile-menu-area bg-white">
            <div class="container">
                <div class="row align-items-center">

                    <div class="col-lg-3 col-md-3">
                        <div class="profile-picture-box">
                            <figure class="profile-picture" style="width: 200px">
                                <a href="profile.html">
                                    <img src="{{ asset('uploads/' . Auth::user()->avatar) }}" alt="profile picture">
                                </a>
                            </figure>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 offset-lg-1">
                        <div class="profile-menu-wrapper">
                            <div class="main-menu-inner header-top-navigation">
                                <nav>
                                    <ul class="main-menu">
                                        <li><a href="about.html">bio</a></li>
                                        <li><a href="photos.html">photos</a></li>
                                        <li><a href="friends.html">friends</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>

                    @if (Auth::user()->id != request('id'))
                        <div class="col-lg-2 col-md-3 d-none d-md-block">
                            <div class="profile-edit-panel">
                                <a href="{{ route('profile.edit') }}" class="edit-btn">Add friend</a>
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>
        <div class="container">
            <div class="row justify-content-center">
                @include('frontend.layout.sections.time-line')
            </div>
        </div>
    </div>
@endsection
