<div class="form-group">
    <label for="name">Name</label>
        {!! Form::text('name' , $model->name, [
           'class' => 'form-control'
        ]) !!}
    <label for="city_id">Governorate Name</label>
        {!! Form::select('city_id', $city->pluck('name', 'id')->toArray() ,null, [
           'class' => 'form-control'
        ]) !!}
</div>

<div class="form-group">
    <button class="btn btn-primary">Submit</button>
</div>