@extends('layouts.app')

@section('title', 'Our Web Design & Development Projects')
@section('description', 'Recent website design, web development, cyber security and digital marketing projects by e-Trust for clients in Bangladesh and Sydney, Australia.')

@section('content')
@include('partials.page-header', ['heading' => 'Our Projects'])
@include('partials.facts')
@include('partials.projects')
@endsection
