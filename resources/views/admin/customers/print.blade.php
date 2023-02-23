<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<style>
*{
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: "Arial", sans-serif;
}
body{
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 20px;
}
.wrapper{
  width: 250px;
  height: 250px;
  background: #fff;
  border-radius: 16px;
  padding: 30px;
}
h2{
  padding: 10px;
}
h4{
  font-size: 13px;
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
  padding-right: 10px;
  display: flex;
  justify-content: flex-end;
}
.table {
  width: 100%;
  border-collapse: collapse;
  font-size: 10px;
}
.table td, .table th {
  border: 1px solid #ddd;
  padding: 6px;
}

.table tr:nth-child(odd){background-color: #f2f2f2;}

.table tr:hover {background-color: #ddd;}

.table th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #bad3f8;
  color: white;
}
p{
  font-size: 11px;
}
</style>
</head>
<body>
  <div class="wrapper">
        <h4>Invoice</h4>  <hr>
        <div class="row">
        <div>
        {{-- @dd($logos->image); --}}
        <img src="{{asset("$logos->image")}}" alt="Member" style="width:80px;height:80px;">
        </div>
        <div class="right">
        <p>
          Invoice: {{ $data['records']->customer->id }} <br>
          {{ $data['records']->customer->address->street->township->city->name}},
          {{ $data['records']->customer->address->street->township->name}},<br>
          {{ $data['records']->customer->address->street->name}} <br> 
          {{ $data['records']->customer->phone_number}}</p>
        </div>
        </div>
        <br>
        <div>
          <h4>Member:  {{ $data['records']->customer->name }}</h4>
          <p>Paid On : {{  $data['records']->created_at->format("j, n, Y") }}</p>
        </div>
        <br>
        <table class="table">
          <thead style="background: rgb(165, 221, 244)">
            <tr>
              <th>Package</th>
              <th>Promotion</th>
              <th>Original Price</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>{{$data['records']->package->package}}</td>
              <td>{{$data['records']->package->promotion}} %</td>
              <td>{{ $data['records']->package->original_price }}</td>
            </tr>
            <tr>
            <td></td>
            <td>Total Amount:</td>
            <td>{{ $data['records']->package->original_price - ($data['records']->package->original_price*$data['records']->package->promotion/100) }}</td>
            </tr>
          </tbody>
          </table>
          <br>
            <p style="text-align: center">
                Thank your for joining with {{ $logos->name }}
            </p>
  </div>
</body>
</html>