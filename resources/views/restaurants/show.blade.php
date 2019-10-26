@extends('layouts.app')
@section('content')

<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Restaurant
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
          <h3 class="box-title">Show Restaurant</h3>
        </div>
        <div class="box-body">
            <div class="table-responsive">
              <table class="table table-bordered">
                <thead>
                  <tr>
                  <th>Name</th>
                  <th>Phone</th>
                  <th>Email</th>
                  <th>City</th>
                  <th>Image</th>
                  <th>Status</th>
                  <th>Activation</th>
                  <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                      <td>{{$restaurant->name}}</a></td>
                      <td>{{$restaurant->phone}}</td>
                      <td>{{$restaurant->email}}</td>
                      <td>{{$restaurant->neighborhood->city->name}}</td>
                      <td>
                        <img src="../{{$restaurant->image}}" class="img-rounded" width="75px">
                      </td>
                      <td>{{$restaurant->status}}</td>
                      <td class="text-center">
                            @if($restaurant->activated)
                                <a href="restaurant/{{$restaurant->id}}/de-activate" class="btn btn-xs btn-danger"><i class="fa fa-close"></i> De-Activate</a>
                            @else
                                <a href="restaurant/{{$restaurant->id}}/activate" class="btn btn-xs btn-success"><i class="fa fa-check"></i> Activate</a>
                            @endif
                      </td>
                      <td>
                          {!! Form::open([
                            'action' => ['RestaurantController@destroy', $restaurant->id],
                            'method' => 'delete'
                          ]) !!}
                          <button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i></button>
                          {!! Form::close() !!}
                      </td>
                    </tr>
                </tbody>
              </table>
            </div>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->

@endsection
