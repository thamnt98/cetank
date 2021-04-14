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
            <hr />
            <form method="POST" action="{{ route('comment.create') }}" style="margin-top: 30px;">
                @csrf
                <div class="form-group">
                    <textarea class="form-control" name=content required></textarea>
                    @if($errors->has('content'))
                    @foreach($errors->get('content') as $error)
                    <span class="text-danger">{{$error}}</span>
                    @endforeach
                    @endif
                    <input type=hidden name=post_id value="{{ $blog->id }}" />
                </div>
                <div class="form-group">
                    <button type=submit class="btn btn-success">Add comment</button>
                </div>
            </form>
            <br>
              @if($blog->comments)
                @include('home.comments', ['comments' => $blog->comments, 'post_id' => $blog->id])
            @endif
        </div>
    </div>
</div>
@endsection
