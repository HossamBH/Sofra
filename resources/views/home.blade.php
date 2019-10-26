@extends('layouts.app')
@inject('client','App\Models\Client')
@inject('restaurant','App\Models\Restaurant')
@inject('order','App\Models\Order')
@section('content')

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-user"></i></span>

                <div class="info-box-content">
                <span class="info-box-text">Clients</span>
                <span class="info-box-number">{{$client->count()}}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
            </div>

            <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-green"><i class="ion ion-ios-gear-chart"></i></span>

                <div class="info-box-content">
                <span class="info-box-text">Restaurants</span>
                <span class="info-box-number">{{$restaurant->count()}}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
            </div>


            <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-red"><i class="ion ion-ios-gear-chart"></i></span>

                <div class="info-box-content">
                <span class="info-box-text">Orders</span>
                <span class="info-box-number">{{$order->count()}}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
            </div>
        </div>
      <!-- Default box -->
      <div class="box">
        <div class="box-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

                    You are logged in!
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->

@endsection