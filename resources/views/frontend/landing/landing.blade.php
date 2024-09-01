@extends('frontend.layouts.master');

@section('content')
    @include('frontend.landing._partials.carousel')

    @include('frontend.landing._partials.about')

    @include('frontend.landing._partials.berita', ['beritas' => $beritas])

    @include('frontend.landing._partials.course', ['jurusans' => $jurusans])

@endsection