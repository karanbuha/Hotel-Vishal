$(document).ready(function() {
    $('.qty_min').click(function() {
        var input = $(this).siblings('.qty_val');
        var currentVal = parseInt(input.val());
        if (!isNaN(currentVal) && currentVal > 0) {
            input.val(currentVal - 1);
        }
    });

    $('.qty_plus').click(function() {
        var input = $(this).siblings('.qty_val');
        var currentVal = parseInt(input.val());
        var maxVal = parseInt(input.attr('max'));
        if (!isNaN(currentVal) && currentVal < maxVal) {
            input.val(currentVal + 1);
        }
    });
});