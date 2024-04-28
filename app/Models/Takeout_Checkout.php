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
}
