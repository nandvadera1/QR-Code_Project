@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Categories</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/home">Home</a></li>
                    <li class="breadcrumb-item active">Categories</li>
                </ol>
            </div>
        </div>
    </div>
@stop

@section('content')
    <div id="notification" class="alert alert-success alert-dismissible fade show" style="display: none; margin-bottom: 15px;" role="alert">
        <strong id="notification-text"></strong>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">Categories</h2>
                        <a class="btn btn-primary float-right" href="/admin/categories/create" role="button">Add Category</a>
                    </div>
                    <div class="card-body">
                        <x-adminlte-datatable id="table1" :heads="$heads" :config="$config" bordered>
                        </x-adminlte-datatable>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('products._successMessage')
@stop

@section('js')
    <script>
        $(document).ready(function () {
            $('#table1').on('click', '.btn_delete', function () {
                var id = $(this).data('id');
                var url = "/admin/categories/" + id;
                var deleteConfirm = confirm("Are you sure to delete Category with id : " + id + "?");
                if (deleteConfirm === true) {
                    var token = $("meta[name='csrf-token']").attr("content");
                    $.ajax(
                        {
                            url: url,
                            type: 'DELETE',
                            data: {
                                "id": id,
                                "_token": token,
                            },
                            success: function (response) {
                                console.log("Delete operation successful");
                            }
                        });
                    $('#table1').DataTable().ajax.reload();
                }
            });
        });
    </script>
@stop
