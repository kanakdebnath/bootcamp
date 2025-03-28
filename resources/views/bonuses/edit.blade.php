@extends('layouts.admin')

@section('content')
    <ol class="breadcrumb">
          <li class="breadcrumb-item">
             <a href="{!! route('bonuses.index') !!}">Bonus</a>
          </li>
          <li class="breadcrumb-item active">Edit</li>
        </ol>
    <div class="container-fluid">
         <div class="animated fadeIn">
             @include('coreui-templates::common.errors')
             <div class="row">
                 <div class="col-lg-12">
                      <div class="card">
                          <div class="card-header">
                              <i class="fa fa-edit fa-lg"></i>
                              <strong>Edit Bonus</strong>
                          </div>
                          <div class="card-body">
                              {!! Form::model($bonus, ['route' => ['bonuses.update', $bonus->id], 'method' => 'patch', 'files' => true]) !!}

                              @include('bonuses.fields')

                              {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
         </div>
    </div>
@endsection