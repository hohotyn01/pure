@extends('layouts.site')

@section('header')
    @include('site.header_home')
@endsection

@section('content')

    <div class="container">

            <div class="col-md-12">
            <strong class="text-center">Get an estimate for home cleaning</strong>
            <form action="" method="post">
                @csrf
                <div class="box box-default">
                    @if(count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="col-md-6">
                        <div class="form-group">
                            <select>
                                @foreach($bedroom as $bedrooms)
                                    <option value="{{$bedrooms}}">{{$bedrooms}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="zip">ZIP Code</label><br>
                            <input type="text" id="zip" name="zip">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <select>
                                @foreach($bathrom as $bathroms)
                                    <option value="{{$bathroms}}">{{$bathroms}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label><br>
                            <input type="text" id="email" name="email">
                        </div>
                    </div>
                    <input class="align-center" type="submit" value="Continue">
                </div>
            </form>
            </div>

    </div>

@endsection