@extends('frontend.layouts.master')
@push('style')
<!-- Summernote CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush
@section('content')
        <div class="box2 mb-5 mx-0 mx-sm-4 mt-0 mt-sm-5 text-center">
            <p class="fs-3 mb-1 fw-semibold">All Support Tickets</p>
          </div>

          <div class="mt-5 mx-0 mx-sm-4">
              <a href="{{route('user.support.create')}}" class="btn btn-success mb-3">Create</a>
            <div class="row g-4">

                <div class="table-responsive course-card">
                    <table class="table  table-bordered align-middle">
                        <thead>
                            <tr>
                                <th>Support ID</th>
                                <th>Subject</th>
                                <th>Status</th>
                                <th>Last Update</th>
                                <th>File</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($supports as $support )
                            <tr>
                                <td>#{{$support->support_id}}</td>
                                <td>{{$support->subject}}</td>
                                <td>{{$support->status}}</td>
                                <td>{{ \Carbon\Carbon::parse($support->updated_at)->format('F j, Y h:i A') }}</td>
                                <td>
                                @if ($support->photo)
                                    <img src="{{ asset('public/images/' . $support->photo) }}" alt="support Image" class="img-thumbnail" style="max-width: 100px;">
                                @else
                                    No Image
                                @endif
                                </td>
                                <td>
                                    <a class="btn btn-info btn-sm my-2" href="{{ route('user.support.show', $support->id) }}">
                                        View
                                    </a>

                                    <form action="{{ route('user.support.destroy', $support->id) }}" method="POST" class="delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                                
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <!-- Pagination -->
                    <nav aria-label="Page navigation">
                        <ul class="pagination justify-content-end">
                            {{ $supports->links('pagination::bootstrap-4') }}
                        </ul>
                    </nav>

                </div>
              
              
            </div>
          </div>
@endsection

@push('script')

<!-- Summernote JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.js"></script>

<script>
        document.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>

@endpush