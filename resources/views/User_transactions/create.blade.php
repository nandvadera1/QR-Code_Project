@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Scan QR Code</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/home">Home</a></li>
                    <li class="breadcrumb-item active">Scan QR Code</li>
                </ol>
            </div>
        </div>
    </div>
@stop

@section('content')
    <div class="container-fluid mt-3">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Scan QR Coder</h3>
            </div>
            {!! Form::open(['url' => '/user/transactions', 'id' => 'validate', 'enctype' => 'multipart/form-data', 'class' => "form-horizontal"]) !!}
            @include('User_transactions._form')
            <div class="card-footer">
                {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
                <a href="/user/transactions" type="submit" class="btn btn-default float-right">Cancel</a>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@stop
