<?php

namespace App\Http\Controllers;

use App\Models\HospitalProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class HospitalProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $profile = HospitalProfile::first();
        
        if (!$profile) {
            // Jika belum ada data, redirect ke form create
            return redirect()->route('admin.profile.edit');
        }
        
        return view('admin.profile', compact('profile'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        $profile = HospitalProfile::first();
        
        if (!$profile) {
            // Jika belum ada data, buat instance kosong
            $profile = new HospitalProfile();
        }
        
        return view('admin.profile-edit', compact('profile'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        Log::info('Updating hospital profile');
        
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'phone' => 'required|string|max:50',
            'email' => 'required|email|max:255',
            'description' => 'required|string',
            'vision' => 'required|string',
            'mission' => 'required|string',
            'history' => 'required|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'facebook' => 'nullable|url|max:255',
            'instagram' => 'nullable|url|max:255',
            'tiktok' => 'nullable|url|max:255',
            'youtube' => 'nullable|url|max:255',
        ]);

        try {
            $profile = HospitalProfile::first();
            
            if (!$profile) {
                // Jika belum ada data, buat baru
                $profile = new HospitalProfile();
            }

            $profile->name = $request->name;
            $profile->address = $request->address;
            $profile->phone = $request->phone;
            $profile->email = $request->email;
            $profile->description = $request->description;
            $profile->vision = $request->vision;
            $profile->mission = $request->mission;
            $profile->history = $request->history;
            $profile->facebook = $request->facebook;
            $profile->instagram = $request->instagram;
            $profile->tiktok = $request->tiktok;
            $profile->youtube = $request->youtube;

            // Handle logo upload
            if ($request->hasFile('logo')) {
                Log::info('Logo file detected');
                
                // Delete old logo if exists
                if ($profile->logo) {
                    Storage::disk('public')->delete($profile->logo);
                }
                
                $logoPath = $request->file('logo')->store('hospital', 'public');
                $profile->logo = $logoPath;
                Log::info('Logo stored at: ' . $logoPath);
            }

            $profile->save();
            Log::info('Hospital profile updated successfully');

            return redirect()->route('admin.profile')->with('success', 'Profil rumah sakit berhasil diperbarui.');

        } catch (\Exception $e) {
            Log::error('Error updating hospital profile: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }
}