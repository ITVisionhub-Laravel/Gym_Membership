<x-admin>
<div class="container my-3">
     <x-successmessage/>
    
     {{--  @foreach($attendents as $attendent)  --}}
    <h3 class="my-2">Attendence List</h3>
    {{--  {{ url('admin/attendent/'.$attendent->attendent_date.'/print') }}  --}}
    <a href="{{ url('admin/attendent/print') }}" class="btnprint btn btn-success my-2 btn-sm float-end mx-1"><i class="fa fa-print"></i></a>
   {{--  @endforeach  --}}

    <div class="row my-3">
        {{--  <div class="col-4">
            <form action="{{route('attendent_check.store')}}" method="post" class="d-inline-block">
                @csrf
                <input type="text" id="member" name="member_check" class="form-control w-50" style="display: inline-block;" placeholder="Enter member ID">
                <button type="submit" class="btn btn-outline-success">Check-in</button>
            </form>
        </div>  --}}
        
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

                $('#scanQrCode').on('keydown', function (event) {
                    if (event.key === 'Enter') {
                        event.preventDefault(); // Prevent default form submission
                        const memberId = $(this).val();

                        // Make an AJAX request to check if the member exists
                        $.ajax({
                            url: "{{ url('admin/attendent_check') }}", // Replace with the correct URL endpoint
                            method: 'POST',
                            data: {
                                member_check: memberId,
                                _token: '{{csrf_token()}}'
                            },

                            dataType: 'json', // Add this line to specify JSON response data type
                            success: function (response) {
                               
                                if (response.wrongMemberId) {
                                    // Member already exists, show the custom popup box
                                    $('#popupContent').html('Member ID is wrong!');
                                    $('#customPopup').show();
                                } else if (response.memberExists) {
                                    $('#popupContent').html('Member with ID ' + memberId + ' already exists!');
                                    $('#customPopup').show();
                                }else if (response.success) {
                                    // Member is new, redirect to 'attendents.index'
                                    window.location.href = "{{ route('attendents.index') }}"; // Replace with the correct URL
                                } else {
                                    // Handle other possible responses or errors here
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