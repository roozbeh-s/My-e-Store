@extends('accountmain')

@section('title', '| Password Edit') 


@section('content')

            <div class="col-sm-6" style="text-align: center; margin-bottom: -30px;">
            @if(session()->has('message'))
            <div class="alert alert-success">
            {{ session()->get('message') }}
            </div>
            @endif
            </div>


<div class="col-sm-6">
    <div class="acc-edit-content">
       <div class="acc-edit-sub-content" style="height:400px;">
            <div class="acc-edit-sub-content-title">
            <br>
            Edit Account Password
            <hr>

            </div>             

            <div class="col-sm-6 col-sm-offset-3" >

            <div class="acc-edit-form">


           {!! Form::model($user,[ 'method' => 'PATCH','route' => ['passwordupdate', $user->id]]) !!} 

                        {{ Form::label('current_password', "Current Password") }}
                        {{ Form::password('current_password',['class'=>'form-control']) }}

                        @if ($errors->has('current_password')) 

                        <p class="validation-error"> {{ $errors->first('current_password') }}</p> 

                        @endif

                        <br>


                        {{ Form::label('password', "New Password") }}
                        {{ Form::password('password',['class'=>'form-control']) }}


                        @if ($errors->has('password')) 

                        <p class="validation-error"> {{ $errors->first('password') }}</p> 

                        @endif

                        <br>

                        {{ Form::label('password_confirmation', 'Confirm New Password') }}
                        {{ Form::password('password_confirmation', ['class' => 'form-control']) }}


                        @if ($errors->has('password_confirmation')) 

                        <p class="validation-error"> {{ $errors->first('password_confirmation') }}</p> 

                        @endif



              </div>          

            </div>





        </div>

        <!---->

        <div class="acc-edit-button-save">

            {{ Form::submit('Save', ['class' => 'button-save get']) }}

            {!! Form::close() !!}

        </div>

    </div>         
</div>





</div>

</div> <!-- end of row-->
</div> <!-- end of container-->

@endsection 
 