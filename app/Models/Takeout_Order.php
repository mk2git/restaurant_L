<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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
        return $this::whereDate('created_at', today())->where('status', config('takeout_order.cooking'))->distinct()->pluck('takeout_id')->count();
    }
    public function getTakeoutOrderIds(){
        return $this::where('check_status', config('takeout_order.not yet'))->distinct()->get('takeout_id');
    }
    public function getTakeoutOrders(){
        return $this::whereDate('created_at', today())->where('check_status', config('takeout_order.not yet'))->get();
    }

    public function getTodayTakeoutOrders(){
        return $this::whereDate('created_at', today())->get();
    }
    public function getThisMonthTakeoutOrders(){
        $startDate = getThisMonthStartDay();
        $endDate = getThisMonthEndDay();

        return $this::whereBetween('created_at', [$startDate, $endDate])->get();
    }
    public function getLastMonthTakeoutOrders(){
        $startDateLastMonth = getLastMonthStartDay();
        $endDateLastMonth = getLastMonthEndDay();

        return $this::whereBetween('created_at', [$startDateLastMonth, $endDateLastMonth])->get();
    }
    public function getYesterdayTakeoutOrders(){
        return $this::whereDate('created_at', \Carbon\Carbon::yesterday())->get();
    }
    public function topThreeTakeoutOrderQuantity(){
        return $this::select('menu_id', DB::raw('SUM(quantity) as total_quantity'))
        ->groupBy('menu_id')
        ->orderByDesc('total_quantity')
        ->take(3)
        ->get();
    }
    public function topThreeTakeoutOrderPrice(){
        return $this::select('menu_id', DB::raw('SUM(quantity * menus.price) as total_amount'), DB::raw('SUM(quantity) as total_quantity'))
        ->join('menus', 'takeout__orders.menu_id', '=', 'menus.id')
        ->groupBy('menu_id')
        ->orderByDesc('total_amount')
        ->take(3)
        ->get();
    }
}
