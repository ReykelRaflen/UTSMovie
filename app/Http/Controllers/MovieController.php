<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Requests\StoreMovieRequest;

class MovieController extends Controller
{
    // Menampilkan daftar film dengan opsi pencarian.
    public function index()
    {
        $movies = Movie::latest()
            // Menambahkan fitur pencarian
            ->when(request('search'), function ($query) {
                $search = request('search');
                $query->where(function ($q) use ($search) {
                    $q->where('judul', 'like', "%{$search}%")
                      ->orWhere('sinopsis', 'like', "%{$search}%");
                });
            })
            // Menggunakan pagination dengan 6 item per halaman
            ->paginate(6)
            // Mempertahankan query string di URL
            ->withQueryString();

        return view('homepage', compact('movies'));
    }

    // Menampilkan detail film berdasarkan ID.
    public function detail($id)
    {
        $movie = Movie::findOrFail($id);
        return view('detail', compact('movie'));
    }

    // Menampilkan halaman untuk menambah film baru.
    public function create()
    {
        $categories = Category::all();
        return view('input', compact('categories'));
    }

    // Menyimpan data film yang baru ditambahkan ke database.
    public function store(StoreMovieRequest $request)
    {
        $validated = $request->validated();

        // Proses upload foto sampul jika ada
        if ($request->hasFile('foto_sampul')) {
            $validated['foto_sampul'] = $request->file('foto_sampul')->store('movie_covers', 'public');
        }

        // Menyimpan data film ke dalam database
        Movie::create($validated);

        // Redirect ke halaman yang sesuai setelah data disimpan
        return redirect()->route('movies.index')->with('success', 'Film berhasil ditambahkan.');
    }

    // Menampilkan daftar film di halaman data-movies dengan pagination.
    public function data()
    {
        $movies = Movie::latest()->paginate(10);
        return view('data-movies', compact('movies'));
    }

    // Menampilkan formulir untuk mengedit film berdasarkan ID.
    public function form_edit($id)
    {
        $movie = Movie::find($id);
        $categories = Category::all();
        return view('form-edit', compact('movie', 'categories'));
    }

    // Memperbarui data film yang sudah ada di database.
    public function update(Request $request, $id)
    {
        // Validasi input dari form
        $validatedData = $request->validate([
            'judul' => 'required|string|max:255',
            'category_id' => 'required|integer',
            'sinopsis' => 'required|string',
            'tahun' => 'required|integer',
            'pemain' => 'required|string',
            'foto_sampul' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Foto opsional
        ]);

        $movie = Movie::findOrFail($id);

        // Jika ada file foto sampul baru yang diunggah, simpan foto tersebut
        if ($request->hasFile('foto_sampul')) {
            $newImageName = $this->storeImage($request->file('foto_sampul'), $movie->foto_sampul);
            $validatedData['foto_sampul'] = $newImageName;
        }

        // Memperbarui data film
        $movie->update($validatedData);

        return redirect('movies/data')->with('success', 'Data berhasil diperbarui');
    }

    // Menyimpan gambar dan menghapus gambar lama jika ada.
    private function storeImage($image, $oldImage)
    {
        // Menghasilkan nama file unik untuk gambar
        $fileName = Str::uuid()->toString() . '.' . $image->getClientOriginalExtension();

        // Menyimpan file gambar baru
        $image->move(public_path('images'), $fileName);

        // Menghapus gambar lama jika ada
        if (File::exists(public_path('images/' . $oldImage))) {
            File::delete(public_path('images/' . $oldImage));
        }

        return $fileName;
    }

    // Menghapus data film beserta foto sampulnya.
    public function delete($id)
    {
        $movie = Movie::findOrFail($id);

        // Menghapus foto sampul jika ada
        if (File::exists(public_path('images/' . $movie->foto_sampul))) {
            File::delete(public_path('images/' . $movie->foto_sampul));
        }

        // Menghapus data film dari database
        $movie->delete();

        return redirect('movies/data')->with('success', 'Data berhasil dihapus');
    }
}
