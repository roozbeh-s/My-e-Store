@extends('main')

@section('title', '| Address Edit') 


@section('content')

<div class="container addr-edit-container">
    
    <div class="col-sm-12" style="text-align: center; margin-bottom: -30px;">
            @if(session()->has('message'))
            <div class="alert alert-success">
            {{ session()->get('message') }}
            </div>
            @endif
    </div>

    @include('partials/_accsidebar')

    <div class="acc-edit-content col-sm-6">
       <div class="acc-edit-sub-content" style="height: 430px;">
            <div class="acc-edit-sub-content-title">
                <br>
                Edit Address
                <hr>
            </div>

            <div class="col-sm-12 acc-edit-form" >
               

                {!! empty($address) ? Form::open() : Form::model($address,[ 'method' => 'POST','route' => ['addressupdate', $address->id]]) 
                !!}

                
                {{ Form::label('addr_first_line', "Address Line 1") }}
                {{ Form::text('addr_first_line', null, ['class'=>'form-control']) }}
                

                @if ($errors->has('addr_first_line')) 
                <p class="validation-error"> {{ $errors->first('addr_first_line') }}</p> 
                @endif
             
                
                {{ Form::label('addr_second_line', "Address Line 2") }}
                {{ Form::text('addr_second_line', null, ['class'=>'form-control']) }}
               
                @if ($errors->has('addr_second_line')) 
                <p class="validation-error"> {{ $errors->first('addr_second_line') }}</p> 
                @endif
             

            </div>

            <div class="col-sm-6">
                {{ Form::label('city', "City") }}
                {{ Form::text('city', null, ['class'=>'form-control']) }}

                @if ($errors->has('city')) 
                <p class="validation-error"> {{ $errors->first('city') }}</p> 
                @endif

                
                {{ Form::label('postcode', "Zip/Postal Code") }}
                {{ Form::text('postcode', null, ['class'=>'form-control']) }}
                
                @if ($errors->has('postcode')) 
                <p class="validation-error"> {{ $errors->first('postcode') }}</p> 
                @endif


            </div>  <!-- city & postcode -->



            <div class="col-sm-6">
                {{ Form::label('state', "State") }}
                <br>
                @if(!empty($addres))
                {{ Form::select('state', $selectstate , $address->state) }}
                @else {{ Form::select('state', $selectstate) }} 
                @endif



                @if ($errors->has('state')) 
                <p class="validation-error"> {{ $errors->first('state') }}</p> 
                @endif
                
                
                
                <div style="margin-top: 10px;">
                {{ Form::label('country', "Country") }}
                @if(!empty($addres))
                {{ Form::select('country', $selectcountry , $address->country) }}
                @else {{ Form::select('country', $selectcountry) }}
                @endif


                @if ($errors->has('country')) 
                <p class="validation-error"> {{ $errors->first('country') }}</p> 
                @endif

                </div>
            </div>  <!-- state & country -->
        </div>
            <div class="acc-edit-button-save">
                {{ Form::submit('Save', ['class' => 'button-save get']) }}
                {!! Form::close() !!}
            </div>
    </div>
</div>    
     
@endsection