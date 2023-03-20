
    <select class="form-control" name="township" id="township_select" required>
        <option value="">Select Township</option>
        @foreach ($logistics as $logistic)
            <option
            value="{{ $logistic->township->id }}"
            data-get-delivery-charge-url="{{ route('admin.orders.delivery.detail',$logistic->id) }}">{{ $logistic->township->name }}</option>
        @endforeach
    </select>
