@extends('layouts.app')
@section('content')

<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Role
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
          <h3 class="box-title">Show Role</h3>
        </div>
        <div class="box-body">
          <a href="{{url('roles/create')}}" class="btn btn-primary"><i class="fa fa-plus"></i>New Role</a>
          @include('flash::message')
          @if(count($roles))
            <div class="table-responsive">
              <table class="table table-bordered">
                <thead>
                  <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Displayed Name</th>
                  <th>Edit</th>
                  <th>Delete</th>
                </tr>
                </thead>

                <tbody>
                  @foreach($roles as $role)
                    <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>{{$role->name}}</td>
                      <td>{{$role->display_name}}</td>
                      <td><a href="{{url(route('roles.edit', $role->id))}}" class="btn btn-success btn-xs"><i class="fa fa-edit"></i>Edit</a></td>
                      <td>
                          {!! Form::open([
                            'action' => ['RoleController@destroy', $role->id],
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
