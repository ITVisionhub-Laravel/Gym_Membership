<div class="container mt-3">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <table class="table table-success table-bordered">
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
                @foreach ($users as $user )
                    <td class="text-center">{{$user->Member}}</td>
                    <td class="text-end">{{$user->Revenue_Amount}}</td>
                    <td class="text-end">{{$user->FSA_75_percent}}</td>
                    <td class="text-end">{{$user->YUFC_25_percent}}</td>
                @endforeach
            </tr>
        </tbody>
    </table>
</div>

