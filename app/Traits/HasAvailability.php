<?php


namespace App\Traits;

trait HasAvailability
{
    public function isAvailable($checkIn, $checkOut)
    {
        return !$this->reservations()
            ->where(function($query) use ($checkIn, $checkOut) {
                $query->whereBetween('check_in', [$checkIn, $checkOut])
                      ->orWhereBetween('check_out', [$checkIn, $checkOut]);
            })
            ->where('status', '!=', 'cancelled')
            ->exists();
    }
}