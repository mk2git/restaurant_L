<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Takeout_Checkout extends Model
{
    use HasFactory;

    protected $fillable = [
        'takeout_id'
    ];

    public function takeout(){
        return $this->belongsTo(Takeout::class);
    }

    public function countTakeoutCheckouts(){
        return $this::where('check_status', config('takeout_checkout.not yet'))->distinct()->pluck('takeout_id')->count();
    }
}
