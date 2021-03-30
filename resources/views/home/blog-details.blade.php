@extends('layouts.frontEnd')
@section('content')
<div class="expert-section expert-blog-section">
    <div class="container">
        <div class="row">
            <!-- <div class="col-lg- col-lg-push-3 col-md-8 col-md-push-4 col-sm-12"> -->
            <article class="blog-post">
                <div class="blog-detail">
                    <h3><a href="#" style="margin-bottom: 30px;">{{ $blog->title }}</a></h3>
                    <ul class="post-date list-inline">
                        <li><a href="#"><i class="fa fa-calendar"></i>{{ \Carbon\Carbon::parse($blog->created_at)->format('dS M, Y h:i A') }}</a></li>
                    </ul>
                    <div class="blog-comment-section" style="margin-top:-20px">
                        <h4 class="comment-title"></h4>
                        <ul class="media-list">
                            <div class="sharethis-inline-share-buttons st-inline-share-buttons  st-left st-has-labels st-animated" id="st-1">
                                <script type="text/javascript" src="//platform-api.sharethis.com/js/sharethis.js#property=5993ef01e2587a001253a261&product=inline-share-buttons"></script>
                            </div>
                        </ul>
                    </div>
                    <hr style="margin-top: 40px;">
                    <div class="post-content">
                        <div class="post-content-inner">
                            <p>{!! $blog->description !!}</p>
                        </div>
                    </div>
                    <div class="post-footer">
                        <ul class="post-date list-inline">
                            <li><b><i class="fa fa-tags"></i>Xem thêm các chủ đề: </b></li>
                            @foreach($blog->tags as $key => $tag)
                                <li class="tag-item">
                                    <a href="{{ route('tag.list', $tag) }}">{{ $tag }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
            </article>

            <!-- <div class="col-lg-3 col-lg-pull-9 col-md-4 col-md-pull-8 col-sm-12"> -->
            <!-- <aside class="single-widget">
                <h4 class="widget-title">Categories</h4>
                <ul class="post-cat-list">
                    @foreach($category as $cat)
                    <li><a href="#">{{ $cat->name }} <span>[{{ \App\Models\Post::whereStatus(1)->whereCategory_id($cat->id)->count() }}]</span></a></li>
                    @endforeach
                </ul>
            </aside> -->
            <!-- <aside class="single-widget">
                <h4 class="widget-title">Popular Post</h4>
                <div class="recent-post-widget">
                    @foreach($popular as $p)
                    <div class="single-post-widget clearfix">
                        <img src="{{ asset('assets/images/post') }}/{{ $p->image }}" alt="" style="width: 80px;">
                        <div class="post-widget-content">
                            <h4><a href="#">{{ substr($p->title,0,15) }}..</a></h4>
                            <p>{{ \Carbon\Carbon::parse($p->created_at)->format('dS M, y h:i A') }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </aside> -->
        </div>
    </div>
</div>
@endsection
