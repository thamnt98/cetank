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
                        <b>Cổ phiếu Việt Nam</b>
                        <a title="Tiêu điểm thị trường" href="{{ route('post.list', $stock_blog_slug)}}"
                           style="float: right; font-size: 14px; color: white" class="zone__title-sub text-primary">Xem
                            tất cả
                            <i class="fa fa-angle-double-right ml-1"></i></a>
                    </div>
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
                                        <a href="#"><img style="max-height: 300px; margin-bottom: 30px;"
                                                         src="{{ asset('images/post') }}/{{ $b->image }}" alt=""></a>
                                    </div>
                                </div>
                                <div class="tag-post" style="color: #827777">
                                    <i class="fa fa-tags">
                                    @foreach($b->tags as $key => $tag)
                                        <a href="{{ route('tag.list', $tag) }}"> {{ $tag }} @if($key != array_key_last($b->tags)),@endif</a>
                                    @endforeach
                                    </i>
                                </div>
                                <div class="detail__footer">
                                    <div class="detail__meta">
                                        <time>{{ \Carbon\Carbon::parse($b->created_at)->format('h:i d/m/Y') }}</time>
                                        <a class="btn btn-link text-primary see_more_{{ $b->id }} see-more"
                                           data-id="{{ $b->id }}">Xem chi tiết <i
                                                class="fa fa-angle-double-down ml-1"></i></a>
                                        <a class="btn btn-link text-primary btn-alt collapse_{{ $b->id }} hidden content-collapse"
                                           data-id="{{ $b->id }}">Thu gọn <i
                                                class="fa fa-angle-double-up ml-1"></i></a>
                                    </div>
                                </div>
                            </div>
                        </post>
                    @endforeach
                    <div class="text-uppercase pull-left"
                         style="background-color: #2b901df5;padding: 8px 20px; color: white; margin-top:40px;margin-bottom: 20px; font-size: 18px; width: 100%">
                        <b>Tiêu điểm tiền tệ, hàng hóa, vàng </b>
                        <a title="Tiêu điểm thị trường" href="{{ route('post.list', $other_blog_slug)}}"
                           style="float: right; font-size: 14px;color: white" class="zone__title-sub text-primary">Xem
                            tất cả
                            <i class="fa fa-angle-double-right ml-1"></i></a>
                    </div>
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
                                        <a href="#"><img style="max-height: 300px; margin-bottom: 30px;"
                                                         src="{{ asset('images/post') }}/{{ $b->image }}" alt=""></a>
                                    </div>
                                </div>
                                <div class="tag-post" style="color: #827777">
                                    <i class="fa fa-tags"> {{ str_replace(',', ', ' , $b->tags) }}</i>
                                </div>
                                <div class="detail__footer">
                                    <div class="detail__meta">
                                        <time>{{ \Carbon\Carbon::parse($b->created_at)->format('h:i d/m/Y') }}</time>
                                        <a class="btn btn-link text-primary see_more_{{ $b->id }} see-more"
                                           data-id="{{ $b->id }}">Xem chi tiết <i
                                                class="fa fa-angle-double-down ml-1"></i></a>
                                        <a class="btn btn-link text-primary btn-alt collapse_{{ $b->id }} hidden content-collapse"
                                           data-id="{{ $b->id }}">Thu gọn <i
                                                class="fa fa-angle-double-up ml-1"></i></a>
                                    </div>
                                </div>
                            </div>
                        </post>
                    @endforeach
                </div>
                <div class="col-lg-5 col-md-5">
                    <div class="" style="margin-bottom: 20px">
                        <div class="text-uppercase pull-left"
                             style="padding: 8px 20px;font-size: 18px; width: 100%; margin-top: 10px;">
                            <b>Phân tích - Nhận định</b>
                        </div>
                        <article class="blog-post">
                            <div class="post-thumbnail" style="padding: 30px">
                                <a href="#"><img class="shadow-sm bg-white rounded"
                                                 src="{{ asset('images/post') }}/{{ $top_right_blog->image }}" alt=""
                                                 style="max-width: 100%;"></a>
                            </div>
                            <div class="post-content" style="padding: 0px 30px;">
                                <h5><a
                                        href="{{ route('post.detail',$top_right_blog->slug) }}">{{ $top_right_blog->title }}</a>
                                </h5>
                                <ul class="post-date list-inline">
                                    <li><a href="#"><i
                                                class="fa fa-calendar"></i>{{ \Carbon\Carbon::parse($top_right_blog->created_at)->format('h:i d/m/Y') }}
                                        </a></li>
                                </ul>
                                <p>{{ substr(strip_tags($top_right_blog->description),0,150) }}...</p>
                            </div>
                        </article>
                        <div class="row" style="background-color: white; margin:0px">
                            @foreach($right_blog as $b)
                                <div class="col-lg-6 col-md-6 mb-md-3" style="padding-left: 30px">
                                    <article class="blog-post" style="margin-top:15px">
                                        <div class="post-thumbnail">
                                            <a href="#"><img src="{{ asset('images/post') }}/{{ $b->image }}" alt=""
                                                             style="max-width: 100%;"
                                                             class="shadow-sm bg-white rounded"></a>
                                        </div>
                                        <div class="post-content" style="margin-top: -10px">
                                            <h5><a
                                                    href="{{ route('post.detail',$b->slug) }}">{{ $b->title }}</a>
                                            </h5>
                                            <ul class="post-date list-inline">
                                                <li><a href="#"><i
                                                            class="fa fa-calendar"></i>{{ \Carbon\Carbon::parse($b->created_at)->format('h:i d/m/Y') }}
                                                    </a></li>
                                            </ul>
                                        </div>
                                    </article>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
            <div class="row">
                <div class="col-md-12">

                    {!! $section->trading_script !!}

                </div>
            </div>
        </div>
    </div>
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
