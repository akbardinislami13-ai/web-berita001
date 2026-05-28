@extends('admin.news.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Admin News</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <p>Selamat datang di halaman manajemen berita. Gunakan menu di samping untuk mengelola artikel, kategori, dan pengguna.</p>
            <div class="row">
                <div class="col-md-4">
                    <div class="card bg-primary text-white shadow">
                        <div class="card-body">
                            Kelola Artikel
                            <div class="text-white-50 small"><a href="{{ route('articles.index') }}" class="text-white">Lihat Semua Artikel →</a></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-success text-white shadow">
                        <div class="card-body">
                            Kelola Kategori
                            <div class="text-white-50 small"><a href="{{ route('categories.index') }}" class="text-white">Lihat Semua Kategori →</a></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-info text-white shadow">
                        <div class="card-body">
                            Kelola Pengguna
                            <div class="text-white-50 small"><a href="{{ route('users.index') }}" class="text-white">Lihat Semua Pengguna →</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
