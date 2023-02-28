<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Customer QRCode</title>
    {{--  <meta name="csrf-token" content="{{ csrf_token() }}">  --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"/>
</head>

<body>

    <div class="container mt-4">

        {{--  <div class="card">
            <div class="card-header">
                <h2>Simple QR Code</h2>
            </div>
            <div class="card-body">
                Hello
                {!! QrCode::size(300)->generate($providers) !!}
            </div>
        </div>  --}}

        <div class="card">
            <div class="card-header">
                <h2>Color QR Code</h2>
            </div>
            <div class="card-body">
                {{--  @dd($qrcode->memberId->id);  --}}
                {{--  http://127.0.0.1:8000/admin/customers/1/invoice  --}}
                {{--  $qrcode->member_card_id  --}}
                'http://127.0.0.1:8000/admin/customers/'. $qrcode->memberId->id .'/invoice'
                {!! QrCode::size(300)->generate($qrcode->member_card_id) !!}
            </div>
        </div>

    </div>
</body>
</html>
