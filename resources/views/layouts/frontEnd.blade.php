<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Homepage | HomePage</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- @if($meta == 1) --}}
        <meta property="og:title" content="{{ $basic->title }}">
        <meta name="description" content="{{ $basic->description }}">
        <meta name="keyword" content="{{ $basic->meta_tag }}">
        <meta name="author" content="{{ $basic->author }}">
        <meta property="og:description" content="{{ $basic->description }}" />
        <meta property="og:image" content="{{ asset('images/logo.png') }}" />
    {{-- @else
        @yield('meta')
    @endif --}}
    <link rel="icon" href="{{ asset('images/favicon.png') }}">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,700,800" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/elements.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/color.php') }}?color={{ $basic->color }}">
    <script src="{{ asset('js/modernizr-2.8.3.min.js') }}"></script>
    @yield('css')
</head>

<body>
<!-- expert loader start -->
{{-- <div id="expert-loader">
    <div class="loader-wrapper">
        <div class="loader-content">
            <div class="loader-dot dot-four"></div>
            <div class="loader-dot dot-three"></div>
            <div class="loader-dot dot-two"></div>
            <div class="loader-dot dot-one"></div>
        </div>
    </div>
</div> --}}
<!-- expert loader End -->
<!-- Main wrapper start -->
<div class="wrapper">
    <!-- Header area start -->
    <header class="header-area">
        <div class="header-top-area header-top-2">
            <div class="container" style="width:95%">
                <div class="row">
                    <div class="col-lg-8 col-sm-12 col-md-8">
                        <div class="header-top-left">
                            <ul class="email-phone">
                                <li style="border-left: none"><a href="#"><i class="fa fa-envelope"></i> Email: <span class="text-bold">robot@cetank.net</span></a></li>
                                <li><a href="#"><i class="fa fa-phone"></i> Call us: <span class="text-bold">0972.845.880</span></a></li>
                                <li  class="search">
                                    <form>
                                        <input style="height: 40px;margin-bottom: 10px" class="form-control" type="text" placeholder="Search" >
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-0 col-md-4">
                        <div class="header-top-right" style="margin-top:10px">
                            <ul class="user-area social-area">
                                <li><a href="https://www.facebook.com/" target="_blank"><i class="fa fa-facebook"></i></a></li>
                                <li style="border-left: none"><a  target="_blank" href="https://www.youtube.com"><i class="fa fa-youtube-play"></i></a></li>
                            @if(Auth::check())
                                    <li><a href=""><i class="fa fa-user user-icon" style="margin-right: 5px;!important;"></i>Hi. {{ Auth::user()->name }}</a></li>
                            @else
                                    <li><a href="{{ route('login') }}"><i class="fa fa-sign-in user-icon"></i>Login</a></li>
                                    <li style="border-right: none"><a href="{{ route('register') }}"><i class="fa fa-user-plus user-icon"></i>Sign Up</a></li>
                            @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="main-header-area sticky-header">
            <div class="container" style="width:95%">
                <div class="row">
                    <div class="col-lg-2 col-md-4 col-sm-6 col-xs-7">
                        <div class="logo-wrapper">
                            <a class="logo" href="{{ route('home') }}"><img style="max-width: -webkit-fill-available;" src="{{ asset('images/logo.png') }}" alt=""></a>
                        </div>
                    </div>
                    <div class="col-lg-10 col-md-8 hidden-xs hidden-sm">
                        <nav class="expert-menu">
                            <ul class="main-menu">
                                <li><a href="{{ route('home') }}">Home</a> </li>
                            @foreach($category as $c)
                                    @if(!$c->parent_id)
                                        @if(count($c->child) == 0)
                                            @if($c->id == 10)
                                                <li><a href="https://keynesacademy.com/" target="_blank">{{ $c->name }}</a> </li>
                                            @else
                                                <li><a href="{{ route('post.list', $c->slug) }}">{{ $c->name }}</a> </li>
                                            @endif
                                        @else
                                            <li><a href="{{ route('post.list', $c->slug) }}">{{ $c->name }}<i class="fa fa-caret-down"></i></a>
                                                <ul>
                                                    @foreach($c->child as $child)
                                                        <li><a href="{{ route('post.list', $child->slug) }}"><i class="fa fa-caret-right"></i> {{ $child->name }}</a></li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                        @endif
                                    @endif
                                @endforeach
{{--                                <li><a href="">Home</a></li>--}}
{{--                                <li><a href="">About Us</a></li>--}}
{{--                                <li><a href="">News<i class="fa fa-caret-down"></i></a>--}}
{{--                                    <ul>--}}
{{--                                        @foreach($category as $cat)--}}
{{--                                            <li><a href=""><i class="fa fa-caret-right"></i> {{ $cat->name }}</a></li>--}}
{{--                                        @endforeach--}}
{{--                                    </ul>--}}
{{--                                </li>--}}
{{--                                @foreach($menus as $m)--}}
{{--                                    <li><a href="{{ route('menu.detail', $m->slug)  }}">{{ $m->name }}</a></li>--}}
{{--                                @endforeach--}}
                            </ul>
                        </nav>
                    </div>
                    <!-- Mobile menu area start -->
                    <div class="mobile-menu-area clearfix hidden-md">
                        <nav class="mobile-menu">
                            <ul class="mobile-menu-nav">
                                <li><a href="{{ route('home') }}">Home</a> </li>
                                @foreach($category as $c)
                                    @if(!$c->parent_id)
                                        @if(count($c->child) == 0)
                                            @if($c->id == 10)
                                                <li><a href="https://keynesacademy.com/" target="_blank">{{ $c->name }}</a> </li>
                                            @else
                                                <li><a href="{{ route('post.list', $c->slug) }}">{{ $c->name }}</a> </li>
                                            @endif
                                        @else
                                            <li><a href="{{ route('post.list', $c->slug) }}">{{ $c->name }}<i class="fa fa-caret-down"></i></a>
                                                <ul>
                                                    @foreach($c->child as $child)
                                                        <li><a href="{{ route('post.list', $child->slug) }}"><i class="fa fa-caret-right"></i> {{ $child->name }}</a></li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                        @endif
                                    @endif
                                @endforeach
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <section class="content">

        @yield('content')

    </section>
    <footer class="footer-section">
        <div class="footer-top-area">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-sm-6">
                        <div class="footer-about-info-area footer-top-content">
                            <div class="footer-widget-heading">
                                <a class="logo" href=""><img src="{{ asset('images/logo.png') }}" alt=""></a>
                            </div>
                            <div class="footer-widget-content">
                                <p>{{$basic->footer_text}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="footer-top-content">
                            <div class="footer-widget-heading">
                                <h3>Popular Category</h3>
                            </div>
                            <div class="footer-widget-content">
                                <ul class="links">
                                    @foreach($footer_category as $fc)
                                    <li>
                                        <i class="fa fa-angle-right"></i>
                                        <a href="">{{ $fc->name }}</a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="footer-top-content">
                            <div class="footer-widget-heading">
                                <h3>Popular Blog</h3>
                            </div>
                            <div class="footer-widget-content">
                                <ul class="links">
                                    @foreach($footer_blog as $fb)
                                        <li>
                                            <i class="fa fa-angle-right"></i>
                                            <a href="">{{ substr($fb->title,0,25) }}{{ strlen($fb->title) > 25 ? '...' : '' }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="footer-contact-info-area footer-top-content">
                            <div class="footer-widget-heading">
                                <h3>contact Details</h3>
                            </div>
                            <div class="footer-widget-content">
                                <ul class="footer-conatct-menu">
                                    <li>
                                        <a><i class="fa fa-envelope"></i><span>Email :</span> {{ $basic->email }}</a>
                                    </li>
                                    <li>
                                        <a><i class="fa fa-phone"></i> <span>Phone : </span> {{ $basic->phone }}</a>
                                    </li>
                                    <li>
                                        <a><i class="fa fa-map-o"></i><span>Address :</span>{{ $basic->address }}</a>
                                    </li>
                                </ul>
                                <ul class="footer-social-menu list-inline">
                                    @foreach($social as $s)
                                    <li><a href="{{ $s->link }}" target="_blank">{!! $s->code !!}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom-area">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="footer-copyright-info">
                            <p>{!! $basic->copy_text !!}</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="footer-bottom-menu">
                            <ul class="footer-main-menu">
                                <li>
                                    <a href="">home</a>
                                </li>
                                <li>
                                    <a href="">about</a>
                                </li>
                                <li>
                                    <a href="">terms & Condition</a>
                                </li>
                                <li>
                                    <a href="">Privacy policy</a>
                                </li>
                                <li>
                                    <a href="">contact</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>
<script src="{{ asset('js/jquery-1.12.4.min.js') }}"></script>
<script src="{{ asset('js/plugins.js') }}"></script>
<script src="{{ asset('js/scripts.js') }}"></script>
@yield('javascript')
{!! $basic->chat !!}
{!! $basic->google_analytic !!}
</body>

</html>
