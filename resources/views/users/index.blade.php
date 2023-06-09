@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Users</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/home">Home</a></li>
                    <li class="breadcrumb-item active">Users</li>
                </ol>
            </div>
        </div>
    </div>
@stop

@section('content')
    <div id="notification" class="alert alert-success alert-dismissible fade show" style="display: none; margin-bottom: 15px; role="alert">
    <strong id="notification-text"></strong>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">Users</h2>
                        <a class="btn btn-primary float-right" href="/admin/users/create" role="button">Add User</a>
                    </div>
                    <div class="card-body">
                        <x-adminlte-datatable id="table1" :heads="$heads" :config="$config" bordered>
                        </x-adminlte-datatable>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if(session()->has('success'))
        <script>
            window.addEventListener('DOMContentLoaded', function() {
                var notification = document.getElementById('notification');
                var notificationText = document.getElementById('notification-text');

                var successMessage = "{{ session('success') }}";
                if (successMessage) {
                    notificationText.textContent = successMessage;
                    notification.style.display = 'block';

                    setTimeout(function() {
                        notification.style.display = 'none';
                    }, 4000);
                }
            });
        </script>
    @endif
@stop
