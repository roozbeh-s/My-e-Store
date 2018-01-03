@extends('auth')

@section('title', '| Login') 

@section('content') 	
	<section id="form">
		<div class="container">

			<div class="col-sm-3 col-sm-offset-4">
				<h2>Sign in</h2>
						<br>

						
						<p class="validation-error">{{  $errors->first('email')  }}</p>
						{!! Form::open() !!}	

						{{ Form::label('email', 'Email')}}
						{{ Form::email('email', null, ['class' => 'form-control']) }}

						<br>

						{{ Form::label('password', "Password")}}
						{{ Form::password('password', ['class'=> 'form-control']) }}
						
						<br>
						
						
						{{ Form::checkbox('remember') }}
						{{ Form::label('remeber',"Keep me signed in")}}

						<br>
						
						
						{{ Form::submit('Login', ['class' => 'btn btn-default btn-block']) }}

						<p> <a href="{{ url('password/reset') }}">Forgot Password</a></p>


						{!! Form::close() !!}


						<div>

						<div style="margin-top: 40px; text-align: center;"><h5>New to E-SHOPPER?</h5></div>

						<a class="button-register get" href="{{ URL::to('auth/register') }}">Create your Account </a>

						</div>
			</div>


		</div>

	</section>

@endsection		
	
	