@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Vouchers</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/home">Home</a></li>
                    <li class="breadcrumb-item active">Vouchers</li>
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
                        <h2 class="card-title">Vouchers</h2>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-3"></div>
                            <div class="col-6 mb-2">
                                <select class="form-select" id="voucher_block-select">
                                    <option>All</option>
                                    @foreach($voucher_blocks as $voucher_block)
                                        <option value="{{ $voucher_block['id'] }}">{{ $voucher_block['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
{{--                        <x-adminlte-datatable id="table1" :heads="$heads" :config="$config" bordered with-buttons>--}}
{{--                        </x-adminlte-datatable>--}}
                        <table id="table1" class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Voucher Block</th>
                                <th>Campaign</th>
                                <th>Code</th>
                                <th>Redeemed At</th>
                                <th>Redeemed By User</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script>
        $(document).ready( function () {
            $('#table1').DataTable({
                responsive: true,
                searching: true,
                ordering: true,
                dom: "<'row'<'col-sm-4 justify-content-start' l><'col-sm-4 justify-content-start' B><'col-sm-4 justify-content-end' f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-6 justify-content-start' i><'col-sm-6 justify-content-end' p>>",
                buttons: [
                    // {
                    //     extend: 'csv',
                    //     text: 'Export CSV',
                    //     exportOptions: {
                    //         columns: ':visible'
                    //     }
                    // },
                    // {
                    //     extend: 'excel',
                    //     text: 'Export Excel',
                    //     exportOptions: {
                    //         columns: ':visible'
                    //     }
                    // },
                ],
                ajax: "{{ url('admin/vouchers/dataTable') }}",
                columns: [
                    { data: 'voucher_block_id', name: 'voucher_block.name' },
                    { data: 'campaign_id', name: 'campaign.name' },
                    { data: 'code', name: 'code' },
                    { data: 'redeemed_at', name: 'redeemed_at' },
                    { data: 'redeemed_by_user_id', name: 'user.name' },
                ],
            });
        });

        $('#voucher_block-select').change(function () {
            var voucher_blockID = $(this).val();
            var url = "/admin/vouchers/dataTable";

            if (voucher_blockID !== "All") {
                url += "?voucher_block_id=" + voucher_blockID;
            }

            $('#table1').DataTable().ajax.url(url).load();
        });
    </script>
@stop
