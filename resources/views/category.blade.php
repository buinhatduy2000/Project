@extends('master')
@section('content')
    @if (\Illuminate\Support\Facades\Auth::guard('account')->user()->role == \App\Models\Account::ACCOUNT_ADMIN)
        <div class="document-right">
            @if (Session::has('error'))
                <div class="alert alert-danger" role="alert">
                    {{ Session::get('error') }}
                </div>
            @endif
            @if (Session::has('success'))
                <div class="alert alert-success" role="alert">
                    {{ Session::get('success') }}
                </div>
            @endif
            <div class="alert alert-success" id="success" role="alert" style="display: none"></div>
            <div class="alert alert-error" id="error" role="alert" style="display: none"></div>
            <div class="box-table">
                <table>
                    <thead>
                        <tr>
                            <th class="nav-title">Title</th>
                            <th class="nav-title">Status</th>
                            <th class="nav-title">Stats</th>
                            <th class="nav-title">Option</th>
                        </tr>
                    </thead>
                    @foreach ($categories as $cate)
                        <tbody>
                            <tr class="tbody-table">
                                <td>
                                    <div class="document-content-left">
                                        <span>{{ $cate->category_name }}</span>
                                        {{-- <span class="document-author">Joe Bloggs</span> --}}
                                    </div>
                                </td>
                                <td>
                                    @if (date('Y-m-d') < $cate->first_closure_date)
                                        <div class="document-content-btn">
                                            <button>Available</button>
                                        </div>
                                    @elseif(date('Y-m-d') < $cate->second_closure_date)
                                        <div class="document-content-btn-exSoon">
                                            <button>Comments</button>
                                        </div>
                                    @else
                                        <div class="document-content-btn-draft">
                                            <button>Close</button>
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <div class="document-content-right">
                                        <div class="document-view">
                                            <span>{{ $cate->ideas->count() }}</span>
                                            <span class="document-view-between">
                                                <a href="/category-by-id/{{ $cate->id }}">ideas</a>
                                            </span>
                                            <i class="far fa-arrow-alt-circle-up" style="color: #9AE6B4;"></i>
                                        </div>
                                        <div class="document-date">
                                            <i class="far fa-calendar-alt" style="width: 30px;
                                                        height: 30px; color: rgba(26, 41, 61, 0.83);"></i>
                                            <span>{{ $cate->first_closure_date }} to
                                                {{ $cate->second_closure_date }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="dots">
                                        <div class="dropdown">
                                            <button class="btn btn-secondary dropdown-toggle" type="button"
                                                id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="true">
                                                <strong>...</strong>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                                <button type="button" class="dropdown-item" data-bs-toggle="modal"
                                                    data-bs-target="#editModal{{ $cate->id }}">Edit closure
                                                    date</button>
                                                <a href="{{ route('export_csv', ['id' => $cate->id]) }}"
                                                    style="text-decoration: none"><button class="dropdown-item"
                                                        type="button">Export CSV</button></a>
                                                <a href="{{ route('downloadCate', ['id' => $cate->id]) }}"
                                                    style="text-decoration: none"><button type="button"
                                                        class="dropdown-item">Download All File</button></a>

                                            </div>
                                        </div>
                                        <div class="modal fade" id="editModal{{ $cate->id }}" tabindex="-1"
                                            aria-labelledby="editModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteModalLabel">Edit Campaign</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <form action="" method="POST" data-id="{{ $cate->id }}"
                                                        class="form-edit" id="editItem">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-body">
                                                            <div class="category-input-date">
                                                                <label for="input-date" class="form-label">Campaign 1st
                                                                    Closure Date :</label>
                                                                <input class="form-control" type="date" id="cate-date"
                                                                    name="category_date"
                                                                    value="{{ $cate->first_closure_date }}">
                                                                <p class="error error-edit-date"></p>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-primary"
                                                                id="save">Save</button>
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    @endforeach
                </table>
            </div>
            <div class="document-number">
                {{ $categories->links('paginate') }}
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    @else
        <div class="tbody-category col col-lg-10">
            @if (Session::has('error'))
                <div class="alert alert-danger" role="alert">
                    {{ Session::get('error') }}
                </div>
            @endif
            @if (Session::has('success'))
                <div class="alert alert-success" role="alert">
                    {{ Session::get('success') }}
                </div>
            @endif
            <div class="alert alert-success" id="success" role="alert" style="display: none"></div>
            <div class="alert alert-error" id="error" role="alert" style="display: none"></div>
            <div class="tbody-content">
                <div class="tbody-title-category col-sm-12">
                    <button type="button" class="category-btn-new" data-bs-toggle="modal" data-bs-target="#newModal">
                        New
                    </button>
                </div>
                <div class="modal fade" id="newModal" tabindex="-1" aria-labelledby="newModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form class="form-add" id="content form-add" method="POST">
                                @csrf
                                <div class="modal-header">
                                    <h5 class="modal-title" id="newModalLabel">Create new campaign</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-add" id="content">
                                        <div class="category-input-name">
                                            <label for="input-name" class="form-label">Campaign Name :</label>
                                            <input class="form-control" type="text" id="cate-name" name="category_name">
                                            <p class="error error-create-name"></p>
                                        </div>
                                        <div class="category-input-date">
                                            <label for="input-date" class="form-label">Campaign 1st Closure Date
                                                :</label>
                                            <input class="form-control" type="date" id="cate-date" name="category_date">
                                            <p class="error error-create-date"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Create</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="tbody-category">
                    @foreach ($categories as $cate)
                        <div
                            class="category-item
                @if (date('Y-m-d') < $cate->first_closure_date) alert alert-success
                @elseif(date('Y-m-d') < $cate->second_closure_date)
                    alert alert-warning
                @else
                    alert alert-dark @endif
                ">
                            <h3 id="category-item-name">{{ $cate->category_name }}</h3>
                            {{-- <p>{{ $cate->first_closure_date }} - {{ $cate->second_closure_date }}</p> --}}
                            <div class="category-tool">
                                <button type="button" class="category-btn-edit" data-bs-toggle="modal"
                                    data-bs-target="#editModal{{ $cate->id }}">Edit</button>
                                {{-- asdasasd --}}
                                <button class="category-btn-edit-responsive" data-bs-toggle="modal"
                                    data-bs-target="#editModal{{ $cate->id }}"><i class="bi bi-pen"></i></button>
                                <div class="modal fade" id="editModal{{ $cate->id }}" tabindex="-1"
                                    aria-labelledby="editModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel">Edit campaign</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="" method="POST" data-id="{{ $cate->id }}"
                                                class="form-edit" id="editItem">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <div class="category-input-name">
                                                        <label for="input-name" class="form-label">Campaign Name
                                                            :</label>
                                                        <input class="form-control" type="text" id="cate-name"
                                                            name="category_name" value="{{ $cate->category_name }}">
                                                        <p class="error error-edit-name"></p>
                                                    </div>
                                                    @if (\Illuminate\Support\Facades\Auth::guard('account')->user()->role == \App\Models\Account::ACCOUNT_ADMIN)
                                                        <div class="category-input-date">
                                                            <label for="input-date" class="form-label">Campaign 1st
                                                                Closure Date :</label>
                                                            <input class="form-control" type="date" id="cate-date"
                                                                name="category_date"
                                                                value="{{ $cate->first_closure_date }}">
                                                            <p class="error error-edit-date"></p>
                                                        </div>
                                                    @endif
                                                </div>
                                                {{-- <div class="modal-footer">
                                            <button type="submit" class="category-btn-edit" id="save">Save</button>
                                        </div> --}}
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary" id="save">Save</button>
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!--Delete Modal -->
                                <button type="button" class="category-btn-delete" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal{{ $cate->id }}">Delete</button>
                                {{-- asdsadasd --}}
                                <button type="button" class="category-btn-delete-responsive" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal{{ $cate->id }}"><i
                                        class="bi bi-trash"></i></button>
                                <div class="modal fade" id="deleteModal{{ $cate->id }}" tabindex="-1"
                                    aria-labelledby="deleteModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel">Delete campaign</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Do you want to delete this campaign ?
                                            </div>
                                            <div class="modal-footer">
                                                <form action="{{ route('category.destroy', ['category' => $cate->id]) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-primary">Delete</button>
                                                </form>
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                {{ $categories->links('paginate') }}
            </div>
        </div>
    @endif
@endsection
