@extends('frontend.layouts.master')
@section('content')
    <!-- Courses Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="text-center mb-5">
                <h5 class="text-primary text-uppercase mb-3" style="letter-spacing: 5px;">Jurusan</h5>
                <h1>Daftar Jurusan</h1>
            </div>
            <div class="row">
                @foreach ($jurusans as $jurusan)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="rounded overflow-hidden mb-2">
                            <div class="bg-secondary p-4 text-center">
                                <div class="mb-3">
                                    <h5>{{ $jurusan->nama }}</h5>
                                </div>
                                <p class="h5">Tahun Ajaran: {{ $jurusan->tahun_ajaran }}</p>
                                <div class="border-top mt-4 pt-4">
                                    <div class="d-flex justify-content-between">
                                        <h6 class="m-0"><i class="fa fa-star text-primary mr-2"></i>{{ $jurusan->kuota }}
                                            Kuota</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Courses End -->
@endsection
