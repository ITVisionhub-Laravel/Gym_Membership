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
                <a href="{{ url('admin/customers/'.$checkoutProducts[0]->customers->id.'/print') }}" target="_blank"  class="btnprint btn btn-success btn-sm float-end mx-1"><i class="fa fa-print"></i></a>
              </h3>
            </div>
            <div class="card-body">
              <div class="row form-group">
                <div class="col-12">

                  <div class="col-md-12">
                    <div class="row">
                    <div class="col-md-4"> 
                        <img src="{{asset('/uploads/customer/'.$checkoutProducts[0]->customers->image)}}" alt="Member" style="width:120px;height:120px;">
                      
                    </div>
                    <div class="col-md-8">
                      
                      <h6>Member Name: {{ $checkoutProducts[0]->customers->name }}</h5> 
                      <h6>Phone Number: {{ $checkoutProducts[0]->customers->phone_number}}</h6>
                      <h6 style="line-height: 1.5">
                        Member ID Number: {{ $checkoutProducts[0]->customers->member_card }} <br>
                        {{ $checkoutProducts[0]->customers->address->street->township->city->name}},
                        {{ $checkoutProducts[0]->customers->address->street->township->name}},<br>
                        {{ $checkoutProducts[0]->customers->address->street->name}} 
                      </h6>
                      
                    </div>
                    
                    </div>
                  </div>
                  
                  <br>
                  					<div class="invoice-body">
    
    						<!-- Row start -->
    						<div class="row gutters">
    							<div class="col-lg-12 col-md-12 col-sm-12">
    								<div class="table-responsive">
    									<table class="table custom-table m-0">
    										<thead>
    											<tr>
    												<th>Items</th>
    												<th>Price</th>
    												<th>Quantity</th>
    												<th>Sub Total Cost</th>
    											</tr>
    										</thead>
    										<tbody> 
    											 @foreach ($checkoutProducts as $checkoutProduct)
												 <tr>
													<td>{{ $checkoutProduct->products->name }}</td>
													<td>{{ $checkoutProduct->products->selling_price }} MMK</td>
													<td>{{ $checkoutProduct->quantity }} </td>
													<td>{{ $checkoutProduct->total }} MMK</td>
												 </tr>
												 @endforeach
												 <tr>
    												<td>&nbsp;</td>
    												<td colspan="2">
    												 <strong>Grand Total</strong>
    												</td>			
    												<td> 
    													<strong class="text-success">{{ $total }} MMK</strong>
    												</td>
    											</tr>
    										</tbody>
    									</table>
    								</div>
    							</div>
    						</div>
    						<!-- Row end -->
    
    					</div>
    
    				</div>
				 
				  <p class="text-center">
                        Paid On @if ($checkoutProducts[0]->paymentType == 0)
							<strong class="text-success">Cash</strong>
							@else
							<strong class="text-success">{{ $checkoutProducts[0]->paymentType->name }}</strong>
						@endif
                    </p>
                  @if ($logos) 
                    <p class="text-center">
						
                        Thank you for joining with <strong class="text-danger">{{ $logos->name }}</strong>
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