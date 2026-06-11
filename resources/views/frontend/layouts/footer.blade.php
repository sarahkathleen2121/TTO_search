<footer class="footer-section">
    <div class="footer-wrapper">
        <div class="footer-top">
            <!-- Brand -->
            <div class="footer-brand">
                <a href="{{ route('home') }}" class="footer-logo">
                    <img src="{{ asset('frontend_assets/images/logo.png') }}" alt="The Total Office" class="footer-logo-img">
                </a>
            </div>

            <!-- Column 1 -->
            <div class="footer-col">
                <div class="footer-links">
                    <a href="{{ route('services') }}" class="footer-link">Services</a>
                    <a href="{{ route('initiatives') }}" class="footer-link">Initiatives</a>
                    <a href="{{ route('about') }}" class="footer-link">About</a>
                    <a href="{{ route('resources') }}" class="footer-link">Resources</a>
                    <a href="{{ route('careers') }}" class="footer-link">Careers</a>
                    <a href="{{ route('moodboards') }}" class="footer-link">Moodboards</a>
                </div>
            </div>

            <!-- Column 2 -->
            <div class="footer-col">
                <div class="footer-links">
                    <a href="{{ route('all.products') }}" class="footer-link">All Products</a>
                    <a href="{{ route('shop.by.space') }}" class="footer-link">Shop by Space</a>
                    <a href="{{ route('conference.rooms') }}" class="footer-link">Conference Rooms</a>
                    <a href="{{ route('conference.room.tables') }}" class="footer-link">Conference Room Tables</a>
                    <a href="{{ route('case.studies') }}" class="footer-link">Case Studies</a>
                    <a href="{{ route('sustainability') }}" class="footer-link">Sustainability</a>
                </div>
            </div>

            <!-- Column 3 -->
            <div class="footer-col">
                <div class="footer-links">
                    <a href="{{ route('contact') }}" class="footer-link">Contact Us</a>
                    <a href="{{ route('make.enquiry') }}" class="footer-link">Make an Enquiry</a>
                    <a href="{{ route('search.results') }}" class="footer-link">AI Search</a>
                    <a href="{{ route('csr') }}" class="footer-link">CSR</a>
                </div>
            </div>

            <!-- Newsletter + Social -->
            <div class="footer-col footer-col--connect">
                <div class="footer-newsletter">
                    <span class="footer-newsletter-label">Subscribe to newsletter</span>
                    <div class="newsletter-input-wrapper">
                        <input type="email" class="newsletter-input" placeholder="Enter email" aria-label="Email for newsletter" />
                        <button type="button" class="newsletter-btn" aria-label="Subscribe">
                            <i class="fas fa-play"></i>
                        </button>
                    </div>
                </div>
                <div class="social-icons">
                    <a href="#" class="social-icon" title="Twitter" aria-label="Twitter">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="social-icon" title="Instagram" aria-label="Instagram">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" class="social-icon" title="LinkedIn" aria-label="LinkedIn">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="footer-copyright">
                © {{ date('Y') }} Total Office. All rights reserved.
            </div>
            <div class="footer-bottom-links">
                <a href="{{ route('privacy.policy') }}" class="footer-bottom-link">Privacy Policy</a>
                <span class="footer-divider">|</span>
                <a href="{{ route('terms.conditions') }}" class="footer-bottom-link">Terms of use</a>
                <span class="footer-divider">|</span>
                <a href="{{ route('return.refund.policy') }}" class="footer-bottom-link">Return & Refund Policy</a>
            </div>
            <div class="footer-credit">
               <!-- Made with 
                 <span style="color: #383E42">❤</span> 
                 by --> thetotaloffice.com
            </div>
        </div>
    </div>
</footer>
