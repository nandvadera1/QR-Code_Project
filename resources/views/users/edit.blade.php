@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1 class="my-4 d-flex justify-content-center">Edit User</h1>
@stop

@section('content')
    <form id="edit" method="POST" action='/admin/users/{{$user->id}}' enctype="multipart/form-data">
        @csrf

        @method('PATCH')

            <div class="border border-black p-4 justify-content-center m-auto" style="max-width: 50%">
                <div class="mb-3 mt-4 my-4">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" class="form-control border-radius" id="name" value='{{ old('name') ?: $user->name }}' required>
                </div>
                @error('name')
                <p class="text-danger text-xs mt-1">
                    {{ $message }}
                </p>
                @enderror

                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" name="email" class="form-control border-radius" id="email" value='{{ old('email') ?: $user->email }}' required>
                </div>
                @error('email')
                <p class="text-danger text-xs mt-1">
                    {{ $message }}
                </p>
                @enderror

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control border-radius" id="password" required>
                </div>
                @error('password')
                <p class="text-danger text-xs mt-1">
                    {{ $message }}
                </p>
                @enderror

                <button type="submit" class="btn btn-primary border-radius">Update</button>
            </div>

    </form>

@stop

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <style>
        .error {
            color: red;
            font-size: small;
        }
        .border-radius{
            border-radius: 15px;
        }
    </style>
@stop

@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
    {{--    <script> console.log('Hi!'); </script>--}}
    <script>
        $(document).ready(function() {
            $('#edit').validate({
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
