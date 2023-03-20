$(".quick-view-btn").on("click", function (e) {
    e.preventDefault();

    let quickViewUrl = $(this).data("quick-view-url");

    $.ajax({
        type: "POST",
        url: quickViewUrl,
        success: function (data) {
            $("#quick-view-modal-content").html(data);
            $("#quick_view_modal").modal("show");
        },
        error: function (data) {
            Toast.fire({
                icon: "error",
                title: "Something want wrong!",
            });
        },
    });
});
