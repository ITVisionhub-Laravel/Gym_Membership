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
                        <th scope="col">Date</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row" class="name"></th>
                        {{-- @foreach ($users as $user ) --}}
                            {{-- <td class="text-center">{{$user->Member}}</td>
                            <td class="text-end">{{$user->Revenue_Amount}}</td>
                            <td class="text-end">{{$user->FSA_75_percent}}</td>
                            <td class="text-end">{{$user->YUFC_25_percent}}</td> --}}
                        {{-- @endforeach --}}
                        <td class="text-center cumulative-sum" data-type="noOfMember"></td>
                        <td class="text-end cumulative-sum" data-type="sumRevenue"></td>
                        <td class="text-end cumulative-sum" data-type="sum75Percent"></td>
                        <td class="text-end cumulative-sum" data-type="sum25Percent"></td>
                        <td class="text-end cumulative-sum" data-type="date"></td>
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
                        var noOfMember = result.daily.length;
                        var sumRevenue = 0;
                        var sum75Percent = 0;
                        var sum25Percent = 0;
                        var date;
                        // alert(JSON.stringify(result.daily))
                        $.each(result.daily, function (index, value) {
                            sumRevenue += value.Revenue_Amount;
                            sum75Percent += value.FSA_75_percent;
                            sum25Percent += value.YUFC_25_percent;
                            date = value.Date;
                        });
                        $('.name').text("Daily Data");
                        $('.cumulative-sum[data-type="sumRevenue"]').text(sumRevenue);
                        $('.cumulative-sum[data-type="noOfMember"]').text(noOfMember);
                        $('.cumulative-sum[data-type="sum75Percent"]').text(sum75Percent);
                        $('.cumulative-sum[data-type="sum25Percent"]').text(sum25Percent);
                        $('.cumulative-sum[data-type="date"]').text(date);
                    },
                    error: function(xhr, status, error) {
                        var errorMessage = xhr.status + ': ' + xhr.statusText;
                        alert('Error - ' + errorMessage);
                    }
                });
        });
        $('#weekly').on('click', function()
        {
            var weekly = $(this).text();
                $.ajax({
                    url: "{{url('admin/customers/weekly')}}",
                    type: "POST",
                    data: {
                        weekly_data: weekly,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (result) {
                        $.each(result.weekly, function (index, value) {
                        //     sumRevenue += value.Revenue_Amount;
                        //     sum75Percent += value.FSA_75_percent;
                        //     sum25Percent += value.YUFC_25_percent;
                        //     date = value.Date;
                        });
                        // $('.name').text("weekly Data");
                        // $('.cumulative-sum[data-type="sumRevenue"]').text(sumRevenue);
                        // $('.cumulative-sum[data-type="noOfMember"]').text(noOfMember);
                        // $('.cumulative-sum[data-type="sum75Percent"]').text(sum75Percent);
                        // $('.cumulative-sum[data-type="sum25Percent"]').text(sum25Percent);
                        // $('.cumulative-sum[data-type="date"]').text(date);
                    },
                    error: function(xhr, status, error) {
                        var errorMessage = xhr.status + ': ' + xhr.statusText;
                        alert('Error - ' + errorMessage);
                    }
                });
        });
        $('#monthly').on('click', function()
        {
            var monthly = $(this).text();
                $.ajax({
                    url: "{{url('admin/customers/monthly')}}",
                    type: "POST",
                    data: {
                        monthly_data: monthly,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (result) {
                        var noOfMember = result.monthly.length;
                        var sumRevenue = 0;
                        var sum75Percent = 0;
                        var sum25Percent = 0;
                        var date;
                        // alert(JSON.stringify(result.monthly))
                        $.each(result.monthly, function (index, value) {
                            sumRevenue += value.Revenue_Amount;
                            sum75Percent += value.FSA_75_percent;
                            sum25Percent += value.YUFC_25_percent;
                            date = value.Date;
                        });
                        $('.name').text("monthly Data");
                        $('.cumulative-sum[data-type="sumRevenue"]').text(sumRevenue);
                        $('.cumulative-sum[data-type="noOfMember"]').text(noOfMember);
                        $('.cumulative-sum[data-type="sum75Percent"]').text(sum75Percent);
                        $('.cumulative-sum[data-type="sum25Percent"]').text(sum25Percent);
                        $('.cumulative-sum[data-type="date"]').text(date);
                    },
                    error: function(xhr, status, error) {
                        var errorMessage = xhr.status + ': ' + xhr.statusText;
                        alert('Error - ' + errorMessage);
                    }
                });
        });
        $('#yearly').on('click', function()
        {
            var yearly = $(this).text();
                $.ajax({
                    url: "{{url('admin/customers/yearly')}}",
                    type: "POST",
                    data: {
                        yearly_data: yearly,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (result) {
                        var noOfMember = result.yearly.length;
                        var sumRevenue = 0;
                        var sum75Percent = 0;
                        var sum25Percent = 0;
                        var date;
                        // alert(JSON.stringify(result.yearly))
                        $.each(result.yearly, function (index, value) {
                            sumRevenue += value.Revenue_Amount;
                            sum75Percent += value.FSA_75_percent;
                            sum25Percent += value.YUFC_25_percent;
                            date = value.Date;
                        });
                        $('.name').text("yearly Data");
                        $('.cumulative-sum[data-type="sumRevenue"]').text(sumRevenue);
                        $('.cumulative-sum[data-type="noOfMember"]').text(noOfMember);
                        $('.cumulative-sum[data-type="sum75Percent"]').text(sum75Percent);
                        $('.cumulative-sum[data-type="sum25Percent"]').text(sum25Percent);
                        $('.cumulative-sum[data-type="date"]').text(date);
                    },
                    error: function(xhr, status, error) {
                        var errorMessage = xhr.status + ': ' + xhr.statusText;
                        alert('Error - ' + errorMessage);
                    }
                });
        });
    });
</script>

