<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Reserve extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'time',
        'adult',
        'kid',
        'name',
        'phone_number'
    ];

    public function todayReserves(){
        return $this::orderBy('time', 'asc')->whereDate('date', today())->get();
    }

    public function getAscReserves(){
        return $this::whereDate('date', '>=', Carbon::today())->orderBy('date', 'asc')->orderBy('time', 'asc')->get();
    }
    public function getAscDates(){
        return $this::whereDate('date', '>=', Carbon::today())->orderBy('date', 'asc')->distinct()->pluck('date');
    }
}
