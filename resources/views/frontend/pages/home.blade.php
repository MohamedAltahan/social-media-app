@extends('frontend.layout.master')
@section('content')
    <div class="main-wrapper pt-80">
        <div class="container">
            <div class="row justify-content-center">
                @include('frontend.layout.sections.time-line')
                <div class="col-lg-3 order-3">
                    <aside class="widget-area">
                        <!-- widget single item start -->
                        <div class="card widget-item">
                            <h4 class="widget-title">Your new friends</h4>
                            <div class="widget-body">
                                <ul class="like-page-list-wrapper">
                                    <li class="unorder-list">
                                        <!-- profile picture end -->
                                        <div class="profile-thumb">
                                            <a href="#">
                                                <figure class="profile-thumb-small">
                                                    <img src="assets/images/profile/profile-35x35-9.jpg"
                                                        alt="profile picture" />
                                                </figure>
                                            </a>
                                        </div>
                                        <!-- profile picture end -->

                                        <div class="unorder-list-info">
                                            <h3 class="list-title">
                                                <a href="#">Any one can join with us if you want</a>
                                            </h3>
                                            <p class="list-subtitle">5 min ago</p>
                                        </div>
                                    </li>
                                </ul>
                                <a href="">See all friends</a>
                            </div>
                        </div>
                        <!-- widget single item end -->
                    </aside>
                </div>
            </div>
        </div>
    </div>
@endsection
