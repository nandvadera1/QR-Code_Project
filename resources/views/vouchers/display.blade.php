@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Vouchers</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/home">Home</a></li>
                    <li class="breadcrumb-item active">Download Vouchers</li>
                </ol>
            </div>
        </div>
    </div>
@stop

@section('content')
{{--    {{ dd($files) }}--}}
{{--    <div class="container-fluid mt-3">--}}
{{--        <div class="card card-primary">--}}
{{--            <div class="card-header">--}}
{{--                <h3 class="card-title">Download Vouchers</h3>--}}
{{--            </div>--}}
{{--            {{ $title }}--}}
{{--                @foreach ($files as $file)--}}
{{--                    <img src="{{ asset('storage/pppp.png') }}" style="width: 200px; height: 200px">--}}
{{--                @endforeach--}}
{{--        </div>--}}
{{--    </div>--}}

<a href="vouchers/generate-pdf">Download PDF</a>
@stop
