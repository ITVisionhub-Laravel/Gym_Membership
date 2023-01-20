
<div class="col-md-8">
	<h1 class="text-center">How To Create Dynamic Bar Chart In Laravel 9 - Websolutionstuff</h1>
    <div class="col-md-8 col-md-offset-2">
    	<div class="col-xl-6">
    		<div class="card col-md-8 pr-10">
                <div class="card-header">
                    <h3 class="p-2">Overview
                        <a href="{{ url('admin/products') }}" class="float-end">Monthly</a>
                    </h3>
                </div>
    			<div class="card-body">
    				<div class="chart-container">
                        <div>{{$attendencedMembers[0]['customer']->count()}}</div>
    					<div class="chart has-fixed-height" id="bars_basic"></div>
    				</div>
    			</div>
    		</div>
    	</div>
    </div>	
</div>

@section('scripts')
<script>
var bars_basic_element = document.getElementById('bars_basic');
if (bars_basic_element) {
    var bars_basic = echarts.init(bars_basic_element);
    bars_basic.setOption({
        color: ['#3398DB'],
        tooltip: {
            trigger: 'axis',
            axisPointer: {            
                type: 'shadow'
            }
        },
        grid: {
            left: '3%',
            right: '4%',
            bottom: '3%',
            containLabel: true
        },
        xAxis: [
            {
                type: 'category',
                data: ['active member','register member'],
                axisTick: {
                    alignWithLabel: true
                }
            }
        ],
        yAxis: [
            {
                type: 'value'
            }
        ],
        series: [
            {
                name: 'Total Products',
                type: 'bar',
                barWidth: '20%',
                data: [
                    {{$attendencedMembers[0]['customer']->count()}},
                    {{$attendencedMembers[0]['customer']->count()}},
                ]
            }
        ]
    });
}
</script>
@endsection