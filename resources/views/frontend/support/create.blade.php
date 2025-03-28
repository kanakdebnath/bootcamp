@extends('frontend.layouts.master')
@push('style')
<!-- Summernote CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.css" rel="stylesheet">
@endpush

@section('content')
        <div class="box2 mb-5 mx-0 mx-sm-4 mt-0 mt-sm-5 text-center">
            <p class="fs-3 mb-1 fw-semibold">Support Ticket Create</p>
          </div>

          <div class="mt-5 mx-0 mx-sm-4">
              <div class="row g-4">
                <a href="{{route('user.support.index')}}" class="btn btn-info mb-3">All Ticket</a>

                <form action="{{route('user.support.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="exampleInputEmail1" class="form-label">Subject</label>
                        <input type="text" name="subject" class="form-control" required placeholder="Enter Subject" >
                        @error('subject')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group mb-3">
                        {!! Form::label('details', 'Details') !!}
                        {!! Form::textarea('details', null, ['class' => 'form-control summernote', 'required' => true]) !!}
                        @error('details')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="exampleInputEmail1" class="form-label">Attachment</label>
                        <input type="file" name="file" class="form-control" >
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
              
              
            </div>
          </div>
@endsection

@push('script')

<!-- Summernote JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.js"></script>

<script>
    $(document).ready(function() {
        $('.summernote').summernote({
            height: 300,  // Set editor height
            minHeight: 200, // Set minimum height
            maxHeight: 500, // Set maximum height
            focus: true,    // Focus the editor on load
            placeholder: 'Write your description here...',
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });
    });
</script>

@endpush