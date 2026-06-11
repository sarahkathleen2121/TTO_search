@extends('frontend.layouts.master')

@section('title', 'Privacy Policy')

@push('styles')
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/privacy-policy.css') }}?v={{ time() }}">
@endpush

@section('content')

    <!-- Hero -->
    <section class="pp-hero">
        <div class="container">
            <div class="pp-breadcrumb">
                <a href="{{ route('home') }}">Home</a> / Privacy Policy
            </div>
            <h1 class="pp-title">Privacy Policy</h1>
        </div>
    </section>

    <!-- Content -->
    <section class="pp-content">
        <div class="container">

            <div class="pp-section">
                <h2>1. Introduction</h2>
                <p>This Privacy Policy describes how The Total Office LLC ("we", "us", or "our") collects, uses, and protects the personal information of visitors and users of www.thetotaloffice.com. By using our website, you agree to the collection and use of information in accordance with this policy.</p>
            </div>

            <div class="pp-section">
                <h2>2. UAE Data Protection Compliance</h2>
                <p>The Total Office LLC is committed to complying with the UAE Federal Decree-Law No. 45 of 2021 on the Protection of Personal Data (PDPL). We process your personal data lawfully, fairly, and transparently, and only for the purposes outlined in this policy.</p>
            </div>

            <div class="pp-section">
                <h2>3. Data Collected</h2>
                <h3>3.1 Information You Provide</h3>
                <p>We collect the information you provide directly to us. For example, we collect information when you subscribe to our newsletter, fill out an enquiry form, request customer support, or otherwise communicate with us. The types of information we may collect include your name, email address, postal address, and other contact or identifying information you choose to provide.</p>
                
                <h3>3.2 Newsletter & Enquiry Form Data</h3>
                <p>When you subscribe to our newsletter or submit an enquiry form on our website, we collect your name and email address for the purpose of sending you relevant updates and communications from The Total Office LLC. This data is used solely for this purpose and is not shared with third parties for marketing. You may unsubscribe at any time via the link included in every email.</p>
                
                <h3>3.3 Automatically Collected Data</h3>
                <p>We collect anonymous data from every visitor of the website to monitor traffic and fix bugs. This includes information such as web requests, Internet Protocol (IP) address, browser type, browser language, and a timestamp for the request.</p>
                
                <h3>3.4 Cookies & Tracking Technologies</h3>
                <p>We use cookies — small data files stored on your device — to improve our services and your experience, identify popular areas of our website, and count visits. We may also use web beacons (tracking pixels) in our website or emails to track visits and understand usage and campaign effectiveness. By accessing our website, you agree to our use of cookies in accordance with this policy.</p>
                
                <h3>3.5 LiveChat & AI Chatbot Data</h3>
                <p>Our website uses a live chat service provided by LiveChat, Inc., which may incorporate AI-assisted features. When you engage with our chat tool, your conversation data may be collected, stored, and processed by LiveChat, Inc. on our behalf. Please note:</p>
                <ul>
                    <li>You should not submit sensitive personal, financial, or confidential information through the chat tool.</li>
                    <li>AI-generated responses are provided for general assistance only and do not constitute professional, legal, or commercial advice.</li>
                    <li>LiveChat, Inc. operates under its own Privacy Policy, available at <a href="https://www.livechat.com/legal/privacy-policy" target="_blank" rel="noopener noreferrer">www.livechat.com/legal/privacy-policy</a>.</li>
                </ul>
                <p>We use chat data solely to respond to your enquiries and improve our customer service.</p>
            </div>

            <div class="pp-section">
                <h2>4. Use of Data</h2>
                <p>We only use your personal information to provide services through thetotaloffice.com or to communicate with you about the website or our services. We employ industry-standard techniques to protect against unauthorised access to data about you that we store, including personal information.</p>
                <p>We do not share personal information you have provided to us without your consent, unless:</p>
                <ul>
                    <li>Doing so is appropriate to carry out your own request</li>
                    <li>We believe it is needed to enforce our legal agreements or is legally required</li>
                    <li>We believe it is needed to detect, prevent, or address fraud, security, or technical issues</li>
                </ul>
            </div>

            <div class="pp-section">
                <h2>5. Sharing of Data</h2>
                <p>We do not share your personal information with third parties. Aggregated, anonymised data is periodically transmitted to external services to help us improve the website and our services.</p>
                <p>We may allow third-party analytics providers to collect data about your use of our website using cookies, web beacons, and similar technologies. This may include your IP address, browser type, pages viewed, time spent on pages, links clicked, and conversion information.</p>
                <p>Our website may include social sharing buttons for platforms including LinkedIn, Facebook, Instagram, and X (formerly Twitter). Your use of these features is entirely optional. We are not responsible for the privacy practices of these third-party platforms and encourage you to review their respective privacy policies.</p>
            </div>

            <div class="pp-section">
                <h2>6. Third-Party Links</h2>
                <p>Our website may contain links to third-party websites, including manufacturer and partner websites. These links are provided for your convenience and informational purposes only. The Total Office LLC has no control over the content, privacy practices, or policies of any third-party websites and accepts no responsibility or liability for them. We recommend reviewing the terms and conditions and privacy policies of any third-party websites you visit.</p>
            </div>

            <div class="pp-section">
                <h2>7. Your Rights Under UAE PDPL</h2>
                <p>In accordance with UAE data protection law, you have the following rights regarding your personal data:</p>
                <ul>
                    <li><strong>Right to Access</strong> — you may request a copy of the personal data we hold about you.</li>
                    <li><strong>Right to Correction</strong> — you may request that we correct any inaccurate or incomplete data.</li>
                    <li><strong>Right to Deletion</strong> — you may request that we delete your personal data, subject to any legal obligations we may have to retain it.</li>
                    <li><strong>Right to Withdraw Consent</strong> — where processing is based on your consent, you may withdraw it at any time.</li>
                    <li><strong>Right to Object</strong> — you may object to the processing of your personal data in certain circumstances.</li>
                </ul>
                <p>To exercise any of these rights, please contact us at <a href="mailto:info@thetotaloffice.com">info@thetotaloffice.com</a>. We will respond to all requests within 30 days.</p>
            </div>

            <div class="pp-section">
                <h2>8. Data Retention</h2>
                <p>We retain personal data only for as long as necessary to fulfil the purposes for which it was collected, or as required by applicable UAE law. Specifically:</p>
                <ul>
                    <li>Newsletter subscriber data is retained until you unsubscribe.</li>
                    <li>Enquiry form data is retained for a period of 12 months unless a longer period is required for legal or business purposes.</li>
                    <li>Chat conversation data is subject to LiveChat, Inc.'s own retention policies.</li>
                </ul>
            </div>

            <div class="pp-section">
                <h2>9. Opt-Out & Communication Preferences</h2>
                <p>You may modify your communication preferences and/or opt out from specific communications at any time. To unsubscribe from our newsletter, use the unsubscribe link included in every email. For other communication preferences, please contact us directly at <a href="mailto:info@thetotaloffice.com">info@thetotaloffice.com</a>.</p>
            </div>

            <div class="pp-section">
                <h2>10. Security</h2>
                <p>We take reasonable steps to protect personally identifiable information from loss, misuse, and unauthorised access, disclosure, alteration, or destruction. However, no Internet transmission is ever completely secure or error-free. In particular, email sent to or from the website may not be secure, and you should exercise caution when sharing sensitive information electronically.</p>
            </div>

            <div class="pp-section">
                <h2>11. Children's Privacy</h2>
                <p>This website is not intended for children under the age of 13. We do not knowingly collect personally identifiable information from visitors in this age group. If you believe a child under 13 has provided us with personal information, please contact us and we will take steps to remove that information promptly.</p>
            </div>

            <div class="pp-section">
                <h2>12. Changes to This Privacy Policy</h2>
                <p>We may amend this Privacy Policy from time to time. Use of information we collect is subject to the Privacy Policy in effect at the time such information is used. If we make significant changes in the way we collect or use information, we will notify you by posting an announcement on the website or sending you an email.</p>
            </div>

            <div class="pp-section">
                <h2>13. Contact Information</h2>
                <p>If you have any questions, concerns, or requests regarding this Privacy Policy or how we handle your personal data, please contact us at:</p>
                <p>
                    <strong>The Total Office LLC</strong><br>
                    Email: <a href="mailto:info@thetotaloffice.com">info@thetotaloffice.com</a> | Website: <a href="https://www.thetotaloffice.com" target="_blank" rel="noopener noreferrer">www.thetotaloffice.com</a>
                </p>
                <p class="mt-4 text-muted" style="font-size: 13px;">Last reviewed and updated: June 2026</p>
            </div>

        </div>
    </section>

@endsection
