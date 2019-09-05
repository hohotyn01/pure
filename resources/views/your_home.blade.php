@extends('layouts.site')

@section('title')
    Your Home
@endsection

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
        <form action="" method="post" enctype="multipart/form-data">
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
                            <input class="form-check-input" type="radio" name="dogs_or_cats" id="none" value="none"
                                    {{!empty($orderDetails->dogs_or_cats) && ($orderDetails->dogs_or_cats == 'none') ? 'checked' : ''}}>
                            <label class="form-check-label" for="none">None</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="dogs_or_cats" id="dog" value="dog"
                                    {{!empty($orderDetails->dogs_or_cats) && ($orderDetails->dogs_or_cats == 'dog') ? 'checked' : ''}}>
                            <label class="form-check-label" for="dog">Dog</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="dogs_or_cats" id="cat" value="cat"
                                    {{!empty($orderDetails->dogs_or_cats) && ($orderDetails->dogs_or_cats == 'cat') ? 'checked' : ''}}>
                            <label class="form-check-label" for="cat">Cat</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="dogs_or_cats" id="both" value="both"
                                    {{!empty($orderDetails->dogs_or_cats) && ($orderDetails->dogs_or_cats == 'both') ? 'checked' : ''}}>
                            <label class="form-check-label" for="both">Both</label>
                        </div>
                    </div>
                    <div class="col-md-12 mt-2">
                        {{--How many pets total?--}}
                        <strong>How many pets total?</strong>
                        <br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="pets_total" id="pet_1" value="pet_1"
                                    {{!empty($orderDetails->pets_total) && ($orderDetails->pets_total == 'pet_1') ? 'checked' : ''}}>
                            <label class="form-check-label" for="pet_1">1</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="pets_total" id="pet_2" value="pet_2"
                                    {{!empty($orderDetails->pets_total) && ($orderDetails->pets_total == 'pet_2') ? 'checked' : ''}}>
                            <label class="form-check-label" for="pet_2">2</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="pets_total" id="pet_3_more"
                                   value="pet_3_more" {{!empty($orderDetails->pets_total) && ($orderDetails->pets_total == 'pet_3_more') ? 'checked' : ''}}>
                            <label class="form-check-label" for="pet_3_more">3+</label>
                        </div>
                    </div>
                    <div class="col-md-12 mt-2">
                        {{--How many adults reside at your location?--}}
                        <strong>How many adults reside at your location?</strong>
                        <br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="adults" id="none_adults" value="none"
                                    {{!empty($orderDetails->adults) && ($orderDetails->adults == 'none') ? 'checked' : ''}}>
                            <label class="form-check-label" for="none_adults">None</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="adults" id="1_2" value="1_2"
                                    {{!empty($orderDetails->adults) && ($orderDetails->adults == '1_2') ? 'checked' : ''}}>
                            <label class="form-check-label" for="1_2">1 - 2</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="adults" id="3_4" value="3_4"
                                    {{!empty($orderDetails->adults) && ($orderDetails->adults == '3_4') ? 'checked' : ''}}>
                            <label class="form-check-label" for="3_4">3 - 4</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="adults" id="5_and_more"
                                   value="5_and_more" {{!empty($orderDetails->adults) && ($orderDetails->adults == '5_and_more') ? 'checked' : ''}}>
                            <label class="form-check-label" for="5_and_more">5 and more</label>
                        </div>
                    </div>
                    <div class="col-md-12 mt-2">
                        {{--How many children?--}}
                        <strong>How many children?</strong>
                        <br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="children" id="none_children"
                                   value="none_children" {{!empty($orderDetails->children) && ($orderDetails->children == 'none_children') ? 'checked' : ''}}>
                            <label class="form-check-label" for="none_children">None</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="children" id="1" value="1"
                                    {{!empty($orderDetails->children) && ($orderDetails->children == '1') ? 'checked' : ''}}>
                            <label class="form-check-label" for="1">1</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="children" id="2" value="2"
                                    {{!empty($orderDetails->children) && ($orderDetails->children == '2') ? 'checked' : ''}}>
                            <label class="form-check-label" for="2">2</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="children" id="3_and_more"
                                   value="3_and_more" {{!empty($orderDetails->children) && ($orderDetails->children == '3_and_more') ? 'checked' : ''}}>
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
                        @foreach(config('admin.range')['rate'] as $rates)
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="rate_cleanliness"
                                       id="rate_{{$rates}}" value="{{$rates}}"
                                        {{!empty($orderDetails->rate_cleanliness) && ($orderDetails->rate_cleanliness == $rates) ? 'checked' : ''}}>
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
                                   value="yes" {{!empty($orderDetails->cleaned_2_months_ago) && ($orderDetails->cleaned_2_months_ago == 'yes') ? 'checked' : ''}}>
                            <label class="form-check-label" for="yes">yes</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="cleaned_2_months_ago" id="no" value="no"
                                    {{!empty($orderDetails->cleaned_2_months_ago) && ($orderDetails->cleaned_2_months_ago == 'no') ? 'checked' : ''}}>
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
                        <textarea class="form-control" name="differently" id="differently"
                                  rows="3">{{!empty($orderDetails->differently) ? $orderDetails->differently : ''}}</textarea>
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
                            <small>You can upload more than one photo at a time. Up to 8 photos in total</small>
                        </label>
                        <br>
                        <div class="custom-file">
                            <input class="custom-file-input" type="file" accept="image/png, image/jpeg, image/jpg"
                                   id="photo" name="photo[]" multiple>
                            <label class="custom-file-label" for="photo">Select a files...</label>
                            <small>JPG, PNG only, maximum file size - 5MB</small>
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