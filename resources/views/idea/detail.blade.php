@extends('master')
@section('content')
<div class="tbody-content">
{{--        <div class="tbody-box-search">--}}
{{--            <form class="d-flex">--}}
{{--                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">--}}
{{--                <button class="btn btn-outline-success" type="submit">Search</button>--}}
{{--            </form>--}}
{{--        </div>--}}
        <div class="tbody-detail">
            <p>Documents</p>
        </div>
        <div class="tbody-detail-ct">
            <div class="infor-user">
                <img src="{{asset('project/img/avatar.png')}}" alt="">
                <div class="infor-user-name">
                    <a href="#">{{$idea->author->personal_info->first_name .' '. $idea->author->personal_info->last_name}}</a>
                    <h6>{{ ucfirst(trans(Auth::guard('account')->user()->role)) }}</h6>
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
                </div>
                <div class="views-like-dislike">
                    <div class="view-icon">
                        <ul>
                            <li><i class="bi bi-hand-thumbs-up"></i></li>
                            <li><i class="bi bi-hand-thumbs-down"></i></li>
                            <li><i class="bi bi-chat-square"></i></li>
                            <li class="btn-dowload-responsive"><i class="bi bi-download"></i></li>
                        </ul>
                    </div>
                    <div class="view-detail">
                        <ul>
                            <li>1222 <span>views</span></li>
                            <li>150 <span>likes</span></li>
                            <li>12 <span>dislikes</span></li>
                        </ul>
                    </div>
                    <div class="download-icon">
                        <ul>
                            <li><i class="bi bi-download"></i></li>
                        </ul>
                    </div>
                </div>
                <div class="view-detail-responsive">
                    <p>1222 views</p>
                    <p>150 likes</p>
                    <p>12 dislikes</p>
                </div>
                <div class="comments">
                    @foreach ($comments as $comment)
                    <div class="comments-detail">
                        <p><span>{{$idea->author->personal_info->first_name .' '. $idea->author->personal_info->last_name}}</span> &nbsp; 
                            {{$comment->content}}</p>
                        <h6>{{$comment->created_at}} &emsp;</h6>
                    </div>
                    @endforeach
                </div>
            </div>
            <form action="comment/{{$idea->id}}" method="POST" class="input-comment">
                @csrf
                <input type="text" name="comment" placeholder="Add a comments...">
                <button type="submit">Post</button>
            </form>
        </div>
</div>
@endsection
