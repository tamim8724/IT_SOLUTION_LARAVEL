{{-- ARCHIVED: previous Bootstrap homepage. Replaced by pages/home3d.blade.php (see routes/web.php). Kept for future use. --}}
@extends('layouts.app')

@section('title', 'Web Design & Development Company in Dhaka & Sydney')
@section('description', 'e-Trust is a web design and development company in Dhaka, Bangladesh, also serving Sydney, Australia. Business websites, e-commerce, Laravel web apps, SEO and web security.')

@section('content')
<!-- Carousel Start -->
<div class="container-fluid px-0">
    <div id="carouselId" class="carousel slide" data-bs-ride="carousel">
        <ol class="carousel-indicators">
            <li data-bs-target="#carouselId" data-bs-slide-to="0" class="active" aria-current="true" aria-label="First slide"></li>
            <li data-bs-target="#carouselId" data-bs-slide-to="1" aria-label="Second slide"></li>
        </ol>
        <div class="carousel-inner" role="listbox">
            <div class="carousel-item active">
                <img src="{{ asset('img/carousel-1.jpg') }}" class="img-fluid" alt="e-Trust IT solutions">
                <div class="carousel-caption">
                    <div class="container carousel-content">
                        <p class="text-secondary h4 animated fadeInUp">Web Design &amp; Development &middot; Dhaka &amp; Sydney</p>
                        <h1 class="text-white display-1 mb-4 animated fadeInRight">An Innovative IT Solutions Agency</h1>
                        <p class="mb-4 text-white fs-5 animated fadeInDown">We design, build, and secure websites and digital solutions that help businesses in Bangladesh and Australia grow with confidence.</p>
                        <a href="{{ url('/about') }}" class="me-2 px-4 py-sm-3 px-sm-5 btn btn-primary rounded-pill carousel-content-btn1 animated fadeInLeft">Read More</a>
                        <a href="{{ url('/contact') }}" class="ms-2 px-4 py-sm-3 px-sm-5 btn btn-primary rounded-pill carousel-content-btn2 animated fadeInRight">Contact Us</a>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('img/carousel-2.jpg') }}" class="img-fluid" alt="Quality digital services">
                <div class="carousel-caption">
                    <div class="container carousel-content">
                        <p class="text-secondary h4 animated fadeInUp">Web Security &middot; SEO &middot; Digital Marketing</p>
                        <h2 class="carousel-title text-white display-1 mb-4 animated fadeInLeft">Quality Digital Services You Really Need!</h2>
                        <p class="mb-4 text-white fs-5 animated fadeInDown">From web design and development to security and digital marketing, we deliver reliable solutions built around your goals.</p>
                        <a href="{{ url('/services') }}" class="me-2 px-4 py-sm-3 px-sm-5 btn btn-primary rounded-pill carousel-content-btn1 animated fadeInLeft">Our Services</a>
                        <a href="{{ url('/contact') }}" class="ms-2 px-4 py-sm-3 px-sm-5 btn btn-primary rounded-pill carousel-content-btn2 animated fadeInRight">Contact Us</a>
                    </div>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselId" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselId" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>
<!-- Carousel End -->

@include('partials.facts')
@include('partials.about')
@include('partials.services')
@include('partials.regions')
@include('partials.projects')
@include('partials.mission-vision')
@include('partials.team')
@include('partials.contact')
@endsection
