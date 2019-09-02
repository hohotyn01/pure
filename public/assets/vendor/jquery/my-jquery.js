$(document).ready(function () {

    // $('input[name=service_weekend]', '#priceForm').on('change', function () {
    //     alert($('input[name=service_weekend]:checked', '#priceForm' ).val());
    // });

var basePrice = parseFloat($('#priceHolder').text());
console.log(basePrice);
    // '#priceForm'
    $('input[name=service_weekend]', '#priceForm').on('change', function () {
        $.post("/assets/vendor/jquery/calculate.php", {

                serviceWeekend: $('input[name=service_weekend]:checked').val()
            },

            function (data) {
            var web = data == 50 ? 50: 0;

                    $('#priceHolder').text((basePrice + parseFloat(web)).toFixed(2))
            });

    });


});