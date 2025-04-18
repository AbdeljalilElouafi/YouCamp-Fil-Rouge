<?php


namespace App\Http\Controllers\Visitor;

use App\Http\Controllers\Controller;
use App\Models\Auberge;


class HomeController extends Controller
{
    public function index()
    {
        $featuredAuberges = Auberge::where('is_featured', true)
            ->where('is_active', true)
            ->with(['city', 'featuredPhoto'])
            ->take(3)
            ->get();

        $availableAuberges = Auberge::where('is_active', true)
            ->with(['city', 'featuredPhoto'])
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get();


        return view('visitor.home', [
            'featuredAuberges' => $featuredAuberges,
            'availableAuberges' => $availableAuberges,
        ]);
    }
}
