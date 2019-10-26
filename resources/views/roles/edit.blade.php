@extends('layouts.app')
@section('content')

<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Edit Role
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
          <h3 class="box-title">Edit Role</h3>
        </div>
        <div class="box-body">

          @include('errors')
          @include('flash::message')

          {!! Form::model($model,[
            'action' => ['RoleController@update', $model->id],
            'method' => 'put'
          ]) !!}
           @include('roles.form')
          {!! Form::close() !!}
        <!-- /.box-body -->
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->

@endsection
