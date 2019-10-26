@extends('layouts.app')
@section('content')

<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Setting
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
          <h3 class="box-title">Show Setting</h3>
        </div>
        <div class="box-body">
          @if(!count($settings))
            <a href="{{url(route('settings.create'))}}" class="btn btn-primary"><i class="fa fa-plus"></i>Add Settings</a>
          @endif  
          @include('flash::message')
            <div class="table-responsive">
              <table class="table table-bordered">
                <thead>
                  <tr>
                  <th>About Us</th>
                  <th>Content</th>
                  <th>Text</th>
                  <th>Phone</th>
                  <th>Email</th>
                  <th>Facebook</th>
                  <th>Twitter</th>
                  <th>Youtube</th>
                  <th>whatsapp</th>
                  <th>Instegram</th>
                  <th>Commission</th>
                  <th>Maximum</th>
                  <th>Edit</th>
                </tr>
                </thead>

                <tbody>
                  @foreach($settings as $setting)
                    <tr>
                      <td>{{$setting->about_us}}</td>
                      <td>{{$setting->content}}</td>
                      <td>{{$setting->text}}</td>
                      <td>{{$setting->phone}}</td>
                      <td>{{$setting->email}}</td>
                      <td>{{$setting->fb_link}}</td>
                      <td>{{$setting->twitter_link}}</td>
                      <td>{{$setting->youtube_link}}</td>
                      <td>{{$setting->wapp}}</td>
                      <td>{{$setting->insta_link}}</td>
                      <td>{{$setting->commission}}</td>
                      <td>{{$setting->maximum}}</td>
                      <td><a href="{{url(route('settings.edit', $setting->id))}}" class="btn btn-success btn-xs"><i class="fa fa-edit"></i>Edit</a></td>
                    </tr>
                  @endforeach
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
