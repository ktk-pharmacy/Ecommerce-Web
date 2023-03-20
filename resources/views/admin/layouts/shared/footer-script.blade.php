<!-- bundle -->
<!-- Vendor js -->
<script src="{{asset('assets/js/vendor.min.js')}}"></script>

<!-- Form Modal js -->
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    //For Delete
    $(document).on('show.bs.modal','#deleteFormModal', function (e) {
        addUrl(e, '#deleteFormAction');
    });
    //For Restore
    $(document).on('show.bs.modal','#restoreFormModal', function (e) {
        addUrl(e, '#restoreFormAction');
    });

    function addUrl(e, modalName) {
        var button = $(e.relatedTarget);
        var url = button.data('url');
        $(modalName).attr('action', url);
    }

    $(document).on('click', '#change-language', function () {
        var url = $(this).attr('data-url');
        $.ajax({
            url: url,
            type:"POST",
            success:function(data){
                window.location.reload(true);
            }
        });
    })
</script>

@yield('script')
<!-- App js -->
<script src="{{asset('assets/js/app.min.js')}}"></script>
<script src="https://cdn.datatables.net/buttons/1.0.3/js/buttons.colVis.js"></script>
@yield('script-bottom')
