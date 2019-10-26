<div class="form-group">
    <label for="old-password">Current Password</label>
      {!! Form::password('old-password', [
        'class' => 'form-control'
      ]) !!}
</div>

<div class="form-group">
    <label for="password">New Password</label>
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
    <button class="btn btn-primary" onClick="{{url('/home')}}">Submit</button>
</div>