<!DOCTYPE html>
<html>
<head>
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
  width: 550px;
  height: 550px;
  background: #fff;
  border-radius: 16px;
  padding: 30px;
}
h2{
  padding: 10px;
}
h5{
  font-size: 15px;
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
  justify-content: flex-end;
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
    <h2>Attendent Lists</h2>  <hr><br>
    <table class="table">
  <tr>
    <th>No</th>
    <th>Attendence Date</th>
    <th>Member Name</th>
    <th>Phone</th>
</tr>
  <tr>
    @php 
    $j=1;
    @endphp
    @foreach($attendents as $attendent)
    <tr>
        <td>{{$j++}}</td>
        <td>{{$attendent->attendent_date}}</td>
        <td>{{$attendent->member->name}}</td>
        <td>{{$attendent->member->phone_number}}</td>
    </tr>
    @endforeach
  </tr>
</table>
</div>
</body>
</html>


