<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Category;
use App\Models\Menu;
use App\Models\Takeout_Order;

class SalesBookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $order = new Order();
        $takeout_order = new Takeout_Order();
        $todayOrders = $order->getTodayOrders();
        
        $today_table_total = 0;
        if($todayOrders){
            foreach($todayOrders as $todayOrder){
            $today_table_total += $todayOrder->quantity * $todayOrder->menu->price;
        }
        }else{
            $today_table_total = 0;
        }
        
        $todayTakeoutOrders =  $takeout_order->getTodayTakeoutOrders();
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

        // 今月の範囲内の注文データを取得
        $thisMonthTableOrders = getThisMonthOrders();
        $thisMonthTotalTableOrders = 0;
        if($thisMonthTableOrders){
            foreach($thisMonthTableOrders as $thisMonthTableOrder){
                $thisMonthTotalTableOrders += $thisMonthTableOrder->quantity * $thisMonthTableOrder->menu->price;
            }
        }else{
            $thisMonthTotalTableOrders = 0;
        }
        // 今月のテイクアウト注文データ
        $thisMonthTakeoutOrders = $takeout_order->getThisMonthTakeoutOrders();
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
        

        $lastMonthTableOrders = getLastMonthOrders();
        $lastMonthTotalTableOrders = 0;
        if($lastMonthTableOrders){
            foreach($lastMonthTableOrders as $lastMonthTableOrder){
                $lastMonthTotalTableOrders += $lastMonthTableOrder->quantity * $lastMonthTableOrder->menu->price;
            }
        }else{
            $lastMonthTotalTableOrders = 0;
        }

        $lastMonthTakeoutOrders = $takeout_order->getLastMonthTakeoutOrders();
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
        $yesterdayTableOrders = $order->getYesterdayOrders();
        $yesterdayTotalTableOrders = 0;
        if($yesterdayTableOrders){
            foreach($yesterdayTableOrders as $yesterdayTableOrder){
                 $yesterdayTotalTableOrders += $yesterdayTableOrder->quantity * $yesterdayTableOrder->menu->price;
            }
        }else{
            $yesterdayTotalTableOrders = 0;
        }
        $yesterdayTakeoutOrders = $takeout_order->getYesterdayTakeoutOrders();
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
        $todayTableOrders = $order->getTodayOrders();
        $todayTotalTableOrders = 0;
        if($todayTableOrders){
            foreach($todayTableOrders as $todayTableOrder){
                 $todayTotalTableOrders += $todayTableOrder->quantity * $todayTableOrder->menu->price;
            }
        }else{
            $todayTotalTableOrders = 0;
        }
        $todayTakeoutOrders = $takeout_order->getTodayTakeoutOrders();
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
        $table_top_three_orders_q = $order->topThreeOrderQuantity();
        $takeout_top_three_orders_q = $takeout_order->topThreeTakeoutOrderQuantity();

        // 金額ランキング
        $table_top_three_prices = $order->topThreeOrderPrice();
        $takeout_top_three_prices = $takeout_order->topThreeTakeoutOrderPrice();

        //  $sbc = new SalesBookController();
        // $sbc->index();
        return view('sales-book.index', compact('todayTotal','todayOrders', 'today_table_total', 'todayTakeoutOrders', 'today_takeout_total', 'categories', 'menus', 'thisMonthTotalTableOrders', 'thisMonthTotalTakeoutOrders', 'lastMonthTotalTableOrders', 'lastMonthTotalTakeoutOrders', 'thisMonthTotalOrders', 'lastMonthTotalOrders', 'yesterdayTotal', 'todayTotal', 'table_top_three_orders_q', 'takeout_top_three_orders_q', 'table_top_three_prices', 'takeout_top_three_prices'));
    }

}
