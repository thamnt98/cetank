@extends('layouts.frontEnd')
@section('content')
<div class="expert-section expert-blog-section" style="padding:50px 0">
    <div class="container" style="width: 70%;">
        <div class="row">
            @foreach($blog as $b)
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
                        <i class="fa fa-tags">
                            @foreach($b->tags as $key => $tag)
                                <a href="{{ route('tag.list', $tag) }}"> {{ $tag }} @if($key != array_key_last($b->tags)),@endif</a>
                            @endforeach
                        </i>
                    </div>
                    <div class="detail__footer">
                        <div class="detail__meta">
                            <time>{{ \Carbon\Carbon::parse($b->created_at)->format('h:i d/m/Y') }}</time>
                            <a class="btn btn-link text-primary see_more_{{ $b->id }} see-more" data-id="{{ $b->id }}">Xem chi tiết <i class="fa fa-angle-double-down ml-1"></i></a>
                            <a class="btn btn-link text-primary btn-alt collapse_{{ $b->id }} hidden content-collapse" data-id="{{ $b->id }}">Thu gọn <i class="fa fa-angle-double-up ml-1"></i></a>
                        </div>
                    </div>
                </div>
            </post>
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
