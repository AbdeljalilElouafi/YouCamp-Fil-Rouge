<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasAvailability;

class Auberge extends Model
{
    use HasFactory, HasAvailability;

    protected $fillable = [
        'name', 'description', 'address', 'region_id', 'city_id', 
        'latitude', 'longitude', 'phone', 'email', 'website',
        'capacity', 'price_per_night', 'is_featured', 'is_active', 'manager_id'
    ];

    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

    public function services()
    {
        return $this->belongsToMany(Service::class);
    }

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function photos()
    {
        return $this->hasMany(AubergePhoto::class);
    }

    public function featuredPhoto()
    {
        return $this->hasOne(AubergePhoto::class)->where('is_featured', true);
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function ville()
    {
        return $this->belongsTo(Ville::class, 'city_id');
    }
    
    public function city()
    {
        return $this->belongsTo(Ville::class, 'city_id');
    }
    
}
