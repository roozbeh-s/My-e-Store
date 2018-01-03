{{--@extends('main')--}}
@extends('auth')

@section('title', '| Register') 

@section('content') 	
	<section id="form" style="margin-top: 10px;"><!--form-->
		<div class="container">
				<div class="col-sm-3 col-sm-offset-4">
						<h2>New User Signup!</h2>

						
						{!! Form::open() !!}

						{{ Form::label('name', "Name") }}
						{{ Form::text('name', null, ['class'=>'form-control']) }}


						@if ($errors->has('name')) 

						 <p class="validation-error"> {{ $errors->first('name') }}</p> 

						@endif

						<br>
						{{ Form::label('email',"Email") }}
						{{ Form::email('email',null, ['class' => 'form-control']) }}


						@if ($errors->has('email')) 

						 <p class="validation-error"> {{ $errors->first('email') }}</p> 

						@endif


						<br>
						{{ Form::label('password',"Password") }}
						{{ Form::password('password',['class' => 'form-control']) }}


						@if ($errors->has('password')) 

						 <p class="validation-error"> {{ $errors->first('password') }}</p> 

						@endif

						<br>
						{{ Form::label('password_confirmation', 'Confirm Password') }}
						{{ Form::password('password_confirmation', ['class' => 'form-control']) }}

						<br>
						{{ Form::submit('Register', ['class' => 'btn btn-default btn-block']) }}



						{!! Form::close() !!}

						
				</div>
		</div>
	</section><!--/form-->
@endsection		
	
	