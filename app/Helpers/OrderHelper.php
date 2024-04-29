<?php
  use App\Models\Order;
  use Carbon\Carbon;

  if(!function_exists('getTodayOrders')){
       function getTodayOrders(){
      return Order::whereDate('created_at', today())->get();
    }
   }

   if(!function_exists('getLastMonthOrders')){
      function getLastMonthOrders(){
        $startDateLastMonth = Carbon::now()->subMonth()->startOfMonth();
        $endDateLastMonth = Carbon::now()->subMonth()->endOfMonth();

        return Order::whereBetween('created_at', [$startDateLastMonth, $endDateLastMonth])->get();
      }
   }
   
    