@inject('perm','App\Models\Permission')

<div class="form-group">
	<label for="name">Name</label>
	{!! Form::text('name' , null, [
	'class' => 'form-control'
	]) !!}
</div>

<div class="form-group">
	<label for="display_name">Displayed Name</label>
	{!! Form::text('display_name' , null, [
	'class' => 'form-control'
	]) !!}
</div>

<div class="form-group">
	<label for="description">Description</label>
	{!! Form::textarea('description' , null, [
	'class' => 'form-control'
	]) !!}
</div>

<div class="form-group">
	<label for="permission_list">Permissions</label>
	<br>
	<input id="select-all" type="checkbox"><label for='select-all'>Select All</label>
	<br>
	<div class="row">
		@foreach($perm->all() as $permission)
			<div class="col-sm-3">
				<div class="checkbox">
				    <label>
				      <input type="checkbox" name="permission_list[]" value="{{$permission->id}}"

				      @if($model->hasPermission($permission->name))
				      		checked
				      @endif

				      > {{$permission->display_name}}
				    </label>
				</div>
			</div>

		@endforeach
	</div>
</div>

<div class="form-group">
  <button class="btn btn-primary">Submit</button>
</div>

@push('scripts')
	<script type="text/javascript">
		
		$("#select-all").click(function(){
			$("input[type=checkbox]").prop('checked', $(this).prop('checked'));
		});
	</script>

@endpush