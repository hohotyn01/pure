@extends('layouts.site')

@section('header')
    @include('site.header')
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <form action="" method="post">
                <strong>Get a price for home cleaning</strong>
                @csrf
                <div class="form-group">
                    <p>CLEANING FREQUENCY</p>
                    <label id="Once">How often would you like us to come?</label><br>

                    <input type="checkbox" value="Once">
                    <input type="checkbox" value="Weekly">
                    <input type="checkbox" value="Biweekly">
                    <input type="checkbox" value="Monthly">
                </div>
                <div class="form-group">
                    <p>CLEANING TYPE</p>
                    <label for="">What type of cleaning</label><br>

                    <input type="checkbox"  value="deep_or_spring">
                    <input type="checkbox"  value="Move in">
                    <input type="checkbox"  value="Move Out">
                    <input type="checkbox"  value="Post remodeling">
                </div>
                <div class="form-group">
                    <p>CLEANING DATE</p>
                    <label id="Once">When will you need us?</label><br>

                    <input type="checkbox" value="Next available">
                    <input type="checkbox" value="This week">
                    <input type="checkbox" value="Next week">
                    <input type="checkbox" value="This month">
                    <input type="checkbox" value="I am flexible">
                    <input type="checkbox" value="Just need a quote">
                </div>

            </form>
        </div>
    </div>
@endsection