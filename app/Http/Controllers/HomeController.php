<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Service;
use App\Models\Testimonial;
use App\Models\Article;
use App\Models\Gallery;
use App\Models\HospitalProfile;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $hospitalProfile;

    public function __construct()
    {
        // Load hospital profile once for all methods
        $this->hospitalProfile = HospitalProfile::first();
    }

    public function index()
    {
        $doctors = Doctor::with('schedules')->where('status', 'active')->limit(3)->get();
        $services = Service::where('status', 'active')->limit(6)->get();
        $testimonials = Testimonial::approved()->latest()->limit(3)->get();
        
        return view('home', [
            'hospitalProfile' => $this->hospitalProfile,
            'doctors' => $doctors,
            'services' => $services,
            'testimonials' => $testimonials
        ]);
    }

    public function about()
    {
        return view('about', ['hospitalProfile' => $this->hospitalProfile]);
    }

    public function services()
    {
        $services = Service::where('status', 'active')->get();
        return view('services', [
            'hospitalProfile' => $this->hospitalProfile,
            'services' => $services
        ]);
    }

    public function doctors()
    {
        $doctors = Doctor::with('schedules')->where('status', 'active')->get();
        return view('doctors', [
            'hospitalProfile' => $this->hospitalProfile,
            'doctors' => $doctors
        ]);
    }

    public function news()
    {
        $articles = Article::published()->latest()->get();
        return view('news', [
            'hospitalProfile' => $this->hospitalProfile,
            'articles' => $articles
        ]);
    }

    public function gallery()
    {
        $galleries = Gallery::latest()->get();
        return view('gallery', [
            'hospitalProfile' => $this->hospitalProfile,
            'galleries' => $galleries
        ]);
    }

    public function testimonials()
    {
        $testimonials = Testimonial::approved()->latest()->get();
        return view('testimonials', [
            'hospitalProfile' => $this->hospitalProfile,
            'testimonials' => $testimonials
        ]);
    }

    public function contact()
    {
        return view('contact', ['hospitalProfile' => $this->hospitalProfile]);
    }
}