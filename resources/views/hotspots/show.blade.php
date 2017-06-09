@extends('dashboard', ['pageTitle' => '_camelUpper_casePlural_ &raquo; Show'])

@section('content')

    <div class="container">
        <div class="col-md-12">

            <div class="col-md-6">
				<p>CITY</p>
            </div>

            <div class="col-md-6">
                <p>{{ $hotspot->city }}</p>
            </div>

            <div class="col-md-6">
				<p>PLACE</p>
            </div>

            <div class="col-md-6">
                <p>{{ $hotspot->place }}</p>
            </div>
            <div class="col-md-6">
				<p>SSID</p>
            </div>

            <div class="col-md-6">
                <p>{{ $hotspot->ssid }}</p>
            </div>

            <div class="col-md-6">
				<p>PASSWORD</p>
            </div>

            <div class="col-md-6">
                <p>{{ $hotspot->password }}</p>
            </div>

        </div>
    </div>

@stop