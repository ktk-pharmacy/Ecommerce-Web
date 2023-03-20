$(".order-detail-view-btn").on("click",function (e) {
    e.preventDefault();

    let orderDetailViewUrl = $(this).data('order-detail-view-url');
    $.ajax({
        type: "Post",
        url: orderDetailViewUrl,
        success: function (response) {
            const to_show = ['#delivery_detail','#container']

            $('#original_table').hide();// Orders table

            to_show.forEach(element => {
                $(element).show();
            });

            $('#container').html(response);
        },
        error: function(response){
            Toast.fire({
                icon: "error",
                title: "Something want wrong!",
            });
        }
    });
})

//all orders click event
$('#orders').on('click',function () {
    const to_hide = ['#delivery_detail','#container']

    $('#original_table').show();// Orders table

    to_hide.forEach(element => {
        $(element).hide();
    });
});
