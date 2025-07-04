@extends('app.index')

@section('content')
<style>
    p {
        margin-bottom: 15px !important;
    }

    h2 {
        margin-top: 35px;
    }

    ul {
        margin-left: 20px;
    }

    .controller-data p {
        margin: 10px 0;
    }

    .label {
        font-weight: bold;
        color: #555;
    }
</style>
<section class="page__title p-relative d-flex align-items-center grey-bg-2" data-overlay="dark" data-opacity="7">
    <div class="page__title-bg" data-background="{{ asset('assets/img/bg/bg-slider_TranslockIt_5.jpg') }}"></div>
    <div class="container">

        <div class="row">
            <div class="col-xl-12">
                <div class="page__title-content mt-100 text-center">
                    <h2 style="overflow: hidden; white-space: nowrap;">{{ __('policy.legal_notice') }}</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ __('landing.Home') }}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ __('policy.legal_notice') }}</li>
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
            <p>This document regulates the rules regarding the legal warnings of the website of the company Translock
                IT, S.L.U. (hereinafter, “the Controller”), regarding the use of the page, contents, data entered
                (Privacy Policy), responsibility for the use or referring to the Cookies used (Cookies Policy), etc.</p>
            <p>Thus, the user is informed in a clear, precise and concise manner of the rights that he/she has and the
                commitments that he/she assumes by reading the documents called “Legal Notice”, “Privacy Policy” and
                “Cookies Policy”, which he can access through the corresponding links on the Web.</p>
                <h2>Controller's Data</h2>
            <table style="width:100%; border-collapse:collapse;">
                <tr>
                    <td style="font-weight:bold; color:#555; padding:6px 8px;">Controller</td>
                    <td style="padding:6px 8px;">:</td>
                    <td style="padding:6px 8px;">Translock IT SLU</td>
                </tr>
                <tr>
                    <td style="font-weight:bold; color:#555; padding:6px 8px;">CIF</td>
                    <td style="padding:6px 8px;">:</td>
                    <td style="padding:6px 8px;">B88074703</td>
                </tr>
                <tr>
                    <td style="font-weight:bold; color:#555; padding:6px 8px;">Website</td>
                    <td style="padding:6px 8px;">:</td>
                    <td style="padding:6px 8px;"><a href="https://www.translockit.com" target="_blank">www.translockit.com</a></td>
                </tr>
                <tr>
                    <td style="font-weight:bold; color:#555; padding:6px 8px;">Social Address</td>
                    <td style="padding:6px 8px;">:</td>
                    <td style="padding:6px 8px;">Calle Joaquin Montes Jovellar, 4 – 28002 Madrid</td>
                </tr>
                <tr>
                    <td style="font-weight:bold; color:#555; padding:6px 8px;">Registration Data</td>
                    <td style="padding:6px 8px;">:</td>
                    <td style="padding:6px 8px;">Registered in the Commercial Register of Madrid, volume 37683, folio 101, section 8, sheet M 671389</td>
                </tr>
            </table>
            <h2>User:</h2>
            <p>
               The mere access and use of the Website attributes the condition of user (hereinafter, the “User” or “Users”) of the Website and implies the full and unreserved acceptance by the User of the total content of the Legal Notice in the version published on the Website at the time of such access.
            </p>
            <h2>Internal rules applicable to navigation:</h2>
            <p>
                In each access of the Users to the Platform, provided that this implies that the Controller must collect some type of data that allows to identify him (name and surname, email, telephone number, mobile number, billing or shipping address, etc., hereinafter, “the Personal Data”), whether with simple navigation, purchase of the products of the Controller or use of its services or functionalities , the Privacy and Cookies Policy and, or any other document mentioned in those (hereinafter, the “Terms and Conditions”) in force at all times, will apply.
            </p>
            <p>
               Access to and use of the Website is subject and, consequently, will be governed by all the provisions of this Legal Notice, without prejudice to the particular conditions that apply to specific services included in the same.
            </p>

            <h2>Changes of the internal rules:</h2>
            <p>
               This Legal Notice, as well as the Privacy Policy and cookies policy may be modified by the Controller, being in force at all times that applicable to the specific operation of the User, so it will be responsibility of the user to visit this Notice and the Policies whenever necessary, in order to verify that the operation of access, purchase, etc., is subject to certain conditions or policies.
            </p>

            <h2>Use of the Website by the User:</h2>
            <p>
               The User undertakes to use the Website in accordance with current legislation, with the provisions of this Legal Notice, as well as with morality, good faith and public order.
            </p>
            <p>The User will be liable for damages of any nature that the Owner of the Website may suffer as a result, directly or indirectly, of the User’s breach of the Legal Notice.</p>
            <p>The Owner of the Website reserves the right to suspend, interrupt, deny or withdraw access to and/or use of its Website at any time and without prior notice, to any User who breaches this Legal Notice.</p>

            <h2>Exclusion of Responsibility of the Controller:</h2>
            <p>To the extent permitted by applicable law, the Website Owner disclaims all liability arising, including but not limited to:
            <ul>
                <li>Any error, deletion, delay or anomaly that may occur in the transmission and operation of the Website, which originate from causes of force majeure or fortuitous event (whether internet problems, computer errors, telephone breakdowns, hackers, etc.), or that would have been caused by bad faith of the User.</li>
                <li>Those arising from the improper use that Users may make of the Website or the liaison websites, and that result in an infringement of intellectual and/or industrial property rights or in other civil or criminal illegals.</li>
                <li>The claims of third parties arising from the misuse by the User of the Website.</li>
                <li>The acts or omissions of third parties, regardless of whether they could maintain some contractual relationship with the Owner of the Website.</li>
                <li>Access to or use of the Website to unsuitable content, as well as the sending of data, by minors, without the consent of parents or legal guardians, when the Law requires it, being the responsibility of the parents or legal guardians to exercise adequate to avoid the access or the minors to the content.</li>
                <li>The errors, omissions, or outdated content published on the Web.</li>
                <li>The uncertain, inaccurate, incorrect or incomplete data provided by the User that prevent transmitting the contracted products or services and / or contact the User.</li>
            </ul>

            <h2>Links to third-party pages:</h2>
            <p>
               The Website may make available to Users links to other websites managed by third parties, through technical devices such as, but not limited to, hypertext links, banners, buttons, directories and any other search tool that allows the User to access websites other than the Web or third-party websites (hereinafter, “Links”). The use of Links does not imply that there is dependence with the Owner of the Website, unless expressly stated otherwise, nor does it imply the acceptance, endorsement or recommendation by the Owner of the Website of the contents or services offered by them, nor any guarantee to the User. Therefore, the User must assess under his/her responsibility the navigation to the other websites through such Links, comprising to hold the Web Owner exempted from all responsibility in relation to the information, data, files, products, services and any kind of material existing on the pages that are accessed to the Web.
            </p>
            <p>Likewise, all those Links between any website and the Website does not imply, by their mere existence, any legal relationship between the Website and the website incorporating such Links, as well as the knowledge and acceptance by the Owner of the Website of their existence and content.</p>
            <h2>Intellectual and Industrial Property</h2>
            <p>
               The Controller holds all rights related to images, articles, links, etc. found on this website or has an authorization from the owner thereof. No user may make use of them without prior authorization from the Controller.
            </p>
            <p>
              It will be understood that the Controller is the exclusive owner of any trademark or distinctive object of intellectual property that appears on its website or, where applicable, that has an authorization from the owner of those, that is limited only to its use on the Website of the Controller and that, therefore, the latter cannot assign to any user without the prior authorization of its owner.
            </p>

            <h2>Regulations and jurisdiction:</h2>
            <p>
               Our legal texts are governed by Spanish law, implementing the provisions of the Data Protection Regulation of the European Parliament and of the Council 679/2016, of April 27 and Organic Law 3/2018 of December 5, on the Protection of Personal Data and guarantee of digital rights and Law 34/2002 of July 11th, on Information Services and Electronic Commerce Society. These texts will remain accessible to users at all times from this website.
            </p>
            <p>
                If the parties do not agree to submit to mediation or arbitration in advance, this legal notice establishes the agreement to submit to the Courts and Tribunals of the Controller’s domicile, expressly waiving any other that may correspond to them.
            </p>
        </div>
    </div>
</section>

@endsection
