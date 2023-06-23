@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Products</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/home">Home</a></li>
                    <li class="breadcrumb-item active">Products</li>
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
                        <h2 class="card-title">Products</h2>
                        <a class="btn btn-primary float-right" href="/admin/products/create" role="button">Add
                            Product</a>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-3"></div>
                            <div class="col-6">
                                <select class="form-select" id="category-select">
                                    <option>All</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
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
        $('#category-select').change(function () {
            var categoryID = $(this).val();
            var url = "/admin/products/dataTable";

            if (categoryID !== "All") {
                url += "?category_id=" + categoryID;
            }

            $('#table1').DataTable().ajax.url(url).load();
        });

        $(document).ready(function () {
            $('#table1').on('click', '.btn_delete', function () {
                var id = $(this).data('id');
                var url = "/admin/products/" + id;
                var deleteConfirm = confirm("Are you sure you want to delete this Product?");
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
                                console.log("Product deleted successfully");
                            }
                        });
                    $('#table1').DataTable().ajax.reload();
                }
            });
        });
    </script>
@stop
