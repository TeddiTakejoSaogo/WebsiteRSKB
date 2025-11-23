<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index']);
    }

    // Public method dengan filter
    public function index(Request $request)
    {
        $query = Gallery::latest();
        
        // Filter by type
        if ($request->has('type') && $request->type != 'all') {
            $query->where('type', $request->type);
        }
        
        $galleries = $query->get();
        $types = Gallery::select('type')->distinct()->get();
        
        return view('gallery', compact('galleries', 'types'));
    }

    // Admin methods tetap sama
    public function adminIndex()
    {
        $galleries = Gallery::latest()->get();
        return view('admin.gallery', compact('galleries'));
    }

    public function create()
    {
        return view('admin.gallery-create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'type' => 'required|in:facility,activity,event',
        ], [
            'title.required' => 'Judul foto wajib diisi',
            'images.required' => 'Pilih minimal satu foto',
            'images.*.image' => 'File harus berupa gambar',
            'images.*.mimes' => 'Format gambar harus jpeg, png, jpg, gif, atau webp',
            'images.*.max' => 'Ukuran gambar maksimal 2MB',
        ]);

        try {
            $uploadedCount = 0;

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $imagePath = $image->store('gallery', 'public');
                    
                    Gallery::create([
                        'title' => $request->title,
                        'description' => $request->description,
                        'image' => $imagePath,
                        'type' => $request->type,
                    ]);
                    
                    $uploadedCount++;
                }
            }

            $message = $uploadedCount . ' foto berhasil ditambahkan ke galeri.';
            return redirect()->route('admin.gallery')->with('success', $message);

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $gallery = Gallery::findOrFail($id);
            
            if ($gallery->image) {
                Storage::disk('public')->delete($gallery->image);
            }
            
            $gallery->delete();

            return redirect()->route('admin.gallery')->with('success', 'Foto berhasil dihapus dari galeri.');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}