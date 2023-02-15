<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Payment Receipt</title>
<style>
@import url('https://fonts.googleapis.com/css2?family=Noto+Sans:wght@700&family=Poppins:wght@400;500;600&display=swap');
*{
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: "Poppins", sans-serif;
}
body{
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 20px;
}
.wrapper{
  width: 500px;
  height: 500px;
  background: #fff;
  border-radius: 16px;
  padding: 30px;
  box-shadow:10px 10px 10px 15px rgba(0,0,0,0.05);
}
h2{
  padding: 10px;
}
.row{
  display: flex;
}
.left{
  padding: 20px;
  font-size: 18px;
  line-height: 1.5;
}
.right{
  display: flex;
  justify-content: flex-end;
}

</style>
</head>
<body>
  <div class="wrapper">
        <h2>Payment Receipt</h2>  <hr>
        <div class="row">
        <div class="left">
        <h4>
          {{ $data['records']->customer->address->street->township->city->name}},
          {{ $data['records']->customer->address->street->township->name}},
          {{ $data['records']->customer->address->street->name}} <br> 
          {{ $data['records']->customer->phone_number}}</h4>
        </div>
        
        <div class="right">
        {{-- @dd($logos->image); --}}
        {{-- <img src="{{asset("$logos->image")}}" alt="Member" style="width:120px;height:120px;"> --}}
        </div>
        </div>
    <br>
    <center>
      <div style="padding:10px;line-height:1.5;">
      <div style="font-size: 18px">
        <h4>Member:  {{ $data['records']->customer->name }}</h4>
      </div>
      <div style="font-size: 17px">
        <h4>Paid On:  {{ $data['records']->created_at->format("F j, Y, g:i a") }}</h4>
      </div>
      </div><hr>
      <div style="font-size: 17px;line-height:1.5;padding:10px;">
        <h4>Package:  {{$data['records']->package->package}}</h4>
        <h4>Promotion:  {{$data['records']->package->promotion}} %</h4>
        <h4>Original Price:  {{ $data['records']->package->original_price }}</h4>
      </div><hr>
       <div style="font-size: 17px;line-height:1.5;padding:10px;">
        <h4>Total Amount: {{ $data['records']->package->original_price - ($data['records']->package->original_price*$data['records']->package->promotion/100) }}</h4>
       </div>
    </center>
  </div>
</body>
</html>