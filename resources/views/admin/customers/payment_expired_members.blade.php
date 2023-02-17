{{--  @props(['expiredPaymentMembers'])  --}}
<x-admin>
<div class="container my-3">
    <x-successmessage/>
    <h3 class="my-2">Payment Expired Members List
    </h3>
    <hr>
    <table id="myTable">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Address</th>
                <th>Mobile</th>
                <th>Expired Date</th>
                <th>Image</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($payment_expired_members as $payment_expired_member)
                <tr>
                <td>{{ $payment_expired_member->customer_id }}</td>
                <td>{{ $payment_expired_member->expiredMember->name }}</td>
                <td>
                    {{ $payment_expired_member->expiredMember->address->street->township->city->name}},<br>
                    {{ $payment_expired_member->expiredMember->address->street->township->name}},<br>
                    {{ $payment_expired_member->expiredMember->address->street->name}}
                </td>
                <td>{{ $payment_expired_member->expiredMember->phone_number}}</td>
                <td>{{ $payment_expired_member->expired_date}}days</td>
                <td>
                    <img src="{{asset('/uploads/customer/'.$payment_expired_member->expiredMember->image)}}" style="width:50px;height:50px" alt="customer">
                </td>
                <td>
                    @if ($payment_expired_member->expired_date <= 1)
                        Expired
                        @else 
                        Warning
                    @endif
                    {{--  {{ $payment_expired_member->expired_date }}  --}}
                    {{--  <a href="{{ url('admin/customers/'.$payment_expired_member->expiredMember->id.'/invoice')}}" class="btn-success btn-sm"><i class="fa-regular fa-eye"></i></a>
                    <a href="{{ url('admin/customers/'.$payment_expired_member->expiredMember->id.'/edit') }}"  class="btn-primary btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
                    <a href="{{ url('admin/customers/'.$payment_expired_member->expiredMember->id.'/delete') }}" onclick="return confirm('Are you sure you want to delete this data?')" class="btn-danger btn-sm"><i class="fa-solid fa-trash"></i></a>  --}}
                </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<x-slot name="scripts">
<script>
     $(document).ready( function () {
        $('#myTable').DataTable({
            // scrollX: true,
        });
    } );
</script>
</x-slot>
</x-admin>

