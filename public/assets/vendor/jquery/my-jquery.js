$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function sendMyAjax(data, onBeforeSend, onSuccess) {
        $.ajax({
            url: 'extrasCalculate',
            type: 'POST',
            cache: false,
            data: {
                data//1
            },
            dataType: 'html',
            beforeSend: function () {
                onBeforeSend()//1
            },
            success: function (data) {
                onSuccess(data)//1
            }
        });
    }

    function updateExtras() {
        const extrasData = {
            //checkbox
            'inside_fridge': $('#inside_fridge').is(':checked') ? 1 : 0,
            'inside_oven': $('#inside_oven').is(':checked') ? 1 : 0,
            'garage_swept': $('#garage_swept').is(':checked') ? 1 : 0,
            'blinds_cleaning': $('#blinds_cleaning').is(':checked') ? 1 : 0,
            'laundry_wash_dry': $('#laundry_wash_dry').is(':checked') ? 1 : 0,
            //radio
            'service_weekend': $('#weekend_yes').is(':checked') ? 1 : 0,
            'carpet': $('#carpet_yes').is(':checked') ? 1 : 0
        };

        sendMyAjax(
            extrasData,
            function () {
                console.log('beforeSend: ', extrasData);
            },
            function (res) {
                console.log('onSuccess: ', res);
            }
        );
    }

    //checkbox
    $('#inside_fridge').on('change', function () {
        updateExtras();
    });
    $('#inside_oven').on('change', function () {
        updateExtras();
    });
    $('#garage_swept').on('change', function () {
        updateExtras();
    });
    $('#blinds_cleaning').on('change', function () {
        updateExtras();
    });
    $('#laundry_wash_dry').on('change', function () {
        updateExtras();
    });

    //radio
    $('#weekend_yes').on('change', function () {
        updateExtras();
    });
    $('#carpet_yes').on('change', function () {
        updateExtras();
    });

    $('#weekend_no').on('change', function () {
        updateExtras();
    });
    $('#carpet_no').on('change', function () {
        updateExtras();
    });


    // $('input[name=service_weekend]').on('change', function () {
    //
    //     let serviceWeekend = $(this).val();//1
    //
    //     $.ajax({//++
    //         url: 'extrasCalculate',
    //         type: 'POST',
    //         cache: false,
    //         data: {
    //             'serviceWeekend': serviceWeekend,//1
    //         },
    //         dataType: 'html',
    //         beforeSend: function () {
    //             console.log('Please wait')//1
    //         },
    //         success: function (data) {
    //             console.log(data)//1
    //
    //         }
    //     });
    // });


    // $('input[type=radio], input[type=checkbox]').on('change', function () {
    //     return false;
    //     let carpet = $('input[name=carpet]:checked').val();
    //     let serviceWeekend = $('input[name=service_weekend]:checked').val();
    //
    //     let insideFridge = $('input[name=inside_fridge]').prop('checked');
    //
    //
    //
    //     // let carpetkey = $(this).attr('name');
    //
    //     $.ajax({
    //         url: 'extrasCalculate',
    //         type: 'POST',
    //         cache: false,
    //         data: {
    //             'carpet': carpet,
    //             // 'serviceWeekend': serviceWeekend,
    //             // nameCheckbox: valueCheckbox,
    //             'inside_fridge': insideFridge
    //         },
    //         dataType: 'html',
    //         beforeSend: function () {
    //             console.log(insideFridge )
    //         },
    //         success: function (data) {
    //              console.log(data)
    //         }
    //     });
    //
    // });


    //
    //
    // $('input[type=checkbox]').on('change', function () {
    //     let valueCheckbox = $(this).is(":checked");
    //     let nameCheckbox = $(this).attr("name");
    //
    //     $.ajax({
    //         url: 'extrasCalculate',
    //         type: 'POST',
    //         cache: false,
    //         data: {
    //             'valueCheckbox': valueCheckbox,
    //             'nameCheckbox': nameCheckbox,
    //         },
    //         dataType: 'html',
    //         beforeSend: function () {
    //             console.log('Please wait')
    //         },
    //         success: function (data) {
    //
    //             $('#priceHolder').text((parseFloat(data)).toFixed(2))
    //             console.log(data);
    //         }
    //     });
    //
    // })


    // console.log('Hello')
    // var name;
    // name = $('input[name=service_weekend]:checked').val();
    //
    // axios.post('/api/extras_json', {name: name})
    //     .then(response => {
    //                    document.getElementById('priceHolder').innerHTML = response.data
    //     });
    // .catch(error => console.log(error));


    // var basePrice = parseFloat($('#priceHolder').text());
    // // console.log(basePrice);
    // //
    // // '#priceForm'
    // $('input[name=service_weekend]', '#priceForm').on('change', function () {
    //     $.post('/extras_json', {
    //             serviceWeekend: $('input[name=service_weekend]:checked').val()
    //         },
    //         function (data) {
    //             var web = data == 50 ? 50 : 0;
    //
    //             $('#priceHolder').text((basePrice + parseFloat(web)).toFixed(2))
    //         });
    // });


});