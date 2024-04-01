<x-admin>
<div class="container my-3">
    <x-successmessage/>
    
    <h3 class="my-2">Attendence List</h3>
    <a href="{{ url('admin/attendent/print') }}" class="btnprint btn btn-success my-2 btn-sm float-end mx-1"><i class="fa fa-print"></i></a>

    <div class="row my-3">        
        <div class="col-3">
            <form action="{{route('attendent_check.store')}}" method="post" class="float-end">
                @csrf
                <!-- barcode -->
                <input type="text" id="scanQrCode" name="member_check" class="form-control  placeholder_text float-end" autocomplete="off" autofocus="" placeholder="33554489012" style="display: inline-block;">
                <!-- end_barcode -->
            </form>
        </div>

        <div class="row col-5">
            <form action="" method="GET" class="d-inline-block">
                 @csrf
                <input type="date" name="date" value="{{Request::get('date') ?? date('Y-m-d') }}" class="form-control w-50" style="display: inline-block;">
                <button type="submit" class="btn btn-primary">Filter</button>
            </form>
        </div>
        
        
    </div>
    
    <table id="myTable" class="table">
        <thead>
            @php 
            $j=1;
            @endphp
           
            <tr>
                <th>No</th>
                <th>Attendence Date</th>
                <th>Member Name</th>
                <th>Phone</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
             @foreach($attendents as $attendent)
            <tr>

                <td>{{$j++}}</td>
                <td>{{$attendent->attendent_date}}</td>
                <td>{{$attendent->member->name}}</td>
                <td>{{$attendent->member->phone_number}}</td>
                <td>
                    <form action="{{route('attendents.destroy',$attendent->id)}}" method="POST" class="d-inline">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger py-2">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
           
        </tbody>
    </table>
</div>
   <!-- Custom popup box --> 
<div id="customPopup" class="popup-container">
    <!-- The popup content -->
    <div class="popup-content">
        <!-- Custom content for the popup box here -->
        <p id="popupContent">Popup Content</p>
        <button id="closeButton">Close</button>
    </div>
</div>


    <!-- Include CSRF token -->
    {{--  <input type="hidden" id="csrfToken" value="{{ csrf_token() }}">  --}}

    <x-slot name="scripts">
        <!-- Add this script to handle the form submission and display popup -->
        <script type="text/javascript">
            $(document).ready(function () {
                // Retrieve CSRF token from the hidden input field
                const csrfToken = $('#csrfToken').val();

               $('#scanQrCode').on('input', function (event) {
                    event.preventDefault(); // Prevent default form submission
                    const memberId = $(this).val();
                    
                    // Check if the length of the input value is exactly 10 characters
                    if (memberId.length === 10) {
                        // Make an AJAX request to check if the member exists
                        $.ajax({
                            url: "{{ url('admin/attendent_check') }}",
                            method: 'POST',
                            data: {
                                memberId: memberId,
                                _token: '{{csrf_token()}}'
                            },
                            dataType: 'json',
                            success: function (response) {
                                // Handle the response accordingly
                                if (response.wrongMemberId) {
                                    $('#popupContent').html('Member ID is wrong!');
                                    $('#customPopup').show();
                                } else if (response.memberExists) {
                                    $('#popupContent').html('Member with ID ' + memberId + ' already exists!');
                                    $('#customPopup').show();
                                } else if (response.success) { 
                                    window.location.href = "{{ route('attendents.index') }}";
                                } else {
                                    console.error('Unknown response:', response);
                                }
                            },
                            error: function (error) {
                                window.location.href = "{{ route('attendents.index') }}?error=1";
                            },
                        });
                    }
            });

                // Close the popup box when the close button is clicked
                $('#closeButton').on('click', function () {
                    // Hide the popup box
                    $('#customPopup').hide();
                });
            });
        </script>

        <script>
            $(document).ready(function () {
                $('#myTable').DataTable();
            });
        </script>

        <script  type="text/javascript">
            $(document).ready(function () {
                $('.btnprint').printPage();
            });
        </script>
    </x-slot>

</x-admin>