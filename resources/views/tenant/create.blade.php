@extends('layouts.dashbord')
@section('title', 'Home Page')
@section('content')
    <section class="custom--contaner">
        @if ($errors->has('error'))
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <div class="dash--text">
            <h2>Add Agency</h2>
        </div>

        <div class="company--deats--form  border--form">
            <div class="form--text">
                <h2>Company Details</h2>
            </div>
            <div class="compamy--deats">
                <form method="post" action="/tenant/create">
                    @csrf
                    <div class="input-wrapper">
                        <label class="input--lable" for="">Company Name</label>
                        <input 
                            type="text" 
                            id="company_name" 
                            name="company_name" 
                            placeholder="Company Name" 
                            value="{{ old('company_name') }}"
                        >
                        @if ($errors->has('company_name'))
                            <span class="text-danger text-error">
                                {{ $errors->first('company_name') }}
                            </span>
                        @endif
                    </div>
                    <div class="input-wrapper">
                        <label class="input--lable" for="">Email</label>
                        <input 
                            type="email" 
                            id="email" 
                            name="email" 
                            placeholder="Email" 
                            value="{{ old('email') }}"
                        >
                        @if ($errors->has('email'))
                            <span class="text-danger text-error">
                                {{ $errors->first('email') }}
                            </span>
                        @endif
                    </div>
                    <div class="input-col--50">
                        <div class="input-wrapper col--50">
                            <label class="input--lable" for="">City</label>
                            <input 
                                type="text" 
                                id="city" 
                                name="city" 
                                placeholder="City"
                                value="{{ old('city') }}"
                            >
                            @if ($errors->has('city'))
                                <span class="text-danger text-error">
                                    {{ $errors->first('city') }}
                                </span>
                            @endif
                        </div>
                        <div class="input-wrapper col--50">
                            <label class="input--lable" for="">State</label>
                            <input 
                                type="text" 
                                id="state" 
                                name="state" 
                                placeholder="State"
                                value="{{ old('state') }}"
                            >
                            @if ($errors->has('state'))
                                <span class="text-danger text-error">
                                    {{ $errors->first('state') }}
                                </span>
                            @endif
                        </div>
                        <div class="input-wrapper col--50">
                            <label class="input--lable" for="">Zip Code</label>
                            <input 
                                type="text" 
                                id="zip_code" 
                                name="zip_code" 
                                placeholder="Zip Code"
                                value="{{ old('zip_code') }}"
                            >
                            @if ($errors->has('zip_code'))
                                <span class="text-danger text-error">
                                    {{ $errors->first('zip_code') }}
                                </span>
                            @endif
                        </div>
                        <div class="input-wrapper col--50">
                            <label class="input--lable" for="">Phone</label>
                            <input 
                                type="text" 
                                id="phone_number" 
                                name="phone_number" 
                                placeholder="Phone"
                                value="{{ old('phone_number') }}"
                            >
                            @if ($errors->has('phone_number'))
                                <span class="text-danger text-error">
                                    {{ $errors->first('phone_number') }}
                                </span>
                            @endif
                        </div>
                        
                    </div>
                    <div class="input-wrapper">
                        <label class="input--lable" for="">Address</label>
                        <input 
                            type="text" 
                            id="address" 
                            name="address" 
                            placeholder="Address"
                            value="{{ old('address') }}"
                        >
                        @if ($errors->has('address'))
                            <span class="text-danger text-error">
                                {{ $errors->first('address') }}
                            </span>
                        @endif
                    </div>
                    <div class="input-col--50">
                        <div class="input-wrapper col--50">
                            <label class="input--lable" for="">First Name</label>
                            <input 
                                type="text" 
                                id="first_name" 
                                name="first_name" 
                                placeholder="First Name"
                                value="{{ old('first_name') }}"
                            >
                            @if ($errors->has('first_name'))
                                <span class="text-danger text-error">
                                    {{ $errors->first('first_name') }}
                                </span>
                            @endif
                        </div>
                        <div class="input-wrapper col--50">
                            <label class="input--lable" for="">Last Name</label>
                            <input 
                                type="text" 
                                id="last_name" 
                                name="last_name" 
                                placeholder="Last Name"
                                value="{{ old('last_name') }}"
                            >
                            @if ($errors->has('last_name'))
                                <span class="text-danger text-error">
                                    {{ $errors->first('last_name') }}
                                </span>
                            @endif
                        </div>
                        
                    </div>
                    <div class="input-wrapper"> 
                        <label class="input--lable" for="">Password</label>  
                        <input 
                            type="password" 
                            id="password" 
                            name="password" 
                            placeholder="Password"
                            value="{{ old('password') }}"
                        >
                        @if ($errors->has('password'))
                            <span class="text-danger text-error">
                                {{ $errors->first('password') }}
                            </span>
                        @endif 
                    </div>
                    <div class="input-wrapper">
                        <label class="input--lable" for="">Confirm Password</label>
                        <input 
                            type="password" 
                            id="password_confirmation" 
                            name="password_confirmation" 
                            placeholder="Confirm password"
                            value="{{ old('password_confirmation') }}"
                        >
                        @if ($errors->has('password_confirmation'))
                            <span class="text-danger text-error">
                                {{ $errors->first('password_confirmation') }}
                            </span>
                        @endif
                    </div>
                    <div class="input-col--50">
                    <div class="input-wrapper col--50">
                    <label class="input--lable" for="">Script Code</label>
                            <input 
                                type="text" 
                                id="tracker_url" 
                                name="tracker_url" 
                                placeholder="Script Code"
                                value="{{ old('tracker_url') }}"
                            >
                            @if ($errors->has('tracker_url'))
                                <span class="text-danger text-error">
                                    {{ $errors->first('tracker_url') }}
                                </span>
                            @endif
                    </div>
                    <div class="input-wrapper col--50">
                            <label class="input--lable" for="">Amount</label>
                            <input 
                                type="text" 
                                id="amount" 
                                name="amount" 
                                placeholder="Amount"
                                value="{{ old('amount') }}"
                            >
                            @if ($errors->has('amount'))
                                <span class="text-danger text-error">
                                    {{ $errors->first('amount') }}
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="input-col--50">
                        <div class="input-wrapper col--50">
                            <label class="input--lable" for="">Lead Cost</label>
                            <input 
                                type="text" 
                                id="lead_cost" 
                                name="lead_cost" 
                                placeholder="Lead Cost"
                                value=""
                            >
                            @if ($errors->has('lead_cost'))
                                <span class="text-danger text-error">
                                    {{ $errors->first('lead_cost') }}
                                </span>
                            @endif
                        </div>
                  
                        <div class="input-wrapper col--50">
                        <label class="input--lable" for="">Credit</label>
                            <input 
                                type="text" 
                                id="credit" 
                                name="credit" 
                                placeholder="Credit"
                                value="{{ old('credit') }}"
                            >
                            @if ($errors->has('credit'))
                                <span class="text-danger text-error">
                                    {{ $errors->first('credit') }}
                                </span>
                            @endif
                        </div>
                    </div>
                    <input type="submit" value="Add Agency">
                </form>
            </div>
        </div>
    </section>
@endsection