@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>DataTables</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">DataTables</li>
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
                    <div class="card-header d-flex justify-content-between">
                        <h3 class="card-title">DataTable with minimal features & hover style</h3>
                        <a class="btn btn-primary d-inline" href="/admin/users/create" role="button">Add User</a>
                    </div>

                    <div class="card-body">
                        <table class="table table-bordered table-hover">
{{--                            <thead>--}}
{{--                            <tr>--}}
{{--                                <th>Id</th>--}}
{{--                                <th>Name</th>--}}
{{--                                <th>Email</th>--}}
{{--                                <th>Actions</th>--}}
{{--                            </tr>--}}
{{--                            </thead>--}}
                            <tbody>
                            <x-adminlte-datatable id="user_datatable" :heads="['ID', 'Name', 'Email', 'Actions']">
                                @foreach($data as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            <a href="/admin/users/{{ $user->id }}/edit" class="btn btn-primary btn-sm">Edit</a>
                                            <button class="btn btn-danger btn-sm btn_delete" data-id="{{ $user->id }}">Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </x-adminlte-datatable>


                            </tbody>
{{--                            <tfoot>--}}
{{--                            <tr>--}}
{{--                                <th>Id</th>--}}
{{--                                <th>Name</th>--}}
{{--                                <th>Email</th>--}}
{{--                                <th>Actions</th>--}}
{{--                            </tr>--}}
{{--                            </tfoot>--}}
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


@stop

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <style>
        .card-body::after, .card-footer::after, .card-header::after {
            display: none;
            clear: both;
        }
    </style>
@stop


@section('js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script>

        $(document).ready(function() {
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            });
            $.ajax({
                url: '/admin/users',
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                }
            });

            $(document).on('click', '.btn_delete', function() {
                console.log("hii");
                var userId = $(this).data('id');
                deleteRecord(userId);
                console.log(userId);
            });

            function deleteRecord(userId) {
                $.ajax({
                    url: '/admin/users/' + userId,
                    type: 'DELETE',
                    dataType: 'json',
                    success: function(response) {
                        console.log(response);
                    }
                });
            }
        });


        {{--$(function () {--}}
        {{--    var table = $('#users-table').DataTable({--}}
        {{--        processing: true,--}}
        {{--        serverSide: true,--}}
        {{--        ajax: "{{ url('/admin/users') }}", // Update the URL to match your route--}}
        {{--        columns: [--}}
        {{--            {data: 'DT_RowIndex', name: 'DT_RowIndex'},--}}
        {{--            {data: 'name', name: 'name'},--}}
        {{--            {data: 'email', name: 'email'},--}}
        {{--            {data: 'action', name: 'action', orderable: false, searchable: false},--}}
        {{--        ]--}}
        {{--    });--}}
        {{--});--}}


    // $('#user_datatable').on('click', '.btn_delete', function () {
    //         var id = $(this).data('id');
    //         var url= "/admin/users/"+id;
    //         var deleteConfirm = confirm("Are you sure to delete User with id : "+id+ "?");
    //         if (deleteConfirm == true) {
    //             var token = $("meta[name='csrf-token']").attr("content");
    //             $.ajax(
    //                 {
    //                     url: url,
    //                     type: 'delete',
    //                     data: {
    //                         "id": id,
    //                         "_token": token,
    //                     },
    //                     success: function (){
    //                         console.log("it Works");
    //
    //                     }
    //                 });
    //             table.ajax.reload();
    //         }
    //     });
    </script>
@stop

