        <!-- Footer Start -->
        <div class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="footer-widget">
                            <h3 class="title">Get in Touch</h3>
                            <div class="contact-info">
                                <p><i class="fa fa-map-marker"></i>{{ $getSettings->city }} {{ $getSettings->country }}
                                    {{ $getSettings->street }}</p>
                                <p><i class="fa fa-envelope"></i>{{ $getSettings->email }}</p>
                                <p><i class="fa fa-phone"></i>{{ $getSettings->phone }}</p>
                                <div class="social">
                                    <a href="{{ $getSettings->twitter }}" title='twitter'><i
                                            class="fab fa-twitter"></i></a>
                                    <a href="{{ $getSettings->facebook }}" title='facebook'><i
                                            class="fab fa-facebook-f"></i></a>
                                    <a href="{{ $getSettings->twitter }}" title='linkedin'><i
                                            class="fab fa-linkedin-in"></i></a>
                                    <a href="{{ $getSettings->instagram }}" title='instagram'><i
                                            class="fab fa-instagram"></i></a>
                                    <a href="{{ $getSettings->youtube }}" title='youtube'><i
                                            class="fab fa-youtube"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="footer-widget">
                            <h3 class="title">Useful Links</h3>
                            <ul>

                                @foreach ($relatedSite as $site)
                                    <li> <a href="{{ $site->url }}"
                                            title="{{ $site->name }}">{{ $site->name }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="footer-widget">
                            <h3 class="title">Quick Links</h3>
                            <ul>
                                <li> <a href="/" class="nav-item nav-link active">Home</a>
                                </li>
                                <li> <a href="{{ route('frontend.contact.index') }}" class="nav-item nav-link">Contact
                                        Us</a>

                                </li>
                                <li> <a href="dashboard.html" class="nav-item nav-link">Dashboard</a></li>

                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="footer-widget">
                            <h3 class="title">Newsletter</h3>
                            <div class="newsletter">
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                    Vivamus sed porta dui. Class aptent taciti sociosqu
                                </p>
                                <form action="{{ route('news.subscribe') }}" method="post">
                                    @csrf

                                    <input class="form-control" type="email" name="email"
                                        placeholder="Your email here" />
                                    @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <button class="btn">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End -->



        <!-- Footer Bottom Start -->
        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 copyright">
                        <p>
                            Copyright &copy; <a href="">{{config('app.name')}} </a>. All Rights
                            Reserved
                        </p>
                    </div>

                    <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                    <div class="col-md-6 template-by">
                        <p>Designed By <strong>Mostafa Khaled</strong></p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer Bottom End -->

        <!-- Back to Top -->
        <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

        <!-- JavaScript Libraries -->
