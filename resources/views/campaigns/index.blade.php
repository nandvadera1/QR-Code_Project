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
                    <li class="breadcrumb-item active">Campaigns</li>
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
                        <h2 class="card-title">Campaigns</h2>
                        <a class="btn btn-primary float-right" href="/admin/campaigns/create" role="button">Add Campaign</a>
                    </div>
                    <div class="card-body">
                        <x-adminlte-datatable id="table1" :heads="$heads" :config="$config" bordered>
                        </x-adminlte-datatable>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script>
        $(document).ready(function () {
            $('#table1').on('click', '.btn_delete', function () {
                var id = $(this).data('id');
                var url = "/admin/campaigns/" + id;
                var deleteConfirm = confirm("Are you sure to delete User with id : " + id + "?");
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
