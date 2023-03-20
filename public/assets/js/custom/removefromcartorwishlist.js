function removeCart(e) {
    let removeCartURL = e.getAttribute("data-remove-cart-url");
    let getCartItemUrl = $("#get-cart-items-url").val();
    $.ajax({
        type: "POST",
        url: removeCartURL,
        success: function (data) {
            if (data.message == "Success") {
                $("#cart-count").html(data.carts.total_quantity);
                $(".cart-subtotal").html(data.carts.subtotal);

                if (data.carts.products.length == 0) {
                    $(".mini-cart-footer").addClass("d-none");
                    $("#no-cart-item").removeClass("d-none");
                }
                $.ajax({
                    type: "GET",
                    url: getCartItemUrl,
                    success: function (cart_menu) {
                        $(".mini-cart-product-area").html(cart_menu);
                    },
                });
            } else {
                Toast.fire({
                    icon: "error",
                    title: "Something want wrong!",
                });
            }
        },
        error: function (data) {
            Toast.fire({
                icon: "error",
                title: "Something want wrong!",
            });
        },
    });
}

function removeViewCart(e) {
    let removeCartURL = e.getAttribute("data-remove-cart-url");
    $.ajax({
        type: "POST",
        url: removeCartURL,
        success: function (data) {
            if (data.message == "Success") {
                if (data.carts.products.length) {
                    e.parentNode.remove();
                } else {
                    $(".liton__shoping-cart-area").addClass("d-none");
                    $(".no-cart-action-area").removeClass("d-none");
                }

                Toast.fire({
                    icon: "success",
                    title: "Successfully removed!",
                    timer: 1000,
                }).then(() => window.location.reload());
            } else {
                Toast.fire({
                    icon: "error",
                    title: "Something want wrong!",
                });
            }
        },
        error: function (data) {
            Toast.fire({
                icon: "error",
                title: "Something want wrong!",
            });
        },
    });
}

function removeWishlist(e) {
    let removeWishlistURL = e.getAttribute("data-remove-wishlist-url");
    $.ajax({
        type: "POST",
        url: removeWishlistURL,
        success: function (data) {
            if (data.message == "Success") {
                if (data.wishlist_count) {
                    e.parentNode.remove();
                } else {
                    $(".liton__wishlist-area").addClass("d-none");
                    $(".no-wishlist-action-area").removeClass("d-none");
                }
                Toast.fire({
                    icon: "success",
                    title: "Successfully removed!",
                    timer: 1000,
                }).then(() => window.location.reload());
            } else {
                Toast.fire({
                    icon: "error",
                    title: "Something want wrong!",
                });
            }
        },
        error: function (data) {
            Toast.fire({
                icon: "error",
                title: "Something want wrong!",
            });
        },
    });
}
