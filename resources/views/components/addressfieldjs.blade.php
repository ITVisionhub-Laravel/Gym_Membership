<script  type="text/javascript">
        $(document).ready(function () {
        
            $('#city').on('change', function () {
                var cityId = $(this).val();
                $("#township-dd").html('');
                $("#street-dd").html('');
                $.ajax({
                    url: "{{url('admin/customers/fetch_township')}}",
                    type: "POST",
                    data: {
                        city_id: cityId,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (result) {
                        $('#township-dd').html('<option value="">Select Township</option>');
                        $.each(result.townships, function (key, value) {
                            $("#township-dd").append('<option value="' + value
                                .id + '">' + value.name + '</option>');
                        });
                        $('#city-dd').html('<option value="">Select City</option>');
                    }
                });
            });
            $('#township-dd').on('change', function () {
                var townshipId = $(this).val();
                $("#street-dd").html('');
                $.ajax({
                    url: "{{url('admin/customers/fetch_street')}}",
                    type: "POST",
                    data: {
                        township_id: townshipId,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (res) {
                        $('#street-dd').html('<option value="">Select Street</option>');
                        $.each(res.streets, function (key, value) {
                            $("#street-dd").append('<option value="' + value
                                .id + '">' + value.name + '</option>');
                        });
                    }
                });
            });
             $('#package-dd').on('change', function () {
                var packageData = $(this).val().split(" ");
                var original_price=packageData[2];
                var promotion=packageData[1];
                var price=original_price-(original_price*promotion/100);
                // alert(price);
                document.getElementById("promotion").value = promotion;
                document.getElementById("original_price").value = original_price;
                document.getElementById("price").value = price;
            });
        });
</script>