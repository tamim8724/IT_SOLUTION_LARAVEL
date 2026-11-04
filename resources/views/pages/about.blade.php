@extends('layouts.app')

@section('title', 'About e-Trust | IT Company in Dhaka, Bangladesh')
@section('description', 'Learn about e-Trust, an IT solutions company in Dhaka founded by Md Muktadir Anik and Tamim Ahmed. Our mission, vision and team behind fast, secure websites.')

@section('content')
@include('partials.page-header', ['heading' => 'About Us'])
@include('partials.facts')
@include('partials.about', ['onAboutPage' => true])
@include('partials.mission-vision')
@include('partials.team')
@endsection
