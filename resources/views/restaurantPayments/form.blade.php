<div class="form-group">
    <label for="restaurant_id">Restaurant</label>
        {!! Form::select('restaurant_id', $restaurant->pluck('name', 'id') ,null, [
           'class' => 'form-control'
        ]) !!}
</div>

<div class="form-group">
    <label for="paid">Paid</label>
        {!! Form::text('paid' , $model->paid, [
           'class' => 'form-control'
        ]) !!}
</div>

<div class="form-group">
    <label for="payment_date">Date</label>
        {!! Form::text('payment_date' , $model->payment_date, [
           'class' => 'form-control'
        ]) !!}
</div>

<div class="form-group">
    <button class="btn btn-primary">Submit</button>
</div>