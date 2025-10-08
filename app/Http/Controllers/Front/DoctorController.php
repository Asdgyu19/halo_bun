<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\Consultation;
use Illuminate\Support\Facades\Auth;

class DoctorController extends Controller
{
    // ✅ Tampilkan daftar dokter
    public function index()
    {
        $doctors = Doctor::all();
        return view('front.doctors.index', compact('doctors'));
    }

    // ✅ Simpan konsultasi (pertanyaan user ke dokter)
    public function consult(Request $request)
    {
        $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'message'   => 'required|string|max:1000',
        ]);

        Consultation::create([
            'user_id'   => Auth::id(),
            'doctor_id' => $request->doctor_id,
            'message'   => $request->message,
        ]);

        return back()->with('ok', 'Pertanyaan berhasil dikirim ke dokter.');
    }
}
