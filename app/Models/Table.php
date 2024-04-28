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

    public function totalSeats(){
        return $this::all()->count();
    }
    public function unusedSeats(){
        return $this::where('status', config('table.未使用'))->count();
    }
    public function usingSeats(){
        return $this::where('status', config('table.使用中'))->count();
    }
    public function getOrderTables()
    {
        $table_ids = Order::where('check_status', config('order.not yet'))->distinct()->get('table_id');

        return $this::whereIn('id', $table_ids)->select('id', 'seat_type', 'seat_number')->get();
    }
}
