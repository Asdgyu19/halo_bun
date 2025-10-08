<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Facility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class FacilityController extends Controller
{
    public function index(Request $request)
    {
        $query = Facility::where('is_verified', true);

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('address', 'LIKE', "%{$search}%")
                  ->orWhere('description', 'LIKE', "%{$search}%");
            });
        }

        // Filter by type
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        // Filter by city
        if ($request->filled('city')) {
            $query->where('city', 'LIKE', "%{$request->city}%");
        }

        // Filter by emergency services
        if ($request->filled('emergency')) {
            $query->where('is_emergency', true);
        }

        // Filter by 24 hours
        if ($request->filled('h24')) {
            $query->where('is_24_hours', true);
        }

        // Location-based search (sort by distance if lat/lng provided)
        if ($request->filled(['lat', 'lng'])) {
            $userLat = $request->lat;
            $userLng = $request->lng;
            
            // Add distance calculation using Haversine formula
            $query->selectRaw("
                facilities.*,
                (6371 * acos(cos(radians(?)) * cos(radians(latitude)) * cos(radians(longitude) - radians(?)) + sin(radians(?)) * sin(radians(latitude)))) AS distance
            ", [$userLat, $userLng, $userLat])
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->orderBy('distance', 'asc');
        } else {
            // Sort facilities normally
            switch ($request->get('sort', 'latest')) {
                case 'name':
                    $query->orderBy('name', 'asc');
                    break;
                case 'rating':
                    $query->orderBy('rating', 'desc');
                    break;
                case 'oldest':
                    $query->oldest();
                    break;
                default:
                    $query->latest();
                    break;
            }
        }

        $facilities = $query->paginate(12);
        
        // Get filter options
        $types = Facility::where('is_verified', true)
                        ->distinct()
                        ->pluck('type')
                        ->filter()
                        ->sort()
                        ->unique()
                        ->values();
        
        $cities = Facility::where('is_verified', true)
                         ->distinct()
                         ->pluck('city')
                         ->filter()
                         ->sort()
                         ->unique()
                         ->values();

        // Get popular facilities (highest rated)
        $popularFacilities = Facility::where('is_verified', true)
                                   ->where('rating', '>', 4.0)
                                   ->orderBy('rating', 'desc')
                                   ->limit(6)
                                   ->get();

        return view('front.facilities.index', compact('facilities', 'types', 'cities', 'popularFacilities'));
    }

    public function show(Facility $facility)
    {
        // Only show verified facilities
        if (!$facility->is_verified) {
            abort(404);
        }

        // Get nearby facilities (same city and type)
        $nearbyFacilities = Facility::where('is_verified', true)
            ->where('id', '!=', $facility->id)
            ->where(function($query) use ($facility) {
                $query->where('city', $facility->city)
                      ->orWhere('type', $facility->type);
            })
            ->limit(6)
            ->get();

        return view('front.facilities.show', compact('facility', 'nearbyFacilities'));
    }
}
