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
{{-- .wrapper{
  width: 250px;
  height: 250px;
  background: #c60707;
  border-radius: 16px;
  padding: 30px;
}  --}}
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
  color: rgb(62, 57, 57);
}
hr{
  size: 100%;
}
p{
  font-size: 11px;
}
</style>
</head>
<body>
  <div >
        <h4>Invoice</h4>  
        <br>
        <hr>
        <br>
        <div class="row">
       
          <div class="col-md-4"> 
          <img src="{{asset('/uploads/customer/'.$records->customer->image)}}" alt="Member" style="width:120px;height:120px;">
          </div> 
        <div class="col-md-8">
        <p>
          
          Member Name:  {{ $records->customer->name }} <br>
          Phone Number: {{ $records->customer->phone_number}} <br>
          Member ID Number: {{ $records->customer->member_card }} <br>
          {{ $records->customer->address->street->township->city->name}},
          {{ $records->customer->address->street->township->name}},<br>
          {{ $records->customer->address->street->name}} <br> 
          </p>
        </div>
        </div>
        <br> 
        <table class="table">
          <thead style="background: rgb(165, 221, 244)">
            <tr>
              <th>Package</th>
              <th>Promotion</th>
              <th>Paid On</th>
              <th>Original Fee</th>
              <th>Discounted Fee</th>
            </tr>
          </thead>
          <tbody>
               <tr>
              <td>{{$records->package->package}}</td>
              <td>{{$records->package->promotion}} %</td>
              <td>{{ $records->created_at->format("F j, Y, g:i a") }}</td>
              <td>{{ $records->package->original_price }}</td>
              <td>{{ $records->package->promotion_price }}</td>
            </tr> 
            
            <tr>
            <td></td>
            <td></td>
            <td></td>
            <td>Total Amount:</td>
            <td>{{ $records->package->promotion_price }}</td>
            </tr>
          </tbody>
          </table>
          <br>
          @if ($logos) 
            <p style="text-align: center">
                Thank your for joining with {{ $logos->name }}
            </p>
          @endif
  </div>
</body>
</html>