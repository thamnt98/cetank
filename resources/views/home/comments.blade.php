@foreach($comments as $key => $comment)
    @if($comment->level == 1)
        <div class="display-comment">
            <div>
                <img src="{{asset('images/1514969943.png')}}" style="height:40px">
                <ul style="margin-top:-30px; margin-left:35px">
                    <li style="float:left; margin-left:10px; color:blue"> <strong>{{ $comment->user->name }}</strong></li>
                    <li style="float:left; margin-left:10px; color:black">
                        <p>{{ $comment->content }}</p>
                    </li>
                </ul>
            </div>
            <form method="post" action="{{ route('comment.create') }}">
                @csrf
                <div class="form-group">
                    <input type="text" name="content" class="form-control" required />
                    <input type="hidden" name="post_id" value="{{ $post_id }}" />
                    <input type="hidden" name="parent_id" value="{{ $comment->id }}" />
                </div>
                <div class="form-group">
                    <input type=submit class="btn btn-warning" value="Reply" />
                </div>
            </form>
            <br>
        </div>
    @endif
    @if($comment->replies)
        @foreach($comment->replies as $reply)
        <div class="display-comment" style="margin-left:40px">
            <div>
                <img src="{{asset('images/1514969943.png')}}" style="height:40px">
                <ul style="margin-top:-30px; margin-left:35px">
                    <li style="float:left; margin-left:10px; color:blue"> <strong>{{ $reply->user->name }}</strong></li>
                    <li style="float:left; margin-left:10px; color:black">
                        <p>{{ $reply->content }}</p>
                    </li>
                </ul>
            </div>
        </div>
        @endforeach
    @endif
@endforeach
