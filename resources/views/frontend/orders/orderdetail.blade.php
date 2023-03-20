<!-- WISHLIST AREA START -->
<div class="row w-100">
    <div class="col-12">
        <div class="row w-100">
            <div class='col-6'>
                <p class="mb-2 "><span class=""><strong>Items from Order #</strong><span
                            class="">{{ $order->id }} - {{ $order->status }} </span></p>
            </div>
            <div class="col-6 text-end d-print-none">
                <a href="javascript:window.print()"
                    class="btn btn-sm py-1 rounded-1 btn-primary waves-effect waves-light mx-0"> Print</a>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Item</th>
                        <th>Name</th>
                        <th style="width: 10%">Price</th>
                        <th style="width: 10%">QTY</th>
                        <th style="width: 10%">Subtotal</th>
                        <th style="width: 10%">Discount</th>
                        <th style="width: 10%" class="text-right">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->products as $key => $order_product)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>
                                <img src="{{ $order_product->product->feature_image }}" alt="" width="50"
                                    class="img-fluid img-thumbnail">
                            </td>
                            <td><small><b>{{ $order_product->product->name }}</b></small> </td>
                            <td class="text-center">{{ $order_product->sale_price }}</td>
                            <td class="text-center">{{ $order_product->quantity }}</td>
                            <td class="text-center">{{ $order_product->sale_price * $order_product->quantity }}</td>
                            <td class="text-center">{{ $order_product->discount_total }}</td>
                            <td class="text-end">{{ $order_product->order_product_total }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="">
            <div class=" mb-1 px-2">
                <p class="mb-1"><b>Sub-total: </b> <span class="float-end">{{ $order->order_total }}</span></p>
                @if ($order->coupon)
                    <p><b>Coupon ({{ $order->coupon->name }}):</b> <span class="float-end"> &nbsp;&nbsp;&nbsp;
                            -{{ $order->coupon_amount }}</span></p>
                @endif
                <p class="mb-1"><b>Delivery Charge: </b> <span class="float-end"> {{ $order->delivery_charge==Null?0:$order->delivery_charge; }}</span></p>
                <p class="float-end mb-1"><b>{{ $order->order_total + $order->delivery_charge - $order->coupon_amount }}
                        MMK</b></p>
            </div>
        </div>
    </div>
</div>
<!-- WISHLIST AREA START -->
