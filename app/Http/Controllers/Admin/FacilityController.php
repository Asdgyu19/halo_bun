<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Facility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class FacilityController extends Controller
{
    public function index(Request $request)
    {
        $q = Facility::with('user');

        // Search functionality
        if ($request->search) {
            $q->where('name', 'like', '%' . $request->search . '%')
              ->orWhere('address', 'like', '%' . $request->search . '%');
        }

        // Filter by type
        if ($request->type) {
            $q->where('type', $request->type);
        }

        // Filter by city
        if ($request->city) {
            $q->where('city', $request->city);
        }

        $facilities = $q->latest()->paginate(10);
        
        // Get statistics
        $stats = [
            'hospital' => Facility::where('type', 'hospital')->count(),
            'clinic' => Facility::where('type', 'clinic')->count(),
            'pharmacy' => Facility::where('type', 'pharmacy')->count(),
            'laboratory' => Facility::where('type', 'laboratory')->count(),
            'emergency' => Facility::where('type', 'emergency')->count(),
        ];
        
        // Get cities for filter dropdown
        $cities = Facility::distinct()->pluck('city')->filter();

        return view('admin.facilities.index', compact('facilities', 'stats', 'cities'));
    }

    public function create()
    {
        return view('admin.facilities.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:100',
            'description' => 'nullable|string',
            'address' => 'required|string',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email',
            'operating_hours' => 'nullable|string',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'website' => 'nullable|url',
            'image' => 'nullable|image|max:2048',
            'services' => 'nullable|string',
            'is_emergency' => 'boolean',
            'rating' => 'nullable|integer|between:1,5',
            'notes' => 'nullable|string'
        ]);

        $data['user_id'] = Auth::id();

        // Convert services string to array
        if (isset($data['services']) && !empty($data['services'])) {
            $data['services'] = array_map('trim', explode(',', $data['services']));
            $data['services'] = array_filter($data['services']); // Remove empty items
        } else {
            $data['services'] = null;
        }

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('facility-images', 'public');
        }

        Facility::create($data);
        return redirect()->route('admin.facilities.index')->with('success', 'Fasilitas kesehatan berhasil ditambahkan.');
    }

    public function show(Facility $facility)
    {
        return view('admin.facilities.show', compact('facility'));
    }

    public function edit(Facility $facility)
    {
        return view('admin.facilities.edit', compact('facility'));
    }

    public function update(Request $request, Facility $facility)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:100',
            'description' => 'nullable|string',
            'address' => 'required|string',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email',
            'operating_hours' => 'nullable|string',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'website' => 'nullable|url',
            'image' => 'nullable|image|max:2048',
            'services' => 'nullable|string',
            'is_emergency' => 'boolean',
            'rating' => 'nullable|integer|between:1,5',
            'notes' => 'nullable|string'
        ]);

        // Convert services string to array
        if (isset($data['services']) && !empty($data['services'])) {
            $data['services'] = array_map('trim', explode(',', $data['services']));
            $data['services'] = array_filter($data['services']); // Remove empty items
        } else {
            $data['services'] = null;
        }

        if ($request->hasFile('image')) {
            // Hapus image lama jika ada
            if ($facility->image && Storage::disk('public')->exists($facility->image)) {
                Storage::disk('public')->delete($facility->image);
            }
            $data['image'] = $request->file('image')->store('facility-images', 'public');
        }

        $facility->update($data);
        return redirect()->route('admin.facilities.index')->with('success', 'Fasilitas kesehatan berhasil diperbarui.');
    }

    public function destroy(Facility $facility)
    {
        // Hapus image jika ada
        if ($facility->image && Storage::disk('public')->exists($facility->image)) {
            Storage::disk('public')->delete($facility->image);
        }
        
        $facility->delete();
        return back()->with('success', 'Fasilitas kesehatan berhasil dihapus.');
    }
}
