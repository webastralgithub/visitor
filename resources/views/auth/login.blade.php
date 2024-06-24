@extends('layouts.login')
@section('title', 'login')
@section('content')
    <section class="log--section">
        <div class="company--deats--form">
            <div class="log-form--icon">
                <div><img class="admin-icon" src="{{ global_asset('images/loginuser.png') }}" /></div>
                <div class="age--sec--text">Super Admin login</div>
            </div>
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <div class="compamy--deats">
                <form method="post" action="/login">
                    @csrf
                    <label class="input--lable">Email ID</label>
                    <input type="email" name='email' />
                    <label class="input--lable">Password</label>
                    <input type="password" name="password" />
                    <input type="submit" value="Login">
                </form>
            </div>
        </div>
    <section>
@endsection
