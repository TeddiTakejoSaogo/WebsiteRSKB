<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    // Public methods
    public function index()
    {
        $articles = Article::published()->latest()->paginate(6);
        return view('news', compact('articles'));
    }

    public function show($slug)
    {
    try {
        $article = Article::where('slug', $slug)->published()->firstOrFail();
        $recentArticles = Article::published()
            ->where('id', '!=', $article->id)
            ->latest()
            ->limit(5)
            ->get();
        
        return view('news-detail', compact('article', 'recentArticles'));
        
    } catch (\Exception $e) {
        Log::error('Error showing article: ' . $e->getMessage());
        abort(404, 'Artikel tidak ditemukan');
    }
    }

    // Admin methods
    public function adminIndex(Request $request)
    {
    $query = Article::query();
    
    // Search
    if ($request->has('search') && $request->search != '') {
        $query->where('title', 'like', '%' . $request->search . '%')
              ->orWhere('content', 'like', '%' . $request->search . '%');
    }
    
    // Filter by category
    if ($request->has('category') && $request->category != '') {
        $query->where('category', $request->category);
    }
    
    // Filter by status
    if ($request->has('status') && $request->status != '') {
        $query->where('status', $request->status);
    }
    
    $articles = $query->latest()->get();
    $categories = Article::distinct()->pluck('category');
    
    return view('admin.news', compact('articles', 'categories'));
    }

    public function create()
    {
        return view('admin.news-create');
    }

   public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255|unique:articles,title',
        'content' => 'required|string|min:50',
        'category' => 'required|string|max:255',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'status' => 'required|in:draft,published',
    ], [
        'title.required' => 'Judul artikel wajib diisi',
        'title.unique' => 'Judul artikel sudah ada',
        'content.required' => 'Konten artikel wajib diisi',
        'content.min' => 'Konten artikel minimal 50 karakter',
        'category.required' => 'Kategori wajib diisi',
        'image.image' => 'File harus berupa gambar',
        'image.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif',
        'image.max' => 'Ukuran gambar maksimal 2MB',
    ]);

    try {
        $article = new Article();
        $article->title = $request->title;
        $article->slug = Str::slug($request->title);
        $article->content = $request->input('content');
        $article->category = $request->category;
        $article->status = $request->status;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('articles', 'public');
            $article->image = $imagePath;
        }

        $article->save();

        return redirect()->route('admin.news')->with('success', 'Artikel berhasil ditambahkan.');

    } catch (\Exception $e) {
        Log::error('Error creating article: ' . $e->getMessage());
        return redirect()->back()
            ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
            ->withInput();
    }
}

    public function edit($id)
    {
        $article = Article::findOrFail($id);
        return view('admin.news-edit', compact('article'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:draft,published',
        ]);

        $article = Article::findOrFail($id);
        $article->title = $request->title;
        $article->slug = Str::slug($request->title);
        $article->content = $request->input('content');
        $article->category = $request->category;
        $article->status = $request->status;

        if ($request->hasFile('image')) {
            // Delete old image
            if ($article->image) {
                Storage::disk('public')->delete($article->image);
            }
            $imagePath = $request->file('image')->store('articles', 'public');
            $article->image = $imagePath;
        }

        $article->save();

        return redirect()->route('admin.news')->with('success', 'Artikel berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        
        // Delete image if exists
        if ($article->image) {
            Storage::disk('public')->delete($article->image);
        }
        
        $article->delete();

        return redirect()->route('admin.news')->with('success', 'Artikel berhasil dihapus.');
    }

    public function toggleStatus($id)
    {
        $article = Article::findOrFail($id);
        $article->status = $article->status === 'published' ? 'draft' : 'published';
        $article->save();

        return redirect()->back()->with('success', 'Status artikel berhasil diubah.');
    }

}