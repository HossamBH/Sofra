@extends('layouts.app')
@inject('restaurants','App\Models\Restaurant')
@section('content')

<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Offers
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
          <h3 class="box-title">Show Offers</h3>
        </div>
        <div>

                    {!! Form::open([

                    'method' => 'get'

                    ]) !!}

                    <div class="row">

                        <div class="col-md-4">

                            <div class="form-group">

                                {!! Form::text('name',request()->input('name'),[

                                'placeholder' => 'Name',

                                'class' => 'form-control'

                                ]) !!}

                            </div>

                        </div>

                        <div class="col-md-3">

                            <div class="form-group">

                                {!! Form::select('restaurant_id',$restaurants->pluck('name','id')->toArray(),request()->input('restaurant_id'),[

                                'class' => 'select2 form-control',

                                'placeholder' => 'Restaurant'

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
          @if(count($offers))
            <div class="table-responsive">
              <table class="table table-bordered">
                <thead>
                  <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Description</th>
                  <th>Image</th>
                  <th>Start</th>
                  <th>End</th>
                  <th>Delete</th>
                </tr>
                </thead>

                <tbody>
                  @foreach($offers as $offer)
                    <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>{{$offer->name}}</td>
                      <td>{{$offer->description}}</td>
                     <td>
                        <img src="{{$offer->image}}" class="img-rounded" width="75px">
                      </td>
                      <td>{{$offer->start}}</td>
                      <td>{{$offer->end}}</td>
                      <td>
                          {!! Form::open([
                            'action' => ['OfferController@destroy', $offer->id],
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
