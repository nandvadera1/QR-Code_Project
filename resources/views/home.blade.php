@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')

    @can('admin')
    <p>Welcome to this beautiful dashboard</p>
    @endcan

    @can('user')
    <div class="info-box bg-primary" style="width: 100%; height: 200px;">
        <h1 class="info-box-icon" style="font-size: 60px;"><i class="far fa-flag"></i></h1>
        <div class="info-box-content">
            <h1 class="info-box-text">Points</h1>
            <h1 class="info-box-number">{{ $points }}</h1>
        </div>
    </div>
    @endcan

@stop
