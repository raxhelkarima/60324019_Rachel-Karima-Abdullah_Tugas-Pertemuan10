@extends('layouts.app')

@section('content')

<h2 class="mb-4">
    Hasil pencarian:
    <span class="text-danger">{{ $keyword }}</span>
</h2>

<div class="row">

    @forelse ($hasil as $kategori)

    <div class="col-md-4 mb-4">

        <div class="card">

            <div class="card-body">

                <h5>
                    {!! str_ireplace($keyword, '<mark>'.$keyword.'</mark>', $kategori['nama']) !!}
                </h5>

                <p>{{ $kategori['deskripsi'] }}</p>

                <span class="badge bg-primary">
                    {{ $kategori['jumlah_buku'] }} Buku
                </span>

            </div>

        </div>

    </div>

    @empty

    <div class="alert alert-danger">
        Kategori tidak ditemukan
    </div>

    @endforelse

</div>

@endsection