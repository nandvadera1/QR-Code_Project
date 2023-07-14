<!DOCTYPE html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <title>
        Download QR Codes
    </title>
</head>
<body>
    <h1> {{ $voucher_blockName }} </h1>

    @foreach ($vouchers as $voucher)
        <img src="{{ asset('images/qr_code_'.$voucher->id.'.png') }}" style="width: 100px; height: 100px; margin: 5px">
    @endforeach

    <br>
    <br>
    <a class="btn btn-primary" href="/admin/pdf/convert/{{$voucher_blockId}}">Convert PDF</a>
</body>
</html>
