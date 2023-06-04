<!-- All JS Plugins -->
<script src="{{ asset('assets/theme/js/plugins.js') }}"></script>

<script src="{{ asset('assets/theme/js/main.js') }}"></script>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).on('click', '.change-language', function() {
        var url = $(this).attr('data-url');
        console.log(url)
        $.ajax({
            url: url,
            type: "POST",
            success: function(data) {
                window.location.reload(true);
            }
        });
    });
</script>

@include('frontend.layouts.shared.toastr-message')
<!-- Custom JS -->
<script src="{{ asset('assets/js/custom/addtocartorwishlist.js') }}"></script>
<script src="{{ asset('assets/js/custom/removefromcartorwishlist.js') }}"></script>
<script src="{{ asset('assets/js/custom/quickview.js') }}"></script>
<script src="{{ asset('assets/js/custom/order_detail_view.js') }}"></script>
