@extends('layouts.site')

@section('title')
    Extras
@endsection

@section('header')
    @include('site.header')
@endsection

@section('content')

    <div class="container mt-4 ">
        <div class="text-center mt-5 mb-5">
            <h3>
                Now choose some extras to finish up
            </h3>
            <h5>
                <small>Almost there hang on we're at the end</small>
            </h5>
        </div>
        <hr>
        <form id="priceForm" action="" method="post">
            @csrf
            @if(count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="row md-4">
                {{--
                    Left Block
                --}}
                <div class="col-sm-9">
                    <div class="form-group">
                        {{--
                            Select extras
                        --}}
                        <strong>Select extras</strong><br>
                        <br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="inside_fridge" id="inside_fridge"
                                   value="1" {{!empty($orderExtras->inside_fridge) ? 'checked' : ''}}>
                            <label class="form-check-label" for="inside_fridge">Inside Fridge</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="inside_oven" id="inside_oven"
                                   value="1" {{!empty($orderExtras->inside_oven) ? 'checked' : ''}}>
                            <label class="form-check-label" for="inside_oven">Inside Oven</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="garage_swept" id="garage_swept"
                                   value="1" {{!empty($orderExtras->garage_swept) ? 'checked' : ''}}>
                            <label class="form-check-label" for="garage_swept">Garage Swept</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="blinds_cleaning" id="blinds_cleaning"
                                   value="1" {{!empty($orderExtras->blinds_cleaning) ? 'checked' : ''}}>
                            <label class="form-check-label" for="blinds_cleaning">Blinds Cleaning</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="laundry_wash_dry"
                                   id="laundry_wash_dry" value="1"
                                    {{!empty($orderExtras->laundry_wash_dry) ? 'checked' : ''}}>
                            <label class="form-check-label" for="laundry_wash_dry">Laundry Wash&Dry</label>
                        </div>
                        <hr>
                        {{--
                            Service Weekend
                        --}}
                        <strong>Would you like us to perform service on weekend?</strong><br>
                        <small></small>
                        <br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="service_weekend" id="weekend_yes"
                                   value="yes" {{!empty($orderExtras->service_weekend) && ($orderExtras->service_weekend == 'yes') ? 'checked' : ''}}>
                            <label class="form-check-label" for="weekend_yes">Yes</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="service_weekend" id="weekend_no"
                                   value="no" {{!empty($orderExtras->service_weekend) && ($orderExtras->service_weekend == 'no') ? 'checked' : ''}}>
                            <label class="form-check-label" for="weekend_no">No</label>
                        </div>
                        <hr>
                        {{--
                           Carpet
                        --}}
                        <strong>Would you like your carpet cleaned?</strong><br>
                        <small>10% or more</small>
                        <br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="carpet" id="carpet_yes"
                                   value="yes" {{!empty($orderExtras->carpet) && ($orderExtras->carpet == 'yes') ? 'checked' : ''}}>
                            <label class="form-check-label" for="carpet_yes">Yes</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="carpet" id="carpet_no"
                                   value="no" {{!empty($orderExtras->carpet) && ($orderExtras->carpet == 'no') ? 'checked' : ''}}>
                            <label class="form-check-label" for="carpet_no">No</label>
                        </div>

                    </div>
                </div>
                {{--
                    Right Block Holder
                --}}
                <div class="col-sm-3">
                    <div class="p-3 mb-2 border rounded">
                        <div class="text-center">
                            <p>One-Time Cleaning</p>
                            <small>This week</small>
                            <br>
                            <small>{{$bedroomExtras}} bed, {{$bathroomExtras}} bath - {{$homeFootageExtras}} sq. ft
                            </small>
                        </div>
                        <hr>
                        <div class="justify-content-between total">
                            <p>Total</p>
                            <div id="priceHolder">100.00</div>
                        </div>
                    </div>
                </div>
                <div class="text-center mt-5 mb-5">
                    <input type="submit" class="btn btn-danger" value="Reserve a Cleaning">
                </div>
            </div>
        </form>
    </div>


@endsection