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
                History
                 <a href="{{ url('admin/customers') }}" class="btn btn-danger btn-sm float-end mx-1">Back</a>
               </h3>
            </div>  
            @if ($records->isNotEmpty()) 
            <div class="card-body">
              <div class="row form-group">
                <div class="col-12"> 
                  <div class="col-md-12">
                    <div class="row">
                      <div class="col-md-4">
                          <img src="{{$records[0]->user->image}}" alt="Member" style="width:120px;height:120px;">

                      </div>
                      <div class="col-md-8">
                        <h6> Member Name: {{ $records[0]->user->name}}</h6>
                        <h6>Phone Number:{{ $records[0]->user->phone_number}}</h6>
                        <h6 style="line-height: 1.5">
                          Member ID Number: {{ $records[0]->user->member_card }} <br>
                         @foreach($records[0]->user->address as $address) 
                          {{ $address->street->ward->township->city->name ?? '' }},
                          {{ $address->street->ward->township->name ?? '' }},
                          {{ $address->street->ward->name ?? '' }},
                          {{ $address->street->name ?? '' }},
                          {{ $address->block_no ?? '' }},
                          {{ $address->floor ?? '' }},
                          {{ $address->zipcode ?? '' }},<br>
                        @endforeach
                        </h6>

                      </div>

                    </div>
                  </div>
                  <br>
                      <table class="table table-striped table-hover">
                      <thead class="table-primary">
                        <tr>
                          <th scope="col">Package</th>
                          <th scope="col">Promotion</th>
                          <th scope="col">Paid On</th>
                          <th scope="col">Original Fee</th>
                          <th scope="col">Discounted Fee</th>
                        </tr>
                      </thead>
                       @if ($records)
                    @foreach ($records as $record)
                      <tbody>
                        <tr>
                          <td>{{$record->package->package}}</td>
                          <td>{{$record->package->promotion}} %</td>
                          <td>{{ $record->created_at->format("F j, Y, g:i a") }}</td>
                          <td>{{ $record->package->original_price }} MMK</td>
                          <td>{{ $record->package->promotion_price }} MMK</td>
                        </tr>
                        @endforeach

                  @endif
                        <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>Total Fee:</td>
                        <td> {{ $totalAmount }} MMK </td>
                        </tr>
                  </tbody>


                  </table>
                  <br>
                  @if ($logos)
                    <p class="text-center">
                        Thank your for joining with {{ $logos->name }}
                    </p>
                  @endif

                </div>
              </div>
            </div>
            @else
            <div class="card-body">
              <div class="row form-group">
                <div class="col-12">
                  <h5 style="color: red">There is no Members Information History!!!!</h5>
                </div>
              </div>
            </div>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="{{asset('assets/js/jquery-3.6.3.min.js')}}"></script>
  <script src="http://www.position-absolute.com/creation/print/jquery.printPage.js"></script>
  <script  type="text/javascript">
    $(document).ready(function () {
      $('.btnprint').printPage();
    });
  </script>

</body>
</html>
