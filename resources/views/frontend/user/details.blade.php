<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css
    ">
    <title>Profile</title>
    <x-css></x-css>
</head>
<body>
    <x-frontend.navbar/>
    <div class="container" style="margin-top: 7.5rem !important;">
        <div class="row">
            <div class="col-md-4">
                @if (empty($userDetailsData->image))
                    <img src="" alt="{{ $userDetailsData->name }}">
                @else
                    <img src="{{ asset('uploads/customer/' . $userDetailsData->image) }}" class="userProfile"
                        class="d-inline-block bg-transparent border-0 rounded-circle">
                @endif
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">User Details </div>
                        <div class="card-body">
                            <p>Name : {{ $userDetailsData->name }}</p>
                            <p>Email : {{ $userDetailsData->email }}</p>
                            <p>Phone : {{ $userDetailsData->phone_number }}</p>
                            <p>Emergency Number : {{ $userDetailsData->emergency_phone }}</p>
                            <p>Age : {{ $userDetailsData->age }} Years</p>
                            <p>Height : {{ $userDetailsData->height }} cm</p>
                            <p>Weight : {{ $userDetailsData->weight }} kg</p>
                        </div>
                            <a href="{{ url('user_register') }}" class="btn btn-primary btn-sm col-md-2 mb-3 ml-3">Edit</a>
                    </div><br>
                    <div class="card">
                        <div class="card-header">User Address</div>
                            @if ($userAddressData)
                                <div class="card-body">
                                    <p>Country  : {{ $userAddressData->street->ward->township->city->state->country->name }}</p>
                                    <p>State    : {{ $userAddressData->street->ward->township->city->state->name }}</p>
                                    <p>City     : {{ $userAddressData->street->ward->township->city->name }}</p>
                                    <p>Township : {{ $userAddressData->street->ward->township->name }}</p>
                                    <p>Ward     : {{ $userAddressData->street->ward->name }}</p>
                                    <p>Street   : {{ $userAddressData->street->name }}</p>
                                    <p>Block No : {{ $userAddressData->block_no }}</p>
                                    <p>Floor    : {{ $userAddressData->floor }}</p>
                                    <p>Zipcode  : {{ $userAddressData->zipcode }}</p>
                                </div>
                                <a href="{{ url('user_address') }}" class="btn btn-primary btn-sm col-md-2 mb-3 ml-3">Edit</a>
                            @else
                            <p class="mb-3 ml-3 mt-3">There is no address.</p>
                            <a href="{{ url('user_address') }}" class="btn btn-primary btn-sm col-md-3 mb-3 ml-3">Add Address</a>
                            @endif
                    </div>
                </div><br>
            </div>
        </div>
    </div>
</body>
</html>
{{-- @endsection --}}
