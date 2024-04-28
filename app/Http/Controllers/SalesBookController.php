<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Category;
use App\Models\Menu;
use App\Models\Takeout_Order;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class SalesBookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $todayOrders = Order::whereDate('created_at', today())->get();
        $today_table_total = 0;
        if($todayOrders){
            foreach($todayOrders as $todayOrder){
            $today_table_total += $todayOrder->quantity * $todayOrder->menu->price;
        }
        }else{
            $today_table_total = 0;
        }
        
        $todayTakeoutOrders = Takeout_Order::whereDate('created_at', today())->get();
        $today_takeout_total = 0;
        if($todayTakeoutOrders){
            foreach($todayTakeoutOrders as $todayTakeoutOrder){
            $today_takeout_total += $todayTakeoutOrder->quantity * $todayTakeoutOrder->menu->price;
        }
        }else{
            $today_takeout_total = 0;
        }
        $todayTotal = 0;
        $todayTotal = $today_table_total + $today_takeout_total;
        $menus = Menu::all();
        // $data['total'] = 0;
        // $data['orders'] = [];
        //  foreach($menus as $k => $menu){
        //     foreach($todayOrders as $order ){
        //          $data['orders'][$k]['name'] = $menu->name;
        //             if($order->menu_id == $menu->id){
                        
        //                 $data['orders'][$k]['count'] = $order->quantity;
        //             dump($data['orders'][$k]['name']);
        //             dump($data['orders'][$k]['count']);
        //             }else{
        //                 $data['orders'][$k]['count'] = 0;
        //             }
                    
                    
    
        //         }
            // dump($data['orders'][$k]['count']);
        // }
        
        // dd($data);
        $categories = Category::all();
        // 今月の最初の日を取得
        $startDate = Carbon::now()->startOfMonth();
        // 今月の最後の日を取得
        $endDate = Carbon::now()->endOfMonth();
        // 今月の範囲内の注文データを取得
        $thisMonthTableOrders = Order::whereBetween('created_at', [$startDate, $endDate])->get();
        $thisMonthTotalTableOrders = 0;
        if($thisMonthTableOrders){
            foreach($thisMonthTableOrders as $thisMonthTableOrder){
                $thisMonthTotalTableOrders += $thisMonthTableOrder->quantity * $thisMonthTableOrder->menu->price;
            }
        }else{
            $thisMonthTotalTableOrders = 0;
        }
        // 今月のテイクアウト注文データ
        $thisMonthTakeoutOrders = Takeout_Order::whereBetween('created_at', [$startDate, $endDate])->get();
        $thisMonthTotalTakeoutOrders = 0;
        if($thisMonthTakeoutOrders){
            foreach($thisMonthTakeoutOrders as $thisMonthTakeoutOrder){
                $thisMonthTotalTakeoutOrders += $thisMonthTakeoutOrder->quantity * $thisMonthTakeoutOrder->menu->price;
            }
        }else{
            $thisMonthTotalTakeoutOrders = 0;
        }
        // 今月のtotal
        $thisMonthTotalOrders = 0;
        $thisMonthTotalOrders = $thisMonthTotalTableOrders + $thisMonthTotalTakeoutOrders;
        

        // 先月の最初の日を取得
        $startDateLastMonth = Carbon::now()->subMonth()->startOfMonth();
        // 先月の最後の日を取得
        $endDateLastMonth = Carbon::now()->subMonth()->endOfMonth();
        $lastMonthTableOrders = Order::whereBetween('created_at', [$startDateLastMonth, $endDateLastMonth])->get();
        $lastMonthTotalTableOrders = 0;
        if($lastMonthTableOrders){
            foreach($lastMonthTableOrders as $lastMonthTableOrder){
                $lastMonthTotalTableOrders += $lastMonthTableOrder->quantity * $lastMonthTableOrder->menu->price;
            }
        }else{
            $lastMonthTotalTableOrders = 0;
        }

        $lastMonthTakeoutOrders = Takeout_Order::whereBetween('created_at', [$startDateLastMonth, $endDateLastMonth])->get();
        $lastMonthTotalTakeoutOrders = 0;
        if($lastMonthTakeoutOrders){
            foreach($lastMonthTakeoutOrders as $lastMonthTakeoutOrder){
                $lastMonthTotalTakeoutOrders += $lastMonthTakeoutOrder->quantity * $lastMonthTakeoutOrder->menu->price;
            }
        }else{
            $lastMonthTotalTakeoutOrders = 0;
        }
        // 先月のtotal
        $lastMonthTotalOrders = 0;
        $lastMonthTotalOrders = $lastMonthTotalTableOrders + $lastMonthTotalTakeoutOrders;


        // 昨日の注文のtotal
        $yesterdayTableOrders = Order::whereDate('created_at', \Carbon\Carbon::yesterday())->get();
        $yesterdayTotalTableOrders = 0;
        if($yesterdayTableOrders){
            foreach($yesterdayTableOrders as $yesterdayTableOrder){
                 $yesterdayTotalTableOrders += $yesterdayTableOrder->quantity * $yesterdayTableOrder->menu->price;
            }
        }else{
            $yesterdayTotalTableOrders = 0;
        }
        $yesterdayTakeoutOrders = Takeout_Order::whereDate('created_at', \Carbon\Carbon::yesterday())->get();
        $yesterdayTotalTakeoutOrders = 0;
        if( $yesterdayTakeoutOrders){
            foreach( $yesterdayTakeoutOrders as  $yesterdayTakeoutOrder){
                $yesterdayTotalTakeoutOrders +=  $yesterdayTakeoutOrder->quantity *  $yesterdayTakeoutOrder->menu->price;
            }
        }else{
            $yesterdayTotalTakeoutOrders = 0;
        }
        $yesterdayTotal = 0;
        $yesterdayTotal = $yesterdayTotalTableOrders + $yesterdayTotalTakeoutOrders;

        // 今日の注文total
        $todayTableOrders = Order::whereDate('created_at',today())->get();
        $todayTotalTableOrders = 0;
        if($todayTableOrders){
            foreach($todayTableOrders as $todayTableOrder){
                 $todayTotalTableOrders += $todayTableOrder->quantity * $todayTableOrder->menu->price;
            }
        }else{
            $todayTotalTableOrders = 0;
        }
        $todayTakeoutOrders = Takeout_Order::whereDate('created_at', today())->get();
        $todayTotalTakeoutOrders = 0;
        if($todayTakeoutOrders){
            foreach($todayTakeoutOrders as $todayTakeoutOrder){
                $todayTotalTakeoutOrders +=  $todayTakeoutOrder->quantity *  $todayTakeoutOrder->menu->price;
            }
        }else{
            $todayTotalTakeoutOrders = 0;
        }
        $todayTotal = 0;
        $todayTotal = $todayTotalTableOrders + $todayTotalTakeoutOrders;
