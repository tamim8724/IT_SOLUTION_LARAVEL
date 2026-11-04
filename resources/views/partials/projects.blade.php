@php
    // 'url' => null means the card is not clickable (no live link yet).
    $projects = [
        ['img' => 'project-1.jpg', 'title' => 'Web Design', 'sub' => 'Security & Cabling, Sydney', 'url' => 'https://securityandcabling.com.au/'],
        ['img' => 'project-2.jpg', 'title' => 'Cyber Security', 'sub' => 'Cyber Security Core', 'url' => null],
        ['img' => 'project-3.jpg', 'title' => 'Mobile Info', 'sub' => 'Upcoming Phone', 'url' => null],
        ['img' => 'project-4.jpg', 'title' => 'Web Development', 'sub' => 'Security & Cabling, Sydney', 'url' => 'https://securityandcabling.com.au/'],
        ['img' => 'project-5.jpg', 'title' => 'Digital Marketing', 'sub' => 'Marketing Analysis', 'url' => null],
        ['img' => 'project-6.jpg', 'title' => 'Keyword Research', 'sub' => 'Keyword Analysis', 'url' => null],
    ];
@endphp
<div class="container-fluid project py-5 mb-5">
    <div class="container">
        <div class="text-center mx-auto pb-5 wow fadeIn" data-wow-delay=".3s" style="max-width: 600px;">
            <h5 class="text-primary">Our Projects</h5>
            <h2 class="h1">Our Recently Completed Projects</h2>
        </div>
        <div class="row g-5">
            @foreach ($projects as $i => $project)
                <div class="col-md-6 col-lg-4 wow fadeIn" data-wow-delay=".{{ ($i % 3) * 2 + 3 }}s">
                    <div class="project-item">
                        <div class="project-img">
                            <img src="{{ asset('img/' . $project['img']) }}" class="img-fluid w-100 rounded" alt="{{ $project['title'] }} project">
                            <div class="project-content">
                                @if ($project['url'])
                                    <a href="{{ $project['url'] }}" target="_blank" rel="noopener noreferrer" class="text-center">
                                        <h4 class="text-secondary">{{ $project['title'] }}</h4>
                                        <p class="m-0 text-white">{{ $project['sub'] }}</p>
                                    </a>
                                @else
                                    <div class="text-center">
                                        <h4 class="text-secondary">{{ $project['title'] }}</h4>
                                        <p class="m-0 text-white">{{ $project['sub'] }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
