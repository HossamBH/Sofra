<div class="form-group">
	<label for="about_us">About Us</label>
		{!! Form::text('about_us' , $model->about_us, [
		'class' => 'form-control'
		]) !!}

	<label for="content">Content</label>
		{!! Form::text('content' , $model->content, [
		'class' => 'form-control'
		]) !!}

	<label for="text">Text</label>
		{!! Form::text('text' , $model->text, [
		'class' => 'form-control'
		]) !!}

	<label for="phone">Phone</label>
		{!! Form::text('phone' , $model->phone, [
		'class' => 'form-control'
		]) !!}

	<label for="email">Email</label>
		{!! Form::text('email' , $model->email, [
		'class' => 'form-control'
		]) !!}
		
	<label for="fb_link">Facebook</label>
		{!! Form::text('fb_link' , $model->fb_link, [
		'class' => 'form-control'
		]) !!}

	<label for="twitter_link">Twitter</label>
		{!! Form::text('twitter_link' , $model->twitter_link, [
		'class' => 'form-control'
		]) !!}

	<label for="youtube_link">Youtube</label>
		{!! Form::text('youtube_link' , $model->youtube_link, [
		'class' => 'form-control'
		]) !!}

	<label for="wapp_link">Whatsapp</label>
		{!! Form::text('wapp_link' , $model->wapp_link, [
		'class' => 'form-control'
		]) !!}

	<label for="insta_link">Instegram</label>
		{!! Form::text('insta_link' , $model->insta_link, [
		'class' => 'form-control'
		]) !!}

	<label for="commission">Commission</label>
		{!! Form::text('commission' , $model->commission, [
		'class' => 'form-control'
		]) !!}	

	<label for="maximum">Maximum</label>
		{!! Form::text('maximum' , $model->maximum, [
		'class' => 'form-control'
		]) !!}
</div>
<div class="form-group">
	<button class="btn btn-primary">Submit</button>
</div>