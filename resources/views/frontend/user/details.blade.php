<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css
    ">
    <title>Profile</title>
</head>

<body>
    <div class="container mt-4"> <!-- Added mt-4 for margin-top -->
        <div class="row">
            <div class="col-md-4">
                @if (empty(Auth::user()->image))
                    <img src="" alt="{{ Auth::user()->name }}">
                @else
                    <img src="{{ asset('uploads/customer/' . Auth::user()->image) }}" width="70" style="width:70%"
                        class="d-inline-block bg-transparent border-0 rounded-circle">
                @endif
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">User Details </div>
                    <div class="card-body">
                        <p>Name : {{ Auth::user()->name }}</p>
                        <p>Email : {{ Auth::user()->email }}</p>
                        <p>Phone : {{ Auth::user()->phone_number }}</p>
                        <p>Emergency Number: {{ Auth::user()->emergency_phone }}</p>
                        <p>Age : {{ Auth::user()->age }} Years</p>
                        <p>Height : {{ Auth::user()->height }} cm</p>
                        <p>Weight : {{ Auth::user()->weight }} kg</p>
                    </div>
                </div><br>

                <a href="{{ url('user_register') }}" class="btn btn-primary btn-sm col-md-2">Edit</a>
            </div>
        </div>
    </div>
</body>



</html>

{{-- @endsection --}}
