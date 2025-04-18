<?php

use Illuminate\Support\Facades\Route;
use App\Models\Region;

Route::get('/regions/{region}/villes', function (Region $region) {
    return $region->villes;
});