@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Scan QR Code</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/home">Home</a></li>
                    <li class="breadcrumb-item active">Scan QR Code</li>
                </ol>
            </div>
        </div>
    </div>
@stop

@section('content')
    <div class="container-fluid mt-3">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Scan QR Coder</h3>
            </div>
            <div id="qr-reader" style="width:350px;" ></div>
            <div id="qr-reader-results"></div>
            {!! Form::open(['url' => '/user/transactions', 'id' => 'scan', 'enctype' => 'multipart/form-data', 'class' => "form-horizontal"]) !!}
            {!! Form::hidden('scannedValue', null, ['id' => 'scannedValue']) !!}
            {!! Form::close() !!}
        </div>
    </div>
@stop

@section('js')
    <script>
        var resultContainer = document.getElementById('qr-reader-results');
        var lastResult, countResults = 0;

        function onScanSuccess(decodedText) {
            if (decodedText !== lastResult) {
                ++countResults;
                lastResult = decodedText;

                $.ajax({
                    type: 'POST',
                    url: '/user/transactions/points',
                    data: {
                        _token: '{{ csrf_token() }}',
                        scannedValue: decodedText
                    },
                    success: function(response) {
                        console.log(response);
                        document.getElementById('scannedValue').value = response;
                        document.getElementById('scan').submit();
                    },
                });
            }
        }

        var html5QrcodeScanner = new Html5QrcodeScanner(
            "qr-reader", { fps: 10, qrbox: 250 });
        html5QrcodeScanner.render(onScanSuccess);
    </script>
@endsection
