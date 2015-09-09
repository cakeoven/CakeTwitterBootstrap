$(document).on('ready', function () {
    $('.form-control-chosen').each(function () {
        $(this).chosen({
            placeholder_text: 'Select an option',
            placeholder_text_multiple: ' ',
            width: "100%",
            allow_single_deselect: true
        });
    });
});

