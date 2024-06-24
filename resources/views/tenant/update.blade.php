@extends('layouts.dashbord')
@section('title', 'Home Page')
@section('content')
    <section class="custom--contaner">
        <div class="dash--text"><span><img src="{{ asset('images/right-arrow.png') }}" /></span>
            <h2>Edit Agency</h2> <span class="ham-sec"> - </span>
            <h2>{{$tenantDetail->company_name}}</h2>
        </div>
        @if (\Session::has('success'))
        <div class="alert alert-success">
            <ul>
                <li>{!! \Session::get('success') !!}</li>
            </ul>
        </div>
        @endif
        <div class="company--deats--form  border--form">
            <div class="update-agency">
                <h2>{{$tenant->company_name}}</h2>
                <a href="//{{$tenant->domains[0]->domain}}" target="__blank">{{$tenant->domains[0]->domain}}</a>
                <img class="edit--btn" src="{{ asset('images/editbtn.svg') }}" />
            </div>


            <div class="form--text">
                <h2>Company Details</h2>
            </div>
            <div class="compamy--deats">
                <form method="post" action="/tenant/edit/{{$tenant_id}}">
                    @csrf
                    <div class="input-wrapper">
                        <label class="input--lable">Company Name</label>
                        <input 
                            type="text" 
                            id="company_name" 
                            name="company_name"
                            value="{{ old('company_name', $tenantDetail->company_name) }}"
                        >
                        @if ($errors->has('company_name'))
                            <span class="text-danger text-error">
                                {{ $errors->first('company_name') }}
                            </span>
                        @endif
                    </div>
                    <div class="input-wrapper">
                        <label class="input--lable">Email</label>
                        <input 
                            type="email" 
                            id="email" 
                            name="email"
                            value="{{ old('email', $user->email) }}"
                        >
                        @if ($errors->has('email'))
                            <span class="text-danger text-error">
                                {{ $errors->first('email') }}
                            </span>
                        @endif
                    </div>
                    <div class="input-wrapper">
                        <label class="input--lable">Address</label>
                        <input 
                            type="text" 
                            id="address" 
                            name="address"
                            value="{{ old('address', $tenantDetail->address) }}"
                        >
                        @if ($errors->has('address'))
                            <span class="text-danger text-error">
                                {{ $errors->first('address') }}
                            </span>
                        @endif
                    </div>
                    <div class="input-col--50">
                        <div class="input-wrapper col--50">
                            <label class="input--lable">First Name</label>
                            <input 
                                type="text" 
                                id="first_name" 
                                name="first_name"
                                value="{{ old('first_name', $tenantDetail->first_name) }}"
                            >
                            @if ($errors->has('first_name'))
                                <span class="text-danger text-error">
                                    {{ $errors->first('first_name') }}
                                </span>
                            @endif
                        </div>
                        <div class="input-wrapper col--50">
                            <label class="input--lable">Last Name</label>
                            <input 
                                type="text" 
                                id="last_name" 
                                name="last_name" 
                                value="{{ old('last_name', $tenantDetail->last_name) }}"
                            >
                            @if ($errors->has('last_name'))
                                <span class="text-danger text-error">
                                    {{ $errors->first('last_name') }}
                                </span>
                            @endif
                        </div>
                        <div class="input-wrapper col--50">
                            <label class="input--lable">Phone</label>
                            <input 
                                type="text" 
                                id="phone_number" 
                                name="phone_number"
                                value="{{ old('phone_number', $tenantDetail->phone_number) }}"
                            >
                            @if ($errors->has('phone_number'))
                                <span class="text-danger text-error">
                                    {{ $errors->first('phone_number') }}
                                </span>
                            @endif
                        </div>
                       
                    </div>
                    <div class="input-wrapper">
                        <label class="input--lable">Script Code</label>
                        <input 
                            type="text" 
                            id="tracker_url" 
                            name="tracker_url"
                            value="{{ old('tracker_url', $tenantDetail->tracker_url) }}"
                        >
                        @if ($errors->has('tracker_url'))
                            <span class="text-danger text-error">
                                {{ $errors->first('tracker_url') }}
                            </span>
                        @endif
                    </div>
                    <div class="input-wrapper">
                        <label class="input--lable">Webhook url</label>
                        <div class="webhook--box">{{Request::getScheme()}}://{{$tenant->domains[0]->domain}}/webhook</div>
                    </div>
                    <input type="submit" value="Update Agency">
                </form>
            </div>
        </div>
    </section>
@endsection