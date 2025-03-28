@extends('frontend.layouts.master')
@section('content')
<div class="box2 mb-5 mx-0 mx-sm-4 mt-0 mt-sm-5 text-center">
            <p class="fs-3 mb-1 fw-semibold">All Live Classes</p>
            <p>
              Helping over 20 thousand peoples move closer to their goal of True
              Financial Freedom
            </p>
          </div>

          <div class="mt-5 mx-0 mx-sm-4">
            <div class="row g-4">
                
                  
                <div class="table-responsive course-card">
                    <table class="table  table-bordered align-middle">
                        <thead>
                            <tr>
                                <th>Live CLass Topics</th>
                                <th>Live CLass Link</th>
                                <th>Live CLass Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($classes as $class )
                            <tr>
                                <td>{{$class->topics}}</td>
                                <td>
                                    <a target="_blank" href="{{$class->link}}">{{$class->link}}</a>
                                    <br>
                                    <span><b>Zoom ID:</b> {{$class->zoom_id}}</span> , <span><b>Zoom Passcode:</b> {{$class->zoom_pass}}</span>
                                </td>
                                <td>{{ \Carbon\Carbon::parse($class->main_date_time)->format('F j, Y h:i A') }}</td>
                                <td>{{$class->status}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <!-- Pagination -->
                    <nav aria-label="Page navigation">
                        <ul class="pagination justify-content-end">
                            {{ $classes->links('pagination::bootstrap-4') }}
                        </ul>
                    </nav>

                </div>
              
              
            </div>
          </div>
@endsection