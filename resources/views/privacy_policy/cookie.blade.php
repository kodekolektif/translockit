@extends('app.index')

@section('content')
<style>
    p {
        margin-bottom: 15px !important;
    }

    h2,
    h3 {
        margin-top: 20px;
    }

    ul {
        margin-left: 20px;
    }
</style>
<section class="page__title p-relative d-flex align-items-center grey-bg-2" data-overlay="dark" data-opacity="7">
    <div class="page__title-bg" data-background="{{ asset('assets/img/bg/bg-slider_TranslockIt_5.jpg') }}"></div>
    <div class="container">

        <div class="row">
            <div class="col-xl-12">
                <div class="page__title-content mt-100 text-center">
                    <h2 style="overflow: hidden; white-space: nowrap;">{{ __('policy.cookie_settings') }}</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ __('landing.Home') }}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ __('policy.cookie_settings') }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="portfolio-area pt-120 pb-70">
    <div class="container ">
        <div class="plan-content description">
            <h2>Use of Cookies</h2>
            <p>
               This page belongs to <b>Translock IT</b>, <b>SLU</b>, as responsible for the processed data and uses Cookies (hereinafter, the <b>“Controller”</b> ), that is, small text files that are stored on the Client’s computer or mobile devices, with the aim of improving their experience and simplifying their visits to the platform.
            </p>
            <p>
                In this way, cookies keep the memory of your preferences on future visits. Personal identification
                information such as name, address, password, bank details, payment card, etc. will never be stored in
                Cookies.
            </p>

            <h2>Consent</h2>
            <p>
               By browsing and staying on the <a href="www.translockit.com" class="text-primary">www.translockit.com</a> site, you as a user, consent to the use of Cookies in accordance with this Cookies Policy, having access at all times to block them, reject their use or eliminate them.
            </p>

            <h2>Types of Cookies</h2>
            <p>
                The Controller may use both “permanent or persistent cookies” and “session cookies”. The first ones are
                stored on the Client’s device for a maximum of ONE (1) month, while the session ones are only stored
                during
                the visit to the Web or the App, being deleted when the Client closes the session in your browser.
            </p>
            <p>
                Permanent Cookies will be used in case the Client selects “Remember me” when starting the session.
            </p>
            <p>
                Likewise, third-party cookies may be used to compile statistics in tools such as Google Analytics or
                Core
                Metrics or other similar sites. These cookies are managed by another entity.
            </p>
            <p>
                There are also:
            <ul>
                <li><strong>Technical cookies</strong>: allow navigation and use of services offered.</li>
                <li><strong>Analysis cookies</strong>: monitor and study user behavior.</li>
                <li><strong>Personalization cookies</strong>: remember characteristics like language or region.</li>
                <li><strong>Geolocation cookies</strong>: store device location to offer relevant content.</li>
                <li><strong>Advertising cookies</strong>: collect anonymous ad view data for targeting.</li>
            </ul>
            </p>
            <p>
                Some services may include social network connections (Twitter, LinkedIn, Facebook, Instagram). When
                authorized, these networks may store a permanent cookie for future identification.
            </p>

            <h2>Cookies used on this website</h2>
            <p>
                Social network cookies can be stored in your browser while browsing www.translockit.com, for example,
                when
                using share buttons.
            </p>
            <p>The companies that generate these cookies have their own cookie policies:</p>
            <ul>
                <li><span class="text-muted font-weight-bold">Twitter</span>: see Twitter’s Privacy Policy</li>
                <li><span class="text-muted font-weight-bold">LinkedIn</span>: see LinkedIn’s Cookies Policy</li>
                <li><span class="text-muted font-weight-bold">Facebook</span>: see Facebook’s Cookies Policy</li>
                <li><span class="text-muted font-weight-bold">Instagram</span>: see Instagram’s Cookies Policy</li>
            </ul>

            <h3>#Cookie Table</h3>

            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover rounded-3 overflow-hidden">
                    <thead class="table-header-custom">
                        <tr>
                            <th scope="col" class="p-3 text-start text-uppercase fw-medium fs-6 rounded-top-left">
                                Name
                            </th>
                            <th scope="col" class="p-3 text-start text-uppercase fw-medium fs-6">
                                Time Frame
                            </th>
                            <th scope="col" class="p-3 text-start text-uppercase fw-medium fs-6 rounded-top-right">
                                Purpose
                            </th>
                        </tr>
                    </thead>
                    <tbody class="text-wrap">
                        <!-- Row 1 -->
                        <tr>
                            <td class="p-3 text-dark fw-medium">
                                Own: Sesióntve_leads_unique
                            </td>
                            <td class="p-3 text-secondary text-start">
                                Expires at the end of the session
                            </td>
                            <td class="p-3 text-secondary">
                                Store user information and sessions to improve the user experience
                            </td>
                        </tr>
                        <!-- Row 2 -->
                        <tr>
                            <td class="p-3 text-dark fw-medium">
                                Terceros persistente_ga
                            </td>
                            <td class="p-3 text-secondary text-start">
                                2 years from the setup
                            </td>
                            <td class="p-3 text-secondary">
                                Used to distinguish users. It is a cookie belonging to Google Analytics. Más información
                            </td>
                        </tr>
                        <!-- Row 3 -->
                        <tr>
                            <td class="p-3 text-dark fw-medium">
                                Terceros persistente_gat.
                            </td>
                            <td class="p-3 text-secondary text-start">
                                10 minutes
                            </td>
                            <td class="p-3 text-secondary">
                                Used to know the recharge rate. It is a cookie belonging to Google Analytics. Más
                                información
                            </td>
                        </tr>
                        <!-- Row 4 -->
                        <tr>
                            <td class="p-3 text-dark fw-medium">
                                Terceros persistente__utma
                            </td>
                            <td class="p-3 text-secondary text-start">
                                2 years from every update
                            </td>
                            <td class="p-3 text-secondary">
                                This cookie is usually set during the first visit. If the cookie is manually deleted, it
                                will be set back on the next visit with a new ID. In most cases this cookie is used to
                                determine unique visitors to our site and is updated with each page viewed. In addition,
                                this cookie has a unique Google Analytics ID that ensures both the validity of the
                                cookie
                                and its accessibility as an additional security measure. Más información
                            </td>
                        </tr>
                        <!-- Row 5 -->
                        <tr>
                            <td class="p-3 text-dark fw-medium">
                                Terceros persistente__utmb
                            </td>
                            <td class="p-3 text-secondary text-start">
                                2 years from every update
                            </td>
                            <td class="p-3 text-secondary">
                                This cookie is used to establish and continue a user session on our site. When a user
                                visits
                                a page on our site, the Google Analytics code attempts to update this cookie. If you
                                can’t
                                find the cookie, it will create a new one. Each time the user visits a different page
                                this
                                cookie is updated to expire after 30 minutes, thus continuing to find a single session
                                at
                                30-minute intervals. This cookie expires when a user stops visiting our site for a
                                period of
                                30 minutes. Más información
                            </td>
                        </tr>
                        <!-- Row 6 -->
                        <tr>
                            <td class="p-3 text-dark fw-medium">
                                Terceros persistente APISID, HSID, NID, SAPISID, SID, SSID
                            </td>
                            <td class="p-3 text-secondary text-start">
                                2 years since its installation
                            </td>
                            <td class="p-3 text-secondary">
                                Save user preferences and other information about Google services that the user has. Más
                                información
                            </td>
                        </tr>
                        <!-- Row 7 -->
                        <tr>
                            <td class="p-3 text-dark fw-medium">
                                Terceros persistente__utmt
                            </td>
                            <td class="p-3 text-secondary">
                                Session
                            </td>
                            <td class="p-3 text-secondary">
                                Historically, this cookie operated together with the __utmb cookie to determine whether
                                the
                                user should be re-logged. Today it is not used but is still here to maintain backward
                                compatibility with theurchin.js and ga.js code. Más información
                            </td>
                        </tr>
                        <!-- Row 8 -->
                        <tr>
                            <td class="p-3 text-dark fw-medium">
                                Terceros persistente__utmz
                            </td>
                            <td class="p-3 text-secondary text-start">
                                6 months from every update
                            </td>
                            <td class="p-3 text-secondary">
                                This cookie stores information about references used by the visitor to reach our site,
                                either directly, a referral link, a web search or an advertising campaign or by email.
                                It is
                                used to calculate traffic from web search engines, marketing campaigns and browsing our
                                site. This cookie is updated in each page view. Más información
                            </td>
                        </tr>
                        <!-- Row 9 -->
                        <tr>
                            <td class="p-3 text-dark fw-medium">
                                Propia persistente__cfduid
                            </td>
                            <td class="p-3 text-secondary text-start">
                                5 años
                            </td>
                            <td class="p-3 text-secondary">
                                The __cfduid cookie is used to override security restrictions based on the visitor’s IP
                                address coming. Más información
                            </td>
                        </tr>
                        <!-- Row 10 -->
                        <tr>
                            <td class="p-3 text-dark fw-medium">
                                Propia__smVID
                            </td>
                            <td class="p-3 text-secondary text-start">
                                Expires at the end of the session
                            </td>
                            <td class="p-3 text-secondary">
                                Stores user information and sessions to improve the user experience.
                            </td>
                        </tr>
                        <!-- Row 11 -->
                        <tr>
                            <td class="p-3 text-dark fw-medium">
                                _remember_checked_on
                            </td>
                            <td class="p-3 text-secondary text-start">
                                Expires at the end of the session
                            </td>
                            <td class="p-3 text-secondary">
                                Cookies with Twitter functionalities.
                            </td>
                        </tr>
                        <!-- Row 12 -->
                        <tr>
                            <td class="p-3 text-dark fw-medium">
                                Terceros persistentepl
                            </td>
                            <td class="p-3 text-secondary text-start">
                                90 days
                            </td>
                            <td class="p-3 text-secondary">
                                Used to register that a device or browser logged in through the Facebook platform. Más
                                información
                            </td>
                        </tr>
                        <!-- Row 13 -->
                        <tr>
                            <td class="p-3 text-dark fw-medium">
                                Terceros persistentefr
                            </td>
                            <td class="p-3 text-secondary text-start">
                                90 days
                            </td>
                            <td class="p-3 text-secondary">
                                This is Facebook’s main advertising cookie. Used to deliver, analyze and improve the
                                relevance of ads. Más información
                            </td>
                        </tr>
                        <!-- Row 14 -->
                        <tr>
                            <td class="p-3 text-dark fw-medium">
                                Terceros persistentesb
                            </td>
                            <td class="p-3 text-secondary text-start">
                                2 years since its installation
                            </td>
                            <td class="p-3 text-secondary">
                                Facebook cookie that identifies your browser for login authentication purposes. Más
                                información
                            </td>
                        </tr>
                        <!-- Row 15 -->
                        <tr>
                            <td class="p-3 text-dark fw-medium">
                                Terceros persistentec_user
                            </td>
                            <td class="p-3 text-secondary text-start" >
                                20 days from installation
                            </td>
                            <td class="p-3 text-secondary">
                                Used in conjunction with the xs cookie to authenticate your identity on Facebook. Más
                                información
                            </td>
                        </tr>
                        <!-- Row 16 -->
                        <tr>
                            <td class="p-3 text-dark fw-medium">
                                Terceros persistentexs
                            </td>
                            <td class="p-3 text-secondary text-start">
                                90 days from installation
                            </td>
                            <td class="p-3 text-secondary">
                                Used in conjunction with the cookie c_user to authenticate your identity on Facebook.
                                Más
                                información
                            </td>
                        </tr>
                        <!-- Row 17 -->
                        <tr>
                            <td class="p-3 text-dark fw-medium">
                                Terceros persistentedatr
                            </td>
                            <td class="p-3 text-secondary text-start">
                                2 years since its installation
                            </td>
                            <td class="p-3 text-secondary">
                                Facebook that identifies browsers for site security and integrity purposes, including
                                account recovery and identifying accounts that may be at risk. Más información
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <h2>How to disable cookies</h2>
            <p>
                You can allow, block or delete cookies by configuring your browser settings. Below are links to guides
                for
                popular browsers:
            </p>
            <ul>
                <li><a href="#">Google Chrome</a></li>
                <li><a href="#">Microsoft Edge</a></li>
                <li><a href="#">Mozilla Firefox</a></li>
                <li><a href="#">Safari (Apple)</a></li>
            </ul>

            <h2>Third-party cookies</h2>
            <p>
                This site uses third-party services like Google Adsense and Google Analytics to collect usage and
                performance statistics and to improve ad targeting.
            </p>
            <p>
                Social sharing features from Facebook, Twitter, and Google+ may also set cookies.
            </p>

            <h2>Warning about deleting cookies</h2>
            <p>
                You can delete or block all cookies from this site, but some site features may not function correctly or
                the
                quality may be degraded.
            </p>

            <p>
                If you have any questions about our cookie policy, contact us through our contact channels.
            </p>

            <h2>Modification of the Cookies Policy</h2>
            <p>
                The Controller may update this Cookies Policy at any time. We recommend reviewing this page periodically
                for
                any changes.
            </p>
            <p>
                For more information about the Controller and how your personal data is handled, please refer to our <a
                    href="#">Legal Notice</a> and <a href="#">Privacy Policy</a>.
            </p>
        </div>
    </div>
</section>

@endsection
