<?php
  use App\Models\Order;
  use Carbon\Carbon;


   if(!function_exists('getLastMonthStartDay')){
      function getLastMonthStartDay(){      
        return $startDateLastMonth = Carbon::now()->subMonth()->startOfMonth();
      }
   }
   if(!function_exists('getLastMonthAndDay')){
    function getLastMonthEndDay(){
      return $endDateLastMonth = Carbon::now()->subMonth()->endOfMonth();
    }
 }

   if(!function_exists('getThisMonthStartDay')){
      function getThisMonthStartDay()
        {
           return $startDate = Carbon::now()->startOfMonth();
        }
   }
   if(!function_exists('getThisMonthEndDay')){
    function getThisMonthEndDay()
      {
         return $endDate = Carbon::now()->endOfMonth();
      }
 }
   
    