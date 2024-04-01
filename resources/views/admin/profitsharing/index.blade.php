<x-admin>
    <div class="container mt-3">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <div class="dropdown mb-3">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              All
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                <button class="dropdown-item" type="button" id="daily">Daily</button>
                <button class="dropdown-item" type="button" id="weekly">Weekly</button>
                <button class="dropdown-item" type="button" id="monthly">Monthly</button>
                <button class="dropdown-item" type="button" id="yearly">Yearly</button>
            </div>
        </div>
        <div class="yufctable">
            <table class="table table-secondary table-bordered border-light">
                <thead>
                    <tr class="text-center">
                        <th scope="col">Profit Breakdown</th>
                        <th scope="col">Member</th>
                        <th scope="col">Revenue Amount</th>
                        <th scope="col">FSA (75%)</th>
                        <th scope="col">YUFC (25%)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">First 3 Months</th>
                        {{-- @foreach ($users as $user ) --}}
                            {{-- <td class="text-center">{{$user->Member}}</td>
                            <td class="text-end">{{$user->Revenue_Amount}}</td>
                            <td class="text-end">{{$user->FSA_75_percent}}</td>
                            <td class="text-end">{{$user->YUFC_25_percent}}</td> --}}
                        {{-- @endforeach --}}
                        <td class="text-center"></td>
                        <td class="text-end"></td>
                        <td class="text-end"></td>
                        <td class="text-end"></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</x-admin>
<script type="text/javascript">
    $(document).ready(function() {
        $('#daily').on('click', function()
        {
            var daily = $(this).text();
                $.ajax({
                    url: "{{url('admin/customers/daily')}}",
                    type: "POST",
                    data: {
                        daily_data: daily,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (result) {
                        $.each(result.daily, function (index, value) {
                            alert(value.Member)
                            $('td.text-center:eq(' + index + ')').text(value.Member);
                            $('td.text-end:eq(' + index + ')').text(value.Revenue_Amount);
                            $('td.text-end:eq(' + index + ')').text(value.FSA_75_percent);
                            $('td.text-end:eq(' + index + ')').text(value.YUFC_25_percent);
                        });
                    },
                    error: function(xhr, status, error) {
                        var errorMessage = xhr.status + ': ' + xhr.statusText;
                        alert('Error - ' + errorMessage);
                    }
                });
        });
    });
</script>

