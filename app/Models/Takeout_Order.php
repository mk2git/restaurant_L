<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Takeout_Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'takeout_id',
        'menu_id',
        'quantity'
    ];

    public function takeout(){
        return $this->belongsTo(Takeout::class);
    }
    
    public function menu(){
        return $this->belongsTo(Menu::class);
    }

    public function countTakeoutOrders(){
        return $this::where('status', config('takeout_order.cooking'))->distinct()->pluck('takeout_id')->count();
    }
    public function getTakeoutOrderIds(){
        return $this::where('check_status', config('takeout_order.not yet'))->distinct()->get('takeout_id');
    }
    public function getTakeoutOrders(){
        return $this::whereDate('created_at', today())->where('check_status', config('takeout_order.not yet'))->get();
    }
}
