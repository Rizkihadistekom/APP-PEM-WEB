@extends('layout.main') 
@section('container')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <a href="{{ route('posts.index') }}" class="btn btn-md btn-secondary mb-3">KEMBALI</a>
                        <h4 class="mb-4">Edit Post</h4>

                        <!-- Menampilkan pesan error jika ada -->
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- Formulir edit post -->
                        <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <!-- Input Gambar -->
                            <div class="form-group">
                                <label for="image">Gambar</label>
                                <input 
                                    type="file" 
                                    name="image" 
                                    id="image" 
                                    class="form-control @error('image') is-invalid @enderror"
                                >
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                                @if($post->image)
                                    <img src="{{ Storage::url('public/posts/') . $post->image }}" class="img-thumbnail mt-2" style="width: 150px">
                                @endif
                            </div>

                            <!-- Input Judul -->
                            <div class="form-group">
                                <label for="title">Judul</label>
                                <input 
                                    type="text" 
                                    name="title" 
                                    id="title" 
                                    class="form-control @error('title') is-invalid @enderror" 
                                    value="{{ old('title', $post->title) }}" 
                                    required
                                >
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Input Konten -->
                            <div class="form-group">
                                <label for="content">Konten</label>
                                <textarea 
                                    name="content" 
                                    id="content" 
                                    rows="5" 
                                    class="form-control @error('content') is-invalid @enderror" 
                                    required
                                >{{ old('content', $post->content) }}</textarea>
                                @error('content')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Tombol Submit -->
                            <button type="submit" class="btn btn-primary mt-3">Perbarui</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Skrip JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        // Menampilkan pesan dengan toastr
        @if(session()->has('success'))
            toastr.success('{{ session('success') }}', 'BERHASIL!'); 
        @elseif(session()->has('error'))
            toastr.error('{{ session('error') }}', 'GAGAL!'); 
        @endif
    </script>
@endsection
