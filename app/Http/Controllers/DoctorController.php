<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\DoctorSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class DoctorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Doctor::with('schedules');
        
        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('specialization', 'like', '%' . $request->search . '%');
        }
        
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }
        
        $doctors = $query->get();
        
        return view('admin.doctors', compact('doctors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.doctors-create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Log::info('Doctor store method called');
        Log::info('Request data:', $request->all());

        $request->validate([
            'name' => 'required|string|max:255',
            'specialization' => 'required|string|max:255',
            'education' => 'required|string',
            'description' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'experience' => 'nullable|string',
            'schedules.*.day' => 'sometimes|required|string',
            'schedules.*.start_time' => 'sometimes|required|date_format:H:i',
            'schedules.*.end_time' => 'sometimes|required|date_format:H:i|after:schedules.*.start_time',
        ]);

        try {
            $doctor = new Doctor();
            $doctor->name = $request->name;
            $doctor->specialization = $request->specialization;
            $doctor->education = $request->education;
            $doctor->description = $request->description;
            $doctor->experience = $request->experience;
            $doctor->status = 'active';

            // Handle photo upload
            if ($request->hasFile('photo')) {
                Log::info('Photo file detected');
                $photoPath = $request->file('photo')->store('doctors', 'public');
                $doctor->photo = $photoPath;
                Log::info('Photo stored at: ' . $photoPath);
            }

            $doctor->save();
            Log::info('Doctor saved with ID: ' . $doctor->id);

            // Handle schedules
            if ($request->has('schedules')) {
                foreach ($request->schedules as $scheduleData) {
                    if (!empty($scheduleData['day']) && !empty($scheduleData['start_time']) && !empty($scheduleData['end_time'])) {
                        DoctorSchedule::create([
                            'doctor_id' => $doctor->id,
                            'day' => $scheduleData['day'],
                            'start_time' => $scheduleData['start_time'],
                            'end_time' => $scheduleData['end_time']
                        ]);
                        Log::info('Schedule created for doctor: ' . $doctor->id);
                    }
                }
            }

            return redirect()->route('admin.doctors')->with('success', 'Data dokter berhasil ditambahkan.');

        } catch (\Exception $e) {
            Log::error('Error creating doctor: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    /**
 * Show the form for editing the specified resource.
 */
    public function edit($id)
    {
        try {
            $doctor = Doctor::with('schedules')->findOrFail($id);
            Log::info('Editing doctor schedules:', $doctor->schedules->toArray());
            
            return view('admin.doctors-edit', compact('doctor'));
        } catch (\Exception $e) {
            Log::error('Error editing doctor: ' . $e->getMessage());
            return redirect()->route('admin.doctors')
                ->with('error', 'Data dokter tidak ditemukan.');
        }
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        Log::info('=== DOCTOR UPDATE METHOD CALLED ===');
        Log::info('Doctor ID: ' . $id);
        Log::info('Request Method: ' . $request->method());
        Log::info('Request Data:', $request->all());

        // Validasi
        $request->validate([
            'name' => 'required|string|max:255',
            'specialization' => 'required|string|max:255',
            'education' => 'required|string',
            'description' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'experience' => 'nullable|string',
            'schedules.*.day' => 'sometimes|required|string',
            'schedules.*.start_time' => 'sometimes|required|date_format:H:i',
            'schedules.*.end_time' => 'sometimes|required|date_format:H:i|after:schedules.*.start_time',
        ]);

        try {
            Log::info('Finding doctor with ID: ' . $id);
            $doctor = Doctor::findOrFail($id);
            Log::info('Doctor found: ' . $doctor->name);

            // Update data dasar dokter
            $doctor->name = $request->name;
            $doctor->specialization = $request->specialization;
            $doctor->education = $request->education;
            $doctor->description = $request->description;
            $doctor->experience = $request->experience;

            Log::info('Doctor basic data updated');

            // Handle photo upload
            if ($request->hasFile('photo')) {
                Log::info('Photo file detected');
                // Delete old photo if exists
                if ($doctor->photo) {
                    Storage::disk('public')->delete($doctor->photo);
                }
                $photoPath = $request->file('photo')->store('doctors', 'public');
                $doctor->photo = $photoPath;
                Log::info('New photo stored at: ' . $photoPath);
            }

            // Save doctor data
            $doctor->save();
            Log::info('Doctor saved successfully: ' . $doctor->id);

            // Handle schedules - HAPUS YANG LAMA DAN BUAT BARU
            Log::info('Processing schedules...');
            Log::info('Schedules data:', $request->schedules ?? []);

            // Delete existing schedules
            $doctor->schedules()->delete();
            Log::info('Old schedules deleted');

            // Create new schedules
            if ($request->has('schedules')) {
                $schedulesCreated = 0;
                foreach ($request->schedules as $index => $scheduleData) {
                    Log::info('Processing schedule ' . $index . ':', $scheduleData);
                    
                    if (!empty($scheduleData['day']) && !empty($scheduleData['start_time']) && !empty($scheduleData['end_time'])) {
                        DoctorSchedule::create([
                            'doctor_id' => $doctor->id,
                            'day' => $scheduleData['day'],
                            'start_time' => $scheduleData['start_time'],
                            'end_time' => $scheduleData['end_time']
                        ]);
                        $schedulesCreated++;
                        Log::info('Schedule created: ' . $scheduleData['day'] . ' ' . $scheduleData['start_time'] . '-' . $scheduleData['end_time']);
                    }
                }
                Log::info('Total schedules created: ' . $schedulesCreated);
            } else {
                Log::info('No schedules data in request');
            }

            Log::info('=== DOCTOR UPDATE COMPLETED SUCCESSFULLY ===');

            return redirect()->route('admin.doctors')->with('success', 'Data dokter berhasil diperbarui.');

        } catch (\Exception $e) {
            Log::error('Error updating doctor: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $doctor = Doctor::findOrFail($id);
            
            // Delete photo if exists
            if ($doctor->photo) {
                Storage::disk('public')->delete($doctor->photo);
            }
            
            $doctor->delete();
            Log::info('Doctor deleted: ' . $id);

            return redirect()->route('admin.doctors')->with('success', 'Data dokter berhasil dihapus.');

        } catch (\Exception $e) {
            Log::error('Error deleting doctor: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Toggle doctor status
     */
    public function toggleStatus($id)
    {
        try {
            $doctor = Doctor::findOrFail($id);
            $doctor->status = $doctor->status === 'active' ? 'inactive' : 'active';
            $doctor->save();

            $status = $doctor->status === 'active' ? 'diaktifkan' : 'dinonaktifkan';
            return redirect()->back()->with('success', 'Status dokter berhasil ' . $status . '.');

        } catch (\Exception $e) {
            Log::error('Error toggling doctor status: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
    public function getDoctorDetails($id)
{
    try {
        $doctor = Doctor::with('schedules')->findOrFail($id);
        
        return response()->json([
            'success' => true,
            'data' => [
                'id' => $doctor->id,
                'name' => $doctor->name,
                'specialization' => $doctor->specialization,
                'education' => $doctor->education,
                'description' => $doctor->description,
                'experience' => $doctor->experience,
                'photo' => $doctor->photo ? asset('storage/' . $doctor->photo) : 'https://via.placeholder.com/200x200?text=No+Image',
                'schedules' => $doctor->schedules->map(function($schedule) {
                    return [
                        'day_name' => $schedule->day_name,
                        'time_range' => $schedule->time_range,
                    ];
                })
            ]
        ]);
        
    } catch (\Exception $e) {
        Log::error('Error getting doctor details: ' . $e->getMessage());
        
        return response()->json([
            'success' => false,
            'message' => 'Data dokter tidak ditemukan.'
        ], 404);
    }
}

    /**
     * Display the specified resource.
     * Required for resource controller but not used in admin
     */
    public function show($id)
    {
        abort(404); // Not used in admin panel
    }
}