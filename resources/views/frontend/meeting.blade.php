@extends('frontend.layouts.master')
@section('content')
<div class="box2 mb-5 mx-0 mx-sm-4 mt-0 mt-sm-5 text-center">
            <p class="fs-3 mb-1 fw-semibold">All Meetings</p>
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
                                <th>Meeting Topics</th>
                                <th>Zoom Meeting Link</th>
                                <th>Meeting Date</th>
                                <th>Meeting With</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($meetings as $meeting )
                            <tr>
                                <td>{{$meeting->topics}}</td>
                                <td>
                                    <a target="_blank" href="{{$meeting->link}}">{{$meeting->link}}</a>
                                    <br>
                                    <span><b>Zoom ID:</b> {{$meeting->zoom_id}}</span> , <span><b>Zoom Passcode:</b> {{$meeting->zoom_pass}}</span>
                                </td>
                                <td>{{ \Carbon\Carbon::parse($meeting->main_date_time)->format('F j, Y h:i A') }}</td>
                                <td>{{$meeting->employee->name}}</td>
                                <td>{{$meeting->status}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <!-- Pagination -->
                    <nav aria-label="Page navigation">
                        <ul class="pagination justify-content-end">
                            {{ $meetings->links('pagination::bootstrap-4') }}
                        </ul>
                    </nav>

                </div>
              
              
            </div>
          </div>
@endsection