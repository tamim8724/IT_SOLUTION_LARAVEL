@extends('layouts.app')

@section('title', 'Our Team | Web Developers & Designers in Dhaka')
@section('description', 'Meet the e-Trust team of web developers, designers and IT specialists in Dhaka who design, build and secure your website.')

@section('content')
@include('partials.page-header', ['heading' => 'Our Team'])
@include('partials.facts')
@include('partials.team')
@endsection
