<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'name', 'surname',
        'address', 'phone', 'day', 'partday', 'subTotal', 'status',
    ];

    public function setCartDataAttribute($value)
    {
        return $this->attributes['cart_data'] = serialize($value);
    }

    public function getCartDataAttribute($value)
    {
        return unserialize($value);
    }
    // Een op veel (omgekeerd)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    // Een functie voor het bepalen van de bezorgkosten met behulp van een accessor
    public function getShippingCostAttribute($value)
    {
        if($this->partday == '08:00-22:00') {
            $shipping_cost = 4.95;
        }else if($this->partday == '16:00-22:00') {
            $shipping_cost = 6.95;
        }
        else {
            $shipping_cost = 7.50;
        }
        return $shipping_cost;
    }
}
