@if ($message = Session::get('success'))
<script>
    $.NotificationApp.send("Well Done!", "{{ $message }}", 'top-right', '#5ba035', 'success');
</script>
@endif

@if ($message = Session::get('error'))
<script>
    $.NotificationApp.send("Oh snap!", "{{ $message }}", 'top-right', '#bf441d', 'error');
</script>
@endif

@if ($message = Session::get('warning'))
<script>
    $.NotificationApp.send("Heads up!", "{{ $message }}", 'top-center', '#da8609', 'warning');
</script>
@endif

@if ($message = Session::get('info'))
<script>
    $.NotificationApp.send("Heads up!", "{{ $message }}", 'top-right', '#3b98b5', 'info');
</script>
@endif

@if ($errors->any())
<script>
    $.NotificationApp.send("Heads up!", "{{ $message }}", 'top-right', '#3b98b5', 'info');
</script>
@endif