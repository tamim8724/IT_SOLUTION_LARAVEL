@php
    // Add a social key ('facebook', 'twitter', 'instagram', 'linkedin') to show that icon.
    $team = [
        [
            'name' => 'Md Muktadir Anik',
            'role' => 'Managing Director & Founder',
            'img' => 'team-1.jpg',
            'profile' => 'https://mdportfolio.e-trust.online/',
            'social' => [
                'facebook' => 'https://www.facebook.com/normalone98',
                'instagram' => 'https://www.instagram.com/i_am_anik_1',
                'linkedin' => 'https://www.linkedin.com/in/md-muktadir-anik-432390214',
            ],
        ],
        [
            'name' => 'Tamim Ahmed',
            'role' => 'Chief Executive Officer & Co-Founder',
            'img' => 'team-2.jpg',
            'profile' => null,
            'social' => ['facebook' => 'https://www.facebook.com/tamim.ahmed.593671'],
        ],
        [
            'name' => 'Md Abdul Alim',
            'role' => 'HR Administrator',
            'img' => 'team-3.jpg',
            'profile' => null,
            'social' => ['facebook' => 'https://www.facebook.com/md.abdul.alim.783523'],
        ],
        [
            'name' => 'Zubayer Farazi',
            'role' => 'IT Team Lead',
            'img' => 'team-zubayer.jpg', // placeholder until a real photo is added
            'profile' => null,
            'social' => ['facebook' => 'https://www.facebook.com/zubayerfarazi'],
        ],
    ];
    $icons = ['facebook' => 'fab fa-facebook-f', 'twitter' => 'fab fa-twitter', 'instagram' => 'fab fa-instagram', 'linkedin' => 'fab fa-linkedin-in'];
@endphp
<div class="container-fluid py-5 my-5 team">
    <div class="container py-5">
        <div class="text-center mx-auto pb-5 wow fadeIn" data-wow-delay=".3s" style="max-width: 600px;">
            <h5 class="text-primary">Our Team</h5>
            <h2 class="h1">Meet Our Expert Team</h2>
        </div>
        <div class="owl-carousel team-carousel wow fadeIn" data-wow-delay=".5s">
            @foreach ($team as $member)
                <div class="rounded team-item">
                    <div class="team-content">
                        <div class="team-img-icon">
                            @if ($member['profile'])
                                <a href="{{ $member['profile'] }}" target="_blank" rel="noopener noreferrer" title="View portfolio">
                            @endif
                                <div class="team-img rounded-circle">
                                    <img src="{{ asset('img/' . $member['img']) }}" class="img-fluid w-100 rounded-circle" alt="{{ $member['name'] }}">
                                </div>
                            @if ($member['profile'])
                                </a>
                            @endif
                            <div class="team-name text-center py-3">
                                <h4>
                                    @if ($member['profile'])
                                        <a href="{{ $member['profile'] }}" target="_blank" rel="noopener noreferrer" class="text-dark">{{ $member['name'] }}</a>
                                    @else
                                        {{ $member['name'] }}
                                    @endif
                                </h4>
                                <p class="m-0">{{ $member['role'] }}</p>
                            </div>
                            <div class="team-icon d-flex justify-content-center pb-4">
                                @foreach ($member['social'] as $network => $link)
                                    <a class="btn btn-square btn-secondary text-white rounded-circle m-1" href="{{ $link }}" target="_blank" rel="noopener noreferrer" aria-label="{{ $member['name'] }} on {{ ucfirst($network) }}"><i class="{{ $icons[$network] }}"></i></a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
