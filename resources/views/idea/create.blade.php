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
                            <textarea name="description" id="docs-introduction" cols="10" rows="7">{{old('description')}}</textarea>
                        </div>
                        @error('description')
                            <p>{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="create-docs-detail">
                        <div class="document">
                            <label for="docs-category">Campaign</label>
                            <select name="category_id" id="docs-category">
                                <option value="">---Choose Campaign---</option>
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
                        <div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="anonymous" value="1"/>
                                <label class="form-check-label" for="flexCheckDefault">  Post with anonymous   </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="flexCheckDefault" name="term" value="true" {{ !old('term') ?: 'checked' }} />
                                <label class="form-check-label" for="flexCheckDefault">
                                    Agree to the terms
                                </label>
                                <label type="button" class="terms-ct" data-bs-toggle="modal" data-bs-target="#termsModal">
                                    (<span>Read terms...</span>)
                                </label>
                                @error('term')
                                <p class="error">{{$message}}</p>
                                @enderror
                            </div>
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
            <div class="modal fade" id="termsModal" tabindex="-1" aria-labelledby="termsModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="termsModalLabel">Create new category</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>This is a project about the development of building a secure web-enabled role-based system of collecting ideas from the staff of a large University. Our group is required to include these functions in order to meet the needs of the stakeholders:
                                            Functions:
                                            QA(Admin):
                                            The QA is the role that can oversee all the process that the Staff or the User made
                                            There are different QA along with different departments, and they can manage the process for their department
                                            The QA can add, delete, edit any categories 
                                            The QA is able to download any data or file after the closure date in a CSV and uploaded documents in a ZIP file
                                            Receive an email notification when an idea is submitted 
                                        </p><br>
                                        <p>  
                                            Users:
                                            Ideas and comments can be posted anonymously
                                            All new ideas are disabled after a closure date for new ideas
                                            The user can rate the post by using a thumbs up and thumbs down button
                                            The author of a post or an idea will receive an automatic email notification whenever a comment is submitted to any of the idea
                                        </p><br>
                                        <p>     
                                            Staff:
                                            All staff can submit ideas
                                            All staff must agree to Terms and Conditions before they can submit
                                            All ideas can be categorized
                                            All staff can optionally upload documents to support their ideas
                                        </p><br>
                                        <p>    
                                            UI/UX:
                                            List of most popular idea, most viewed, latest ideas and comments are visible to all users
                                            There must be a pagination (5 post per page)
                                            There must be a dashboard for statistical analysis
                                            The interface must be responsive
                                        </p>
                                    </div>
                                    <div class="modal-footer">                                        
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
        </div>
    </div>
@endsection
