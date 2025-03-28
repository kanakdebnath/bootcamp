@extends('frontend.layouts.master')
@push('style')
<link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
@endpush
@section('content')
<div class="mt-3 mt-sm-5 mx-0 mx-sm-5 px-0 px-ms-5">
    
   <div class="row">
    <div class="col-md-8 col-lg-8">
        <div class="course-card">
            <img
            class="img-fluid rounded-4"
            src="{{asset('public/images/service/' . $service->photo)}}"
            alt=""
            />
            
        </div>
        <div class="mt-2 g-4">
            {!!$service->description!!}
        </div>
    </div>
    <div class="col-md-4 col-lg-4">
        <p class="fs-3 mb-3 fw-bold text-danger " style="font-family: 'Poppins', sans-serif;">
            {{$service->title}}
        </p>

        <div class="box pb-0">
            <p>
                {{$service->category->name}}
            </p>
            <p>
                <b>Price:</b>  {{$service->price}} BDT
            </p>
            <p>
                <b>Delivery Time:</b>  {{$service->delivery_time}} Days
            </p>

            <div class="text-center mt-4">
                <a href="{{route('user.service.buy',$service->id)}}" class="btn-buy w-50">Buy Now</a>
            </div>
        </div>


    </div>
   </div>
</div>    
@endsection