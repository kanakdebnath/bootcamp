@extends('frontend.layouts.master')
@section('content')
<div class="box2 mb-5 mx-0 mx-sm-4 mt-0 mt-sm-5 text-center">
            <p class="fs-3 mb-1 fw-semibold">All Service</p>
            <p>
              Helping over 20 thousand peoples move closer to their goal of True
              Financial Freedom
            </p>
          </div>

          <div class="mt-5 mx-0 mx-sm-4">
            <div class="row g-4">
                @foreach ($services as $service )
                    
              <div class="col-lg-3 col-md-3">
                <div class="course-card">
                  <p class="fs-5 mb-1 fw-semibold">{{$service->title}}</p>
                  <img
                    class="img-fluid"
                    src="{{asset('public/images/service/' . $service->photo)}}"
                    alt="{{$service->title}}"
                  />
                  <div class="box pb-0">
                    <p>
                        {{$service->category->name}}
                    </p>
                    <p>
                      <b>Price:</b>  {{$service->price}}
                    </p>
                    <p>
                      <b>Delivery Time:</b>  {{$service->delivery_time}} Days
                    </p>

                    <div class="text-center mt-4">
                      <a href="{{route('user.service.details',$service->id)}}" class="btn-buy w-50">Buy Now</a>
                    </div>
                  </div>
                </div>
              </div>
              
              @endforeach
            </div>
          </div>
@endsection