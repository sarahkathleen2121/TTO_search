@extends('frontend.layouts.master')

@section('title', 'Return & Refund Policy')

@push('styles')
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/return-refund-policy.css') }}?v={{ time() }}">
@endpush

@section('content')

    <!-- Hero -->
    <section class="rr-hero">
        <div class="container">
            <div class="rr-breadcrumb">
                <a href="{{ route('home') }}">Home</a> / Return & Refund Policy
            </div>
            <h1 class="rr-title">Return & Refund Policy</h1>
        </div>
    </section>

    <!-- Content -->
    <section class="rr-content">
        <div class="container">

            <div class="rr-section">
                <h2>1. Returns</h2>
                <p>If you are not happy with your purchase, we will accept the return of an unused and unopened product within 7 days of receipt. To initiate a return, please contact us at <a href="mailto:info@thetotaloffice.com">info@thetotaloffice.com</a> within this period.</p>
                <p>Please note the following conditions apply to all returns:</p>
                <ul>
                    <li>Returned items must be unused, unopened, and in their original packaging in the condition they were received.</li>
                    <li>Discounted items are not eligible for return.</li>
                    <li>We are unable to issue a refund without actual receipt of the returned item(s) or confirmed proof of delivery.</li>
                    <li>We aim to accept all returns. In the unlikely event that an item is returned in an unsuitable condition, we may have to send it back to you. All goods will be inspected upon return.</li>
                    <li>The Total Office LLC will not issue refunds for products purchased through other entities, such as distributors or retail partners.</li>
                </ul>
            </div>

            <div class="rr-section">
                <h2>2. Refunds</h2>
                <p>Once we receive the returned item, The Total Office LLC will issue a full refund excluding the original shipping cost, as we are unable to refund initial shipping charges.</p>
                <p>Please allow 1–2 weeks for your return to be processed and your refund to be issued.</p>
            </div>

            <div class="rr-section">
                <h2>3. Return Shipping</h2>
                <p>We cannot be held responsible for items damaged or lost in return shipment. We strongly recommend using an insured and trackable mail or courier service when returning products to us.</p>
            </div>

            <div class="rr-section">
                <h2>4. ESCREO Writeable Paint - Product Note</h2>
                <p>The Total Office LLC is an authorised supplier and installer of ESCREO writeable wall paint products. Please note that ESCREO products, once opened, cannot be returned as they are unfit for resale. Only unused and unopened ESCREO kits and materials are eligible for return under the standard 7-day return window outlined above.</p>
            </div>

            <div class="rr-section">
                <h2>5. Limited 10-Year Warranty — ESCREO Writeable Paint</h2>
                <p>The Total Office LLC offers a 10-year limited warranty on ESCREO writeable paint surfaces, subject to the following conditions:</p>
                <ul>
                    <li>The warranty is applicable only when both the product supply and installation are carried out by The Total Office team. Warranty is not applicable to kit-only purchases or self-applied installations.</li>
                    <li>ESCREO surfaces are warranted for 10 years not to crack or peel, to resist staining and yellowing, and to maintain performance when used with appropriate dry erase markers and properly cleaned and maintained in accordance with ESCREO's maintenance guidelines.</li>
                    <li>ESCREO products are warranted to be free from defects in material and workmanship when properly applied and installed per recommended installation instructions.</li>
                    <li>If a product covered by this warranty is found to be defective, The Total Office LLC will arrange for a replacement or remedy free of charge. The liability under this warranty is limited to the replacement value of the ESCREO product and does not extend to any other damages, losses, or consequential costs.</li>
                    <li>This warranty shall extend for a period of 10 years from the date of installation by The Total Office team.</li>
                </ul>
            </div>

            <div class="rr-section">
                <h2>6. Contact</h2>
                <p>For all return, refund, or warranty enquiries, please contact us at:</p>
                <p>
                    <strong>The Total Office LLC</strong><br>
                    Email: <a href="mailto:info@thetotaloffice.com">info@thetotaloffice.com</a> | Website: <a href="https://www.thetotaloffice.com" target="_blank" rel="noopener noreferrer">www.thetotaloffice.com</a>
                </p>
                <p class="mt-4 text-muted" style="font-size: 13px;">Last reviewed and updated: June 2026</p>
            </div>

        </div>
    </section>

@endsection
