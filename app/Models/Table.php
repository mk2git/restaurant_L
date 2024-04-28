<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    use HasFactory;

    protected $fillable = [
        'seat_type',
        'seat_number'
    ];

    public function orders(){
        return $this->hasMany(Order::class);
    }

    public function checkout(){
        return $this->hasOne(Checkout::class);
    }
}
