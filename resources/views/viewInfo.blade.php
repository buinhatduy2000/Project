@extends('master')
@section('css')
    <style>
        .tbody-content{
            height: auto;
        }
    </style>
@endsection
@section('content')
<div class="tbody-user col col-sm-9 col-lg-10">
    <div class="tbody-content">
        @if(Session::has('error'))
            <div class="alert alert-danger" role="alert">
                {{Session::get('error')}}
            </div>
        @endif
        @if(Session::has('success'))
            <div class="alert alert-success" role="alert">
                {{Session::get('success')}}
            </div>
        @endif
        <div class="tbody-user-detail">
            <div class="tbody-user-title">
                <p>User Information</p>
            </div>
            <div class="tbody-user-infor">
                <img src="{{asset('project/img/avatar.png')}}" alt="">
                <div class="tbody-user-infor-text">
                    <h3>{{$account->personal_info->first_name .' '. $account->personal_info->last_name}}</h3>
                    <h6>{{ ucfirst(trans($account->role)) }}</h6>
                    <p><i class="bi bi-pin-map"></i> &ensp;{{$account->personal_info->address}}</p>
                    <p><i class="bi bi-calendar2-event"></i> &ensp;{{$account->personal_info->dob}}</p>
                    <p><i class="bi bi-phone"></i> &ensp;{{$account->personal_info->phone_number}}</p>
                    <p><i class="bi bi-mailbox"></i> &ensp;{{$account->personal_info->email}}</p>
                </div>
            </div>
        </div>
        @if($ideas)
            <div class="tbody-filter">
                <div class="tbody-filter-left">
                    <p>Documents</p>
                </div>
                <div class="tbody-filter-right">
                    <p><i class="bi bi-dash"></i>&emsp;Filter&emsp;</p>
                    <div class="tbody-dropdown">
                        <button class="tbody-dropbtn">Choose sort order</button>
                        <div class="tbody-dropdown-ct">
                            <a href="{{Request::url()}}?sort_by=popular">Most popular</a>
                            <a href="{{Request::url()}}?sort_by=newtest">Latest Ideas</a>
                            <a href="{{Request::url()}}?sort_by=like">Most likes</a>
                            <a href="{{Request::url()}}?sort_by=comments">Most comments</a>
                        </div>
                    </div>
                </div>
            </div>
            @foreach($ideas as $idea)
            <div class="tbody-documents">
                <div class="tbody-doc-left">
                    <h3>{{$idea->idea_title}}</h3>
                    <p>
                        {{$idea->description}}
                    </p>
                    <p class="author">{{$idea->author->personal_info->first_name .' '. $idea->author->personal_info->last_name}} - {{$idea->created_at->format('m/d/Y')}}</p>
                </div>
                <div class="tbody-doc-right">
                    <p><i class="bi bi-calendar2-week"></i> {{$idea->category->first_closure_date}} to {{$idea->category->second_closure_date}}</p>
                    <button class="btn btn-outline-success button-download-idea" data-id="{{$idea->id}}">Download</button>
                    <button class="btn btn-outline-secondary"><a href="{{route('idea.show', ['idea' => $idea->id])}}">See More</a></button>
                    <p class="view">
                        <i class="bi bi-tag"></i> {{$idea->category->category_name}} &emsp;&emsp;&emsp;&nbsp;
                        <i class="bi bi-people-fill"></i> {{$idea->views}}
                    </p>
                </div>
            </div>
            @endforeach
            <div class="page-navigation">
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        @endif
    </div>
</div>
@endsection
