@extends('layouts.app')
@inject('model','App\Models\Commission')
@inject('restaurant','App\Models\Restaurant')
@section('content')

<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Create Restaurant Payment
      </h1>
      <!-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Examples</a></li>
        <li class="active">Blank page</li>
      </ol> -->
    </section>

    <!-- Main content -->
    <section class="content">

        
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Create Restaurant Payment</h3>
        </div>
        <div class="box-body">

          @include('errors')
          @include('flash::message')

          {!! Form::model($model,[
            'action' => 'RestaurantPaymentController@store'
          ]) !!}
            
          @include('restaurantPayments.form')
           
          {!! Form::close() !!}
        <!-- /.box-body -->
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->

@endsection
