@extends('layouts.app')
@inject('restaurant','App\Models\Restaurant')
@section('content')

<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Orders
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
          <h3 class="box-title">Show Orders</h3>
        </div>
        <div>

                    {!! Form::open([

                    'method' => 'get'

                    ]) !!}

                    <div class="row">

                        <div class="col-md-4">

                            <div class="form-group">

                                {!! Form::text('id',request()->input('id'),[

                                'placeholder' => 'Order No.',

                                'class' => 'form-control'

                                ]) !!}

                            </div>

                        </div>

                        <div class="col-md-3">

                            <div class="form-group">

                                {!! Form::select('restaurant_id',$restaurant->pluck('name','id')->toArray(),request()->input('restaurant_id'),[

                                'class' => 'select2 form-control',

                                'placeholder' => 'Restaurants'

                                ]) !!}

                            </div>

                        </div>

                        <div class="col-md-2">

                            <div class="form-group">

                                <button class="btn btn-primary btn-block" type="submit"><i class="fa fa-search"></i></button>

                            </div>

                        </div>

                    </div>

                    {!! Form::close() !!}

        </div>

      </div>


        <div class="box-body">
          @if(count($orders))
            <div class="table-responsive">
              <table class="table table-bordered">
                <thead>
                  <tr>
                  <th>#</th>
                  <th>Order No.</th>
                  <th>Restaurant</th>
                  <th>Total</th>
                  <th>State</th>
                  <th>Notes</th>
                </tr>
                </thead>

                <tbody>
                  @foreach($orders as $order)
                    <tr>
                      <td>{{$loop->iteration}}</td>
                      <td><a href="{{url(route('orders.show', $order->id))}}">{{$order->id}}</a></td>
                      <td>{{$order->restaurant->name}}</td>
                      <td>{{$order->total_price}}</td>
                      <td>{{$order->order_state}}</td>
                      <td>{{$order->notes}}</td>                      
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
