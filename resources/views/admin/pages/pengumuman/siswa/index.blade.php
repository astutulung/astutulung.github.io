@extends('admin.layouts.app')

@section('content')
<div class="row mb-12 g-6">
    @foreach ($pengumuman as $item)
        <div class="col-md-6 col-lg-4 mx-auto">
            <div class="card h-100">
                <img class="card-img-top" src="{{ asset($item->status === 'terima' ? 'assets_backend/img/congrats.jpg' : 'assets_backend/img/try.jpg') }}" alt="Card image cap" />
                <div class="card-body">
                    <h5 class="card-title">{{ $item->judul_pengumuman }}</h5>
                    <p class="card-text">{{ $item->deskripsi }}</p>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection
