@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Campaigns</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/home">Home</a></li>
                    <li class="breadcrumb-item active">Edit Campaign</li>
                </ol>
            </div>
        </div>
    </div>
@stop

@section('content')
    <div class="container-fluid mt-3">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Edit Campaign</h3>
            </div>
            {!! Form::model($campaign, ['url' => '/admin/campaigns/' . $campaign->id, 'id' => 'validate', 'method'=>'patch', 'enctype' => 'multipart/form-data']) !!}
            @include('campaigns._form')
            <div class="card-footer">
                {!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}
                <a href="/admin/campaigns" type="submit" class="btn btn-default float-right">Cancel</a>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@stop
