@extends('user.master')
@section('content')
<div class="tbody-content">
    @if($ideas)
        <div class="tbody-box-search">
            <form class="d-flex">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>
        <div class="tbody-filter">
            <div class="tbody-filter-left">
                <p>Documents</p>
            </div>
            <div class="tbody-filter-right">
                <p><i class="bi bi-dash"></i>&emsp;Filter&emsp;</p>
                <div class="tbody-dropdown">
                    <button class="tbody-dropbtn">Choose sort order</button>
                    <div class="tbody-dropdown-ct">
                        <a href="#">Link 1</a>
                        <a href="#">Link 2</a>
                        <a href="#">Link 3</a>
                    </div>
                </div>
            </div>
        </div>
        @foreach($ideas as $idea)
        <div class="tbody-documents">
            <div class="tbody-doc-left col-sm-8">
                <h3>{{$idea->idea_title}}</h3>
                <p class="author-responsive">{{$idea->author->personal_info->first_name .' '. $idea->author->personal_info->last_name}} - {{$idea->created_at->format('d M, Y')}} &ensp; <i class="bi bi-tag"> {{$idea->category->category_name}}</i> <i class="bi bi-people-fill"> 2300</i></p>
                <p class="tbody-doc-right-date-responsive"><i class="bi bi-calendar2-week"></i> <span>Expiry:</span> {{$idea->category->second_closure_date}}</p>
                <p>
                    {{$idea->description}}
                </p>
                <p class="author">{{$idea->author->personal_info->first_name .' '. $idea->author->personal_info->last_name}} - {{$idea->created_at->format('d M, Y')}}</p>
            </div>
            <div class="tbody-doc-right col-sm-3">
                <p class="tbody-doc-right-date"><i class="bi bi-calendar2-week"></i> <span>Expiry:</span> {{$idea->category->second_closure_date}}</p>
                <button class="btn btn-outline-success">Download</button>
                <button class="btn btn-outline-secondary"><a href="{{route('idea.show', ['idea' => $idea->id])}}">See More</a></button>
                <p class="view">
                    <i class="bi bi-tag"> - {{$idea->category->category_name}}</i>
                    <i class="bi bi-people-fill"> - 2300</i>
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
@endsection

