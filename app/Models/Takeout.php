<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Takeout extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone_number'
    ];

    public function takeout_orders(){
        return $this->hasMany(Takeout_Order::class);
    }

    public function takeout_checkout(){
        return $this->hasOne(Takeout_Checkout::class);
    }
}
