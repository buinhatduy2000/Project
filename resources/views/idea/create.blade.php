@extends('master')
@section('content')
    <div class="tbody-content col col-lg-10">
        <div class="tbody-detail">
            <p>New Document</p>
        </div>
        <div class="tbody-ct">
            <form role="form" action="{{ route('idea.store') }}" method="post" enctype='multipart/form-data'>
                @csrf
                <div class="create-docs">
                    <div class="create-docs-detail">
                        <div class="document">
                            <label for="docs-name">Document name</label>
                            <input type="text" id="docs-name" name="idea_title" value="{{ old('idea_title') }}" />
                        </div>
                        @error('idea_title')
                            <p>{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="create-docs-detail">
                        <div class="document">
                            <label for="docs-introduction">Introduction</label>
                            <textarea name="description" id="docs-introduction" cols="10" rows="7"></textarea>
                        </div>
                        @error('description')
                            <p>{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="create-docs-detail">
                        <div class="document">
                            <label for="docs-category">Category</label>
                            <select name="category_id" id="docs-category">
                                <option value="">---Choose Category---</option>
                                @foreach ($category as $item)
                                    @if (date('Y-m-d') < $item->first_closure_date)
                                        <option value="{{ $item->id }}"
                                            {{ old('category_id') == $item->id ? 'selected' : '' }}>
                                            {{ $item->category_name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        @error('category_id')
                            <p>{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="document-file">
                        <input type="file" name="files[]" id="file" class="inputfile" multiple />
                        <label for="file"><i class="bi bi-file-earmark-plus"></i> Upload Documents</label>
                        @error('files.*')
                            <p>{{ $message }}</p>
                        @enderror
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" name="term" />
                            <label class="form-check-label" for="flexCheckDefault">
                                Agree to the terms
                            </label>
                            @error('term')
                            <p class="error">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="create-docs-detail">
                        @error('files')
                        <p class="error">{{$message}}</p>
                        @enderror
                        @error('files.*')
                        <p class="error">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="docs-save">
                        <button type="submit">Create</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
