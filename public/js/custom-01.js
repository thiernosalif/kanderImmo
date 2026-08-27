var DataTable;

$(function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    if ($("#dt_colVis").length) {
        DataTable = $("#dt_colVis").DataTable({
            retrieve: true
        });

        $('body').on('ajax:success', '.destroy-btn', function (e, data, status, xhr) {

            $('.dt_colVis_buttons').append('<button id="suppress-notification" style="display: none;" class="md-btn" ' +
                'data-message="<a href=\'#\' id=\'clear-suppress-notification\' class=\'notify-action\'><i class=\'uk-icon-times uk-text-contrast\'></i></a>' +
                data + '" ' +
                'data-status="success"' +
                'data-pos="top-center">' + '</button>');

            setTimeout(function() {
                $( "#suppress-notification" ).trigger( "click" );
            }, 200);
            setTimeout(function() {
                $( "#clear-suppress-notification" ).trigger( "click" );
            }, 5000);

            /* retirer la ligne */
            DataTable.row($(e.target).closest('tr')).remove().draw();
        });

        $('body').on('ajax:error', '.destroy-btn', function (e, data, status, xhr) {

            $('.dt_colVis_buttons').append('<button id="suppress-notification" style="display: none;" class="md-btn" ' +
                'data-message="<a href=\'#\' id=\'clear-suppress-notification\' class=\'notify-action\'><i class=\'uk-icon-times uk-text-contrast\'></i></a>' +
                data.responseText + '" ' +
                'data-status="danger"' +
                'data-pos="top-center">' + '</button>');

            setTimeout(function() {
                $( "#suppress-notification" ).trigger( "click" );
            }, 200);
            setTimeout(function() {
                $( "#clear-suppress-notification" ).trigger( "click" );
            }, 5000);

        });
    }

    $('form').on('focus', 'input[type=number]', function (e) {
        $(this).on('mousewheel.disableScroll', function (e) {
            e.preventDefault()
        })
    });
    $('form').on('blur', 'input[type=number]', function (e) {
        $(this).off('mousewheel.disableScroll')
    });

});