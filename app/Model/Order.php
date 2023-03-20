<?php

namespace App\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_id',
        'coupon_id',
        'delivery_type',
        'delivery_charge',
        'delivery_information_id',
        'order_total',
        'order_note',
        'payment_method',
        'status',
        'cancel_remark'
    ];

    //Payment Methods
    const CASH_ON_DELIVERY = 'cod';
    const WAVE_PAY = 'wave_pay';
    const KBZ_PAY = 'k_pay';
    const AYA_PAY = 'aya_pay';
    const CARD = 'card';

    //Order Status
    const PENDING = 'Pending';
    const PROCESSING = 'Processing';
    const COMPLETED = 'Confirm';
    const DELIVER = 'Deliver';
    const CANCELED = 'Canceled';

    protected $casts = [
        'created_at' => 'datetime:d-M-Y',
        'updated_at' => 'datetime:d-M-Y',
    ];

    public function products()
    {
        return $this->hasMany(OrderProduct::class);
    }

    public function orderProducts()
    {
        return $this->hasMany(OrderProduct::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function group() {
        return $this->belongsTo(CategoryGroup::class);
    }

    public function delivery_information()
    {
        return $this->belongsTo(DeliveryInformation::class);
    }

    public function scopeStatus($query, $status ,$status2 = "")
    {
        if ($status2 == "") {
            return $query->where('status', $status);
        }
        return $query->whereIn('status', [$status,$status2]);
    }

    public function scopeNotEqualStatus($query, $status)
    {
        return $query->where('status', '!=', $status);
    }

    public function getPaymentMethodAttribute($value)
    {
        switch ($value) {
            case 'cod':
                return 'Cash On Delivery';
                break;
            case 'wave_pay':
                return 'Wave Pay';
                break;
            case 'k_pay':
                return 'KBZ Pay';
                break;
            case 'aya_pay':
                return 'Aya Pay';
                break;
            case 'card':
                return 'Card';
                break;
            default:
                return 'Cash On Delivery';
                break;
        }
    }

    public function getCouponAmountAttribute()
    {
        if ($this->coupon) {
            $coupon_amount = $this->coupon->type == 'percent' ? $this->order_total * ($this->coupon->amount/100) : $this->coupon->amount;
            return $coupon_amount;
        }
        return 0;
    }
}
