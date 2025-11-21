<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Service;
use App\Models\Article;
use App\Models\Gallery;
use App\Models\Testimonial;
use App\Models\HospitalProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard()
    {
        // Statistics
        $totalDoctors = Doctor::count();
        $totalServices = Service::count();
        $totalArticles = Article::count();
        $totalTestimonials = Testimonial::count();
        $pendingTestimonials = Testimonial::where('status', 'pending')->count();
        $totalGalleries = Gallery::count();

        // Recent Activities
        $recentActivities = $this->getRecentActivities();

        // Recent data for quick overview
        $recentDoctors = Doctor::with('schedules')->latest()->limit(3)->get();
        $recentTestimonials = Testimonial::with('doctor')->latest()->limit(3)->get();
        $recentArticles = Article::latest()->limit(3)->get();

        return view('admin.dashboard', compact(
            'totalDoctors',
            'totalServices',
            'totalArticles',
            'totalTestimonials',
            'pendingTestimonials',
            'totalGalleries',
            'recentActivities',
            'recentDoctors',
            'recentTestimonials',
            'recentArticles'
        ));
    }

    private function getRecentActivities()
    {
        $activities = collect();

        // Recent doctors (last 7 days)
        $recentDoctors = Doctor::where('created_at', '>=', Carbon::now()->subDays(7))
            ->latest()
            ->get()
            ->map(function ($doctor) {
                return [
                    'type' => 'doctor',
                    'icon' => 'fa-user-md',
                    'color' => 'success',
                    'message' => 'Data dokter ' . $doctor->name . ' ditambahkan',
                    'time' => $doctor->created_at,
                    'url' => route('admin.doctors.edit', $doctor->id)
                ];
            });

        // Recent testimonials (last 7 days)
        $recentTestimonials = Testimonial::where('created_at', '>=', Carbon::now()->subDays(7))
            ->latest()
            ->get()
            ->map(function ($testimonial) {
                $statusColor = $testimonial->status === 'approved' ? 'success' : 
                             ($testimonial->status === 'pending' ? 'warning' : 'danger');
                $statusText = $testimonial->status === 'approved' ? 'disetujui' : 
                            ($testimonial->status === 'pending' ? 'menunggu' : 'ditolak');
                
                return [
                    'type' => 'testimonial',
                    'icon' => 'fa-comments',
                    'color' => $statusColor,
                    'message' => 'Testimoni dari ' . $testimonial->patient_name . ' ' . $statusText,
                    'time' => $testimonial->created_at,
                    'url' => route('admin.testimonials')
                ];
            });

        // Recent articles (last 7 days)
        $recentArticles = Article::where('created_at', '>=', Carbon::now()->subDays(7))
            ->latest()
            ->get()
            ->map(function ($article) {
                $statusColor = $article->status === 'published' ? 'success' : 'secondary';
                $statusText = $article->status === 'published' ? 'dipublikasikan' : 'draft';
                
                return [
                    'type' => 'article',
                    'icon' => 'fa-newspaper',
                    'color' => $statusColor,
                    'message' => 'Artikel "' . $article->title . '" ' . $statusText,
                    'time' => $article->created_at,
                    'url' => route('admin.news.edit', $article->id)
                ];
            });

        // Recent gallery uploads (last 7 days)
        $recentGalleries = Gallery::where('created_at', '>=', Carbon::now()->subDays(7))
            ->latest()
            ->get()
            ->map(function ($gallery) {
                return [
                    'type' => 'gallery',
                    'icon' => 'fa-images',
                    'color' => 'info',
                    'message' => 'Foto "' . $gallery->title . '" ditambahkan ke galeri',
                    'time' => $gallery->created_at,
                    'url' => route('admin.gallery')
                ];
            });

        // Merge all activities
        $activities = $activities->merge($recentDoctors)
            ->merge($recentTestimonials)
            ->merge($recentArticles)
            ->merge($recentGalleries);

        // Sort by time and get latest 10
        return $activities->sortByDesc('time')->take(10);
    }

    public function profile()
    {
        $profile = HospitalProfile::first();
        return view('admin.profile', compact('profile'));
    }
}