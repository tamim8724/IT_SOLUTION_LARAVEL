<div class="container-fluid py-5 my-5">
    <div class="container pt-5">
        <div class="row g-5">
            <div class="col-lg-5 col-md-6 col-sm-12 wow fadeIn" data-wow-delay=".3s">
                <div class="h-100 position-relative">
                    <img src="{{ asset('img/about-1.jpg') }}" class="img-fluid w-75 rounded" alt="The e-Trust team at work" style="margin-bottom: 25%;">
                    <div class="position-absolute w-75" style="top: 25%; left: 25%;">
                        <img src="{{ asset('img/about-2.jpg') }}" class="img-fluid w-100 rounded" alt="Planning a client project">
                    </div>
                </div>
            </div>
            <div class="col-lg-7 col-md-6 col-sm-12 wow fadeIn" data-wow-delay=".5s">
                <h5 class="text-primary">About Us</h5>
                <h2 class="h1 mb-4">About e-Trust and Our Innovative IT Solutions</h2>
                <p>e-Trust is an information technology solutions firm based in Dhaka with experience in helping businesses develop their capacity using intelligent and reliable technology. The founders of the company are Md Muktadir Anik and Tamim Ahmed, and the firm specializes in designing and developing websites, web applications, and other digital projects which are fast, safe, and intuitive. Our process begins with listening to our clients to learn about their goals and business. Each project is unique because each client is unique. Whatever the nature of the business, be it a small business, a startup, or a big organization, our attention and expertise are dedicated to the client.</p>
                <p class="mb-4">The areas covered under our service include web design, web development, UI/UX design, web security, digital marketing, and programming. Security of the products we develop is incorporated from day one, not as an afterthought. We value clarity in communication and honesty in pricing.</p>
                @unless ($onAboutPage ?? false)
                    <a href="{{ url('/about') }}" class="btn btn-secondary rounded-pill px-5 py-3 text-white">More Details</a>
                @else
                    <a href="{{ url('/contact') }}" class="btn btn-secondary rounded-pill px-5 py-3 text-white">Talk To Us</a>
                @endunless
            </div>
        </div>
    </div>
</div>
