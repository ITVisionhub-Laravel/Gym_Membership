<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Payment Receipt</title>
<style>
*{
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  /* font-family: "Poppins", sans-serif; */
  font-family: "Arial", sans-serif;
}
body{
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 20px;
}
.wrapper{
  width: 550px;
  height: 550px;
  background: #fff;
  border-radius: 16px;
  padding: 30px;
  box-shadow:10px 10px 10px 15px rgba(0,0,0,0.05);
}
h2{
  padding: 10px;
}
h5{
  font-size: 15px;
  color: #434447
}
.row{
  display: flex;
  flex-direction: row;
}
.row > div {
  width: 100%;
}
.right{
  padding-top: 20px;
  padding-right: 40px;
  display: flex;
  justify-content: flex-between;
}
.table {
  width: 100%;
  border-collapse: collapse;
}
.table td, .table th {
  border: 1px solid #ddd;
  padding: 8px;
}

.table tr:nth-child(odd){background-color: #f2f2f2;}

.table tr:hover {background-color: #ddd;}

.table th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #bad3f8;
  color: rgb(62, 57, 57);
}
</style>
</head>
<body>
  <div class="wrapper">
        <h2>Invoice</h2>
          <hr>
          <br>
        <div class="row">
        
          <div class="col-md-4"> 
            <img src="{{asset('/uploads/customer/'.$records->customer->image)}}" alt="Member" style="width:120px;height:120px;">
          </div> 
          <div  class="col-md-8">
            <h5 style="line-height: 2">
              Member Name: {{ $records->customer->name}} <br>
              Phone Number: {{ $records->customer->phone_number}} <br>
              Member ID Number: {{ $records->customer->member_card }} <br>
              {{ $records->customer->address->street->township->city->name}},
              {{ $records->customer->address->street->township->name}},<br>
              {{ $records->customer->address->street->name}} <br> 
            </h5>
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
              <td>{{  $records->created_at->format("F j, Y, g:i a") }}</td>
              <td>{{ $records->package->original_price }} MMK</td>
              <td>{{ $records->package->promotion_price }} MMK</td>
            </tr>
            <tr>
            <td></td>
            <td></td>
            <td></td>
            <td>Total Amount:</td>
            <td>{{ $records->package->promotion_price }} MMK</td>
            </tr>
          </tbody>
          </table>
          <br>
          <br>
            <p style="text-align: center">
                Thank your for joining with {{ $logos->name }}
            </p>
  </div>
</body>
</html>