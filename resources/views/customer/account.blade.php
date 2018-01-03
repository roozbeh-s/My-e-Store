
@extends('main')

@section('title', '| Account') 


@section('content')

<div class="container acc-container">
    @include('partials/_accsidebar')

        <div class="acc-content col-sm-6">
        <div class="acc-content-title">
            <h2>My Dashboard</h2>
        </div>
        <div>
            Hello, {{ Auth::user()->name }}!
            From your My Account Dashboard you have the ability to view a snapshot of your recent account activity and update your account information. Select a link below to view or edit information.
        </div>
        <div class="acc-sub-content">
            <div class="acc-sub-content-title">
            <br>
            <i class="fa fa-user-circle-o" aria-hidden="true"></i>
            ACCOUNT INFORMATION
            <hr>
            </div>
            <div class="col-sm-6">
                <div class="contact-info">
                    <div class="contact-info-title">
                    Contact Information
                    <a href={{ route('accountedit') }}>Edit</a>
                    </div>

                    <div class="contact-info-content">
                        <ul>
                        <li>
                        {{ Auth::user()->name }}
                        </li>
                        <li>
                        {{ Auth::user()->email }}
                        </li>
                        <li>
                        <a href={{ route('passwordedit')}}>Change Password</a>
                        </li>
                        </ul>


                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                    <div class="contact-info-title">
                    Address Book
                    <a href={{ route('addressedit')}}>{{ empty($address) ? 'Add Address' : 'Change Address'  }}</a>
                    </div>

                    <div class="contact-info-content">
                        <ul>
                            <li>
                            {{ empty($address) ? '' : $address->addr_first_line }}
                            </li>
                            <li>
                            {{ empty($address) ? '' : $address->addr_second_line }}
                            </li>
                            <li>
                            {{ empty($address) ? '' : $address->city.','}} {{ empty($state) ? '' : $state->name.',' }} {{ empty($address) ? '' : $address->postcode }}
                            </li>
                            <li>
                            {{ empty($country) ? '': $country->name }}
                            </li>
                        </ul>
                    </div>
                </div>
                
            </div>
        </div>  
</div>




@endsection 
 