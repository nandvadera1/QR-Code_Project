@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Voucher Blocks</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/home">Home</a></li>
                    <li class="breadcrumb-item active">Voucher Blocks</li>
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
                        <h2 class="card-title">Voucher Blocks</h2>
                        <a class="btn btn-primary float-right" href="/admin/voucher_blocks/create" role="button">Add
                            Vouchers</a>
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
        $('#table1').on('click', '.btn_download', function () {
            var id = $(this).data('id');
            var download = $(this).data('download');
            var url = "/admin/pdf/view/" + id;
            var token = $("meta[name='csrf-token']").attr("content");
            $.ajax(
                {
                    url: url,
                    type: 'GET',
                    data: {
                        "id": id,
                        "_token": token,
                    },
                    success: function (response) {
                        if(download){
                            var confirmation = confirm("Are you sure you want to download this again?");
                            if(confirmation){
                                window.location.href = "/admin/pdf/view/" + id;
                            }
                        }
                        else{
                            window.location.href = "/admin/pdf/view/" + id;
                        }
                    }
                });
            $('#table1').DataTable().ajax.reload();
        });
    });
</script>

@endsection


