@extends('dashboard.master')
@section('title','Sayur Dan Buah')
@section('nav')
    @include('dashboard.nav')
@endsection
{{-- @section('page', 'Dashboard')
@section('page-title', 'Dashboard')
@section('main')
    @include('dashboard.main')
    @include('dashboard.dashboard')
@endsection --}}
@section('dashboard')
    @include('dashboard.dashboard')
@endsection
@section('footer')
    @include('dashboard.footer')
@endsection