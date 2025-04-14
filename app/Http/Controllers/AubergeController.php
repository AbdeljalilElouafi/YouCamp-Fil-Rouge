<?php

namespace App\Http\Controllers;

use App\Models\Auberge;
use App\Models\Service;
use App\Models\Tag;
use App\Models\Region;
use App\Models\Ville;
use App\Http\Requests\AubergeRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class AubergeController extends Controller
{

    use AuthorizesRequests;

    public function index()
    {
        $auberges = Auberge::with(['manager', 'services', 'tags', 'featuredPhoto'])
            ->where('is_active', true)
            ->latest()
            ->get();
    
        return view('auberges.index', compact('auberges'));
    }

    public function managerAuberges()
    {
        $user = Auth::user();
        $auberges = Auberge::with(['manager', 'services', 'tags', 'featuredPhoto', 'photos'])
            ->where('manager_id', $user->id)
            ->latest()
            ->get();

        return response()->json($auberges);
    }

    public function show(Auberge $auberge)
    {
        $auberge->load(['manager', 'services', 'tags', 'photos', 'rooms', 'featuredPhoto', 'region', 'city']);
        return view('auberges.show', compact('auberge'));
    }

    public function store(AubergeRequest $request)
    {
        $data = $request->validated();
        $data['manager_id'] = auth()->id(); 
        $data['city'] = Ville::find($request->city_id)->name;
        
        $auberge = Auberge::create($data);
        
        if ($request->has('services')) {
            $auberge->services()->sync($request->services);
        }
        
        if ($request->has('tags')) {
            $auberge->tags()->sync($request->tags);
        }
        
        return redirect()->route('auberges.show', $auberge)
            ->with('success', 'Auberge created successfully');
    }

    public function update(AubergeRequest $request, Auberge $auberge)
    {
        $this->authorize('update', $auberge);
        
        $data = $request->validated();
        $data['city'] = Ville::find($request->city_id)->name;
        
        $auberge->update($data);
        
        if ($request->has('services')) {
            $auberge->services()->sync($request->services);
        }
        
        if ($request->has('tags')) {
            $auberge->tags()->sync($request->tags);
        }
        
        return redirect()->route('auberges.show', $auberge)
            ->with('success', 'Auberge updated successfully');
    }

    public function destroy(Auberge $auberge)
    {
        $this->authorize('delete', $auberge);
        
        $auberge->delete();
        
        return response()->json(null, 204);
    }

    public function toggleFeatured(Auberge $auberge)
    {
        $this->authorize('update', $auberge);
        
        $auberge->update(['is_featured' => !$auberge->is_featured]);
        
        return response()->json(['is_featured' => $auberge->is_featured]);
    }

    public function toggleActive(Auberge $auberge)
    {
        $this->authorize('update', $auberge);
        
        $auberge->update(['is_active' => !$auberge->is_active]);
        
        return response()->json(['is_active' => $auberge->is_active]);
    }


    public function create()
    {
        $services = Service::all();
        $tags = Tag::all();
        $regions = Region::all();
        $cities = collect(); 
        
        
        if (isset($auberge) && $auberge->region_id) {
            $cities = Ville::where('region_id', $auberge->region_id)->get();
        }
        
        return view('auberges.form', compact('services', 'tags', 'regions', 'cities'));
    }

    public function edit(Auberge $auberge)
    {
        $this->authorize('update', $auberge);
        
        $services = Service::all();
        $tags = Tag::all();
        $regions = Region::all();
        $cities = Ville::where('region_id', $auberge->region_id)->get();
        
        return view('auberges.form', compact('auberge', 'services', 'tags', 'regions', 'cities'));
    }

    public function myAuberges()
    {
        $auberges = Auth::user()->auberges()
            ->with(['services', 'tags', 'featuredPhoto', 'photos'])
            ->latest()
            ->get();
    
        return view('auberges.my', compact('auberges'));
    }


}