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
                        <select class="form-control" name="bedrooms">
                            @foreach($bedroom as $bedrooms)
                                <option value="{{$bedrooms}}">{{$bedrooms}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="zip">ZIP Code</label><br>
                        <input type="text" class="form-control" id="zip" name="zip">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <select class="form-control" name="bathrom">
                            @foreach($bathrom as $bathroms)
                                <option value="{{$bathroms}}">{{$bathroms}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label><br>
                        <input type="text" class="form-control" id="email" name="email">
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