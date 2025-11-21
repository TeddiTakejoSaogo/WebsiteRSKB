<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Testimonial;
use Illuminate\Support\Facades\Log;

class TestimonialController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['store']);
    }

    // Public method untuk submit testimoni
    /**
 * Store a newly created resource in storage.
 */
    public function store(Request $request)
    {
        $request->validate([
            'patient_name' => 'required|string|max:255',
            'patient_email' => 'required|email',
            'message' => 'required|string|min:10|max:1000',
            'rating' => 'required|integer|between:1,5'
        ], [
            'patient_name.required' => 'Nama lengkap wajib diisi',
            'patient_email.required' => 'Email wajib diisi',
            'patient_email.email' => 'Format email tidak valid',
            'message.required' => 'Pesan testimoni wajib diisi',
            'message.min' => 'Pesan testimoni minimal 10 karakter',
            'message.max' => 'Pesan testimoni maksimal 1000 karakter',
            'rating.required' => 'Rating wajib dipilih',
            'rating.between' => 'Rating harus antara 1-5 bintang'
        ]);

        try {
            Testimonial::create([
                'patient_name' => $request->patient_name,
                'patient_email' => $request->patient_email,
                'message' => $request->message,
                'rating' => $request->rating,
                'status' => 'pending'
            ]);

            return redirect()->route('testimonials')
                ->with('success', 'Terima kasih! Testimoni Anda telah berhasil dikirim dan sedang menunggu persetujuan admin.');

        } catch (\Exception $e) {
            Log::error('Error storing testimonial: ' . $e->getMessage());
            
            return redirect()->route('testimonials')
                ->with('error', 'Maaf, terjadi kesalahan. Silakan coba lagi.')
                ->withInput();
        }
    }

    // Admin methods
    public function index()
    {
        $pendingTestimonials = Testimonial::pending()->latest()->get();
        $approvedTestimonials = Testimonial::approved()->latest()->get();
        
        return view('admin.testimonials', compact('pendingTestimonials', 'approvedTestimonials'));
    }

    public function approve($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        $testimonial->status = 'approved';
        $testimonial->save();

        return redirect()->back()->with('success', 'Testimoni berhasil disetujui.');
    }

    public function reject($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        $testimonial->status = 'rejected';
        $testimonial->save();

        return redirect()->back()->with('success', 'Testimoni berhasil ditolak.');
    }

    public function destroy($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        $testimonial->delete();

        return redirect()->back()->with('success', 'Testimoni berhasil dihapus.');
    }
}