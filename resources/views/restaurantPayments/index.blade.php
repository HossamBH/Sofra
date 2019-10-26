@extends('layouts.app')
@inject('restaurant', 'App\Models\Restaurant')
@section('content')

<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Restaurant Payments
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
          <h3 class="box-title">Show Payment</h3>
        </div>
        <div>

                    {!! Form::open([

                    'method' => 'get'

                    ]) !!}

                    <div class="row">

                        <div class="col-md-4">

                            <div class="form-group">

                                {!! Form::select('restaurant_id', $restaurant->pluck('name', 'id') ,null,[

                                'placeholder' => 'Restaurants',

                                'class' => 'form-control'

                                ]) !!}

                            </div>

                        </div>

                        <div class="col-md-4">

                            <div class="form-group">

                                {!! Form::text('payment_date',request()->input('payment_date'),[

                                'placeholder' => 'Date',

                                'class' => 'form-control'

                                ]) !!}

                            </div>

                        </div>

                        <div class="col-md-2">

                            <div class="form-group">

                                <button class="btn btn-primary btn-block" type="submit"><i class="fa fa-search"></i></button>

                            </div>

                        </div>

                    </div>
        <div class="box-body">
          <a href="{{url('restaurant-payments/create')}}" class="btn btn-primary"><i class="fa fa-plus"></i>New Payment</a>
          @include('flash::message')
          @if(count($models))
            <div class="table-responsive">
              <table class="table table-bordered">
                <thead>
                  <tr>
                  <th>#</th>
                  <th>Restaurant</th>
                  <th>Paid</th>
                  <th>Date</th>
                  <th>Edit</th>
                  <th>Delete</th>
                </tr>
                </thead>

                <tbody>
                  @foreach($models as $model)
                    <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>{{$model->restaurant->name}}</td>
                      <td>{{$model->paid}}</td>
                      <td>{{$model->payment_date}}</td>
                      <td><a href="{{url(route('restaurant-payments.edit', $model->id))}}" class="btn btn-success btn-xs"><i class="fa fa-edit"></i>Edit</a></td>
                      <td>
                          {!! Form::open([
                            'action' => ['RestaurantPaymentController@destroy', $model->id],
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
