@extends('master')
@section('content')
    @if (\Illuminate\Support\Facades\Auth::guard('account')->user()->role == \App\Models\Account::ACCOUNT_ADMIN)
        <div class="admin-content-right">
            @if (!count($ideas))
                <div class="tbody-content">
                    <h1>No document uploaded</h1>
                </div>
            @else
                <div class="tbody-content">
                    <div class="tbody-filter">
                        <div class="tbody-filter-left">
                            <p>Documents</p>
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
                    @foreach ($ideas as $idea)
                        <div class="tbody-documents">
                            <div class="tbody-doc-left">
                                <h3>{{ $idea->idea_title }}</h3>
                                <p class="intro-ideas">
                                <p>{{ $idea->description }}</p>
                                </p>
                                @if ($idea->anonymous == 1)
                                    <p class="author">Post with Anonymous</p>
                                @else
                                    <p class="author">
                                        {{ $idea->author->personal_info->first_name . ' ' . $idea->author->personal_info->last_name }}
                                        - {{ $idea->created_at->format('m/d/Y') }}</p>
                                @endif
                            </div>
                            <div class="tbody-doc-right">
                                <p class="tbody-doc-right-date"><i class="bi bi-calendar2-week"></i>
                                    <span>Expiry:</span>{{ $idea->category->second_closure_date }}
                                </p>
                                <a href="{{ route('downloadIdea', ['id' => $idea->id]) }}">
                                    <button class="btn btn-outline-success button-download-idea"
                                        data-id="{{ $idea->id }}">Download</button>
                                </a>
                                <a href="{{ route('idea.show', ['idea' => $idea->id]) }}">
                                    <button class="btn btn-outline-secondary">See More</button>
                                </a>
                                <p class="view">
                                    <i class="bi bi-tag"></i> {{ $idea->category->category_name }}
                                </p>
                                <p class="view">                                                                      
                                    <i class="bi bi-people-fill"></i> {{ $idea->views }}&nbsp;
                                    <i class="bi bi-hand-thumbs-up-fill"></i> {{ $idea->likes_count }}&nbsp;
                                    <i class="bi bi-hand-thumbs-down-fill"></i> {{ $idea->dislikes_count }}&nbsp;
                                    <i class="bi bi-chat-square"></i> {{ $idea->comments->count() }}&nbsp;
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    @else
        <div class="tbody-home col col-sm-9 col-lg-10">
            <div class="tbody-content">
                <!-- filter -->
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
                    <!-- hiện thị bài viết -->
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
                                    </p>
                                    <p class="tbody-doc-right-date-responsive">
                                        <i class="bi bi-calendar2-week"></i>
                                        <span>Expiry:</span> {{ $idea->category->second_closure_date }}
                                    </p>
                                    <p>{{ $idea->description }}</p>
                                    @if ($idea->anonymous == 1)
                                        <p class="author">Post with Anonymous</p>
                                    @else
                                        <p class="author">
                                            {{ $idea->author->personal_info->first_name . ' ' . $idea->author->personal_info->last_name }}
                                            - {{ $idea->created_at->format('m/d/Y') }}</p>
                                    @endif
                                </div>
                                <div class="tbody-doc-right col-sm-3">
                                    <p class="tbody-doc-right-date"><i class="bi bi-calendar2-week"></i>
                                        <span>Expiry:</span>{{ $idea->category->second_closure_date }}
                                    </p>
                                    <a href="{{ route('downloadIdea', ['id' => $idea->id]) }}">
                                        <button class="btn btn-outline-success button-download-idea"
                                            data-id="{{ $idea->id }}">Download</button>
                                    </a>
                                    <a href="{{ route('idea.show', ['idea' => $idea->id]) }}">
                                        <button class="btn btn-outline-secondary">See More</button>
                                    </a>
                                    <p class="view-ct">
                                        <i class="bi bi-tag"></i> {{ $idea->category->category_name }}                                       
                                    </p>
                                    <p class="view-ct2">
                                        <i class="bi bi-people-fill"></i> {{ $idea->views }}&nbsp;
                                        <i class="bi bi-hand-thumbs-up-fill"></i> {{ $idea->likes_count }}&nbsp;
                                        <i class="bi bi-hand-thumbs-down-fill"></i> {{ $idea->dislikes_count }}&nbsp;
                                        <i class="bi bi-chat-square"></i> {{ $idea->comments->count() }}&nbsp;
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    @endif
                    @if (!count($ideas))
                        <br>
                    @else
                        {{ $ideas->links('vendor.pagination.custom') }}
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
    @endif
@endsection
