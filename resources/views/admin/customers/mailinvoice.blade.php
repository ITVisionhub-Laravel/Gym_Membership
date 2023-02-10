<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Payment Receipt</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
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
              </h3>
            </div>
            <div class="card-body">
              <div class="row form-group">
                <div class="col-12">

                  <div class="col-md-12">
                    <div class="row">
                    <div class="col-md-9 p-3">
                      <h5>
                        {{ $data['records']->customer->address->street->township->city->name}},
                        {{ $data['records']->customer->address->street->township->name}},
                        {{ $data['records']->customer->address->street->name}} 
                      </h5>
                      <h5>{{ $data['records']->customer->phone_number}}</h5>
                    </div>
                    <div class="col-md-3">
                      <img src="/admin/images/gymlogo.png" alt="Member" style="width:120px;height:120px;">
                    </div>
                    </div>
                  </div>
                  <br>
                  <br>
                  <center>
                    <h4>Member:  {{ $data['records']->customer->name }}</h4>
                    <h5>Paid On:  {{ $data['records']->created_at->format("F j, Y, g:i a") }}</h5>
                      <hr>
                    <h5>Package:  {{$data['records']->package->package}}</h5>
                    <h5>Promotion:  {{$data['records']->package->promotion}} %</h5>
                    <h5>Original Price:  {{ $data['records']->package->original_price }}</h5>
                       <hr>
                      <h5>Total Amount: {{ $data['records']->package->original_price - ($data['records']->package->original_price*$data['records']->package->promotion/100) }}</h5>
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