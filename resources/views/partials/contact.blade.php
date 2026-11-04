<div class="container-fluid py-5 mb-5" id="contact">
    <div class="container">
        <div class="text-center mx-auto pb-5 wow fadeIn" data-wow-delay=".3s" style="max-width: 600px;">
            <h5 class="text-primary">Get In Touch</h5>
            <h2 class="h1 mb-3">Contact Us For Any Query</h2>
            <p class="mb-2">Have a project in mind or a question about our services? Send us a message, call us, or drop by our office, and we'll get back to you as soon as we can.</p>
        </div>
        <div class="contact-detail position-relative p-5">
            <div class="row g-5 mb-5 justify-content-center">
                <div class="col-xl-4 col-lg-6 wow fadeIn" data-wow-delay=".3s">
                    <div class="d-flex bg-light p-3 rounded">
                        <div class="flex-shrink-0 btn-square bg-secondary rounded-circle" style="width: 64px; height: 64px;">
                            <i class="fas fa-map-marker-alt text-white"></i>
                        </div>
                        <div class="ms-3">
                            <h4 class="text-primary">Address</h4>
                            <a href="{{ config('etrust.map_url') }}" target="_blank" rel="noopener noreferrer" class="h5">{{ config('etrust.address') }}</a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 wow fadeIn" data-wow-delay=".5s">
                    <div class="d-flex bg-light p-3 rounded">
                        <div class="flex-shrink-0 btn-square bg-secondary rounded-circle" style="width: 64px; height: 64px;">
                            <i class="fa fa-phone text-white"></i>
                        </div>
                        <div class="ms-3">
                            <h4 class="text-primary">Call Us</h4>
                            <a class="h5" href="tel:{{ config('etrust.phone_tel') }}">{{ config('etrust.phone') }}</a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 wow fadeIn" data-wow-delay=".7s">
                    <div class="d-flex bg-light p-3 rounded">
                        <div class="flex-shrink-0 btn-square bg-secondary rounded-circle" style="width: 64px; height: 64px;">
                            <i class="fa fa-envelope text-white"></i>
                        </div>
                        <div class="ms-3">
                            <h4 class="text-primary">Email Us</h4>
                            <a class="h5" href="mailto:{{ config('etrust.email') }}">{{ config('etrust.email') }}</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row g-5">
                <div class="col-lg-6 wow fadeIn" data-wow-delay=".3s">
                    <div class="p-5 h-100 rounded contact-map">
                        <iframe class="rounded w-100 h-100" title="e-Trust office location on Google Maps" src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d7303.476832652679!2d90.40558650601243!3d23.756705788272424!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sbd!4v1772048692072!5m2!1sen!2sbd" style="border:0; min-height: 350px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
                <div class="col-lg-6 wow fadeIn" data-wow-delay=".5s">
                    <form method="POST" action="{{ route('contact.send') }}#contact" class="p-5 rounded contact-form" novalidate>
                        @csrf

                        @if (session('contact_success'))
                            <div class="alert alert-success" role="alert">{{ session('contact_success') }}</div>
                        @endif
                        @if (session('contact_error'))
                            <div class="alert alert-danger" role="alert">{{ session('contact_error') }}</div>
                        @endif

                        {{-- Honeypot: hidden from people, bots fill it in --}}
                        <div style="position:absolute; left:-9999px;" aria-hidden="true">
                            <label for="website">Leave this empty</label>
                            <input type="text" id="website" name="website" tabindex="-1" autocomplete="off">
                        </div>

                        <div class="mb-4">
                            <input type="text" name="name" value="{{ old('name') }}" class="form-control border-0 py-3 @error('name') is-invalid @enderror" placeholder="Your Name" aria-label="Your name" required maxlength="100">
                            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-4">
                            <input type="email" name="email" value="{{ old('email') }}" class="form-control border-0 py-3 @error('email') is-invalid @enderror" placeholder="Your Email" aria-label="Your email" required maxlength="150">
                            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-4">
                            <input type="text" name="project" value="{{ old('project') }}" class="form-control border-0 py-3 @error('project') is-invalid @enderror" placeholder="Project / Subject" aria-label="Project or subject" maxlength="150">
                            @error('project')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-4">
                            <textarea name="message" class="w-100 form-control border-0 py-3 @error('message') is-invalid @enderror" rows="6" placeholder="Message" aria-label="Message" required maxlength="5000">{{ old('message') }}</textarea>
                            @error('message')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="text-start">
                            <button class="btn bg-primary text-white py-3 px-5" type="submit">Send Message</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
