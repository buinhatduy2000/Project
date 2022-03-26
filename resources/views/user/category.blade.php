@extends('user.master')
@section('content')
<div class="tbody-content">
    @can('create-cate')
    <div class="tbody-detail-category">
        <p>Category</p>
        <input class="category-btn-new" type="button" id="new" value="New" />
    </div>
    <form action="{{route('category.store')}}" class="form-add" id="content" method="POST">
        @csrf
        <label for="category-name">Category Name :</label>
        <input class="category-input" type="text" id="cate-name" name="category_name">
        <button type="submit" class="category-btn-add">Add</button>
        <input class="category-btn-cancel" type="button" id="cancel" value="Cancel" />
    </form>
    <script language="javascript">
        document.getElementById("new").onclick = function () {
            document.getElementById("content").style.display = 'block';
        };
        document.getElementById("cancel").onclick = function () {
            document.getElementById("content").style.display = 'none';
        };
    </script>
    @endcan
    <div class="tbody-category">
        @foreach ($categories as $cate)
            <div class="category-item">
                <h3 id="category-item-name">{{$cate ->category_name}}</h3>
                @can('update-cate')
                <form action="{{route('category.update', ['category' => $cate->id])}}" method="POST" class="form-edit" id="editItem">
                    @csrf
                    @method("PUT")
                    <input class="category-input" type="text" id="cate-name" name="category_name"
                           value="{{$cate ->category_name}}">
                    <button type="submit" class="category-btn-edit" id="save">Save</button>
                </form>
                @endcan
                @can('delete-cate')
                <div class="category-tool">
                    <input class="category-btn-edit" type="button" id="edit" value="Edit" />

                    <form action="{{route('category.destroy', ['category' => $cate->id])}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="category-btn-delete">Delete</button>
                    </form>

                </div>
                @endcan
            </div>
            <script language="javascript">
                document.getElementById("edit").onclick = function () {
                    document.getElementById("editItem").style.display = 'inline-block';
                    document.getElementById("edit").style.display = 'none';
                    document.getElementById("category-item-name").style.display = 'none';
                    document.getElementById("save").style.display = 'inline-block';
                };
                document.getElementById("save").onclick = function () {
                    document.getElementById("editItem").style.display = 'none';
                    document.getElementById("save").style.display = 'none';
                    document.getElementById("category-item-name").style.display = 'inline-block';
                    document.getElementById("edit").style.display = 'inline-block';
                };
            </script>
        @endforeach
    </div>
</div>
@endsection
