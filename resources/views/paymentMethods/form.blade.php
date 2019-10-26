<div class="form-group">
    <label for="type">Type</label>
        {!! Form::text('type' , $model->type, [
           'class' => 'form-control'
        ]) !!}
</div>

<div class="form-group">
    <button class="btn btn-primary">Submit</button>
</div>