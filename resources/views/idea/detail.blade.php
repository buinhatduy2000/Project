@extends('master')
@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <style>
        .view-detail ul li .like-count, .view-detail ul li .dislike-count{
            color: unset;
        }
    </style>
@endsection
@section('content')
<div class="tbody-detail-docs col col-sm-9 col-lg-10">
<div class="tbody-content">
{{--        <div class="tbody-box-search">--}}
{{--            <form class="d-flex">--}}
{{--                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">--}}
{{--                <button class="btn btn-outline-success" type="submit">Search</button>--}}
{{--            </form>--}}
{{--        </div>--}}
        <div class="tbody-detail">
            <p>Ideas</p>
        </div>
        <div class="tbody-detail-ct">
            <div class="infor-user">
                <img src="{{asset('project/img/avatar.png')}}" alt="">
                <div class="infor-user-name">
                    <a href="#">{{$idea->author->personal_info->first_name .' '. $idea->author->personal_info->last_name}}</a>
                    <h6>{{ ucfirst(trans($idea->author->role)) }}</h6>
                </div>
            </div>
            <div class="detail-docs">
                <div class="docs-date-category">
                    <p>{{$idea->created_at->format('M d,Y')}}</p>
                    <p>{{'@'.$idea->category->category_name}}</p>
                </div>
                <div class="docs-content">
                    <h3>{{$idea->idea_title}}</h3>
                    <p>{{$idea->description ?? 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Turpis velit blandit id donec
                        magnis donec amet. Convallis consectetur et sagittis arcu, sed. Imperdiet at porta ac
                        porttitor donec neque, pulvinar a. Arcu consequat tortor, quisque porttitor ullamcorper
                        leo.'}}
                    </p>
                    @foreach($idea->documents as $key => $doc)
                        <a href="{{$doc->file_name}}" target="_blank"><p>File {{$key + 1}}</p></a>
                    @endforeach
                </div>
                <div class="views-like-dislike">
                    <div class="view-icon">
                        <ul>
                            <li id="like-idea"><i class=
                            @if(Auth::guard('account')->user()->hasLiked($idea))
                                "bi bi-hand-thumbs-up-fill" style="color: blue"
                            @else
                                "bi bi-hand-thumbs-up"
                            @endif
                                ></i></li>
{{--                            <li><i class="bi bi-hand-thumbs-down"></i></li>--}}
                            <li><i class="bi bi-chat-square"></i></li>
                            <li class="btn-dowload-responsive"><i class="bi bi-download"></i></li>
                        </ul>
                    </div>
                    <div class="view-detail">
                        <ul>
                            <li>{{$idea->views}} <span>views</span></li>
                            <li><span class="like-count">{{$idea->likers()->count()}}</span> <span>likes</span></li>
                            <li>{{ $idea->comments->count() }} <span>comments</span></li>
{{--                            <li><span class="dislike-count">2</span> <span>dislikes</span></li>--}}
                        </ul>
                    </div>
                    <div class="download-icon">
                        <ul>
                            <li><i class="bi bi-download"></i></li>
                        </ul>
                    </div>
                </div>
                <div class="view-detail-responsive">
                    <p>{{$idea->views}} views</p>
                    <p class="like-count">{{$idea->likers()->count()}} likes</p>
{{--                    <p class="dislike-count">12 dislikes</p>--}}
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="comments">
                    @foreach ($comments as $comment)
                    <div class="comments-detail">
                        <p>
                            @if ($comment->anonymous == null)
                            <span>{{$comment->author->personal_info->first_name}}</span>
                            @else
                            <span>Anonymous</span>
                            @endif
                            {{$comment->content}}
                        </p>
                        <h6>{{$comment->created_at}} &emsp;</h6>
                    </div>
                    @endforeach
                </div>
            </div>
            <form action="comment/{{$idea->id}}" method="POST" class="form-comment">
                @csrf
                <div class="input-comment">
                    <input type="text" name="comment" placeholder="Add a comments...">
                    <button type="submit">Post</button>
                </div>
                <div class="checkbox-comment form-check">
                    <input class="form-check-input" type="checkbox" name="anonymous" value="1" id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault">
                        Comment by anonymous
                    </label>
                </div>
            </form>
        </div>
</div>
</div>
    @section('script')
        <script>
            $(document).ready(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var flag = true
                $('#like-idea').on('click', function() {
                    if (!flag){
                        return false;
                    }
                    var likeButton = $(this);
                    var id = {{$idea->id}}
                    $.ajax({
                        type:'POST',
                        url:'/idea/like',
                        data:{id:id},
                        beforeSend: function(){
                            flag = false
                        },
                        success:function(data){
                            if(jQuery.isEmptyObject(data.success)){
                                likeButton.children().removeClass('bi-hand-thumbs-up-fill').css('color', '')
                                likeButton.children().addClass('bi-hand-thumbs-up')
                            }else {
                                likeButton.children().removeClass('bi-hand-thumbs-up')
                                likeButton.children().addClass('bi-hand-thumbs-up-fill').css('color', 'blue')
                            }
                            flag = true
                            $('.like-count').text(data.likes)
                        }
                    });
                })
            })
        </script>
    @endsection
@endsection
