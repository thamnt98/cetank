@extends('layouts.frontEnd')
@section('css')
@endsection
@section('content')
    <div class="expert-section blog-section" style="padding:30px 0;">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-7">
                    <div class="text-uppercase pull-left"
                         style="background-color: #2b901df5;padding: 8px 20px; color: white; margin-bottom: 20px; font-size: 18px; width: 100%">
                        <b>Tiêu điểm chứng khoán</b>
                        <a title="Tiêu điểm thị trường" href="" style="float: right; font-size: 14px; color: white" class="zone__title-sub text-primary">Xem tất cả
                            <i class="fa fa-angle-double-right ml-1"></i></a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-7 col-md-7">
                    @foreach($stock_blog as $b)
                        <post class="blog-post">
                            <div class="detail-wrap">
                                <header class="detail__header">
                                    <h5 class="detail__title" style="line-height: 1.8">
                                        <a href="#" class="aDisable" title="{{ $b->title }}">{{ $b->title }}</a>
                                    </h5>
                                </header>
                                <div class="detail__content_{{ $b->id }} hidden detail-content">
                                    {!! html_entity_decode($b->description, ENT_QUOTES, 'UTF-8') !!}
                                    <div class="post-thumbnail">
                                        <a href="#"><img style="max-height: 300px; margin-bottom: 30px;" src="{{ asset('images/post') }}/{{ $b->image }}" alt=""></a>
                                    </div>
                                </div>
                                <div class="tag-post" style="color: #827777">
                                    <i class="fa fa-tags"> {{ str_replace(',', ', ' , $b->tags) }}</i>
                                </div>
                                <div class="detail__footer">
                                    <div class="detail__meta">
                                        <time>{{ \Carbon\Carbon::parse($b->created_at)->format('h:i d/m/Y') }}</time>
                                        <a class="btn btn-link text-primary see_more_{{ $b->id }} see-more" data-id="{{ $b->id }}">Xem chi tiết <i
                                                class="fa fa-angle-double-down ml-1"></i></a>
                                        <a class="btn btn-link text-primary btn-alt collapse_{{ $b->id }} hidden content-collapse" data-id="{{ $b->id }}">Thu gọn <i
                                                class="fa fa-angle-double-up ml-1"></i></a>
                                    </div>
                                </div>
                            </div>
                        </post>
                    @endforeach
                </div>
                <div class="col-lg-5 col-md-5">
{{--                    <div class="row">--}}
{{--                        @foreach($right_blog as $b)--}}
{{--                            <div class="col-lg-6 col-md-6 col-sm-6" style="margin-bottom: 20px;">--}}
{{--                                <article class="blog-post">--}}
{{--                                    <div class="post-thumbnail">--}}
{{--                                        <a href="#"><img src="{{ asset('images/post') }}/{{ $b->image }}" alt=""></a>--}}
{{--                                    </div>--}}
{{--                                    <div class="post-content">--}}
{{--                                        <h5 class="post-title"><a--}}
{{--                                                href="">{{ substr($b->title,0,30) }}{{ strlen($b->title) > 33 ? '...' : '' }}</a>--}}
{{--                                        </h5>--}}
{{--                                        <ul class="post-date list-inline">--}}
{{--                                            <li><a href="#"><i--}}
{{--                                                        class="fa fa-calendar"></i>{{ \Carbon\Carbon::parse($b->created_at)->format('h:i d/m/Y') }}--}}
{{--                                                </a></li>--}}
{{--                                            <li><a href="#"><i class="fa fa-flag"></i>{{ $b->category->name }}</a></li>--}}
{{--                                        </ul>--}}
{{--                                        <p>{{ substr(strip_tags($b->description),0,120) }}..</p>--}}
{{--                                    </div>--}}
{{--                                </article>--}}
{{--                            </div>--}}
{{--                        @endforeach--}}
{{--                    </div>--}}
                </div>
            </div>
            <div class="row">
                <div class="col-lg-7 col-md-7">
                    <div class="text-uppercase pull-left"
                         style="background-color: #2b901df5;padding: 8px 20px; color: white; margin-top:40px;margin-bottom: 20px; font-size: 18px; width: 100%">
                        <b>Tiêu điểm tiền tệ, hàng hóa, vàng </b>
                        <a title="Tiêu điểm thị trường" href="" style="float: right; font-size: 14px;color: white" class="zone__title-sub text-primary">Xem tất cả
                            <i class="fa fa-angle-double-right ml-1"></i></a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-7 col-md-7">
                    @foreach($other_blog as $b)
                        <post class="blog-post">
                            <div class="detail-wrap">
                                <header class="detail__header">
                                    <h5 class="detail__title" style="line-height: 1.8">
                                        <a href="#" class="aDisable" title="{{ $b->title }}">{{ $b->title }}</a>
                                    </h5>
                                </header>
                                <div class="detail__content_{{ $b->id }} hidden detail-content">
                                    {!! html_entity_decode($b->description, ENT_QUOTES, 'UTF-8') !!}
                                    <div class="post-thumbnail">
                                        <a href="#"><img style="max-height: 300px; margin-bottom: 30px;" src="{{ asset('images/post') }}/{{ $b->image }}" alt=""></a>
                                    </div>
                                </div>
                                <div class="detail__footer">
                                    <div class="detail__meta">
                                        <time>{{ \Carbon\Carbon::parse($b->created_at)->format('h:i d/m/Y') }}</time>
                                        <a class="btn btn-link text-primary see_more_{{ $b->id }} see-more" data-id="{{ $b->id }}">Xem chi tiết <i
                                                class="fa fa-angle-double-down ml-1"></i></a>
                                        <a class="btn btn-link text-primary btn-alt collapse_{{ $b->id }} hidden content-collapse" data-id="{{ $b->id }}">Thu gọn <i
                                                class="fa fa-angle-double-up ml-1"></i></a>
                                    </div>
                                </div>
                            </div>
                        </post>
                    @endforeach
                </div>
                <div class="col-lg-5 col-md-5">
                </div>
            </div>
        </div>
    </div>
    {{--    <div class="expert-section">--}}
    {{--        <div class="container" style="width:70%">--}}
    {{--            <div class="row">--}}
    {{--                <div class="col-md-12">--}}
    {{--                    <div class="area-heading text-center">--}}
    {{--                        <h2 class="area-title">{{ $section->about_title }}</h2>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--            <div class="row">--}}
    {{--                <div class="col-md-7">--}}
    {{--                    <div class="intro-image wow fadeIn" data-wow-delay="0.2s">--}}
    {{--                        <img src="{{ asset('images') }}/{{ $section->about_image }}" alt="" class="img-responsive">--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--                <div class="col-md-5">--}}
    {{--                    <div class=" wow fadeIn" data-wow-delay="0.2s">--}}
    {{--                        <div class="intro-description">--}}
    {{--                            <p class="text-justify">{!! $section->about_description !!}</p>--}}
    {{--                        </div>--}}
    {{--                        <div style="text-align: center;">--}}
    {{--                            <a class="button btn-block" href=""><i class="fa fa-sign-in"></i> Register Now</a>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}
    {{--    <div class="feature-section gray-bg">--}}
    {{--        <div class="container">--}}
    {{--            <div class="row">--}}
    {{--                <div class="col-md-12">--}}
    {{--                    <div class="area-heading text-center">--}}
    {{--                        <h2 class="area-title">{{ $section->speciality_title }}</h2>--}}
    {{--                        <p>{{ $section->speciality_description }}</p>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--            <div class="row">--}}

    {{--                @foreach($speciality as $key => $sp)--}}
    {{--                    <div class="col-md-4 col-sm-6">--}}
    {{--                        <div class="single-feature wow fadeIn" data-wow-delay="0.2s">--}}
    {{--                            <div class="extraSpeciality">{!! $sp->icon !!}</div>--}}
    {{--                            <div class="feature-content">--}}
    {{--                                <h4>{{ $sp->name }}</h4>--}}
    {{--                                <p>{!! $sp->description  !!}</p>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                @endforeach--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}

    <div class="expert-section colored-bg">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="area-heading text-center title-white ">
                        <h2 class="area-title">{{ $section->currency_title }}</h2>
                        <p>{{ $section->currency_description }}</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="text-center">
                        {!! $section->currency_live !!}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="text-center">
                        {!! $section->currency_cal !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--    <div class="expert-section gray-bg">--}}
    {{--        <div class="container">--}}
    {{--            <div class="row">--}}
    {{--                <div class="col-md-12">--}}
    {{--                    <div class="area-heading text-center">--}}
    {{--                        <h2 class="area-title">{{ $section->price_title }}</h2>--}}
    {{--                        <p>{{ $section->price_description }}</p>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--            <div class="row">--}}

    {{--                @foreach($plan as $pl)--}}

    {{--                    <div class="col-lg-4 col-md-4 col-sm-6" style="margin-top: 20px;">--}}
    {{--                        <div class="single-price-table table-active wow fadeIn" data-wow-delay="0.6s">--}}
    {{--                            <div class="pricing-head">--}}
    {{--                                <h4 class="pricing-title">{{ $pl->name }}</h4>--}}
    {{--                            </div>--}}
    {{--                            <div class="pricing-content">--}}
    {{--                                <div class="pricing-value-wrapper">--}}
    {{--                                    @if($pl->price_type == 0)--}}
    {{--                                        <h2 class="pricing-value">--}}
    {{--                                            FREE--}}
    {{--                                            @if($pl->plan_type == 0)--}}
    {{--                                                <sub>/ {{$pl->duration}} days</sub>--}}
    {{--                                            @else--}}
    {{--                                                <sub>/ unlimited</sub>--}}
    {{--                                            @endif--}}
    {{--                                        </h2>--}}
    {{--                                    @else--}}
    {{--                                        <h2 class="pricing-value">--}}
    {{--                                            <sup>{{ $basic->currency }}</sup>--}}
    {{--                                            {{ $pl->price }}--}}
    {{--                                            @if($pl->plan_type == 0)--}}
    {{--                                                <sub>/ {{$pl->duration}} days</sub>--}}
    {{--                                            @else--}}
    {{--                                                <sub>/ unlimited</sub>--}}
    {{--                                            @endif--}}
    {{--                                        </h2>--}}
    {{--                                    @endif--}}
    {{--                                </div>--}}
    {{--                                <ul class="table-content">--}}
    {{--                                    <li>Dashboard Signal - {{ $pl->dashboard_status == 1 ? 'YES' : 'NO' }}</li>--}}
    {{--                                    <li>Email Alert - {{ $pl->email_status == 1 ? 'YES' : 'NO' }}</li>--}}
    {{--                                    <li>SMS Alert - {{ $pl->sms_status == 1 ? 'YES' : 'NO' }}</li>--}}
    {{--                                    <li>Telegram Alert - {{ $pl->telegram_status == 1 ? 'YES' : 'NO' }}</li>--}}
    {{--                                    <li>Phone Consulting - {{ $pl->call_status == 1 ? 'YES' : 'NO' }}</li>--}}
    {{--                                    <li>Support - {{ $pl->support }}</li>--}}
    {{--                                </ul>--}}
    {{--                            </div>--}}
    {{--                            <div class="pricibg-footer">--}}
    {{--                                <a href="" class="button button-small">Subscribe now</a>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                @endforeach--}}


    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}

    <div class="expert-section" style="background: url('{{ asset('images') }}/{{ $section->counter_image }}')">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="single-counter wow fadeIn" data-wow-delay="0.2s">
                        <div class="counter-icon">
                            <i class="bi bi-spark"></i>
                        </div>
                        <div class="counter-text">
                            <p class="fact-number">{{ $total_signal }}</p>
                            <h4>Total Signal</h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="single-counter wow fadeIn" data-wow-delay="0.3s">
                        <div class="counter-icon">
                            <i class="bi bi-link"></i>
                        </div>
                        <div class="counter-text">
                            <p class="fact-number">{{ $total_category }}</p>
                            <h4>Blog Category</h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="single-counter wow fadeIn" data-wow-delay="0.4s">
                        <div class="counter-icon">
                            <i class="bi bi-article"></i>
                        </div>
                        <div class="counter-text">
                            <p class="fact-number">{{ $total_blog }}</p>
                            <h4>Total Blog</h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="single-counter wow fadeIn" data-wow-delay="0.5s">
                        <div class="counter-icon">
                            <i class="bi bi-group"></i>
                        </div>
                        <div class="counter-text">
                            <p class="fact-number">{{$total_user}}</p>
                            <h4>Happy User</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="expert-section gray-bg">
        <div class="container">
            {{--            <div class="row">--}}
            {{--                <div class="col-md-12">--}}
            {{--                    <div class="area-heading text-center">--}}
            {{--                        <h2 class="area-title">{{ $section->trading_title }}</h2>--}}
            {{--                        <p>{{ $section->trading_description }}</p>--}}
            {{--                    </div>--}}
            {{--                </div>--}}
            {{--            </div>--}}
            <div class="row">
                <div class="col-md-12">

                    {!! $section->trading_script !!}

                </div>
            </div>
        </div>
    </div>

    {{--    <div class="colored-bg call-to-action-area">--}}
    {{--        <div class="container">--}}
    {{--            <div class="row">--}}
    {{--                <div class="col-md-8">--}}
    {{--                    <div class="action-content">--}}
    {{--                        <div class="action-heading">--}}
    {{--                            <h3>{{ $section->advertise_title }}</h3>--}}
    {{--                            <p>{{ $section->advertise_description }}</p>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--                <div class="col-md-4">--}}
    {{--                    <div class="action-button">--}}
    {{--                        <a href="" class="btn button btn-primary btn-white" style="background: #ffffff;"><i--}}
    {{--                                class="fa fa-send"></i> Register Now.!</a>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}


    {{--    <div class="expert-section testimonial-section gray-bg">--}}
    {{--        <div class="container">--}}
    {{--            <div class="row">--}}
    {{--                <div class="col-md-12">--}}
    {{--                    <div class="area-heading text-center">--}}
    {{--                        <h2 class="area-title">{{ $section->testimonial_title }}</h2>--}}
    {{--                        <p>{{ $section->testimonial_description }}</p>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--            <div class="row">--}}
    {{--                <div class="col-md-12">--}}
    {{--                    <div class="testimonial-wrapper navigation-one text-center">--}}

    {{--                        @foreach($testimonial as $key => $t)--}}
    {{--                            <div class="single-testimonial">--}}
    {{--                                <blockquote>--}}
    {{--                                    <img src="{{ asset('images/testimonial') }}/{{ $t->image }}" alt="{{ $t->name }}"--}}
    {{--                                         class="client-image">--}}
    {{--                                    <p>{{ $t->message }}</p>--}}
    {{--                                    <p class="client-name">{{ $t->name }} <span--}}
    {{--                                            class="designation">{{ $t->position }}</span></p>--}}
    {{--                                </blockquote>--}}
    {{--                            </div>--}}
    {{--                        @endforeach--}}

    {{--                    </div>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}

    <div class="subscribe-section colored-bg">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-6">
                    <div class="subscribe-content">
                        <h3>{{ $section->subscriber_title }}</h3>
                        <p>{{ $section->subscriber_description }}</p>
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-6">
                    <div class="subscription-box">
                        @if (session()->has('message'))
                            <div class="alert alert-warning alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;
                                </button>
                                {{ session()->get('message') }}
                            </div>
                        @endif
                        @if($errors->any())
                            @foreach ($errors->all() as $error)
                                <div class="alert alert-danger alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                                        &times;
                                    </button>
                                    {!!  $error !!}
                                </div>
                            @endforeach
                        @endif
                        <form class="subscription-form" method="POST" action="">
                            {!! csrf_field() !!}
                            <div class="subscribe-input">
                                <input type="email" class="subscribe-control" required name="email"
                                       placeholder="Enter Your Email">
                            </div>
                            <div class="subscribe-input">
                                <button class="button email-submit-btn btn-white" type="submit"
                                        style="background: #ffffff;"><i class="fa fa-paper-plane"></i> Subscribe Now
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="expert-section blog-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="area-heading text-center">
                        <h2 class="area-title">{{ $section->blog_title }}</h2>
                        <p>{{ $section->blog_description }}</p>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($blog as $b)
                    <div class="col-md-4 col-sm-6" style="margin-bottom: 20px;">
                        <article class="blog-post">
                            <div class="post-thumbnail">
                                <a href="#"><img src="{{ asset('images/post') }}/{{ $b->image }}" alt=""></a>
                            </div>
                            <div class="post-content">
                                <h5 class="post-title"><a
                                        href="">{{ substr($b->title,0,30) }}{{ strlen($b->title) > 33 ? '...' : '' }}</a>
                                </h5>
                                <ul class="post-date list-inline">
                                    <li><a href="#"><i
                                                class="fa fa-calendar"></i>{{ \Carbon\Carbon::parse($b->created_at)->format('dS M, Y') }}
                                        </a></li>
                                    <li><a href="#"><i class="fa fa-flag"></i>{{ $b->category->name }}</a></li>
                                </ul>
                                <p>{{ substr(strip_tags($b->description),0,120) }}..</p>
                                <a class="button" href="">Read More</a>
                            </div>
                        </article>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
@section('javascript')
    <script>
        $(document).ready(function () {
            $('.see-more').on('click', function () {
                let id = $(this).attr('data-id');
                $('.content-collapse').addClass('hidden');
                $('.collapse_' + id).removeClass('hidden');
                $('.detail-content').addClass('hidden');
                $('.see-more').removeClass('hidden');
                $('.see_more_' + id).addClass('hidden');
                $('.detail__content_' + id).removeClass('hidden');
            })
            $('.content-collapse').on('click', function () {
                let id = $(this).attr('data-id');
                $('.content-collapse').addClass('hidden');
                $('.detail-content').addClass('hidden');
                $('.see-more').removeClass('hidden');
            })
        })
    </script>
@endsection
