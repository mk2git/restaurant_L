<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        return $this::orderBy('date', 'asc')->orderBy('time', 'asc')->get();
    }
    public function getAscDates(){
        return $this::orderBy('date', 'asc')->distinct()->pluck('date');
    }
}
