<style>
    
/* Services CTA Section */
.services-cta-section {
    background-color: white;
    border-top: 1px solid #eef2f6;
    border-bottom: 1px solid #eef2f6;
    padding: 50px 0 !important;
}

.services-cta-box {
    background-color: transparent;
    padding: 0;
    border-radius: 0;
    width: 100%;
}

.services-cta-text {
    color: #383E42;
    font-size: 28px;
    font-weight: 400;
    line-height: 1.3;
}

.services-cta-btn {
    background-color: #737b8c !important;
    color: white !important;
    font-weight: 500 !important;
    font-size: 13px !important;
    padding: 12px 30px !important;
    border: none !important;
    border-radius: 25px !important;
    transition: all 0.3s ease;
    cursor: pointer;
    box-shadow: none !important;
}

.services-cta-btn:hover {
    background-color: #5d6473 !important;
    transform: translateY(-1px);
}

@media (max-width: 768px) {
    .services-cta-section {
        padding: 40px 0 !important;
    }
    .services-cta-box {
        flex-direction: column;
        text-align: center;
        gap: 24px;
    }
    .services-cta-text {
        font-size: 22px;
    }
}
</style>
    <!-- Services CTA Section -->
    <section class="services-cta-section">
        <div class="container">
            <div class="services-cta-box d-flex align-items-center justify-content-between">
                <h3 class="services-cta-text m-0">
                    Book a Meeting OR<br/>Visit to our Showroom
                </h3>
                <button class="btn btn-primary services-cta-btn" onclick="window.location.href='{{ route('contact') }}'">Book a Visit</button>
            </div>
        </div>
    </section>