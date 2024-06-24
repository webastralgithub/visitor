@extends('layouts.agency')
@section('title', 'Create customer')
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
            <h2>Edit Customer</h2>
        </div>
        <div class="back-button">
            <a href="{{ route('customerList') }}" class="label"><img src="/images/leftarrow.png"> Back</a>
        </div>
        <div class="company--deats--form">
            <div class="form--text">
                <h2>Customer Details</h2>
            </div>

            <div class="compamy--deats">
                <form method="post" action="/customer/{{$customer->id}}">
                    @csrf
                    <div class="input-wrapper">
                        <label class="input--lable" for="">Company Name</label>
                        <input 
                            type="text" 
                            id="company_name" 
                            name="company_name" 
                            placeholder="Company Name" 
                            value="{{ old('company_name', $customer->company_name) }}"
                        >
                        @if ($errors->has('company_name'))
                            <span class="text-danger text-error">
                                {{ $errors->first('company_name') }}
                            </span>
                        @endif
                    </div>
                    <div class="input-wrapper">
                        <label class="input--lable" for="">Location Id</label>
                        <input 
                            type="text" 
                            id="location_id" 
                            name="location_id" 
                            placeholder="Location ID" 
                            value="{{ old('location_id', $customer->location_id) }}"
                        >
                        @if ($errors->has('location_id'))
                            <span class="text-danger text-error">
                                {{ $errors->first('location_id') }}
                            </span>
                        @endif
                    </div>
                    <div>
                        @if ($errors->has('domain'))
                            <span class="text-danger text-error">
                            {{ $errors->first('domain') }}
                            </span>
                        @endif
                    </div>
                    <label class="input--lable" for="">Domain</label>
                    @forelse (old('domain', $customer->domains) as $i => $domain)
                        <div class="input-wrapper" id="domain-url">
                            <input 
                                type="text" 
                                id="domain" 
                                name="domain[]" 
                                placeholder="Domain URL"
                                value="{{ !empty($domain) ? (is_string($domain) ? $domain : $domain->domain) : '' }}"
                            >
                        </div>
                    @empty
                        <div class="input-wrapper" id="domain-url">
                            <input 
                                type="text" 
                                id="domain" 
                                name="domain[]" 
                                placeholder="Domain URL"
                            >
                        </div>
                    @endforelse
                    
                    <div id="more-domains"></div>
                    <div class="input-wrapper">
                        <label class="text-info link" id="add-more-domain">+ Add another domain</label>
                    </div>

                    <div class="input-wrapper">
                    <label class="input--lable" for="">Webhook URL</label>
                        <input 
                            type="text" 
                            id="webhook_url" 
                            name="webhook_url" 
                            placeholder="Webhook URL" 
                            value="{{ old('webhook_url', $customer->webhook_url) }}"
                        >
                        @if ($errors->has('webhook_url'))
                            <span class="text-danger text-error">
                                {{ $errors->first('webhook_url') }}
                            </span>
                        @endif
                    </div>
                    <input type="submit" value="Update Customer">
                </form>
            </div>
        </div>
    </section>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#add-more-domain').click(function() {
                console.log("Debugger")
                var div = $('<div class="input-wrapper"></div>');
                var input = $('<input type="text" name="domain[]" placeholder="Domain URL" />')
                div.append(input)
                $("#more-domains").append(div);
            })
        })
    </script>
    
@endsection