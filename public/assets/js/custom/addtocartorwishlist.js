function addToCart(e) {
    let addToCartURL = e.getAttribute("data-add-to-cart-url");
    let getCartItemUrl = $("#get-cart-items-url").val();
    let quantity = $("#cart-quantity").val();

    $.ajax({
        type: "POST",
        url: addToCartURL,
        data: { quantity: quantity ?? 1 },
        success: function (data) {
            if (data.message == "Success") {
                //Header Cart Icon
                $("#cart-count").html(data.carts.total_quantity);
                $(".cart-subtotal").html(data.carts.subtotal);
                //Add To Cart Modal Data
                $("#modal-product-img").attr(
                    "src",
                    data.carts.products[0].feature_image
                );
                $("#modal-product-name").html(data.carts.products[0].name);

                $("#add_to_cart_modal").modal("show");
                $("#quick_view_modal").modal("hide");
                $.ajax({
                    type: "GET",
                    url: getCartItemUrl,
                    success: function (cart_menu) {
                        $(".mini-cart-footer").removeClass("d-none");
                        $("#no-cart-item").addClass("d-none");
                        $(".mini-cart-product-area").html(cart_menu);
                    },
                });
            } else if (data.message == "fail") {
                Toast.fire({
                    icon: "error",
                    title: "Quantity is over limitting!",
                });
            }
            else {
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

function addToWishlist(e) {
    let addToWishlistURL = e.getAttribute("data-add-to-wishlist-url");

    $.ajax({
        type: "POST",
        url: addToWishlistURL,
        success: function (data) {
            if (data.success) {
                $("#add-to-wishlist-msg").html(data.message);
                $("#liton_wishlist_modal").modal("show");
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
