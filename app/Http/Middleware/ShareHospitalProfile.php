<?php

namespace App\Http\Middleware;

use App\Models\HospitalProfile;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpFoundation\Response;

class ShareHospitalProfile
{
    public function handle(Request $request, Closure $next): Response
    {
        $hospitalProfile = HospitalProfile::first();
        View::share('hospitalProfile', $hospitalProfile);
        
        return $next($request);
    }
}