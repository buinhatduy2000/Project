$(document).ready(function () {
    // var flag = true
    // $('.button-download-idea').on('click', function () {
    //     var idea_id = $(this).data('id')
    //     if (!flag){
    //         return false
    //     }
    //     $.ajax({
    //         type: 'GET',
    //         url: `/download-idea/${idea_id}`,
    //         data: {id: idea_id},
    //         beforeSend: function () {
    //             flag = false
    //         },
    //         success: function (data) {
    //             flag = true
    //         }
    //     })
    // })

    $('.form-add').submit(function(e) {
        e.preventDefault();
        $.ajax({
            method: 'POST',
            url: "/category",
            data: $(this).serialize(),
            success: function(msg) {
                $("#success").text(msg.success).show();
                setTimeout(function() {
                    $("#success").slideUp(500, function() {
                        $(this).remove();
                    });
                }, 3000)
                $('.error-create-name').text('')
                $('.error-create-date').text('')
                $('#newModal').modal('hide')
            },
            error: function(error) {
                if (error.status == 422) {
                    var data = error.responseJSON;
                }
                $('.error-create-name').text(data.errors.category_name ?? '')
                $('.error-create-date').text(data.errors.category_date ?? '')
            }
        });
    })

    $('.form-edit').submit(function(e) {
        e.preventDefault();
        var id = $(this).data('id')
        $.ajax({
            method: 'PUT',
            url: `/category/${id}`,
            data: $(this).serialize(),
            success: function(msg) {
                $("#success").text(msg.success).show();
                setTimeout(function() {
                    $("#success").slideUp(500, function() {
                        $(this).remove();
                    });
                    window.location.reload()
                }, 3000)
                $('.error-edit-name').text('')
                $('.error-edit-date').text('')
                $(`#editModal${id}`).modal('hide')
            },
            error: function(error) {
                if (error.status == 422) {
                    var data = error.responseJSON;
                }
                $('.error-edit-name').text(data.errors.category_name ?? '')
                $('.error-edit-date').text(data.errors.category_date ?? '')
            }
        });
    })
})
