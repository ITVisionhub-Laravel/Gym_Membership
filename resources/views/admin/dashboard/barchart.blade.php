 

@if ($monthlyEarningMoney)

    <div class="col-lg-8 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Bar chart</h4>
            <canvas id="barChart"></canvas>
        </div>
    </div>
</div>
@else
<div class="col-lg-8 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Bar chart</h4>
            <div>
                No Payment Record
            </div>
        </div>
    </div>
</div>

@endif