// dd($yesterdayTotal);

        // 数量ランキング
        $table_orders = Order::all();
        $table_top_three_orders_q = Order::select('menu_id', DB::raw('SUM(quantity) as total_quantity'))
            ->groupBy('menu_id')
            ->orderByDesc('total_quantity')
            ->take(3)
            ->get();
        $takeout_top_three_orders_q = Takeout_Order::select('menu_id', DB::raw('SUM(quantity) as total_quantity'))
        ->groupBy('menu_id')
        ->orderByDesc('total_quantity')
        ->take(3)
        ->get();

        // 金額ランキング
        $table_top_three_prices = Order::select('menu_id', DB::raw('SUM(quantity * menus.price) as total_amount'), DB::raw('SUM(quantity) as total_quantity'))
        ->join('menus', 'orders.menu_id', '=', 'menus.id')
        ->groupBy('menu_id')
        ->orderByDesc('total_amount')
        ->take(3)
        ->get();
        $takeout_top_three_prices = Takeout_Order::select('menu_id', DB::raw('SUM(quantity * menus.price) as total_amount'), DB::raw('SUM(quantity) as total_quantity'))
        ->join('menus', 'takeout__orders.menu_id', '=', 'menus.id')
        ->groupBy('menu_id')
        ->orderByDesc('total_amount')
        ->take(3)
        ->get();

        //  $sbc = new SalesBookController();
        // $sbc->index();
        return view('sales-book.index', compact('todayTotal','todayOrders', 'today_table_total', 'todayTakeoutOrders', 'today_takeout_total', 'categories', 'menus', 'thisMonthTotalTableOrders', 'thisMonthTotalTakeoutOrders', 'lastMonthTotalTableOrders', 'lastMonthTotalTakeoutOrders', 'thisMonthTotalOrders', 'lastMonthTotalOrders', 'yesterdayTotal', 'todayTotal', 'table_top_three_orders_q', 'takeout_top_three_orders_q', 'table_top_three_prices', 'takeout_top_three_prices'));
    }

}
