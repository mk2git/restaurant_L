<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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

    public function getTodayOrders(){
        $getOrders = $this::join('checkouts', 'orders.checkout_id', '=', 'checkouts.id')
        ->whereDate('orders.created_at', today())
        ->where('checkouts.check_status', config('check.done'))
        ->get();

        return $getOrders;
      }

    public function countOrders(){
        return $this::whereDate('created_at', today())->where('status', config('order.cooking'))->distinct()->pluck('table_id')->count();
    }
    public function getTableId(){
        return $this::where('check_status', config('order.not yet'))->distinct()->get('table_id');
    }
    public function getOrders(){
        return $this::whereDate('created_at', today())->where('check_status', config('order.not yet'))->get();
    }

    function getThisMonthOrders()
        {
            $startDate = getThisMonthStartDay();
            $endDate = getThisMonthEndDay();

            return Order::whereBetween('created_at', [$startDate, $endDate])->get();
        }

    public function getLastMonthOrders(){
        $startDateLastMonth = getLastMonthStartDay();
        $endDateLastMonth = getLastMonthEndDay();

        return Order::whereBetween('created_at', [$startDateLastMonth, $endDateLastMonth])->get();
      }

    public function getYesterdayOrders(){
        return $this::whereDate('created_at', \Carbon\Carbon::yesterday())->get();
    }
    public function topThreeOrderQuantity(){
        return $this::select('menu_id', DB::raw('SUM(quantity) as total_quantity'))->groupBy('menu_id')
         ->orderByDesc('total_quantity')
         ->take(3)
         ->get();
    }
    public function topThreeOrderPrice(){
        return $this::select('menu_id', DB::raw('SUM(quantity * menus.price) as total_amount'), DB::raw('SUM(quantity) as total_quantity'))
        ->join('menus', 'orders.menu_id', '=', 'menus.id')
        ->groupBy('menu_id')
        ->orderByDesc('total_amount')
        ->take(3)
        ->get();
    }
}
