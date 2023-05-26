@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>General Form</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">General Form</li>
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

                    <form id="create" method="POST" action="/admin/users" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="form-control" id="name" value='{{old('name')}}' required placeholder="Enter name">
                            </div>
                            @error('name')
                                <p class="text-danger text-xs mt-1">
                                    {{ $message }}
                                </p>
                            @enderror
                            <div class="form-group">
                                <label for="email">Email address</label>
                                <input type="email" name="email" class="form-control" id="email" value='{{old('email')}}' required placeholder="Enter email">
                            </div>
                            @error('email')
                                <p class="text-danger text-xs mt-1">
                                    {{ $message }}
                                </p>
                            @enderror
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="form-control" id="password" required placeholder="Password">
                            </div>
                            @error('password')
                                <p class="text-danger text-xs mt-1">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
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
{{--    <script> console.log('Hi!'); </script>--}}
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
                    }
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
                    }
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        });
    </script>
@stop
