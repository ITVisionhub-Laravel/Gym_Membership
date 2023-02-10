<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Payment Receipt</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>
</head>
<body>

  <div class="wrapper p-3">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-5">
          <div class="card centered shadow-lg mt-2 mb-2 bg-white rounded">
            <div class="card-header">
              <h3>
                Payment Receipt
                @foreach ($customers as $customer)
                <a href="{{ url('admin/customers') }}" class="btn btn-danger btn-sm float-end mx-1">Back</a>
                <a href="{{ url('admin/customers/'.$customer->id.'/generate') }}" class="btn btn-primary btn-sm float-end mx-1"><i class="fa fa-download"></i></a>
                <a href="{{ url('admin/customers/'.$customer->id.'/view') }}" target="_blank" class="btn btn-warning btn-sm float-end mx-1"><i class="fa-regular fa-eye"></i></a>
                <a href="{{ url('admin/customers/'.$customer->id.'/mail') }}"  class="btn btn-info btn-sm float-end mx-1"><i class="fa fa-envelope"></i></a>
              </h3>
            </div>
            <div class="card-body">
              <div class="row form-group">
                <div class="col-12">

                  <div class="col-md-12">
                    <div class="row">
                    <div class="col-md-9 p-3">
                      
                      <h5>
                        {{ $customer->address->street->township->city->name}},
                        {{ $customer->address->street->township->name}},
                        {{ $customer->address->street->name}} 
                      </h5>
                      <h5>{{ $customer->phone_number}}</h5>
                    </div>
                    <div class="col-md-3">
                      <img src="/admin/images/gymlogo.png" alt="Member" style="width:120px;height:120px;">
                    </div>
                    </div>
                  </div>
                  
                  <br>
                  <br>
                  <center>
                      <h4>Member:  {{ $customer->name }}</h4>
                      @endforeach
                      @foreach ($records as $record)
                        <h5>Paid On:  {{ $record->created_at->format("F j, Y, g:i a") }}</h5>
                      @endforeach
                      <hr>
                      <h5>Package:  {{$packages->package}}</h5>
                      <h5>Promotion:  {{$packages->promotion}} %</h5>
                      <h5>Original Price:  {{ $packages->original_price }}</h5>
                       <hr>
                      <h5>Total Amount: {{ $packages->original_price-($packages->original_price*$packages->promotion/100) }}</h5>
                  </center>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>