@extends('layouts.site')

@section('title')

@endsection

@section('header')
    @include('site.header')
@endsection

@section('content')
    <div class="container mt-5 mb-5 cart">
        <form action="/extras/charge" method="post" id="payment-form">
            @csrf
            <div class="form-row inline">
                <div class="col">
                    <label class="with" for="card-holder-name">
                        Name
                    </label>
                    <input class="with" type="text" id="card-holder-name" name="card_holder_name" required>
                </div>
            </div>
            <div class="form-row inline">
                <div class="col">
                    <label class="with" for="iban-element">
                        CARD
                    </label>
                    <!-- Stripe Elements Placeholder -->
                    <div id="card-element"></div>
                </div>
            </div>
            <input type="hidden" name="payment_method_id" id="payment-method-id" value="">

            <button id="card-button" data-secret="{{empty($intent) ? '' : $intent->client_secret}}">
                Process Payment
            </button>
        </form>
        <br>
    </div>
    <div class="text-center">
        <p>4242424242424242</p>
    </div>
@endsection

