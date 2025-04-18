<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AubergePhoto extends Model
{
    protected $fillable = ['auberge_id', 'path', 'is_featured'];
    
    public function auberge()
    {
        return $this->belongsTo(Auberge::class);
    }
}
