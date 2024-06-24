@extends('layouts.agency')
@section('title', 'Home Page')
@section('content')


@php


$customerName = $cardDetails['customer']['name'];
$cardDetails =$cardDetails['card']['data'];


@endphp

<section class="custom--contaner">
  <div class="dash--text">
    <h2>Payments</h2>
  </div>
  <div class ="row">
<div class="col-sm-6">

<div class="view--cust--table-section">
    <div class="view--cust--table">
        <form id="payment-form" action="create-payment"  method="post">
            @csrf
            <label for="card-element">
                Credit or debit card
            </label>
            <div id="card-element"></div>
            <div id="card-errors" role="alert"></div>
            <button type="submit" class="btn btn-primary" id="payment-button">Pay</button>
        </form>
    </div>
   
  </div>
</div>
<hr>    
<div class="col-sm-6">
@if (!empty($cardDetails))
  <div class="container">

          @foreach ($cardDetails as $cards )
          <div class="card">
            <div class="visa_logo">
            {{$cards['card']->brand}}           
 </div>
            <div class="visa_info">
                <img src="https://raw.githubusercontent.com/muhammederdem/credit-card-form/master/src/assets/images/chip.png" alt="">
                <p>**** **** **** {{$cards['card']->last4}}</p>
            </div>
            <div class="visa_crinfo">
                <p>{{$cards['card']->exp_month}}/{{$cards['card']->exp_year}}</p>
                <p>{{$customerName}}</p>
            </div>
        </div>
          @endforeach
     
    </div>
  @endif
  </div>
  </div>
 
  
</section>

<script src="https://js.stripe.com/v3/"></script>
<script>
    var stripe = Stripe('{{ env('STRIPE_KEY') }}');
    var elements = stripe.elements();
    var card = elements.create('card', {
        hidePostalCode: true
    });
    card.mount('#card-element');

    card.on('change', function(event) {
        var displayError = document.getElementById('card-errors');
        if (event.error) {
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = '';
        }
    });

    var form = document.getElementById('payment-form');
    // form.addEventListener('payment-button', function(event) {
    //     event.preventDefault();
    //     // document.getElementById('submit').disabled = true;

    // });

     $('#payment-button').click(function(e){
        e.preventDefault();
     
        stripe.createToken(card).then(function(result) {
            if (result.error) {
                var errorElement = document.getElementById('card-errors');
                errorElement.textContent = result.error.message;
                document.getElementById('payment-button').disabled = false;
            } else {
                var tokenInput = document.createElement('input');
                tokenInput.setAttribute('type', 'hidden');
                tokenInput.setAttribute('name', 'stripeToken');
                tokenInput.setAttribute('value', result.token.id);
                form.appendChild(tokenInput);
                $('#payment-form').submit();
            }
        });
     })
       
</script>

<style>
    .custom--contaner {
        margin: 0 auto;
        max-width: 600px;
        padding: 20px;
        background: #f9f9f9;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }
    .dash--text {
        text-align: center;
        margin-bottom: 20px;
    }
    .view--cust--table-section {
        display: flex;
        justify-content: center;
    }
    .view--cust--table {
        width: 100%;
    }
    form {
        width: 100%;
    }
    label {
        font-size: 16px;
        font-weight: 600;
        margin-bottom: 10px;
        display: block;
    }
    #card-element {
        background: #fff;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        margin-bottom: 10px;
    }
    #card-errors {
        color: #fa755a;
        margin-top: 10px;
    }
    .btn {
        display: inline-block;
        padding: 10px 20px;
        font-size: 16px;
        font-weight: 600;
        text-align: center;
        text-decoration: none;
        color: #fff;
        background-color: #007bff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s;
    }
    .btn:hover {
        background-color: #0056b3;
    }
</style>

@endsection
