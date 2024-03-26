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
                Invoice
                <a href="{{ url('admin/customers') }}" class="btn btn-danger btn-sm float-end mx-1">Back</a>
                <a href="{{ url('admin/customers/'.$records->user->id.'/generate') }}" class="btn btn-primary btn-sm float-end mx-1"><i class="fa fa-download"></i></a>
                <a href="{{ url('admin/customers/'.$records->user->id.'/view') }}" target="_blank" class="btn btn-warning btn-sm float-end mx-1"><i class="fa-regular fa-eye"></i></a>
                <a href="{{ url('admin/customers/'.$records->user->id.'/mail') }}"  class="btn btn-info btn-sm float-end mx-1"><i class="fa fa-envelope"></i></a>
                <a href="{{ url('admin/customers/'.$records->user->id.'/print/package') }}" target="_blank"  class="btnprint btn btn-success btn-sm float-end mx-1"><i class="fa fa-print"></i></a>
              </h3>
            </div>
            <div class="card-body">
              <div class="row form-group">
                <div class="col-12">

                  <div class="col-md-12">
                    <div class="row">
                    <div class="col-md-4">
                        <img src="{{asset('/uploads/customer/'.$records->user->image)}}" alt="Member" style="width:120px;height:120px;">

                    </div>
                    <div class="col-md-8">

                      <h6>Member Name: {{ $records->user->name }}</h5>
                      <h6>Phone Number: {{ $records->user->phone_number}}</h6>
                      <h6 style="line-height: 1.5">
                        Member ID Number: {{ $records->user->member_card }} <br>
                        {{ $records->user->address->street->township->city->name}},
                        {{ $records->user->address->street->township->name}},<br>
                        {{ $records->user->address->street->name}}
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
                      <tbody>
                        <tr>
                          <td>{{$records->package->package}}</td>
                          <td>{{$records->package->promotion}} %</td>
                          <td>{{ $records->created_at->format("F j, Y, g:i a") }}</td>
                          <td>{{ $records->package->original_price }} MMK</td>
                          <td>{{ $records->package->promotion_price }} MMK</td>
                        </tr>
                        {{--  @endforeach

                  @endif  --}}
                        <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>Total Fee:</td>
                        <td> {{ $records->package->promotion_price }} MMK </td>
                        </tr>
                  </tbody>


                  </table>
                  <br>
                  @if ($logos)
                    <p class="text-center">
                        Thank you for joining with {{ $logos->name }}
                    </p>
                  @endif

                </div>
              </div>
            </div>
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
