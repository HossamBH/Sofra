@extends('layouts.app')
@section('content')

<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Contacts
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
          <h3 class="box-title">Show Contacts</h3>
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

                        <div class="col-md-4">

                            <div class="form-group">

                                {!! Form::text('email',request()->input('email'),[

                                'placeholder' => 'Email',

                                'class' => 'form-control'

                                ]) !!}

                            </div>

                        </div>

                        <div class="col-md-4">

                            <div class="form-group">

                                {!! Form::text('phone',request()->input('phone'),[

                                'placeholder' => 'Phone Number',

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

                    {!! Form::close() !!}

        </div>
        <div class="box-body">
          @if(count($contacts))
            <div class="table-responsive">
              <table class="table table-bordered">
                <thead>
                  <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>Subject</th>
                  <th>Message</th>
                  <th>Type</th>
                  <th>Delete</th>
                </tr>
                </thead>

                <tbody>
                  @foreach($contacts as $contact)
                    <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>{{$contact->name}}</td>
                      <td>{{$contact->email}}</td>
                      <td>{{$contact->phone}}</td>
                      <td>{{$contact->message}}</td>
                      <td>{{$contact->type}}</td>
                      <td>
                          {!! Form::open([
                            'action' => ['ContactController@destroy', $contact->id],
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
