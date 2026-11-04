<div class="container-fluid bg-dark py-2 d-none d-md-flex">
    <div class="container">
        <div class="d-flex justify-content-between topbar">
            <div class="top-info">
                <small class="me-3 text-white-50">
                    <a href="{{ config('etrust.map_url') }}" target="_blank" rel="noopener noreferrer"><i class="fas fa-map-marker-alt me-2 text-secondary"></i></a>{{ config('etrust.address') }}
                </small>
                <small class="me-3 text-white-50">
                    <a href="mailto:{{ config('etrust.email') }}"><i class="fas fa-envelope me-2 text-secondary"></i></a>{{ config('etrust.email') }}
                </small>
            </div>
            <div id="note" class="text-secondary d-none d-xl-flex"><small>We help you grow your business</small></div>
            <div class="top-link">
                <a href="{{ config('etrust.facebook') }}" target="_blank" rel="noopener noreferrer" class="bg-light nav-fill btn btn-sm-square rounded-circle me-0" aria-label="e-Trust on Facebook"><i class="fab fa-facebook-f text-primary"></i></a>
            </div>
        </div>
    </div>
</div>
