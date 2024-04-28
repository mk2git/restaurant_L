<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'menu_id',
        'table_id',
        'quantity'
    ];

    public function menu(){
        return $this->belongsTo(Menu::class);
    }

    public function table(){
        return $this->belongsTo(Table::class);
    }

    public function countOrders(){
        return $this::where('status', config('order.cooking'))->distinct()->pluck('table_id')->count();
    }
}
