$(document).ready(function () {
    var flag = true
    $('.button-download-idea').on('click', function () {
        var idea_id = $(this).data('id')
        if (!flag){
            return false
        }
        $.ajax({
            type: 'GET',
            url: `/download-idea/${idea_id}`,
            data: {id: idea_id},
            beforeSend: function () {
                flag = false
            },
            success: function (data) {
                flag = true
            }
        })
    })
})
