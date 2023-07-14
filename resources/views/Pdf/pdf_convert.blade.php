<!DOCTYPE html>
<head>
    <title>
        Download QR Codes
    </title>
</head>
<body>
    <h1> {{ $voucher_blockName }} </h1>

    @foreach ($vouchers as $voucher)
        <img src="{{ public_path('images/qr_code_'.$voucher->id.'.png') }}"
             style="width: 100px; height: 100px; margin: 5px">
    @endforeach
</body>
</html>
