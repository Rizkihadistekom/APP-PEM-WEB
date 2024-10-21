@extends('layout.main') 
@section('container')
<div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
    <div class="jumbotron bg-white rounded shadow-sm text-center" style="width: 80%; max-width: 600px;">
        <img src="{{ asset('storage\posts\rpOE9BjXV0AwoeWVNabxmFCWXjT8KYFjj0wqCZmA.jpg') }}" alt="Foto Saya" class="img-fluid rounded-circle mb-4" style="max-width: 150px;">
        <h5 class="mb-3">Rizki Hadi Syarifudin</h5>
        <h1 class="display-4 fw-bold">Selamat Datang di STEKOM</h1>
        <p class="lead">Mari Kita Sama-Sama Belajar Aplikasi Pemrograman WEB.</p>
        <hr class="my-4">
        <p>Jangan biarkan ketakutan menghentikanmu. Keberanian adalah kunci untuk meraih pengetahuan.</p>
        <a class="btn btn-primary btn-lg" href="{{ route('posts.index') }}" role="button">Lihat Semua Posts</a>
        <a class="btn btn-success btn-lg" href="{{ route('posts.create') }}" role="button">Tambah Post Baru</a>
    </div>
</div>
@endsection

