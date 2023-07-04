@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Transactions</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/home">Home</a></li>
                    <li class="breadcrumb-item active">Transactions</li>
                </ol>
            </div>
        </div>
    </div>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">Transactions</h2>
                        <a class="btn btn-primary float-right" href="/admin/transactions/create" role="button">Add Transaction</a>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-3"></div>
                            <div class="col-6">
                                <select class="form-select" id="user-select">
                                    <option>All</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user['id'] }}">{{ $user['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <x-adminlte-datatable id="table1" :heads="$heads" :config="$config" bordered >
                        </x-adminlte-datatable>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script>
        $('#user-select').change(function () {
            var userID = $(this).val();
            var url = "/admin/transactions/dataTable";

            if (userID !== "All") {
                url += "?user_id=" + userID;
            }

            $('#table1').DataTable().ajax.url(url).load();
        });
    </script>
@endsection
