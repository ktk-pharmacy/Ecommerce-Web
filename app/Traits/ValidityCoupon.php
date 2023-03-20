<?php

namespace App\Traits;

use App\Model\Coupon;

trait ValidityCoupon
{
    public function checkCoupon($name, $cart_total, $customer_id)
    {
        $coupon = Coupon::with('orders')->valid()->where('name', $name)->get()->first();
        
        if (!$coupon) {
            return response()->error("Sorry! This coupon isn't active yet. Please come back later.", 404);
        }

        //if coupon is define total usage limit and check total used count
        if (!is_null($coupon->limit_per_coupon) && $coupon->limit_per_coupon == count($coupon->orders)) {
            return response()->error("Sorry! This coupon usage limit has been reached.", 404);
        }

        //if coupon is define user usage limit and check coupon count used by current user
        if (!is_null($coupon->limit_per_user)) {
            $currentCustomerOrders = collect($coupon->orders)->where('customer_id', $customer_id);
            if (count($currentCustomerOrders) == $coupon->limit_per_user) {
                return response()->error("Sorry! This coupon is already used.", 404);
            }
        }

        if ($coupon->min_amount > $cart_total) {
            return response()->error("Sorry! Minimum order amount is " . $coupon->min_amount, 404);
        }

        $data['id'] = $coupon->id;
        $data['discount_amount'] = $coupon->amount;
        $data['discount_type'] = $coupon->type;
        $data['discount_total'] = calculateCouponAmount($cart_total, $coupon);

        return response()->success('The coupon code applied successfully.', 200, $data);
    }
}
