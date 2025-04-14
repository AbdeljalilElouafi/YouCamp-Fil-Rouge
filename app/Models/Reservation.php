<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'user_id', 'auberge_id', 'room_id', 'check_in', 'check_out',
        'guests', 'total_price', 'status', 'special_requests'
    ];

    protected $casts = [
        'check_in' => 'date',
        'check_out' => 'date',
        'total_price' => 'decimal:2'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function auberge()
    {
        return $this->belongsTo(Auberge::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
