@extends('layouts.app')

@section('title', 'Web Design, Development, SEO & Security Services')
@section('description', 'Website design, web development, UI/UX, web security, SEO & digital marketing and custom programming for businesses in Dhaka, Bangladesh and Sydney, Australia.')

@section('content')
@include('partials.page-header', ['heading' => 'Our Services'])
@include('partials.facts')
@include('partials.services')
@include('partials.regions')
@include('partials.faq')
@endsection
