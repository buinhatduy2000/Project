@extends('master')
@section('css')
    <style>
        .tbody-content {
            height: 100%;
        }

    </style>
@endsection
@section('content')
    <div class="tbody-home col col-sm-9 col-lg-10">
        <div class="tbody-content">
            <div class="tbody-box-search">
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" />
                    <button class="btn btn-outline-success" type="submit">
                        Search
                    </button>
                </form>
            </div>
            @if ($ideas)
                <div class="tbody-filter">
                    <div class="tbody-filter-left">
                        <p>Ideas</p>
                    </div>
                    <div class="tbody-filter-right">
                        <p><i class="bi bi-dash"></i>&emsp;Filter&emsp;</p>
                        <div class="tbody-dropdown">
                            <button class="tbody-dropbtn">Choose sort order</button>
                            <div class="tbody-dropdown-ct">
                                <a href="{{ Request::url() }}?sort_by=popular">Most popular</a>
                                <a href="{{ Request::url() }}?sort_by=view">Most view</a>
                                <a href="{{ Request::url() }}?sort_by=newest">Latest Ideas</a>
                                <a href="{{ Request::url() }}?sort_by=comments">Latest Comments</a>
                            </div>
                        </div>
                    </div>
                </div>
                @if (!count($ideas))
                    <h1 class="no-docs-upload">No document uploaded</h1>
                @else
                    @foreach ($ideas as $idea)
                        <div class="tbody-documents">
                            <div class="tbody-doc-left col-sm-8">
                                <h3>{{ $idea->idea_title }}</h3>
                                <p class="author-responsive">
                                    {{ $idea->author->personal_info->first_name . ' ' . $idea->author->personal_info->last_name }}
                                    - {{ $idea->category->first_closure_date }} &ensp;
                                    <i class="bi bi-tag"> {{ $idea->category->category_name }}</i>
                                    <i class="bi bi-people-fill"> 2300</i>
                                </p>
                                <p class="tbody-doc-right-date-responsive">
                                    <i class="bi bi-calendar2-week"></i>
                                    <span>Expiry:</span> {{ $idea->category->second_closure_date }}
                                </p>
                                @if ($idea->anonymous == 1)
                                    <p class="author">Post with Anonymous</p>
                                @else
                                    <p class="author">
                                        {{ $idea->author->personal_info->first_name . ' ' . $idea->author->personal_info->last_name }}
                                        - {{ $idea->created_at->format('m/d/Y') }}</p>
                                @endif
                                <p>
                                    {{ $idea->description }}
                                </p>

                            </div>
                            <div class="tbody-doc-right col-sm-3">
                                <p class="tbody-doc-right-date"><i class="bi bi-calendar2-week"></i>
                                    <span>Expiry:</span>{{ $idea->category->second_closure_date }}
                                </p>
                                <button class="btn btn-outline-success button-download-idea"
                                    data-id="{{ $idea->id }}">Download</button>
                                <button class="btn btn-outline-secondary"><a
                                        href="{{ route('idea.show', ['idea' => $idea->id]) }}">See More</a></button>
                                <p class="view">
                                    <i class="bi bi-tag"></i> {{ $idea->category->category_name }}
                                    &emsp;&emsp;&emsp;&nbsp;
                                    <i class="bi bi-people-fill"></i> {{ $idea->views }}
                                    <i class="bi bi-hand-thumbs-up-fill"></i> {{ $idea->likers()->count() }}
                                    <i class="bi bi-chat-square"></i> {{ $idea->comments->count() }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                @endif
                @if (!count($ideas))
                    <br>
                @else
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
            @endif
        </div>
    </div>
    <script language="javascript">
        document.getElementById("navbar-item").onclick = function() {
            document.getElementById("navbar-item-detail").style.display =
                "block";
            document.getElementById("navbar-item-cancel").style.display =
                "block";
            document.getElementById("navbar-item").style.display = "none";
        };
        document.getElementById("navbar-item-cancel").onclick =
            function() {
                document.getElementById(
                    "navbar-item-detail"
                ).style.display = "none";
                document.getElementById(
                    "navbar-item-cancel"
                ).style.display = "none";
                document.getElementById("navbar-item").style.display =
                    "block";
            };
        document.getElementById("category").onclick = function() {
            document.getElementById("cate-ct").style.display = "block";
            document.getElementById("cate-cancel").style.display = "block";
            document.getElementById("category").style.display = "none";
        };
        document.getElementById("cate-cancel").onclick = function() {
            document.getElementById("cate-ct").style.display = "none";
            document.getElementById("cate-cancel").style.display = "none";
            document.getElementById("category").style.display = "block";
        };
    </script>
@endsection
