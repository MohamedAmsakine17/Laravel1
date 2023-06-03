<div>
    @foreach($comments as $comment)
    @if($comment->user)
    <div class="comment-container">
        <div class="container">
            <div class="d-flex">
                <div class="user-comment-img-container">
                    <div class="picture"
                        style="background-image: url({{$comment->user->getFirstMediaUrl('userImage', 'thumb')}}); background-repeat: no-repeat; background-size: cover; background-position: center;">
                    </div>
                </div>
                <div class="comment-content-containr">
                    <div class="d-flex justify-content-between">
                        <div>
                            <i class="bi bi-star user-comment-rate user-rate-1{{$comment->id}}"></i>
                            <i class="bi bi-star user-comment-rate user-rate-2{{$comment->id}}"></i>
                            <i class="bi bi-star user-comment-rate user-rate-3{{$comment->id}}"></i>
                            <i class="bi bi-star user-comment-rate user-rate-4{{$comment->id}}"></i>
                            <i class="bi bi-star user-comment-rate user-rate-5{{$comment->id}}"></i>
                        </div>
                        @if(Auth::user()->id == $comment->user_id || Auth::user()->role_id == 1)
                        <div>
                            <form id="remove-comment-form" action="{{route("comment_delete",$comment->id)}}"
                                method="post">
                                @csrf
                                <input type="hidden" name="_method" value="DELETE">
                            </form>
                            <a onclick="document.querySelector('#remove-comment-form').submit();"
                                class="delete-comment"><i class="bi bi-trash3-fill"></i></a>
                        </div>
                        @endif
                    </div>
                    <p class="comment-user-name">{{$comment->user->name}}</p>
                    <p class="comment-content">
                        {{$comment->content}}
                    </p>
                </div>
            </div>
        </div>
    </div>
        @for($i = 1 ; $i <= $comment->rating ; $i++)
            <script>
                document.querySelector(".user-rate-" + {{$i}}+{{$comment->id}}).classList.remove("bi-star");
                document.querySelector(".user-rate-" + {{$i}}+{{$comment->id}}).classList.add("bi-star-fill");
                document.querySelector(".user-rate-" + {{$i}}+{{$comment->id}}).style.color = "#9d44f6";
            </script>
        @endfor
        @endif
    @endforeach
</div>