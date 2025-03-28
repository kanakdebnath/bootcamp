@extends('frontend.layouts.master')
@push('style')
<!-- Summernote CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.css" rel="stylesheet">
@endpush

@section('content')
        <div class="box2 mb-5 mx-0 mx-sm-4 mt-0 mt-sm-5 ">
            <p class="fs-3 mb-1 fw-semibold text-center">Support Ticket Information</p>
            
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th >Ticket ID</th>
                        <td>#{{$support->support_id}}</td>
                    </tr>
                    <tr>
                        <th >Status</th>
                        <td>
                            @if ($support->status == 'Open')
                            <span class="badge rounded-pill text-bg-success">Open</span>
                            @elseif ($support->status == 'Processing')
                            <span class="badge rounded-pill text-bg-info">Processing</span>
                            @elseif ($support->status == 'Complete')
                            <span class="badge rounded-pill text-bg-dark">Complete</span>
                            @else
                            <span class="badge rounded-pill text-bg-primary">{{$support->status}}</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th >Subject</th>
                        <td>{{$support->subject}}</td>
                    </tr>
                </tbody>
            </table>

          </div>

          <div class="mt-5 mx-0 mx-sm-4">
              <div class="row g-4">

                <form action="{{route('user.support.reply', $support->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    
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
                    
                    <button type="submit" class="btn btn-success">Reply</button>
                </form>
              
              
            </div>
          </div>


          <div class="box2 mb-5 mx-0 mx-sm-4 mt-0 mt-sm-5 ">

            <div class="d-flex justify-content-between">
                <p class="fs-5 mb-1 fw-semibold text-center">History</p>
                @if($last)
                <p>
                    <b>Last Activity:</b> {{$last->employee ? $last->employee->name : $last->user->name}} , {{ \Carbon\Carbon::parse($last->updated_at)->format('F j, Y h:i A') }}
                </p>
                @endif
            </div>
            <hr>
                @foreach ($supports as $supportt )
                    @if ($supportt->employee != null)
                        <div  class="mb-5">
                            <p>
                                <span class="fs-5 fw-semibold "> {{$supportt->employee->name}}</span> <small>{{ \Carbon\Carbon::parse($supportt->updated_at)->format('F j, Y h:i A') }}</small>
                            </p>

                            <div class="admin-message">
                                <p>
                                    {!! $supportt->details !!}
                                </p>
                                @if ($supportt->photo != null)
                                    <a target="_blank" href="{{ asset('public/images/' . $supportt->photo) }}">{{ asset('public/images/' . $supportt->photo) }}</a>
                                @endif
                           </div>

                        </div>
                    @else

                        <div class="mb-5">
                            <p>
                                <span class="fs-5 fw-semibold "> {{$supportt->user->name}}</span> <small>{{ \Carbon\Carbon::parse($supportt->updated_at)->format('F j, Y h:i A') }}</small>
                            </p>

                           <div class="user-message">
                                <p>
                                    {!! $supportt->details !!}
                                </p>
                                @if ($supportt->photo != null)
                                    <a target="_blank" href="{{ asset('public/images/' . $supportt->photo) }}">{{ asset('public/images/' . $supportt->photo) }}</a>
                                @endif
                           </div>

                        </div>
                        
                    @endif
                    
                @endforeach

                <div class="mb-5">
                    <p>
                        <span class="fs-5 fw-semibold "> {{$support->user->name}}</span> <small>{{ \Carbon\Carbon::parse($support->updated_at)->format('F j, Y h:i A') }}</small>
                    </p>

                    <div class="user-message">
                        <p>
                            {!! $support->details !!}
                        </p>
                        @if ($support->photo != null)
                            <a target="_blank" href="{{ asset('public/images/' . $support->photo) }}">{{ asset('public/images/' . $support->photo) }}</a>
                        @endif
                    </div>

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