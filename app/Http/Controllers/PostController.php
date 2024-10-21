<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class PostController extends Controller

{
    // Menampilkan daftar post
    public function index()
    {
        $posts = Post::latest()->paginate(10);
        return view('posts.index', compact('posts'));
    }

    // Menampilkan formulir pembuatan post
    public function create()
    {
        return view('posts.create');
    }

    // Menyimpan data post baru
    public function store(Request $request)
    {
        // Validasi data yang masuk
        $validated = $request->validate([
            'title'   => 'required|max:255',
            'content' => 'required',
            'image'   => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Tangani unggahan gambar jika ada
        if ($request->hasFile('image')) {
            // Simpan gambar di storage/app/public/posts
            $imagePath = $request->file('image')->store('public/posts');
            // Ambil nama file
            $validated['image'] = basename($imagePath);
        }

        // Membuat post baru
        Post::create($validated);

        // Redirect setelah berhasil
        return redirect()->route('posts.index')->with('success', 'Post Berhasil Disimpan!');
    }

    // Menampilkan formulir edit post
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.edit', compact('post'));
    }

    // Memperbarui data post
    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        // Validasi data yang masuk
        $validated = $request->validate([
            'title'   => 'required|max:255',
            'content' => 'required',
            'image'   => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Tangani unggahan gambar jika ada
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($post->image) {
                Storage::delete('public/posts/' . $post->image);
            }

            // Simpan gambar baru
            $imagePath = $request->file('image')->store('public/posts');
            $validated['image'] = basename($imagePath);
        }

        // Memperbarui data post
        $post->update($validated);

        // Redirect setelah berhasil
        return redirect()->route('posts.index')->with('success', 'Data Berhasil Diperbarui!');
    }

    // Menghapus post
    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        // Hapus gambar dari storage jika ada
        if ($post->image) {
            Storage::delete('public/posts/' . $post->image);
        }

        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post Telah Dihapus!');
    }
}
