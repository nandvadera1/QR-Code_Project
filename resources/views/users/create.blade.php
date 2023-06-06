@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Add</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Add New User</li>
                </ol>
            </div>
        </div>
    </div>
@stop

@section('content')
    <div class="container-fluid mt-3">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Add New User</h3>
            </div>

            {!! Form::open(['url' => '/admin/users', 'method' => 'POST', 'id' => 'create', 'enctype' => 'multipart/form-data']) !!}
            @csrf
            <x-_form :type="$type" />
            {!! Form::close() !!}
        </div>
        @stop

        @section('css')
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
            <style>
                .error {
                    color: red;
                    font-size: small;
                }
            </style>
        @stop

        @section('js')
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
            <script>
                $(document).ready(function() {
                    $('#create').validate({
                        rules: {
                            name: 'required',
                            email: {
                                required: true,
                                email: true
                            },
                            password: {
                                required: true,
                                minlength: 7,
                                maxlength: 255
                            },
                            user_type_id: 'required',
                        },
                        messages: {
                            name: 'Please enter your name',
                            email: {
                                required: 'Please enter your email address',
                                email: 'Please enter a valid email address'
                            },
                            password: {
                                required: 'Please enter your password',
                                minlength: 'Password must be at least 3 characters long',
                                maxlength: 'Password cannot exceed 7 characters'
                            },
                            user_type_id : 'Please enter your type',
                        },
                        submitHandler: function(form) {
                            form.submit();
                        }
                    });
                });
            </script>
@stop
