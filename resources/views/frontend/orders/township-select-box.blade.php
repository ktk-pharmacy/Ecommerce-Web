    <div class="input-item">
        <h6>Township</h6>
        <select class="nice-select" name="township" id="township_select">
            <option>Select Township</option>
            @foreach ($logistics as $logistic)
                <option
                value="{{ $logistic->township->id }}"
                data-get-delivery-charge-url="{{ route('frontend.delivery_charge',$logistic->id) }}">{{ $logistic->township->name }}</option>
            @endforeach
        </select>
    </div>
    <script>
        $(document).ready(function () {
            $("select").niceSelect();
        });
    </script>
