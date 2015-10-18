$(document).on('ready', function () {

    $('.form-control-chosen').chosen({
        placeholder_text: 'Select an option',
        placeholder_text_multiple: ' ',
        width: "100%",
        allow_single_deselect: true
    });

    $('.form-control-datepicker').datepicker({
        format: "yyyy-mm-dd"
    });

    $('.form-control-clockpicker').clockpicker({
        donetext: "Done."
    });
});