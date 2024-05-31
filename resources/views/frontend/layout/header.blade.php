<!-- header area start -->
<header>
    <div class="header-top sticky bg-white d-none d-lg-block">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-5">
                    <!-- header top navigation start -->
                    <div class="header-top-navigation">
                        <nav>
                            <ul>
                                <li class=""><a href="{{ url('/') }}"><i class="fa-solid fa-house"></i>
                                        home</a></li>

                                <li class=""><a href="{{ route('time-line.index', Auth::user()->id) }}"><i
                                            class="fa-solid fa-bars-staggered"></i>
                                        Profile</a></li>

                                <li class="notification-trigger"><a class="msg-trigger-btn" href="#b">
                                        <span>{{ count(Auth::user()->unreadnotifications) }}</span><i
                                            class="fa-regular fa-bell"></i> notification</a>
                                    <div class="message-dropdown" id="b">
                                        <div class="dropdown-title">
                                            <p class="recent-msg"><i class="fa-regular fa-bell"></i>Notification</p>
                                        </div>

                                        {{-- notifications_____________________________________________________ --}}
                                        <ul class="dropdown-msg-list">
                                            @forelse(Auth::user()->notifications->take(5) as $notification)
                                                <li class="msg-list-item d-flex justify-content-between">

                                                    <!-- profile picture start -->
                                                    <div class="profile-thumb">
                                                        <figure class="profile-thumb-middle">
                                                            <a href="{{ @$notification->data['notificationUrl'] }}">
                                                                <img src="{{ asset('uploads/' . @$notification->data['senderAvatar']) }}"
                                                                    alt="profile picture">
                                                            </a>
                                                        </figure>
                                                    </div>

                                                    <!-- message content start -->
                                                    <div class="msg-content notification-content">
                                                        <a href="{{ @$notification->data['notificationUrl'] }}">{{ $notification->data['senderName'] }},
                                                            <p style="font-size: 16px">
                                                                {{ $notification->data['eventType'] }}</p>
                                                        </a>
                                                    </div>

                                                    <!-- message content end -->
                                                    <div class="msg-time">
                                                        <p>{{ $notification->created_at->diffForHumans() }}</p>
                                                    </div>

                                                    @if ($notification->unread())
                                                        <strong class="px-2">Not read</strong>
                                                    @endif

                                                </li>
                                            @empty
                                                <div class="d-flex justify-content-center">
                                                    <h5 class="text-danger p-3 ">{{ __('No notifications yet') }}</h5>
                                                </div>
                                            @endforelse
                                        </ul>

                                        <div class="msg-dropdown-footer">
                                            <a href="{{ route('notifications.read-all') }}">Mark All as Read</a>
                                            <a href="{{ route('notifications.clear-all') }}">Clear all</a>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    <!-- header top navigation start -->
                </div>

                <div class="col-md-2">
                    <!-- brand logo start -->
                    <div class="brand-logo text-center">
                        <a href="{{ url('/') }}">
                            <img src="{{ asset('frontend') }}/images/logo/logo.png" alt="brand logo">
                        </a>
                    </div>
                    <!-- brand logo end -->
                </div>

                <div class="col-md-5">
                    <div class="header-top-right d-flex align-items-center justify-content-end">
                        <!-- header top search start -->
                        <div class="header-top-search">
                            <form class="top-search-box">
                                <input type="text" placeholder="Search" class="top-search-field">
                                <button class="top-search-btn"><i class="flaticon-search"></i></button>
                            </form>
                        </div>
                        <!-- header top search end -->

                        <!-- profile picture start -->
                        <div class="profile-setting-box">
                            <div class="profile-thumb-small">
                                <a href="javascript:void(0)" class="profile-triger">
                                    <figure>
                                        <img src="{{ asset('uploads/' . Auth::user()->avatar) }}"
                                            alt="profile picture">
                                    </figure>
                                </a>
                                <div class="profile-dropdown">
                                    <div class="profile-head">
                                        <h5 class="name"><a href="#">{{ Auth::user()->name }}</a></h5>
                                        <a class="mail" href="#">{{ Auth::user()->email }}</a>
                                    </div>
                                    <div class="profile-body">
                                        <ul>
                                            <li><a href="{{ route('profile.update') }}"><i
                                                        class="flaticon-settings"></i>
                                                    {{ __('Setting') }}</a>
                                            </li>
                                        </ul>
                                        <ul>
                                            <li>
                                                <!-- logout -->
                                                <form method="POST" action="{{ route('logout') }}">
                                                    @csrf

                                                    <x-responsive-nav-link :href="route('logout')"
                                                        onclick="event.preventDefault();
                                                        this.closest('form').submit();"><i
                                                            class="flaticon-unlock"></i>{{ __('Log Out') }}
                                                    </x-responsive-nav-link>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- profile picture end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- header area end -->
