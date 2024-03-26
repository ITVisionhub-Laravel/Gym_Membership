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
    <div class="container">
        <div class="row">
            <div class="col-md-3">

                @if (empty(Auth::user()->image))
                    <img src="" alt="{{ Auth::user()->name }}">
                @else
                    <img src="{{ asset('uploads/customer/' . Auth::user()->image) }}" width="100" style="width:100%">
                @endif
            </div>

            <div class="col-md-5">
                <div class="card">

                    <div class="card-header">User Details</div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" class="form-control" name="name" value="{{ Auth::user()->name }}"
                                readonly>
                        </div>

                        <div class="form-group">
                            <label for="">Phone</label>
                            <input type="text" class="form-control" name="phone"
                                value="{{ Auth::user()->phone_number }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="">Emergency Phone</label>
                            <input type="text" class="form-control" name="emergency_phone"
                                value="{{ Auth::user()->emergency_phone }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="">Age</label>
                            <input type="text" class="form-control" name="age"
                                value="{{ Auth::user()->age }} Years" readonly>
                        </div>

                        <div class="form-group">
                            <label for="">Height</label>
                            <input type="text" class="form-control" name="height"
                                value="{{ Auth::user()->height }} cm" readonly>
                        </div>

                        <div class="form-group">
                            <label for="">Weight</label>
                            <input type="text" class="form-control" name="weight"
                                value="{{ Auth::user()->weight }} kg" readonly>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Address</div>
                    <div class="card-body">
                        {{-- <p>Street: {{ Auth::user()->address->street->name }}</p> --}}
                        {{-- <p>Township : {{ Auth::user()->address->street->township }}</p> --}}
                    </div>
                    <div>
                        <a href="{{ url('user_register') }}" class="btn btn-danger btn-sm ">Back</a>
                    </div>
                </div>
            </div>

        </div>

    </div>


</body>


</html>

{{-- @endsection --}}
