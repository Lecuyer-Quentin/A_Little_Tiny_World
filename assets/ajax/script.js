document.addEventListener('DOMContentLoaded', function() {
    const toast_body_success = document.getElementById('toast-body-success');
    const toast_body_error = document.getElementById('toast-body-error');

    $array = [
        'special_add_form', 'special_edit_form', 'special_delete_form',
        'category_add_form', 'category_edit_form', 'category_delete_form',
        'product_add_form', 'product_edit_form', 'product_delete_form',
        'user_add_form', 'user_edit_form', 'user_delete_form', 'edit_password_form',
        'login_form', 'register_form', 'logout_form',
        'favorite_form',
    ];

    $array.forEach(function(item) {
        $(document.getElementById(item)).ready(function() {
            document.getElementById(item).addEventListener('submit', function(e) {
                e.preventDefault();

                const req = $.ajax({
                    type: 'POST',
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    dataType: 'json',
                    encode: true
                });

                req.done(function(data) {
                    if (data.status == 'success') {
                        toast_body_success.innerHTML = data.message;
                        $('#toast-success').toast('show');
                        setTimeout(function() {
                            window.location.href = data.redirect;
                        }, 3000);
                    }
                    if (data.status == 'error') {
                        toast_body_error.innerHTML = data.message;
                        $('#toast-error').toast('show');
                    }
                });

                req.fail(function(jqXhr) {
                    toast_body_error.innerHTML = 'Error: ' + jqXhr.responseText;
                    $('#toast-error').toast('show');
                });
                
            });
        });
    });

});
