<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
        'auberge_id', 'type', 'description', 'quantity', 
        'max_occupancy', 'price_per_night', 'amenities'
    ];
    
    protected $casts = [
        'amenities' => 'array'
    ];
    
    public function auberge()
    {
        return $this->belongsTo(Auberge::class);
    }
}
