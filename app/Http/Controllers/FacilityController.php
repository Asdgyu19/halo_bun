<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use Illuminate\Http\Request;

class FacilityController extends Controller
{
    public function index(Request $request)
    {
        $query = Facility::where('status', 'published');
        
        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('address', 'LIKE', "%{$search}%")
                  ->orWhere('city', 'LIKE', "%{$search}%")
                  ->orWhere('district', 'LIKE', "%{$search}%")
                  ->orWhere('services', 'LIKE', "%{$search}%");
            });
        }
        
        // Filter by type
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }
        
        // Filter by city
        if ($request->filled('city')) {
            $query->where('city', $request->city);
        }
        
        // Filter by verified status
        if ($request->filled('verified') && $request->verified == 'yes') {
            $query->where('is_verified', true);
        }
        
        // Filter by 24 hours
        if ($request->filled('hours_24') && $request->hours_24 == 'yes') {
            $query->where('is_24_hours', true);
        }
        
        // Filter by emergency
        if ($request->filled('emergency') && $request->emergency == 'yes') {
            $query->where('is_emergency', true);
        }
        
        // Sort by distance if coordinates provided
        if ($request->filled('lat') && $request->filled('lng')) {
            $facilities = $query->get()->map(function ($facility) use ($request) {
                if ($facility->latitude && $facility->longitude) {
                    $facility->distance = $this->calculateDistance(
                        $request->lat,
                        $request->lng,
                        $facility->latitude,
                        $facility->longitude
                    );
                } else {
                    $facility->distance = 999; // Large number for facilities without coordinates
                }
                return $facility;
            })->sortBy('distance');
            
            $facilities = new \Illuminate\Pagination\LengthAwarePaginator(
                $facilities->forPage($request->get('page', 1), 12),
                $facilities->count(),
                12,
                $request->get('page', 1),
                ['path' => request()->url(), 'query' => request()->query()]
            );
        } else {
            $facilities = $query->latest()->paginate(12);
        }
        
        // Get unique cities for filter dropdown
        $cities = Facility::where('status', 'published')
                          ->distinct()
                          ->pluck('city')
                          ->filter()
                          ->sort()
                          ->values();
        
        // Get facility types for filter
        $types = [
            'hospital' => 'Rumah Sakit',
            'clinic' => 'Klinik',
            'pharmacy' => 'Apotek',
            'laboratory' => 'Laboratorium',
            'emergency' => 'UGD'
        ];
        
        return view('front.facilities.index', compact('facilities', 'cities', 'types'));
    }
    
    public function show(Facility $facility)
    {
        // Get nearby facilities based on distance (10km radius)
        $nearbyFacilities = collect();
        
        if ($facility->latitude && $facility->longitude) {
            $nearbyFacilities = Facility::where('id', '!=', $facility->id)
                ->where('status', 'published')
                ->get()
                ->filter(function ($nearbyFacility) use ($facility) {
                    if (!$nearbyFacility->latitude || !$nearbyFacility->longitude) {
                        return false;
                    }
                    
                    $distance = $this->calculateDistance(
                        $facility->latitude,
                        $facility->longitude,
                        $nearbyFacility->latitude,
                        $nearbyFacility->longitude
                    );
                    
                    return $distance <= 10; // 10km radius
                })
                ->sortBy(function ($nearbyFacility) use ($facility) {
                    return $this->calculateDistance(
                        $facility->latitude,
                        $facility->longitude,
                        $nearbyFacility->latitude,
                        $nearbyFacility->longitude
                    );
                })
                ->take(6);
        }
        
        return view('front.facilities.show', compact('facility', 'nearbyFacilities'));
    }
    
    private function calculateDistance($lat1, $lon1, $lat2, $lon2)
    {
        $earthRadius = 6371; // Earth's radius in kilometers
        
        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);
        
        $a = sin($dLat / 2) * sin($dLat / 2) +
             cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
             sin($dLon / 2) * sin($dLon / 2);
        
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        
        return $earthRadius * $c;
    }
}