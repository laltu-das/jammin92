@php
    $footer = App\Models\Footer::getFooter();
@endphp
        <!-- Footer -->
<footer>
    <div class="container">
        <div class="row g-5">
            <div class="col-md-4">
                <div class="footer-column">
                    <h3 class="brand-font">{{ $footer->brand_name }}</h3>
                    <p>{{ $footer->description }}</p>
                    <div class="social-links">
                        @if($footer->facebook_url && $footer->facebook_url != '#')
                            <a href="{{ $footer->facebook_url }}" title="Facebook" target="_blank"
                               rel="noopener noreferrer"><i class="fab fa-facebook-f"></i></a>
                        @endif
                        @if($footer->instagram_url && $footer->instagram_url != '#')
                            <a href="{{ $footer->instagram_url }}" title="Instagram" target="_blank"
                               rel="noopener noreferrer"><i class="fab fa-instagram"></i></a>
                        @endif
                        @if($footer->twitter_url && $footer->twitter_url != '#')
                            <a href="{{ $footer->twitter_url }}" title="Twitter" target="_blank"
                               rel="noopener noreferrer"><i class="fab fa-twitter"></i></a>
                        @endif
                        @if($footer->youtube_url && $footer->youtube_url != '#')
                            <a href="{{ $footer->youtube_url }}" title="YouTube" target="_blank"
                               rel="noopener noreferrer"><i class="fab fa-youtube"></i></a>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="footer-column">
                    <h3>Quick Links</h3>
                    <ul class="list-unstyled footer-links">
                        <li><a href="{{ $footer->home_link_url }}"><i
                                        class="fas fa-chevron-right me-2"></i> {{ $footer->home_link_text }}</a></li>
                        <li><a href="{{ $footer->news_link_url }}"><i
                                        class="fas fa-chevron-right me-2"></i> {{ $footer->news_link_text }}</a></li>
                        <li><a href="{{ $footer->concerts_link_url }}"><i
                                        class="fas fa-chevron-right me-2"></i> {{ $footer->concerts_link_text }}</a>
                        </li>
                        <li><a href="{{ $footer->events_link_url }}"><i
                                        class="fas fa-chevron-right me-2"></i> {{ $footer->events_link_text }}</a></li>
                        <li><a href="{{ $footer->contact_link_url }}"><i
                                        class="fas fa-chevron-right me-2"></i> {{ $footer->contact_link_text }}</a></li>
                    </ul>
                </div>
            </div>

            <div class="col-md-4">
                <div class="footer-column">
                    <h3>Contact Info</h3>
                    <ul class="list-unstyled footer-links">
                        <li><a href="#"><i class="fas fa-map-marker-alt me-2"></i> {{ $footer->address }}</a></li>
                        <li><a href="tel:{{ preg_replace('/[^0-9+]/', '', $footer->phone) }}"><i
                                        class="fas fa-phone-alt me-2"></i> {{ $footer->phone }}</a></li>
                        <li><a href="mailto:{{ $footer->email }}"><i
                                        class="fas fa-envelope me-2"></i> {{ $footer->email }}</a></li>
                        <li><a href="#"><i class="fas fa-broadcast-tower me-2"></i> Frequency: {{ $footer->frequency }}
                            </a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="copyright">
            &copy; {{ $footer->copyright_text }}
        </div>
    </div>
</footer>