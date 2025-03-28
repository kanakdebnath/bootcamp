@extends('frontend.layouts.master')
@section('content')
<div class="box2 mb-5 mx-0 mx-sm-4 mt-0 mt-sm-5 text-center">
            <p class="fs-3 mb-1 fw-semibold">All Record Classes</p>
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
                                <th>Topics</th>
                                <th>Link</th>
                                <th>Password</th>
                                <th>Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($classes as $class )
                            <tr>
                                <td>{{$class->topics}}</td>
                                <td>
                                    <a target="_blank" href="{{$class->link}}">{{$class->link}}</a>
                                </td>
                                <td>{{$class->password}}</td>
                                <td>{{ \Carbon\Carbon::parse($class->main_date_time)->format('F j, Y h:i A') }}</td>
                                <td>
                                    <a class="btn btn-success btn-sm my-2" target="_blank" href="{{$class->link}}">View</a>
                                </td>
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