@extends('layouts.app')

@section('PageCSS')
    <link href="{{ asset('css/custom/sidebar.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                @include('layouts.partials.sidebar')
            </div>
            <div class="col-md-10 pt-3">
                @yield('manage-content')
            </div>
        </div>
    </div>
@endsection
