  @props(['month','monthlyEarningMoney'])
  
 <script type="text/javascript">
      var data = {
        labels: @php
            echo  json_encode($month)
        @endphp ,
        datasets: [
            {
                label: "Monthly Earnings",
                data: @php echo json_encode($monthlyEarningMoney) @endphp,
                backgroundColor: [
                    "rgba(255, 99, 132, 0.2)",
                    "rgba(54, 162, 235, 0.2)",
                    "rgba(255, 206, 86, 0.2)",
                    "rgba(75, 192, 192, 0.2)",
                    "rgba(153, 102, 255, 0.2)",
                    "rgba(255, 159, 64, 0.2)",
                ],
                borderColor: [
                    "rgba(255,99,132,1)",
                    "rgba(54, 162, 235, 1)",
                    "rgba(255, 206, 86, 1)",
                    "rgba(75, 192, 192, 1)",
                    "rgba(153, 102, 255, 1)",
                    "rgba(255, 159, 64, 1)",
                ],
                borderWidth: 1,
                fill: false,
            },
        ],
    };
   
    var options = {
        scales: {
            yAxes: [
                {
                    ticks: {
                        beginAtZero: true,
                    },
                },
            ],
        },
        legend: {
            display: false,
        },
        elements: {
            point: {
                radius: 0,
            },
        },
    };

    if ($("#barChart").length) {
        var barChartCanvas = $("#barChart").get(0).getContext("2d");
        // This will get the first returned node in the jQuery collection.
        var barChart = new Chart(barChartCanvas, {
            type: "bar",
            data: data,
            options: options,
        });
    }
</script>