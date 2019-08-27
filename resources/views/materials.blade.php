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
        <form action="" method="post">
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
            <div class="form-group row mt-4 md-4">
                {{--LEFT LABEL--}}
                <label class="col-sm-3 col-form-label align-self-center">HOME SURFACES</label>

                <div class="col-sm-9">
                    {{--
                        Flooring
                    --}}
                    <strong>What types of flooring in your home?</strong><br>
                    <small>Check all that apply</small>
                    <br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="hardwood" id="hardwood" value="1">
                        <label class="form-check-label" for="hardwood">Hardwood</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="cork" id="cork" value="1">
                        <label class="form-check-label" for="cork">Cork</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="vinyl" id="vinyl" value="1">
                        <label class="form-check-label" for="vinyl">Vinyl</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="concrete" id="concrete" value="1">
                        <label class="form-check-label" for="concrete">Concrete</label>
                    </div>
                    <br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="carpet" id="carpet" value="1">
                        <label class="form-check-label" for="carpet">Carpet</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="natural_stone" id="natural_stone"
                               value="1">
                        <label class="form-check-label" for="natural_stone">Natural Stone</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="tile" id="tile" value="1">
                        <label class="form-check-label" for="tile">Tile</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="laminate" id="laminate" value="1">
                        <label class="form-check-label" for="laminate">Laminate</label>
                    </div>
                    <hr>
                    {{--
                        Countertops
                    --}}
                    <strong>What types of countertops in your home?</strong><br>
                    <small>Check all that apply</small>
                    <br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="concrete_c" id="concrete_c" value="1">
                        <label class="form-check-label" for="concrete_c">Concrete</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="quartz" id="quartz" value="1">
                        <label class="form-check-label" for="quartz">Quartz</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="formica" id="formica" value="1">
                        <label class="form-check-label" for="formica">Formica</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="granite" id="granite" value="1">
                        <label class="form-check-label" for="granite">Granite</label>
                    </div>
                    <br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="marble" id="marble" value="1">
                        <label class="form-check-label" for="marble">Marble</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="tile_c" id="tile_c" value="1">
                        <label class="form-check-label" for="tile_c">Tile</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="paper_stone" id="paper_stone" value="1">
                        <label class="form-check-label" for="paper_stone">Paper Stone</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="butcher_block" id="butcher_block"
                               value="1">
                        <label class="form-check-label" for="butcher_block">Butcher Block</label>
                    </div>
                    <hr>
                    {{--
                        Are there stainless steel
                    --}}
                    <strong>Are there stainless steel appliances?</strong>
                    <br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="stainless_steel_appliances" id="steel_yes"
                               value="1">
                        <label class="form-check-label" for="steel_yes">yes</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="stainless_steel_appliances" id="steel_no"
                               value="0">
                        <label class="form-check-label" for="steel_no">no</label>
                    </div>
                    <hr>
                    {{--
                        What type of stove
                    --}}
                    <strong>What type of stove you use?</strong>
                    <br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="stove_type" id="stove_yes" value="yes">
                        <label class="form-check-label" for="stove_yes">yes</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="stove_type" id="stove_no" value="no">
                        <label class="form-check-label" for="stove_no">no</label>
                    </div>
                    <hr>
                    {{--
                        Are shower doors made of glass?
                    --}}
                    <strong>Are shower doors made of glass?</strong>
                    <br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="shawer_doors_glass" id="shawer_yes"
                               value="yes">
                        <label class="form-check-label" for="shawer_yes">yes</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="shawer_doors_glass" id="shawer_no"
                               value="no">
                        <label class="form-check-label" for="shawer_no">no</label>
                    </div>
                    <hr>
                    {{--
                        Are shower doors made of glass?
                    --}}
                    <strong>Any mold or mildew issues?</strong>
                    <br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="mold" id="mold_yes" value="yes">
                        <label class="form-check-label" for="mold_yes">yes</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="mold" id="mold_no" value="no">
                        <label class="form-check-label" for="mold_no">no</label>
                    </div>

                </div>


            </div>
            <hr>
            <div class="form-group row mt-4 md-4">
                {{--LEFT LABEL--}}
                <label class="col-sm-3 col-form-label align-self-center">ADDITIONAL INFO</label>

                <div class="col-sm-9">
                    {{--
                        Special attention (TEXT)
                    --}}
                    <div class="col-md-12">
                        <label for="areas_special_attention"><strong>Are there areas needing special attention?</strong></label>
                        <textarea class="form-control" name="areas_special_attention" id="areas_special_attention" rows="3"></textarea>
                    </div>
                    {{--
                        Anything else we should know (TEXT)
                    --}}
                    <div class="col-md-12">
                        <label for="anything_know"><strong>Anything else we should know?</strong></label>
                        <textarea class="form-control" name="anything_know" id="anything_know" rows="3"></textarea>
                    </div>
                </div>
            </div>
            <div class="text-center mt-5 mb-5">
                <input type="submit" class="btn btn-danger" value="1 Steps Left">
            </div>
        </form>
    </div>
@endsection