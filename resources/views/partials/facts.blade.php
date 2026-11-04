{{-- Counter bar. Edit the numbers/labels here once; it updates on every page. --}}
@php
    $facts = [
        ['value' => '4', 'label' => 'Expert team members'],
        ['value' => '6', 'label' => 'Core digital services'],
        ['value' => '7', 'label' => 'Happy clients served'],
        ['value' => '5', 'label' => 'Star rating from our clients'],
    ];
@endphp
<div class="container-fluid bg-secondary py-5">
    <div class="container">
        <div class="row">
            @foreach ($facts as $i => $fact)
                <div class="col-lg-3 wow fadeIn" data-wow-delay=".{{ $i * 2 + 1 }}s">
                    <div class="d-flex counter">
                        <span class="h1 me-3 text-primary counter-value">{{ $fact['value'] }}</span>
                        <h5 class="text-white mt-1">{{ $fact['label'] }}</h5>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
