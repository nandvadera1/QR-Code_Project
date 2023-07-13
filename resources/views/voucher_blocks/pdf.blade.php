<!DOCTYPE html>
<html>
<head>
    <style>
        img {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>
<body>
@foreach ($vouchers as $voucher)
    <img src="{{ public_path('qrcodes/qr_code_' . $voucher->id . '.png') }}" alt="QR Code">
@endforeach
</body>
</html>
