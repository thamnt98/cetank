@foreach($comments as $key => $comment)
    @if($comment->level == 1)
        <div>
            <div style="margin-top:35px">
                @if($comment->user->image)
                    <img src="{{ asset('images/') }}/{{ $comment->user->image }}" style="height:40px; border-radius: 50%">
                @else
                    <img src="{{asset('images/1514969943.png')}}" style="height:40px; border-radius: 50%">
                    @endif
                <ul style="margin-top:-40px; margin-left:50px; width:fit-content;; background-color: #dddddd" class="rounded">
                    <li style="margin-left:10px; color:blue;  padding-top: 5px;"> <strong style="padding-right: 10px">{{ $comment->user->name }}</strong></li>
                    <li style="margin-left:10px; color:black;">
                        <p style="padding-bottom:10px; padding-right: 10px">{{ $comment->content }}</p>
                    </li>
                </ul>
            </div>

            <div style="margin-top: -10px !important;   padding-bottom: 40px;padding-left: 50px;" >
                <ul>
                    <li style="float:left; margin-right:13px">{{ \Carbon\Carbon::parse($comment->created_at)->format('Y-m-d H:i') }}</li>
                    <li style="float:left" @if(is_null(Auth::user()) && !count($comment->replies)) class="hidden" @endif><a  class="reply" data-id="{{ $comment->id }}"><i class="fa fa-reply" style="margin-right:3px"></i>Trả lời</a></li>
                </ul>
            </div>
            @if(Auth::user())
            <form method="post" action="{{ route('comment.create') }}" style="margin-left: 50px" class="hidden reply-form-{{$comment->id}}">
                @csrf
                <div class="form-group">
                    <input type="text" name="content" class="form-control border-input bg-grey" required/>
                    <input type="hidden" name="post_id" value="{{ $post_id }}" />
                    <input type="hidden" name="parent_id" value="{{ $comment->id }}" />
                </div>
                <div class="form-group">
                    <input type=submit class="btn btn-warning" value="Reply" />
                </div>
            </form>
            @endif
        </div>
    @endif
    @if($comment->replies)
        @foreach($comment->replies as $reply)
        <div style="margin-left:50px;margin-top:10px" class="hidden reply-list-{{$comment->id}}">
                <img src="{{asset('images/1514969943.png')}}" style="height:40px">
                <ul style="margin-top:-40px; margin-left:50px; background-color: #dddddd; width: fit-content" class="rounded">
                    <li style="margin-left:10px; color:blue; padding-top: 5px"> <strong style="padding-right: 10px">{{ $reply->user->name }}</strong></li>
                    <li style="margin-left:10px; color:black;">
                        <p  style="padding-bottom:10px; padding-right: 10px">{{ $reply->content }}</p>
                    </li>
                </ul>
        </div>
        @endforeach
    @endif
@endforeach
