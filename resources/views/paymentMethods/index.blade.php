@extends('layouts.app')
@section('content')

<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Payment Methods
        <small>list</small>
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
          <h3 class="box-title">Show Payment Method</h3>
        </div>
        <div class="box-body">
          <a href="{{url('payment-methods/create')}}" class="btn btn-primary"><i class="fa fa-plus"></i>New Payment Method</a>
          @include('flash::message')
          @if(count($paymentMethods))
            <div class="table-responsive">
              <table class="table table-bordered">
                <thead>
                  <tr>
                  <th>#</th>
                  <th>Type</th>
                  <th>Edit</th>
                  <th>Delete</th>
                </tr>
                </thead>

                <tbody>
                  @foreach($paymentMethods as $paymentMethod)
                    <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>{{$paymentMethod->type}}</td>
                      <td><a href="{{url(route('payment-methods.edit', $paymentMethod->id))}}" class="btn btn-success btn-xs"><i class="fa fa-edit"></i>Edit</a></td>
                      <td>
                          {!! Form::open([
                            'action' => ['PaymentMethodController@destroy', $paymentMethod->id],
                            'method' => 'delete'
                          ]) !!}
                          <button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i></button>
                          {!! Form::close() !!}
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          @else
            <div class="alert alert-danger" role="alert">
              No data
            </div>
          @endif
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->

@endsection
