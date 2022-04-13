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
                            <textarea name="description" id="docs-introduction" cols="10" rows="7">{{ old('description') }}</textarea>
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
                                <input class="form-check-input" type="checkbox" name="anonymous" value="1" />
                                <label class="form-check-label" for="flexCheckDefault"> Post with anonymous </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="flexCheckDefault" name="term"
                                    value="true" {{ !old('term') ?: 'checked' }} />
                                <label class="form-check-label" for="flexCheckDefault">
                                    Agree to the
                                    <a href="#" data-toggle="modal" data-target="#exampleModalLong"
                                        onclick="$('#exampleModalLong').modal('show')">terms</a>
                                </label>
                                @error('term')
                                    <p class="error">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                    </div>
                    <div class="create-docs-detail">
                        @error('files')
                            <p class="error">{{ $message }}</p>
                        @enderror
                        @error('files.*')
                            <p class="error">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="docs-save">
                        <button type="submit">Create</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Terms and Conditions</h5>
                </div>
                <div class="modal-body">
                    <p>We have the legal right to require that You comply with these Terms of Use, Privacy Policy or
                        The respective usage agreement when using the Service. If it is determined that You are in breach of
                        these terms and conditions,
                        In this event, We may unilaterally terminate or immediately suspend: (1) Use of the Service;
                        (2) Agreement to use the Service; (3) Access this Website. We also reserve the right to notify
                        activities
                        This action is suspected of violating regulations with authorities or a third party. We can also
                        cooperate with law enforcement to assist in the investigation and prosecution of illegal activities
                        in
                        accordance with the law
                        determined. If You would like to report any violation of these terms, please contact us</p>

                    <p>All images, logos, and all other content (referred to as the Content) on this Website are the
                        property
                        of owned by us or other organizations or individuals that are legally cited. We allow
                        You view, download and print Content when:
                        – You only use it for personal purposes and not for commercial purposes.
                        – You do not copy, publish or reuse the Content.
                        – You do not edit the Content.
                        – You do not move any copyright, trademark and other proprietary Content on the Website.
                        Except as expressly permitted above, any copying, adaptation or re-use of the Contents is strictly
                        prohibited content of the Website without our prior written permission. To request use of the
                        Content,
                        You can contact us. If approved, You warrant that your use of the Website Content
                        Your application will be in accordance with these Regulations and this use will not violate the
                        rights
                        and interests of individuals, organizations
                        other organizations or violate contracts or legal obligations of other individuals or organizations.
                    </p>

                    <p>All information entered into this Website is governed by our Privacy Policy.
                        We may change or modify these Terms of Use at our sole discretion without
                        inform you. You can view updated information at any time on this Website. If
                        Your continued use of the Service means that You accept and agree to abide by the Terms of Use
                        update.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                        onclick="$('#exampleModalLong').modal('hide')">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection
