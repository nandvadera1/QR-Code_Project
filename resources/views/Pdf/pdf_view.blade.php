<!DOCTYPE html>
<html>
<head>
    <title>
        Download QR Codes
    </title>
</head>
<body>
<h1> {{ $voucher_blockId }} </h1>

@foreach ($vouchers as $voucher)
    <img src="{{ asset('images/qr_code_'.$voucher->id.'.png') }}" style="width: 100px; height: 100px; margin: 5px">
@endforeach


<br>
<br>
<a class="btn btn-primary" href="/admin/pdf/convert/{{$voucher_blockId}}">Convert PDF</a>
</body>
</html>
