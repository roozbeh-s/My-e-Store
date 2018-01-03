@extends('auth')

@section('title', '| Forgot my Password')

@section('content') 	
	<div class="container">

			<div class="col-sm-6 col-sm-offset-3" style="margin-top: 50px; margin-bottom: 50px;">
				<div class="panel panel-default">
					<div class="panel-heading">Reset Password </div>

						<div class="panel-body">
						
						{!! Form::open(['url' => 'password/reset', 'method' => "POST"]) !!}


							{{ Form::hidden('token', $token)}}
							{{ Form::label('email', 'Email Address') }}
							{{ Form::email('email', $email, ['class' => 'form-control']) }}



							{{ Form::label('password', 'New Password') }}
							{{ Form::password('password', ['class' => 'form-control']) }}

							{{ Form::label('password_confirmation', 'Confirm New Password') }}
							{{ Form::password('password_confirmation', ['class' => 'form-control']) }}

							<br>

							{{ Form::submit('Reset Password', ['class' => 'btn btn-default btn-block']) }}

							{!! Form::close() !!}
							
							

						</div>
				</div>


			</div>
	</div>					

@endsection	