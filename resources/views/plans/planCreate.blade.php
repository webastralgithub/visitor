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
        <h2>Add Plans</h2>
    </div>

    <div class="company--deats--form  border--form">
        <div class="form--text">
            <h2>Plans Details</h2>
        </div>
        <div class="compamy--deats">
            <form method="post" action="/plans/create">
                @csrf
                <div class="input-wrapper">
                    <input type="hidden" name="srtipe_plan">
                    <label class="input--lable" for="">Plan Name:</label>
                    <input type="text" id="name" name="name" placeholder="Name" value="{{ old('name') }}">
                    @if ($errors->has('name'))
                    <span class="text-danger text-error">
                        {{ $errors->first('name') }}
                    </span>
                    @endif
                </div>
                <div class="input-wrapper">
                    <label class="input--lable" for="">Price:</label>
                    <input type="text" id="price" name="price" placeholder="Price" value="{{ old('price') }}">
                    @if ($errors->has('price'))
                    <span class="text-danger text-error">
                        {{ $errors->first('price') }}
                    </span>
                    @endif
                </div><br>
                <div class="input-wrapper custom_list_section">
                    <label class="input--label custom_list" for="billing_period">Billing Period:</label>
                    <select id="billing_period" name="billing_period">
                        <option value="day" {{ old('billing_period')=='daily' ? 'selected' : '' }}>Daily</option>
                        <option value="month" {{ old('billing_period')=='month' ? 'selected' : '' }}>Monthly</option>
                        <option value="year" {{ old('billing_period')=='year' ? 'selected' : '' }}>Yearly</option>
                        <option value="week" {{ old('billing_period')=='every_3_months' ? 'selected' : '' }}>
                            Every 3 Months
                        </option>
                        <option value="week" {{ old('billing_period')=='every_6_months' ? 'selected' : '' }}>
                            Every 6 Months
                        </option>
                    </select>
                    @if ($errors->has('billing_period'))
                    <span class="text-danger text-error">
                        {{ $errors->first('billing_period') }}
                    </span>
                    @endif
                </div><br>
                <div class="input-col--50">
                    <div class="input-wrapper description">
                        <label class="input--lable" for="">Description:</label>
                        <textarea id="description" name="description"
                            placeholder="Description">{{ old('description') }}</textarea>
                        @if ($errors->has('description'))
                        <span class="text-danger text-error">
                            {{ $errors->first('description') }}
                        </span>
                        @endif
                    </div>
                </div>

                <input type="submit" value="Add Plan">
            </form>
        </div>
    </div>
</section>
@endsection