$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('input[name=service_weekend]').on('change', function () {
        let serviceWeekend = $(this).val();

        $.ajax({
            url: 'extrasCalculate',
            type: 'POST',
            cache: false,
            data: {
                'serviceWeekend': serviceWeekend,
            },
            dataType: 'html',
            beforeSend: function () {
                console.log('Please wait')
            },
            success: function (data) {
                console.log(data)
            }
        });

    });

    $('input[name=carpet]').on('change', function () {
        let carpet = $(this).val();

        $.ajax({
            url: 'extrasCalculate',
            type: 'POST',
            cache: false,
            data: {
                'carpet': carpet,
            },
            dataType: 'html',
            beforeSend: function () {
                console.log('Please wait')
            },
            success: function (data) {
                console.log(data)
            }
        });

    });


    $('input[type=checkbox]').on('change', function () {
        let valueCheckbox = $(this).is(":checked");
        let nameCheckbox = $(this).attr("name");



        $.ajax({
            url: 'extrasCalculate',
            type: 'POST',
            cache: false,
            data: {
                'valueCheckbox': valueCheckbox,
                'nameCheckbox': nameCheckbox,
            },
            dataType: 'html',
            beforeSend: function () {
                console.log('Please wait')
            },
            success: function (data) {

                $('#priceHolder').text((parseFloat(data)).toFixed(2))
                console.log(data);
            }
        });

    })


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