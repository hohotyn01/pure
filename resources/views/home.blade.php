@extends('layouts.site')

@section('header')
    @include('site.header_home')
@endsection

@section('content')
    <div class="container mt-4">
        <div class="text-center">
            <h2>
                Get an estimate for home cleaning
            </h2>
            @if(count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
        <form action="" method="post">
            <div class="form-row mt-4">
                @csrf
                <div class="col-md-3"></div>
                <div class="col-md-3">
                    <div class="form-group">
                        <select class="form-control" name="bedroom">
                            @foreach($bedroomRange as $bedrooms)
                                <option {{!empty($bedroom) && ($bedrooms == $bedroom) ? 'selected': ''}} value="{{$bedrooms}}">{{$bedrooms.' Bedroom'}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="zip">ZIP Code</label><br>
                        <input type="text" class="form-control" id="zip" name="zip_code" value="{{!empty($zipCode) ? $zipCode : ""}}">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <select class="form-control" name="bathroom">
                            @foreach($bathromRange as $bathroms)
                                <option {{!empty($bathroom) && ($bathroms == $bathroom) ? 'selected': ''}} value="{{$bathroms}}">{{$bathroms.' Bathroms'}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label><br>
                        <input type="text" class="form-control" id="email" name="email" value="{{!empty($email) ? $email : ""}}">
                    </div>
                </div>
                <div class="col-md-3"></div>
            </div>
            <div class="text-center">
                <input type="submit" class="btn btn-danger mb-4" value="Continue">
            </div>
        </form>
    </div>
@endsection