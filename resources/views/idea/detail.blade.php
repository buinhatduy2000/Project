@extends('master')
@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <style>
        .view-detail ul li .like-count,
        .view-detail ul li .dislike-count {
            color: unset;
        }

    </style>
@endsection
@section('content')
    <div class="tbody-detail-docs col col-sm-9 col-lg-10">
        <div class="tbody-content">
            <div class="tbody-detail">
                <p>Ideas</p>
            </div>
            <div class="tbody-detail-ct">
                <div class="infor-user">
                    <img src="{{ asset('project/img/avatar.png') }}" alt="">
                    @if ($idea->anonymous == 1)
                        <div class="infor-user-name">
                            <a href="">Anonymous</a>
                        </div>
                    @else
                        <div class="infor-user-name">
                            <a
                                href="">{{ $idea->author->personal_info->first_name . ' ' . $idea->author->personal_info->last_name }}</a>
                            <h6>{{ ucfirst(trans($idea->author->role)) }}</h6>
                        </div>
                    @endif
                </div>
                <div class="detail-docs">
                    <div class="docs-date-category">
                        <p>{{ $idea->created_at->format('M d,Y') }}</p>
                        <p>{{ '@' . $idea->category->category_name }}</p>
                    </div>
                    <div class="docs-content">
                        <h3>{{ $idea->idea_title }}</h3>
                        <p>{{ $idea->description ??
                            'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Turpis velit blandit id donec
                                                                        magnis donec amet. Convallis consectetur et sagittis arcu, sed. Imperdiet at porta ac
                                                                        porttitor donec neque, pulvinar a. Arcu consequat tortor, quisque porttitor ullamcorper
                                                                        leo.' }}
                        </p>
                        <div class="file-docs">
                            @foreach ($idea->documents as $key => $doc)
                                <a href="{{ $doc->file_name }}" target="_blank">
                                    <p><i class="bi bi-file-earmark-image"></i>&ensp; File {{ $key + 1 }}</p>
                                </a>
                            @endforeach
                        </div>
                    </div>
                    <div class="views-like-dislike">
                        <div class="view-detail">
                            <ul>
                                <li>{{ $idea->views }} <span>views</span></li>
                            </ul>
                        </div>
                        <div class="view-icon">
                            <ul>
                                <li><i id="like-idea" class=
                                    @if (Auth::guard('account')->user()->isLiked($idea))
                                        "bi bi-hand-thumbs-up-fill" style="color: blue" data-is="liked"
                                    @else
                                        "bi bi-hand-thumbs-up" data-is="like"
                                    @endif
                                >
                                        <span class="like-count">{{$idea->likes_count}}</span>
                                    </i>
                                </li>
                                <li>
                                    <i id="dislike-idea" class=
                                        @if (Auth::guard('account')->user()->isDisliked($idea))
                                           "bi bi-hand-thumbs-down-fill" style="color: red" data-is="disliked"
                                        @else
                                            "bi bi-hand-thumbs-down" data-is="dislike"
                                        @endif
                                    >
                                    <span class="dislike-count">{{$idea->dislikes_count}}</span>
                                    </i>
                                </li>
                                <li><i class="bi bi-chat-square"></i><span>{{ $idea->comments->count() }}</span></li>
                                <li><a href="{{route('downloadIdea', ['id' => $idea->id])}}"><i class="bi bi-download button-download-idea"></i></a></li>
                            </ul>
                        </div>
                        <div class="view-detail-responsive">
                            <p>{{ $idea->views }} views</p>
                            {{-- <p class="like-count">{{ $idea->likers()->count() }} likes</p> --}}
                            {{-- <p class="dislike-count">12 dislikes</p> --}}
                        </div>
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
                                        <span><strong>{{ $comment->author->personal_info->first_name }}: </strong></span>
                                    @else
                                        <span><strong>Anonymous:</strong> </span>
                                    @endif
                                    {{ $comment->content }}
                                </p>
                                <h6>{{ $comment->created_at }} &emsp;</h6>
                            </div>
                        @endforeach
                    </div>
                </div>
                <form action="comment/{{ $idea->id }}" method="POST" class="form-comment">
                    @csrf


                    <div class="input-comment">
                        <input class="comment-input form-control" type="text" name="comment" placeholder="Add a comments...">
                        <button class="submit-comment" type="submit">Post</button>
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
            $('.submit-comment').on('click', function(e) {
                if (!$('.comment-input').val()){
                    e.preventDefault()
                    $('.comment-input').focus().addClass('is-invalid')
                }
            })
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var flag = true
            $('#like-idea ,#dislike-idea').on('click', function() {
                var button = $(this);
                var status = button.attr('data-is')
                console.log(button)
                console.log(button + "-" +status)
                if (!flag) {
                    return false;
                }
                var id = {{ $idea->id }}
                $.ajax({
                    type: 'POST',
                    url: '/idea/like-dislike',
                    data: {
                        id: id,
                        status: status
                    },
                    beforeSend: function() {
                        flag = false
                    },
                    success: function(data) {
                        var newStatus = data.status
                        if (data.status === "liked") {
                            button.removeClass('bi-hand-thumbs-up')
                            button.addClass('bi-hand-thumbs-up-fill').css(
                                'color', 'blue')
                            button.attr('data-is', newStatus)
                        }
                        if (data.status === "disliked") {
                            button.removeClass('bi-hand-thumbs-down')
                            button.addClass('bi-hand-thumbs-down-fill').css(
                                'color', 'red')
                            button.attr('data-is', newStatus)
                        }
                        if (data.status === "unlike") {
                            button.removeClass('bi-hand-thumbs-up-fill').css(
                                'color', '')
                            button.addClass('bi-hand-thumbs-up')
                            button.attr('data-is', newStatus.slice(2))
                        }
                        if (data.status === "undislike") {
                            button.removeClass('bi-hand-thumbs-down-fill').css(
                                'color', '')
                            button.addClass('bi-hand-thumbs-down')
                            button.attr('data-is', newStatus.slice(2))
                        }
                        if (data.status === "toliked") {
                            button.removeClass('bi-hand-thumbs-up')
                            button.addClass('bi-hand-thumbs-up-fill').css(
                                'color', 'blue')
                            $('#dislike-idea').removeClass('bi-hand-thumbs-down-fill').css(
                                'color', '')
                            $('#dislike-idea').addClass('bi-hand-thumbs-down')
                            $('#dislike-idea').attr('data-is', 'dislike')
                            button.attr('data-is', newStatus.slice(2))
                        }
                        if (data.status === "todisliked") {
                            button.removeClass('bi-hand-thumbs-down')
                            button.addClass('bi-hand-thumbs-down-fill').css(
                                'color', 'red')
                            $('#like-idea').removeClass('bi-hand-thumbs-up-fill').css(
                                'color', '')
                            $('#like-idea').addClass('bi-hand-thumbs-up')
                            $('#like-idea').attr('data-is', 'like')
                            button.attr('data-is', newStatus.slice(2))
                        }
                        if (!('reactCount' in data)){
                            $('.like-count').text('0')
                            $('.dislike-count').text('0')
                        } else {
                            $('.like-count').text(data.reactCount.likes_count)
                            $('.dislike-count').text(data.reactCount.dislikes_count)
                        }
                        flag = true
                    }
                });
            })
        })
    </script>
@endsection
@endsection
