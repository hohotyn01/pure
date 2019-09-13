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


    // jQuery start Upload
    $(function () {
        var ul = $('#upload ul');

        $('#drop a').click(function () {
            // Click simulation file selection field
            $(this).parent().find('input').click();
        });

        // Initialization File Upload plugin
        $('#upload').fileupload({

            // This item will accept files dragged onto it
            dropZone: $('#drop'),

            // The function will be called when the file is queued
            add: function (e, data) {

                var tpl = $(
                    '<li><input type="text" value="0" data-width="48" data-height="48"' +
                    ' data-fgColor="#0788a5" data-readOnly="1" data-bgColor="#3e4043" />' +
                    '<p></p><span></span></li>'
                );

                // Output file name and size
                tpl.find('p').text(data.files[0].name)
                    .append('<i>' + formatFileSize(data.files[0].size) + '</i>');

                data.context = tpl.appendTo(ul);

                //  Initialization jQuery Knob plugin
                tpl.find('input').knob();

                // Track usage of cancel button
                tpl.find('span').click(function () {

                    if (tpl.hasClass('working')) {
                        jqXHR.abort();
                    }

                    tpl.fadeOut(function () {
                        tpl.remove();
                    });

                });

                // File is automatically loaded when added to the queue
                var jqXHR = data.submit();
            },

            progress: function (e, data) {

                // Download Percentage Calculation
                var progress = parseInt(data.loaded / data.total * 100, 10);

                // Update the scale
                data.context.find('input').val(progress).change();

                if (progress == 100) {
                    data.context.removeClass('working');
                }
            },

            fail: function (e, data) {
                // Error
                data.context.addClass('error');
            }
        });

        $(document).on('drop dragover', function (e) {
            e.preventDefault();
        });

        // вспомогательная функция, которая форматирует размер файла
        function formatFileSize(bytes) {
            if (typeof bytes !== 'number') {
                return '';
            }

            if (bytes >= 1000000000) {
                return (bytes / 1000000000).toFixed(2) + ' GB';
            }

            if (bytes >= 1000000) {
                return (bytes / 1000000).toFixed(2) + ' MB';
            }

            return (bytes / 1000).toFixed(2) + ' KB';
        }
    });

});