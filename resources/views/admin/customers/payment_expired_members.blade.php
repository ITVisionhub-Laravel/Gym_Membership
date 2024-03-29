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
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($payment_expired_members as $payment_expired_member)
                <tr>
                <td>{{ $payment_expired_member->customer_id }}</td>
                {{--  @dd($payment_expired_member->expiredMember)  --}}
                <td>{{ $payment_expired_member->expiredMember->name }}</td>
                <td>
                    {{ $payment_expired_member->expiredMember->address?->street->township->city->name}},<br>
                    {{ $payment_expired_member->expiredMember->address?->street->township->name}},<br>
                    {{ $payment_expired_member->expiredMember->address?->street->name}}
                </td>
                <td>{{ $payment_expired_member->expiredMember->phone_number}}</td>
                <td>{{ $payment_expired_member->expired_date}}</td>
                <td>
                    <img src="{{asset('/uploads/customer/'.$payment_expired_member->expiredMember->image)}}" style="width:50px;height:50px" alt="customer">
                </td>
                <td>
                    @if ($payment_expired_member->extra_days <= 1)
                        Expired
                        @else 
                        Warning
                    @endif
                    
                </td>
                <td>
                    <a href="{{ url('/admin/'.$payment_expired_member->customer_id.'/addPayments') }}" class="btn btn-sm btn-primary">Pay</a>
                    {{--  <a href="#" wire:click="addPayments({{ $payment_expired_member->customer_id }})" data-bs-toggle="modal" data-bs-target="#payFeeModal" class="btn-primary btn-sm">Pay</a>  --}}
                </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<x-slot name="scripts">
    <script type="text/javascript">
        $(document).ready( function () {
        $('#myTable').DataTable();
        } );
       
    </script>
    <script>
         $document.addEventListener('close-modal',event=> {
                $('#payFeeModal').modal('hide');
            });
    </script>

<x-addressfieldjs></x-addressfieldjs>
</x-slot>
</x-admin>