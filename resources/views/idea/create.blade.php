@extends('master')
@section('content')
    <div class="tbody-content col col-lg-10">
        <div class="tbody-detail">
            <p>New Document</p>
        </div>
        <div class="tbody-ct">
            <form role="form" action="{{route('idea.store')}}" method="post" enctype='multipart/form-data'>
                @csrf
                <div class="create-docs">
                    <div class="create-docs-detail">
                        <div class="document">
                            <label for="docs-name">Document name</label>
                            <input type="text" id="docs-name" name="idea_title" value="{{old('idea_title')}}"/>
                        </div>
                        @error('idea_title')
                            <p>{{$message}}</p>
                        @enderror
                    </div>
                    <div class="create-docs-detail">
                        <div class="document">
                            <label for="docs-introduction">Introduction</label>
                            <textarea name="description" id="docs-introduction" cols="10" rows="7"></textarea>
                        </div>
                        @error('description')
                            <p>{{$message}}</p>
                        @enderror
                    </div>
                    <div class="create-docs-detail">
                        <div class="document">
                            <label for="docs-category">Category</label>
                            <select name="category_id" id="docs-category">
                                <option value="">---Choose Category---</option>
                                @foreach( $category as $item)
                                    <option value="{{$item->id}}" {{ old('category_id') == $item->id ? 'selected' : ''}}>{{$item->category_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('category_id')
                        <p>{{$message}}</p>
                        @enderror
                    </div>

                    <div class="document-file">
                        <input type="file" name="files[]" id="file" class="inputfile" multiple/>
                        <label for="file"><i class="bi bi-file-earmark-plus"></i> Upload Documents</label>
                        @error('files.*')
                            <p>{{$message}}</p>
                        @enderror
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                            <label class="form-check-label" for="flexCheckDefault">
                                Agree to the terms
                            </label>
                        </div>
                    </div>
                    <button type="submit">Create</button>
                </div>
            </form>
        </div>
    </div>
@endsection
