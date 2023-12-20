
(function ($) {
    $('.item-quantity').on('change', function () {
        $.ajax({
            url: "/cart/" + $(this).data('id'),
            method: 'put',
            data: {
                quantity: $(this).val(),
                _token: csrf_token
            }
        });
    });

    $('.remove-item').on('click', function () {
        $.ajax({
            url: "/cart/" + $(this).data('id'),
            method: 'delete',
            data: {
                _token: csrf_token
            },
            success: response => {
                 $(this).data('id').remove();
            }
        });
    });
})(JQuery);
