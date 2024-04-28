<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checkout extends Model
{
    use HasFactory;

    protected $fillable = [
        'table_id'
    ];

    public function table(){
        return $this->belongsTo(Table::class);
    }

    public function countCheckouts(){
        return $this::where('check_status', config('check.not yet'))->distinct()->pluck('table_id')->count();
    }

    
}
