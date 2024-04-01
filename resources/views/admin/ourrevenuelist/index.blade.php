<x-admin>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <div class="dropdown mb-3">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-bs-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            All
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
            <button class="dropdown-item" type="button" id="daily">Daily</button>
            <button class="dropdown-item" type="button" id="weekly">Weekly</button>
            <button class="dropdown-item" type="button" id="monthly">Monthly</button>
            <button class="dropdown-item" type="button" id="yearly">Yearly</button>
        </div>
    </div>
    <table class="table table-success table-bordered">
        <thead>
            <tr class="text-center">
                <th scope="col">Our Income</th>
                <th scope="col">Expenses</th>
                <th scope="col">Our Revenue</th> 
                <th scope="col">Profit/Loss</th> 
            </tr>
        </thead>
        <tbody>
            <tr>
                @php
                $profit = $ourIncome - $expenses;
                @endphp
                <td class="text-center"><a href="{{ route('profitsharing.index') }}">$ {{ $ourIncome }}</a></td>
                <td class="text-center"><a href="{{ route('expenses.index') }}">$ {{ $expenses }}</a></td>
                <td class="text-center">$ {{ $profit }}</td> 
                <td class="text-center" style="background-color: {{ $profit > 0 ? 'green' : 'red' }}">
                    &nbsp;
                    @if ($profit > 0)
                        <p style="color: white">Got Profit</p>
                    @else
                        <p style="color: white">Loss</p>
                    @endif
                </td>
                {{--  <td class="text-center">
                   
                    @if ($profit > 0)
                        <button class="btn btn-success">Profit</button>
                    @else
                        <button class="btn btn-danger">Loss</button>
                    @endif
                </td>  --}}
            </tr>
        </tbody>
    </table>
    
</x-admin>