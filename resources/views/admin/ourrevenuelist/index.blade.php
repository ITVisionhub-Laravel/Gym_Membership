<x-admin> 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <div class="dropdown mb-3">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-bs-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            All
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
           <button class="dropdown-item" type="button" id="daily" data-type="daily">Daily</button>
        <button class="dropdown-item" type="button" id="weekly" data-type="weekly">Weekly</button>
        <button class="dropdown-item" type="button" id="monthly" data-type="monthly">Monthly</button>
        <button class="dropdown-item" type="button" id="yearly" data-type="yearly">Yearly</button>
        </div>
    </div>
    <table class="table table-success table-bordered">
        <thead>
            <tr class="text-center">
                <th scope="col">Profit BreakDown</th>
                <th scope="col">Our Income</th>
                <th scope="col">Expenses</th>
                <th scope="col">Our Revenue</th> 
                <th scope="col">Date</th>
                <th scope="col">Profit/Loss</th> 
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="text-center" id="breakdown">All</td>
                @php
                $profit = $ourIncome - $expenses;
                @endphp
                <td class="text-center" id="ourIncome"><a href="{{ route('profitsharing.index') }}">$ {{ $ourIncome }}</a></td>
                <td class="text-center" id="ourExpense"><a href="{{ route('expenses.index') }}">$ {{ $expenses }}</a></td>
                <td class="text-center" id="ourRevenue">$ {{ $profit }}</td> 
                <td class="text-center" id="date">N/A</td> 
                <td class="text-center" id="profitAndLoss" style="background-color: {{ $profit > 0 ? 'green' : 'red' }}">
                    &nbsp;
                    @if ($profit > 0)
                        <p style="color: white">Got Profit</p>
                    @else
                        <p style="color: white">Loss</p>
                    @endif
                </td>
            </tr>
        </tbody>
    </table>
    
</x-admin>

<script type="text/javascript">
    $(document).ready(function() {
        $('.dropdown-item').on('click', function() {           
            var dataType = $(this).data('type');  
            $('#breakdown').text($(this).data('type'));
                $.ajax({
                    url: "{{ route('our_income_and_expense') }}",
                    type: "POST",
                    data: {
                    data_type: dataType,
                    _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(result) {
                        
                        //alert("Income: " + result.income + ", Expense: " + result.expense + ", Date: " + result.date);
                        //alert(JSON.stringify(result))
                        $('#ourIncome').text("$ " + result.income);
                        $('#ourExpense').text("$ " + result.expense);
                        
                        // Calculate profit
                        var profit = result.income - result.expense;
                        $('#ourRevenue').text("$ " + profit);
                        
                        // Set the date if available
                        if (result.date) {
                            $('#date').text(result.date);
                        } else {
                            $('#date').text("N/A");
                        }
                        
                        // Display profit or loss message
                        if (profit > 0) {
                            $('#profitAndLoss').html('<p style="color: white; text-align: center;">Got Profit</p>');
                        } else {
                            $('#profitAndLoss').html('<p style="color: white; text-align: center;">Loss</p>');
                        }
                    },
                    error: function(xhr, status, error) {
                    var errorMessage = xhr.status + ': ' + xhr.statusText;
                    alert('Error - ' + errorMessage);
                    }
                })
            });
        }); 
    
</script>