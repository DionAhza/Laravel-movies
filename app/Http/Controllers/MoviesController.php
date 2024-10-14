<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Movie;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class MoviesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $movies = Movie::get(); // Mengambil semua data film
        return view('index', ['movies' => $movies]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $genres = Genre::all(); // Mengambil semua genre dari database
        return view('admin.create', compact('genres'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'genre' => 'required|array',
        'director' => 'required|string|max:255',
        'release_year' => 'required|digits:4',
        'link' => 'required|url',
        'synopsis' => 'required|string',
        'duration' => 'required|integer',
        'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Menyimpan thumbnail
    $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');

    // Menyimpan data movie
    $movie = Movie::create([
        'title' => $validated['title'],
        'genre' => json_encode($validated['genre']), // Simpan genre sebagai JSON
        'director' => $validated['director'],
        'release_year' => $validated['release_year'],
        'link' => $validated['link'],
        'synopsis' => $validated['synopsis'],
        'duration' => $validated['duration'],
        'thumbnail' => $thumbnailPath,
    ]);

    return redirect()->route('movies.index')->with('success', 'Movie created successfully.');
}

    
    
    /**
     * Display the specified resource.
     */
    public function show(string $id)
{
    // Mengambil data film berdasarkan ID
    $movie = Movie::findOrFail($id);
    
    // Mengembalikan tampilan 'movies.show' dengan data film
    return view('show', compact('movie'));
}


    /**
     * Show the form for editing the specified resource.
     */
    public function search(Request $request)
    {
        $query = $request->input('query');
        
        $movies = Movie::where('title', 'like', '%' . $query . '%')
        ->orWhere('genre', 'like', '%' . $query . '%') // Pencarian dengan LIKE
        ->paginate(10);
    

        
        return view('search', compact('movies', 'query'));
    }
    


    // public function genre(Request $request)
    // {
    //     $query = $request->input('query');
    
    //     // Mengambil data film yang sesuai dengan pencarian dan menerapkan paginasi
    //     $movies = Movie::where('title', 'like', '%' . $query . '%')
    //         ->paginate(10); // Menggunakan paginate untuk hasil paginasi
    
    //     return view('search', compact('movies', 'query'));
    // }
    


    
    
    public function edit(string $id)
    {
        //
        $movies = Movie::findOrFail($id);
        $genres =Genre::all();


        return view('admin.edit',compact('movies','genres'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validasi data input
        $request->validate([
            'thumbnail' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title' => 'required|string|max:255',
            'genre' => 'required|array',
            'director' => 'required|string|max:255',
            'release_year' => 'required|digits:4',
            'link' => 'required|url',
            'synopsis' => 'required|string',
            'duration' => 'required|integer',
        ]);
    
        // Temukan film berdasarkan ID
        $movie = Movie::findOrFail($id);
    
        // Jika ada file thumbnail yang diupload
        if ($request->hasFile('thumbnail')) {
            // Hapus thumbnail lama
            if ($movie->thumbnail && Storage::disk('public')->exists($movie->thumbnail)) {
                Storage::disk('public')->delete($movie->thumbnail);
            }
    
            // Simpan thumbnail baru
            $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
            $movie->thumbnail = $thumbnailPath;
        }
    
        // Update data film
        $movie->title = $request->input('title');
        $movie->genre = json_encode($request->input('genre')); // Simpan genre sebagai JSON seperti di store
        $movie->director = $request->input('director');
        $movie->release_year = $request->input('release_year');
        $movie->link = $request->input('link');
        $movie->synopsis = $request->input('synopsis');
        $movie->duration = $request->input('duration');
    
        // Simpan perubahan
        $movie->save();
    
        // Redirect dengan pesan sukses
        return redirect()->route('movies.index')->with('success', 'Movie updated successfully.');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
{
    // Temukan film berdasarkan ID
    $movie = Movie::findOrFail($id);

    // Hapus thumbnail dari storage jika ada
    if ($movie->thumbnail && Storage::exists($movie->thumbnail)) {
        Storage::delete($movie->thumbnail);
    }

    // Hapus data film dari database
    $movie->delete();

    // Redirect dengan pesan sukses
    return redirect()->back()->with('delete', 'Berhasil menghapus info film');
}

public function rate(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'rating' => 'required|integer|between:1,5',
        ]);

        // Temukan movie berdasarkan ID
        $movie = Movie::findOrFail($id); // Gunakan findOrFail untuk menangani jika tidak ditemukan

        // Simpan rating ke database
        $movie->rating = $request->rating; // Ganti sesuai dengan kolom yang ada di tabel
        $movie->save();

        return redirect()->back()->with('success', 'Rating submitted successfully!');
    }



}
