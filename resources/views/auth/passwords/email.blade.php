@extends('auth')

@section('title', '| Forgot my Password')

@section('content') 	
	<div class="container">

			<div class="col-sm-6 col-sm-offset-3" style="margin-top: 50px; margin-bottom: 50px;">
				<div class="panel panel-default">
					<div class="panel-heading">Reset Password </div>

						<div class="panel-body">

							@if (session('status'))
								<div class="alert alert-success">
									{{ session('status') }}
								</div>
							@endif


						{!! Form::open(['url' => 'password/email', 'method' => "POST"]) !!}
							{{ Form::label('email', 'Email Address') }}
							{{ Form::email('email', null, ['class' => 'form-control']) }}

							<br>

							{{ Form::submit('Reset Password', ['class' => 'btn btn-default btn-block']) }}

							{!! Form::close() !!}
							
							

						</div>
				</div>


			</div>
	</div>					

@endsection	