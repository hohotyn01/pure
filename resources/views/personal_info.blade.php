@extends('layouts.site')

@section('header')
    @include('site.header')
@endsection

@section('content')
    <div class="container mt-4 ">
        <div class="text-center mt-5 mb-5">
            <h3>
                Let's start with some basic information
            </h3>
            <h5>
                <small>At the end of the quote you will get a price for cleaning</small>
            </h5>
        </div>
        <hr>
        <form action="" method="post">
            @if(count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
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
                {{--LEFT LABEL--}}
                <label for="staticEmail" class="col-sm-3 col-form-label align-self-center">CLEANING FREQUENCY</label>

                <div class="col-sm-9">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="once" value="once" name="cleaning_frequency"
                                {{!empty($order->cleaning_frequency) && ($order->cleaning_frequency == 'once') ? 'checked' : ''}}>
                        <label class="form-check-label" for="once">Once</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="weekly" value="weekly"
                               name="cleaning_frequency"
                                {{!empty($order->cleaning_frequency) && ($order->cleaning_frequency == 'weekly') ? 'checked' : ''}}>
                        <label class="form-check-label" for="weekly">Weekly</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="biweekly" value="biweekly"
                               name="cleaning_frequency"
                                {{!empty($order->cleaning_frequency) && ($order->cleaning_frequency == 'biweekly') ? 'checked' : ''}}>
                        <label class="form-check-label" for="biweekly">Biweekly</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="monthly" value="monthly"
                               name="cleaning_frequency"
                                {{!empty($order->cleaning_frequency) && ($order->cleaning_frequency == 'monthly') ? 'checked' : ''}}>
                        <label class="form-check-label" for="monthly">Monthly</label>
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
                {{--LEFT LABEL--}}
                <label for="staticEmail" class="col-sm-3 col-form-label">CLEANING TYPE</label>

                <div class="col-sm-9">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="deep_or_spring" value="deep_or_spring"
                               name="cleaning_type"
                                {{!empty($order->cleaning_type) && ($order->cleaning_type == 'deep_or_spring') ? 'checked' : ''}}>
                        <label class="form-check-label" for="deep_or_spring">Deep or Spring</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="move_in" value="move_in" name="cleaning_type"
                                {{!empty($order->cleaning_type) && ($order->cleaning_type == 'move_in') ? 'checked' : ''}}>
                        <label class="form-check-label" for="move_in">Move in</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="move_out" value="move_out"
                               name="cleaning_type"
                                {{!empty($order->cleaning_type) && ($order->cleaning_type == 'move_out') ? 'checked' : ''}}>

                        <label class="form-check-label" for="move_out">Move Out</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="post_remodeling" value="post_remodeling"
                               name="cleaning_type"
                                {{!empty($order->cleaning_type) && ($order->cleaning_type == 'post_remodeling') ? 'checked' : ''}}>
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
                {{--LEFT LABEL--}}
                <label for="staticEmail" class="col-sm-3 col-form-label">CLEANING DATE</label>

                <div class="col-sm-9">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="next_available" value="next_available"
                               name="cleaning_date"
                                {{!empty($order->cleaning_date) && ($order->cleaning_date == 'next_available') ? 'checked' : ''}}>
                        <label class="form-check-label" for="next_available">Next available</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="this_week" value="this_week"
                               name="cleaning_date"
                                {{!empty($order->cleaning_date) && ($order->cleaning_date == 'this_week') ? 'checked' : ''}}>
                        <label class="form-check-label" for="this_week">This week</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="next_week" value="next_week"
                               name="cleaning_date"
                                {{!empty($order->cleaning_date) && ($order->cleaning_date == 'next_week') ? 'checked' : ''}}>
                        <label class="form-check-label" for="next_week">Next week</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="this_month" value="this_month"
                               name="cleaning_date"
                                {{!empty($order->cleaning_date) && ($order->cleaning_date == 'this_month') ? 'checked' : ''}}>
                        <label class="form-check-label" for="this_month">This Month</label>
                    </div>
                    <br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="i_am_flexible" value="i_am_flexible"
                               name="cleaning_date"
                                {{!empty($order->cleaning_date) && ($order->cleaning_date == 'i_am_flexible') ? 'checked' : ''}}>
                        <label class="form-check-label" for="i_am_flexible">I am flexible</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="just_need_a_quote" value="just_need_a_quote"
                               name="cleaning_date"
                                {{!empty($order->cleaning_date) && ($order->cleaning_date == 'just_need_a_quote') ? 'checked' : ''}}>
                        <label class="form-check-label" for="just_need_a_quote">Just need a quote</label>
                    </div>
                </div>
            </div>
            <hr>
            {{--
                PERSONAL INFO
            --}}
            <div class="form-group form-row mt-5  mb-5">
                {{--LEFT LABEL--}}
                <label for="staticEmail" class="col-sm-3 col-form-label align-self-center">PERSONAL INFO</label>

                <div class="col-sm-9">
                    <div class="form-row">
                        {{--The first block--}}
                        <div class="form-group col-md-6">
                            <label for="first_name">First name</label>
                            <input type="text" class="form-control" id="first_name" name="first_name"
                                   value="{{!empty($user->first_name) ? $user->first_name : ''}}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="last_name">Last name</label>
                            <input type="text" class="form-control" id="last_name" name="last_name"
                                   value="{{!empty($user->last_name) ? $user->last_name : ''}}">
                        </div>
                        {{--The second block--}}
                        <div class="form-group col-md-8">
                            <label for="street_address">Street address</label>
                            <input type="text" class="form-control" id="street_address" name="street_address"
                                   value="{{!empty($order->street_address) ? $order->street_address : ''}}">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="apt">Apt</label>
                            <input type="text" class="form-control" id="apt" name="apt" value="{{!empty($order->apt) ? $order->apt : ''}}">
                        </div>
                        {{--Tree block--}}
                        <div class="form-group col-md-6">
                            <label for="city">City</label>
                            <input type="text" class="form-control" id="city" name="city" value="{{!empty($order->city) ? $order->city : ''}}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="home_footage">Home Footage</label>
                            <input type="text" class="form-control" id="home_footage" name="home_footage"
                                   value="{{!empty($order->home_footage) ? $order->home_footage : ''}}">
                        </div>
                        {{--Four Bock--}}
                        <div class="form-group col-md-6">
                            <label for="mobile_phone">Mobile phone</label>
                            <input type="tel" class="form-control" name="mobile_phone" id="mobile_phone"
                                   value="{{!empty($user->mobile_phone) ? $user->mobile_phone : ''}}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="about_us">How did you hear about us?</label>
                            <select class="form-control" name="about_us" id="about_us">
                                <option {{!empty($order->about_us) && ($order->about_us == 'cleaning_for_reason' ? 'selected' : '')}} value="cleaning_for_reason">Cleaning for Reason</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            {{--Button--}}
            <div class="text-center mb-5">
                <input type="submit" class="btn btn-danger" value="3 Steps Left">
            </div>
        </form>
    </div>
@endsection