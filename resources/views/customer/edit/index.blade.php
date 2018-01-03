@extends('main')

@section('title', '| Account Edit') 


@section('content')

<div class="container acc-edit-container">

    <div class="col-sm-6" style="text-align: center; margin-bottom: -30px;">
        @if(session()->has('message'))
        <div class="alert alert-success">
        {{ session()->get('message') }}
        </div>
        @endif
    </div>

    @include('partials/_accsidebar')

    <div class="acc-edit-content col-sm-6">
       <div class="acc-edit-sub-content">
            <div class="acc-edit-sub-content-title">
            <br>
            Edit Account Information
            <hr>

            </div>             

            <div class="col-sm-6 col-sm-offset-3" >

            <div class="acc-edit-form">


           {!! Form::model($user,[ 'method' => 'PATCH','route' => ['accountupdate', $user->id]]) !!} 

                        {{ Form::label('name', "Name") }}
                        {{ Form::text('name', null, ['class'=>'form-control']) }}


                        @if ($errors->has('name')) 

                         <p class="validation-error"> {{ $errors->first('name') }}</p> 

                        @endif

                        <br>
                        {{ Form::label('email',"Email") }}
                        {{ Form::email('email', null, ['class' => 'form-control','readonly']) }}


                        @if ($errors->has('email')) 

                         <p class="validation-error"> {{ $errors->first('email') }}</p> 

                        @endif
              </div>          
            </div>
        </div>

        <div class="acc-edit-button-save">

            {{ Form::submit('Save', ['class' => 'button-save get']) }}

            {!! Form::close() !!}

        </div>

    </div> 

</div>    


@endsection 
 