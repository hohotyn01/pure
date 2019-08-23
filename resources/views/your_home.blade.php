@extends('layouts.site')

@section('header')
    @include('site.header')
@endsection

@section('content')
    <div class="container mt-4 ">
        <div class="text-center mt-5 mb-5">
            <h3>
                Now we need information about your home
            </h3>
            <h5>
                <small>This information will used to prepare for a cleaning</small>
            </h5>
        </div>
        <hr>
        <form action="">
            @csrf
            {{--
                HOME RESIDENT
            --}}
            <div class="form-group row mt-4 md-4">
                {{--LEFT LABEL--}}
                <label class="col-sm-3 col-form-label align-self-center">HOME RESIDENT</label>
                <div class="col-sm-9">
                    <div class="col-md-12">
                        {{--How any dogs or cats?--}}
                        <strong>How any dogs or cats?</strong>
                        <br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="dogs_or_cats" id="none" value="none">
                            <label class="form-check-label" for="none">None</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="dogs_or_cats" id="dog" value="dog">
                            <label class="form-check-label" for="dog">Dog</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="dogs_or_cats" id="cat" value="cat">
                            <label class="form-check-label" for="cat">Cat</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="dogs_or_cats" id="both" value="both">
                            <label class="form-check-label" for="both">Both</label>
                        </div>
                    </div>
                    <div class="col-md-12 mt-2">
                        {{--How many pets total?--}}
                        <strong>How many pets total?</strong>
                        <br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="pets_total" id="pet_1" value="pet_1">
                            <label class="form-check-label" for="pet_1">1</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="pets_total" id="pet_2" value="pet_2">
                            <label class="form-check-label" for="pet_2">2</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="pets_total" id="pet_3_more"
                                   value="pet_3_more">
                            <label class="form-check-label" for="pet_3_more">3+</label>
                        </div>
                    </div>
                    <div class="col-md-12 mt-2">
                        {{--How many adults reside at your location?--}}
                        <strong>How many adults reside at your location?</strong>
                        <br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="adults" id="none_adults" value="none">
                            <label class="form-check-label" for="none_adults">None</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="adults" id="1_2" value="1_2">
                            <label class="form-check-label" for="1_2">1 - 2</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="adults" id="3_4" value="3_4">
                            <label class="form-check-label" for="3_4">3 - 4</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="adults" id="5_and_more"
                                   value="5_and_more">
                            <label class="form-check-label" for="5_and_more">5 and more</label>
                        </div>
                    </div>
                    <div class="col-md-12 mt-2">
                        {{--How many children?--}}
                        <strong>How many children?</strong>
                        <br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="children" id="none_children"
                                   value="none_children">
                            <label class="form-check-label" for="none_children">None</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="children" id="1" value="1">
                            <label class="form-check-label" for="1">1</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="children" id="2" value="2">
                            <label class="form-check-label" for="2">2</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="children" id="3_and_more"
                                   value="3_and_more">
                            <label class="form-check-label" for="3_and_more">3 and more</label>
                        </div>
                    </div>

                </div>
            </div>
            <hr>
            {{--
                RATE
            --}}
            <div class="form-group row mt-4 md-4">
                {{--LEFT LABEL--}}
                <label class="col-sm-3 col-form-label align-self-center">HOME CLEANLINESS</label>

                <div class="col-sm-9">
                    <div class="col-md-12">
                        <strong>How would you rate your current home cleanliness?</strong>
                        <br>
                        @foreach($rate as $rates)
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="rate" id="rate_{{$rates}}"
                                       value="{{$rates}}">
                                <label class="form-check-label" for="rate_{{$rates}}">{{$rates}}</label>
                            </div>
                        @endforeach


                    </div>
                </div>
            </div>
            <hr>
            {{--
                cleaned_2_months_ago
            --}}
            <div class="form-group row mt-4 md-4">
                {{--LEFT LABEL--}}
                <label class="col-sm-3 col-form-label align-self-center"></label>

                <div class="col-sm-9">
                    <div class="col-md-12">
                        <strong>Did you have professional in path 2 months?</strong>
                        <br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="cleaned_2_months_ago" id="yes"
                                   value="yes">
                            <label class="form-check-label" for="yes">yes</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="cleaned_2_months_ago" id="no" value="no">
                            <label class="form-check-label" for="no">no</label>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            {{--
                CLEANING BEFORE (TEXT)
            --}}
            <div class="form-group row mt-4 md-4">
                {{--LEFT LABEL--}}
                <label class="col-sm-3 col-form-label align-self-center">CLEANING BEFORE</label>

                <div class="col-sm-9">
                    <div class="col-md-12">
                        <label for="differently"><strong>What would you like us to do differently?</strong></label>
                        <textarea class="form-control" name="differently" id="differently" rows="3"></textarea>
                    </div>
                </div>
            </div>
            <hr>
            {{--
                UPLOAD PHOTOS
            --}}
            <div class="form-group row mt-4 md-4">
                {{--LEFT LABEL--}}
                <label class="col-sm-3 col-form-label align-self-center">HOME PHOTOS</label>

                <div class="col-sm-9">
                    <div class="col-md-12">
                        <label>
                            <strong>Do you have any photos of your home?</strong><br>
                            <small>You can upload more than one photo at a time. Up to 5 photos in total</small>
                        </label>
                        <br>
                        <div class="custom-file">
                            <input class="custom-file-input" type="file" id="photo" name="photo">
                            <label class="custom-file-label" for="photo">Select a files...</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center mt-5 mb-5">
                <input type="submit" class="btn btn-danger" value="2 Steps Left">
            </div>
        </form>
    </div>
@endsection