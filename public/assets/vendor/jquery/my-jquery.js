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
                $('#priceHolder').text('Please wait');
            },
            function (res) {
                $('#priceHolder').text(JSON.parse(res).data);
            }
        );
    }

    // Checkbox
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

    // Radio
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


    // Hide pets total
    $('#none').on('change', function () {
        $('#pets').hide(1000);
    });

    // Show pets total
    $('#dog').on('change', function () {
        $('#pets').show(1000);
    });

    $('#cat').on('change', function () {
        $('#pets').show(1000);
    });

    $('#both').on('change', function () {
        $('#pets').show(1000);
    });

    let photo;

    $('input[type=file]').change(function () {
        photo = this.files;
    });

    // Send delete for photo
    $('button.btn-light').click(function (event) {
        event.preventDefault();
        let idPhoto = $(this).attr("id");

        $.ajax({
            url: 'your_home_photo_delete',
            method: "POST",
            cache: false,
            data: {
                "idPhoto": idPhoto,
                'modelPhoto': modelPhoto
            },
            dataType: 'html',
            beforeSend: function () {
                // Buttons none active
                $("button").prop('disabled', true);
            },
            success: function (data) {
                console.log(data);
                // Reload from cookies
                location.reload();
                // Buttons active
                $("button").prop('disabled', false);

            }
        });
    });

});