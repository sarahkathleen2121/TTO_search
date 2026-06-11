@extends('frontend.layouts.master')

@section('title', 'Terms & Conditions')

@push('styles')
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/terms-conditions.css') }}?v={{ time() }}">
@endpush

@section('content')

    <!-- Hero -->
    <section class="tc-hero">
        <div class="container">
            <div class="tc-breadcrumb">
                <a href="{{ route('home') }}">Home</a> / Terms & Conditions
            </div>
            <h1 class="tc-title">Terms & Conditions</h1>
        </div>
    </section>

    <!-- Content -->
    <section class="tc-content">
        <div class="container">

            <div class="tc-section">
                <h2>Welcome to thetotaloffice.com!</h2>
                <p>These terms and conditions outline the rules and regulations for the use of The Total Office LLC's Website, located at www.thetotaloffice.com.</p>
                <p>By accessing this website we assume you accept these terms and conditions. Do not continue to use thetotaloffice.com if you do not agree to take all of the terms and conditions stated on this page.</p>
                <p>The following terminology applies to these Terms and Conditions, Privacy Statement and Disclaimer Notice and all Agreements: "Client", "You" and "Your" refers to you, the person log on this website and compliant to the Company’s terms and conditions. "The Company", "Ourselves", "We", "Our" and "Us", refers to our Company. "Party", "Parties", or "Us", refers to both the Client and ourselves. All terms refer to the offer, acceptance and consideration of payment necessary to undertake the process of our assistance to the Client in the most appropriate manner for the express purpose of meeting the Client’s needs in respect of provision of the Company’s stated services, in accordance with and subject to, prevailing law of United Arab Emirates. Any use of the above terminology or other words in the singular, plural, capitalization and/or he/she or they, are taken as interchangeable and therefore as referring to the same.</p>
            </div>

            <div class="tc-section">
                <h2>Cookies</h2>
                <p>We employ the use of cookies. By accessing thetotaloffice.com, you agreed to use cookies in agreement with The Total Office LLC Privacy Policy.</p>
                <p>Most interactive websites use cookies to let us retrieve the user’s details for each visit. Cookies are used by our website to enable the functionality of certain areas to make it easier for people visiting our website. Some of our affiliate/advertising partners may also use cookies.</p>
            </div>

            <div class="tc-section">
                <h2>AI Chatbot & Third-Party Communication Tools</h2>
                <p>Our website uses a live chat service provided by LiveChat, Inc., which may incorporate AI-assisted response features. By initiating a chat session on our website, you acknowledge and agree that:</p>
                <ul>
                    <li>Your conversation may be processed, stored, or analysed by LiveChat, Inc. as a third-party service provider.</li>
                    <li>AI-generated responses are provided for general assistance only and do not constitute professional, legal, or commercial advice.</li>
                    <li>You should not share sensitive personal information, financial details, or confidential data through the chat tool.</li>
                    <li>LiveChat, Inc. operates under its own Privacy Policy, which can be accessed at <a href="https://www.livechat.com/legal/privacy-policy" target="_blank" rel="noopener noreferrer">www.livechat.com/legal/privacy-policy</a>.</li>
                </ul>
            </div>

            <div class="tc-section">
                <h2>Data Collection & Newsletter Signup</h2>
                <p>When you subscribe to our newsletter or submit an enquiry form on our website, we collect personal information including but not limited to your name and email address. This information is collected solely for the purpose of sending you relevant updates, news, and communications from The Total Office LLC.</p>
                <p>You may unsubscribe from our newsletter at any time by clicking the unsubscribe link included in every email communication. We do not sell, rent, or share your personal data with third parties for marketing purposes.</p>
                <p>In accordance with the UAE Personal Data Protection Law (Federal Decree-Law No. 45 of 2021), we are committed to ensuring that your personal data is handled lawfully, transparently, and securely. For full details on how we collect, use, and protect your data, please refer to our <a href="{{ route('privacy.policy') }}">Privacy Policy</a>.</p>
            </div>

            <div class="tc-section">
                <h2>License</h2>
                <p>Unless otherwise stated, The Total Office LLC and/or its licensors own the intellectual property rights for all material on thetotaloffice.com. All intellectual property rights are reserved. You may access this from thetotaloffice.com for your own personal use subjected to restrictions set in these terms and conditions.</p>
                <p>You must not:</p>
                <ul>
                    <li>Republish material from thetotaloffice.com</li>
                    <li>Sell, rent or sub-license material from thetotaloffice.com</li>
                    <li>Reproduce, duplicate or copy material from thetotaloffice.com</li>
                    <li>Redistribute content from thetotaloffice.com</li>
                </ul>
                <p>This Agreement shall begin on the date hereof.</p>
                <p>Parts of this website offer an opportunity for users to post and exchange opinions and information in certain areas of the website. The Total Office LLC does not filter, edit, publish or review Comments prior to their presence on the website. Comments do not reflect the views and opinions of The Total Office LLC, its agents and/or affiliates. Comments reflect the views and opinions of the person who post their views and opinions. To the extent permitted by applicable law, The Total Office LLC shall not be liable for the Comments or for any liability, damages or expenses caused and/or suffered as a result of any use of and/or posting of and/or appearance of the Comments on this website.</p>
                <p>The Total Office LLC reserves the right to monitor all Comments and to remove any Comments which can be considered inappropriate, offensive or causes a breach of these Terms and Conditions.</p>
                <p>You warrant and represent that:</p>
                <ul>
                    <li>You are entitled to post the Comments on our website and have all necessary licenses and consents to do so;</li>
                    <li>The Comments do not invade any intellectual property rights, including without limitation copyright, patent or trademark of any third party;</li>
                    <li>The Comments do not contain any defamatory, libelous, offensive, indecent or otherwise unlawful material which is an invasion of privacy;</li>
                    <li>Comments will not be used to solicit or promote business or custom or present commercial activities or unlawful activity.</li>
                </ul>
                <p>You hereby grant The Total Office LLC a non-exclusive license to use, reproduce, edit and authorize others to use, reproduce and edit any of your Comments in any and all forms, formats or media.</p>
            </div>

            <div class="tc-section">
                <h2>Hyperlinking to our Content</h2>
                <p>The following organizations may link to our Website without prior written approval:</p>
                <ul>
                    <li>Government agencies;</li>
                    <li>Search engines;</li>
                    <li>News organizations;</li>
                    <li>Online directory distributors may link to our Website in the same manner as they hyperlink to the Websites of other listed businesses; and</li>
                    <li>Systemwide Accredited Businesses except soliciting non-profit organizations, charity shopping malls, and charity fundraising groups which may not hyperlink to our Web site.</li>
                </ul>
                <p>These organizations may link to our home page, to publications or to other Website information so long as the link: (a) is not in any way deceptive; (b) does not falsely imply sponsorship, endorsement or approval of the linking party and its products and/or services; and (c) fits within the context of the linking party’s site.</p>
                <p>We may consider and approve other link requests from the following types of organizations:</p>
                <ul>
                    <li>commonly-known consumer and/or business information sources;</li>
                    <li>dot.com community sites;</li>
                    <li>associations or other groups representing charities;</li>
                    <li>online directory distributors;</li>
                    <li>internet portals;</li>
                    <li>accounting, law and consulting firms; and</li>
                    <li>educational institutions and trade associations.</li>
                </ul>
                <p>We will approve link requests from these organizations if we decide that: (a) the link would not make us look unfavorably to ourselves or to our accredited businesses; (b) the organization does not have any negative records with us; (c) the benefit to us from the visibility of the hyperlink compensates the absence of The Total Office LLC; and (d) the link is in the context of general resource information.</p>
                <p>These organizations may link to our home page so long as the link: (a) is not in any way deceptive; (b) does not falsely imply sponsorship, endorsement or approval of the linking party and its products or services; and (c) fits within the context of the linking party’s site.</p>
                <p>If you are one of the organizations listed in paragraph 2 above and are interested in linking to our website, you must inform us by sending an e-mail to The Total Office LLC. Please include your name, your organization name, contact information as well as the URL of your site, a list of any URLs from which you intend to link to our Website, and a list of the URLs on our site to which you would like to link. Wait 2-3 weeks for a response.</p>
                <p>Approved organizations may hyperlink to our Website as follows:</p>
                <ul>
                    <li>By use of our corporate name; or</li>
                    <li>By use of the uniform resource locator being linked to; or</li>
                    <li>By use of any other description of our Website being linked to that makes sense within the context and format of content on the linking party’s site.</li>
                </ul>
                <p>No use of The Total Office LLC's logo or other artwork will be allowed for linking absent a trademark license agreement.</p>
            </div>

            <div class="tc-section">
                <h2>Third-Party Links</h2>
                <p>Our website may contain links to third-party websites, including manufacturer and partner websites. These links are provided for your convenience and informational purposes only. The Total Office LLC has no control over the content, privacy practices, or policies of any third-party websites and accepts no responsibility or liability for them. We recommend reviewing the terms and conditions and privacy policies of any third-party websites you visit.</p>
            </div>

            <div class="tc-section">
                <h2>iFrames</h2>
                <p>Without prior approval and written permission, you may not create frames around our Webpages that alter in any way the visual presentation or appearance of our Website.</p>
            </div>

            <div class="tc-section">
                <h2>Content Liability</h2>
                <p>We shall not be held responsible for any content that appears on your Website. You agree to protect and defend us against all claims that are rising on your Website. No link(s) should appear on any Website that may be interpreted as libelous, obscene or criminal, or which infringes, otherwise violates, or advocates the infringement or other violation of, any third party rights.</p>
            </div>

            <div class="tc-section">
                <h2>Your Privacy</h2>
                <p>Please read <a href="{{ route('privacy.policy') }}">Privacy Policy</a>.</p>
            </div>

            <div class="tc-section">
                <h2>Reservation of Rights</h2>
                <p>We reserve the right to request that you remove all links or any particular link to our Website. You approve to immediately remove all links to our Website upon request. We also reserve the right to amend these terms and conditions and it’s linking policy at any time. By continuously linking to our Website, you agree to be bound to and follow these linking terms and conditions.</p>
            </div>

            <div class="tc-section">
                <h2>Removal of links from our website</h2>
                <p>If you find any link on our Website that is offensive for any reason, you are free to contact and inform us any moment. We will consider requests to remove links but we are not obligated to or so or to respond to you directly.</p>
                <p>We do not ensure that the information on this website is correct, we do not warrant its completeness or accuracy; nor do we promise to ensure that the website remains available or that the material on the website is kept up to date.</p>
            </div>

            <div class="tc-section">
                <h2>Product & Service Information</h2>
                <p>All product specifications, descriptions, availability, and pricing displayed on this website are provided for informational purposes only and are subject to change without notice. Nothing on this website constitutes a binding offer, quotation, or contract for the supply of goods or services. Please contact us directly to confirm current product details and pricing.</p>
            </div>

            <div class="tc-section">
                <h2>Disclaimer</h2>
                <p>To the maximum extent permitted by applicable law, we exclude all representations, warranties, and conditions relating to our website and the use of this website. Nothing in this disclaimer will:</p>
                <ul>
                    <li>limit or exclude our or your liability for death or personal injury;</li>
                    <li>limit or exclude our or your liability for fraud or fraudulent misrepresentation;</li>
                    <li>limit any of our or your liabilities in any way that is not permitted under applicable law; or</li>
                    <li>exclude any of our or your liabilities that may not be excluded under applicable law.</li>
                </ul>
                <p>The limitations and prohibitions of liability set in this Section and elsewhere in this disclaimer: (a) are subject to the preceding paragraph; and (b) govern all liabilities arising under the disclaimer, including liabilities arising in contract, in tort and for breach of statutory duty.</p>
                <p>As long as the website and the information and services on the website are provided free of charge, we will not be liable for any loss or damage of any nature.</p>
            </div>

            <div class="tc-section">
                <h2>Governing Law & Jurisdiction</h2>
                <p>These Terms and Conditions are governed by and construed in accordance with the laws of the United Arab Emirates. Any disputes arising in connection with these Terms and Conditions shall be subject to the exclusive jurisdiction of the courts of the United Arab Emirates.</p>
            </div>

            <div class="tc-section">
                <h2>Contact Information</h2>
                <p>If you have any questions, concerns, or requests regarding these Terms and Conditions, please contact us at:</p>
                <p>
                    <strong>The Total Office LLC</strong><br>
                    Email: <a href="mailto:info@thetotaloffice.com">info@thetotaloffice.com</a> | Website: <a href="https://www.thetotaloffice.com" target="_blank" rel="noopener noreferrer">www.thetotaloffice.com</a>
                </p>
            </div>

        </div>
    </section>

@endsection
