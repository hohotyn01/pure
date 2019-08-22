@extends('layouts.site')

@section('header')
    @include('site.header')
@endsection

@section('content')
    <div class="container mt-4">
        <div class="text-center">
            <h2>
                Get a price for home cleaning
            </h2>
        </div>
        <form>
            <hr>
            @csrf
            {{--
                CLEANING FREQUENCY
            --}}
            <div class="form-group row mt-4  mb-4">
                <label class="col-sm-3"></label>
                <div class="col-sm-9">
                    <h5> How often would you like us to come?
                        <br>
                        <small>You can always change frequencies, reschedule, or save cleaning for later</small>
                    </h5>
                </div>
                <label for="staticEmail" class="col-sm-3 col-form-label">CLEANING FREQUENCY</label>
                <div class="col-sm-9">

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="Once" value="Once">
                        <label class="form-check-label" for="Once">Once</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="Weekly" value="Weekly">
                        <label class="form-check-label" for="Weekly">Weekly</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="Biweekly" value="Biweekly">
                        <label class="form-check-label" for="Biweekly">Biweekly</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="Monthly" value="Monthly">
                        <label class="form-check-label" for="Monthly">Monthly</label>
                    </div>
                </div>
            </div>
            <hr>
            {{--
                CLEANING TYPE
            --}}
            <div class="form-group row mt-4  mb-4">
                <label class="col-sm-3"></label>
                <div class="col-sm-9">
                    <h5> What type of cleaning? </h5>
                </div>
                <label for="staticEmail" class="col-sm-3 col-form-label">CLEANING TYPE</label>
                <div class="col-sm-9">

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="deep_or_spring" value="deep_or_spring">
                        <label class="form-check-label" for="deep_or_spring">Deep or Spring</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="move_in" value="move_in">
                        <label class="form-check-label" for="move_in">Move in</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="move_out" value="move_out">
                        <label class="form-check-label" for="move_out">Move Out</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="post_remodeling" value="post_remodeling">
                        <label class="form-check-label" for="post_remodeling">Post Remodeling</label>
                    </div>
                </div>
            </div>
            <hr>
            {{--
                CLEANING DATE
            --}}
            <div class="form-group row mt-4  mb-5">
                <label class="col-sm-3"></label>
                <div class="col-sm-9">
                    <h5> When will you need us? </h5>
                </div>
                <label for="staticEmail" class="col-sm-3 col-form-label">CLEANING DATE</label>
                <div class="col-sm-9">

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="next_available" value="next_available">
                        <label class="form-check-label" for="next_available">Next available</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="this_week" value="this_week">
                        <label class="form-check-label" for="this_week">This week</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="next_week" value="next_week">
                        <label class="form-check-label" for="next_week">Next week</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="this_month" value="this_month">
                        <label class="form-check-label" for="this_month">This Month</label>
                    </div>
                    <br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="i_am_flexible" value="i_am_flexible">
                        <label class="form-check-label" for="i_am_flexible">I am flexible</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="just_need_a_quote"
                               value="just_need_a_quote">
                        <label class="form-check-label" for="just_need_a_quote">Just need a quote</label>
                    </div>
                </div>
            </div>
            <hr>
            {{--
                FORMA INFO
            --}}
            <div class="form-group row mt-5  mb-5">
                <label for="staticEmail" class="col-sm-3 col-form-label">PERSONAL INFO</label>
                <div class="col-sm-9">
                    <div class="row">
                        {{--The first block--}}
                        <div class="form-group col-md-6">
                            <label for="first_name">First name</label>
                            <input type="text" class="form-control" id="first_name">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="last_name">Last name</label>
                            <input type="text" class="form-control" id="last_name">
                        </div>
                        {{--The second block--}}
                        <div class="form-group col-md-8">
                            <label for="street_address">Street address</label>
                            <input type="text" class="form-control" id="street_address">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="Apt">Apt</label>
                            <input type="text" class="form-control" id="Apt">
                        </div>
                        {{--Tree block--}}
                        <div class="form-group col-md-6">
                            <label for="City">City</label>
                            <input type="text" class="form-control" id="City">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="home_square_footage">Home Square Footage</label>
                            <input type="text" class="form-control" id="home_square_footage">
                        </div>
                        {{--Four Bock--}}
                        {{--<div class="form-group col-md-6">--}}
                            {{--<label for="City">City</label>--}}
                            {{--<input type="text" class="form-control" id="City">--}}
                        {{--</div>--}}
                        {{--<div class="form-group col-md-6">--}}
                            {{--<label for="home_square_footage">Home Square Footage</label>--}}
                            {{--<input type="text" class="form-control" id="home_square_footage">--}}
                        {{--</div>--}}
                    </div>
                </div>
            </div>
            {{--
                Button
            --}}
            <div class="text-center mb-5">
                <input type="submit" class="btn btn-danger" value="3 Steps Left">
            </div>
        </form>
    </div>
@endsection