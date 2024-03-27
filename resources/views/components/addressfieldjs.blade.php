<script  type="text/javascript">
        $(document).ready(function () {

            $('#country').on('change', function () {
                var countryId = $(this).val();
                $("#state-dd").html('');
                $.ajax({
                    url: "{{url('admin/customers/fetch_state')}}",
                    type: "POST",
                    data: {
                        country_id: countryId,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (result) {
                        $('#state-dd').html('<option value="">Select State</option>');
                        $.each(result.states, function (key, value) {
                            $("#state-dd").append('<option value="' + value
                                .id + '">' + value.name + '</option>');
                        });
                    }
                });
            });
            $('#state-dd').on('change', function () {
                var stateId = $(this).val();
                $("#city-dd").html('');
                $.ajax({
                    url: "{{url('admin/customers/fetch_city')}}",
                    type: "POST",
                    data: {
                        state_id: stateId,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (result) {
                        $('#city-dd').html('<option value="">Select City</option>');
                        $.each(result.cities, function (key, value) {
                            $("#city-dd").append('<option value="' + value
                                .id + '">' + value.name + '</option>');
                        });
                    }
                });
            });
            $('#city-dd').on('change', function () {
                var cityId = $(this).val();
                $("#township-dd").html('');
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
                    }
                });
            });
            $('#township-dd').on('change', function () {
                var townshipId = $(this).val();
                $("#ward-dd").html('');
                $.ajax({
                    url: "{{url('admin/customers/fetch_ward')}}",
                    type: "POST",
                    data: {
                        township_id: townshipId,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (res) {
                        $('#ward-dd').html('<option value="">Select Street</option>');
                        $.each(res.wards, function (key, value) {
                            $("#ward-dd").append('<option value="' + value
                                .id + '">' + value.name + '</option>');
                        });
                    }
                });
            });
            $('#ward-dd').on('change', function () {
                var wardId = $(this).val();
                $("#street-dd").html('');
                $.ajax({
                    url: "{{url('admin/customers/fetch_street')}}",
                    type: "POST",
                    data: {
                        ward_id: wardId,
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
             $('#package').on('change', function () {
                var packageData = $(this).val().split(" ");
                var original_price=packageData[2];
                var promotion=packageData[1];
                var price=original_price-(original_price*promotion/100);
                document.getElementById("promotion").value = promotion;
                document.getElementById("original_price").value = original_price;
                document.getElementById("price").value = price;
            });
        });
</script>
