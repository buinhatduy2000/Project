@extends('master')
@section('content')
    <div class="tbody-category col col-lg-10">
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
        <div class="tbody-content">
            <div class="tbody-title-category col-sm-12">
                <button type="button" class="category-btn-new" data-bs-toggle="modal" data-bs-target="#newModal">
                    New
                </button>
            </div>
            <div class="modal fade" id="newModal" tabindex="-1" aria-labelledby="newModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="{{ route('category.store') }}" class="form-add" id="content" method="POST">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title" id="newModalLabel">Create new category</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="form-add" id="content">
                                    <div class="category-input-name">
                                        <label for="input-name" class="form-label">Category Name :</label>
                                        <input class="form-control" type="text" id="cate-name" name="category_name">
                                        {{-- <p class="error">Error documentation!</p> --}}
                                    </div>
                                    <div class="category-input-date">
                                        <label for="input-date" class="form-label">Category 1st Closure Date :</label>
                                        <input class="form-control" type="date" id="cate-date" name="category_date" min="{{date('Y-m-d')}}">
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
                    <div class="category-item">
                        <h3 id="category-item-name">{{ $cate->category_name }}</h3>
                        <p>{{$cate->first_closure_date}} - {{$cate->second_closure_date}}</p>
                        <div class="category-tool">
                            <button type="button" class="category-btn-edit" data-bs-toggle="modal"
                                data-bs-target="#editModal{{ $cate->id }}">Edit</button>
                            <div class="modal fade" id="editModal{{ $cate->id }}" tabindex="-1"
                                aria-labelledby="editModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel">Edit category</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                            <form action="{{ route('category.update', ['category' => $cate->id]) }}" method="POST"
                                                class="form-edit" id="editItem">
                                                @csrf
                                                @method("PUT")
                                                <div class="modal-body">
                                                    <div class="category-input-name">
                                                        <label for="input-name" class="form-label">Category Name :</label>
                                                        <input class="form-control" type="text" id="cate-name" name="category_name" value="{{ $cate->category_name }}">
                                                        @error('category_name')
                                                         <p class="error">{{$message}}</p>
                                                        @enderror
                                                    </div>
                                                    @if(\Illuminate\Support\Facades\Auth::guard('account')->user()->role == \App\Models\Account::ACCOUNT_ADMIN)
                                                    <div class="category-input-date">
                                                        <label for="input-date" class="form-label">Category 1st Closure Date :</label>
                                                        <input class="form-control" type="date" id="cate-date" name="category_date"
                                                               value="{{$cate->first_closure_date}}" min="{{date('Y-m-d')}}">
                                                        @error('category_date')
                                                        <p class="error">{{$message}}</p>
                                                        @enderror
                                                    </div>
                                                    @endif
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="category-btn-edit" id="save">Save</button>
                                                </div>
                                            </form>
                                    </div>
                                </div>
                            </div>
                            <!--Delete Modal -->
                            <button type="button" class="category-btn-delete" data-bs-toggle="modal"
                                data-bs-target="#deleteModal{{ $cate->id }}">Delete</button>
                            <div class="modal fade" id="deleteModal{{ $cate->id }}" tabindex="-1"
                                aria-labelledby="deleteModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel">Delete category</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Do you want to delete category ?
                                        </div>
                                        <div class="modal-footer">
                                            <form action="{{ route('category.destroy', ['category' => $cate->id]) }}"
                                                method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="category-btn-delete">Delete</button>
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
            {{$categories->links('paginate')}}
        </div>
    </div>
@endsection
