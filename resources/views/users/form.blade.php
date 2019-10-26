@inject('role','App\Models\Role')

<?php
	$roles = $role->pluck('display_name', 'id')->toArray();
?>


<div class="form-group">
    <label for="name">Name</label>
      {!! Form::text('name' , $model->name, [
        'class' => 'form-control'
      ]) !!}
</div>

<div class="form-group">
    <label for="email">Email</label>
      {!! Form::text('email' , $model->email, [
        'class' => 'form-control'
      ]) !!}
</div>

<div class="form-group">
    <label for="password">Password</label>
      {!! Form::password('password', [
        'class' => 'form-control'
      ]) !!}
</div>

<div class="form-group">
    <label for="password_confirmation">Password Confirmation</label>
      {!! Form::password('password_confirmation', [
        'class' => 'form-control'
      ]) !!}
</div>

<div class="form-group">
    <label for="roles_list">Roles</label>
      {!! Form::select('roles_list[]',$roles,null,[
        'class' => 'form-control select2',
        'multiple' => 'multiple',
      ]) !!}
</div>

<div class="form-group">
    <button class="btn btn-primary">Submit</button>
</div>