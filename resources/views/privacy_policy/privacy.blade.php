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
                    <h2 style="overflow: hidden; white-space: nowrap;">{{ __('policy.privacy_policy') }}</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ __('landing.Home') }}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ __('policy.privacy_policy') }}</li>
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
            <h2>{{ __('policy.privacy.1') }}</h2>
            <p>{!! __('policy.privacy.11') !!}</p>
            <p>{!! __('policy.privacy.12') !!}</p>

            <h2>{!! __('policy.privacy.2') !!}</h2>
            <table style="width:100%; border-collapse:collapse;">
                <tr>
                    <td style="font-weight:bold; color:#555; padding:6px 8px;">{{ __('policy.privacy.2A') }}</td>
                    <td style="padding:6px 8px;">:</td>
                    <td style="padding:6px 8px;">Translock IT SLU</td>
                </tr>
                <tr>
                    <td style="font-weight:bold; color:#555; padding:6px 8px;">CIF</td>
                    <td style="padding:6px 8px;">:</td>
                    <td style="padding:6px 8px;">B88074703</td>
                </tr>
                <tr>
                    <td style="font-weight:bold; color:#555; padding:6px 8px;">{{ __('policy.privacy.2B') }}</td>
                    <td style="padding:6px 8px;">:</td>
                    <td style="padding:6px 8px;"><a href="https://www.translockit.com"
                            target="_blank">www.translockit.com</a></td>
                </tr>
                <tr>
                    <td style="font-weight:bold; color:#555; padding:6px 8px;">{{ __('policy.privacy.2E') }}</td>
                    <td style="padding:6px 8px;">:</td>
                    <td style="padding:6px 8px;">sales@translockit.local</td>
                </tr>
                <tr>
                    <td style="font-weight:bold; color:#555; padding:6px 8px;">{{ __('policy.privacy.2C') }}</td>
                    <td style="padding:6px 8px;">:</td>
                    <td style="padding:6px 8px;">{{ __('policy.privacy.2C1') }}</td>
                </tr>
                <tr>
                    <td style="font-weight:bold; color:#555; padding:6px 8px;">{{ __('policy.privacy.2D') }}</td>
                    <td style="padding:6px 8px;">:</td>
                    <td style="padding:6px 8px;">{{ __('policy.privacy.2D1') }}</td>
                </tr>
            </table>
            <p class="mt-3">
                {{ __('policy.privacy.21') }}</p>
            </p>{{ __('policy.privacy.22') }}</p>
            <p>{{ __('policy.privacy.23') }}</p>
            <p>{{ __('policy.privacy.24') }}</p>
            <p>{{ __('policy.privacy.25') }}</p>

            <h2>{{ __('policy.privacy.3') }}</h2>
            <p>{{ __('policy.privacy.31') }}</p>
            <p>{{ __('policy.privacy.32') }}</p>

            <h2>{{ __('policy.privacy.4') }}</h2>
            <p>{{ __('policy.privacy.41') }}</p>
            <p>{{ __('policy.privacy.42') }}</p>
            <p>{{ __('policy.privacy.43') }}</p>
            <p>{{ __('policy.privacy.44') }}</p>

            <h2>{{ __('policy.privacy.5') }}</h2>
            <p>{{ __('policy.privacy.51') }}</p>
            <p>{{ __('policy.privacy.52') }}</p>
            <p>{{ __('policy.privacy.53') }}</p>
            <p>{{ __('policy.privacy.54') }}</p>
            <p>{{ __('policy.privacy.55') }}</p>
            <p>{{ __('policy.privacy.56') }}</p>
            <p>{{ __('policy.privacy.57') }}</p>
            <p>{{ __('policy.privacy.58') }}</p>

            <h2>{{ __('policy.privacy.5') }}</h2>
            <p>{{ __('policy.privacy.51') }}</p>
            <p>{{ __('policy.privacy.52') }}</p>
            <p>{{ __('policy.privacy.53') }}</p>
            <p>{{ __('policy.privacy.54') }}</p>
            <ul>
                <li>{{ __('policy.privacy.55') }}</li>
                <li>{{ __('policy.privacy.56') }}</li>
                <li>{{ __('policy.privacy.57') }}</li>
            </ul>
            <p>{{ __('policy.privacy.58') }}</p>



            <h3>{{ __('policy.privacy.6') }}</h3>
            <ul>
                <li>{{ __('policy.privacy.61') }}</li>
                <li>{{ __('policy.privacy.62') }}</li>
                <li>{{ __('policy.privacy.63') }}</li>
                <li>{{ __('policy.privacy.64') }}</li>
                <li>{{ __('policy.privacy.65') }}</li>
            </ul>

            <h2>{{ __('policy.privacy.7') }}</h2>
            <ul>
                <li>{{ __('policy.privacy.71') }}</li>
                <li>{{ __('policy.privacy.72') }}</li>
                <li>{{ __('policy.privacy.73') }}</li>
                <li>{{ __('policy.privacy.74') }}</li>
                <li>{{ __('policy.privacy.75') }}</li>
            </ul>
            <h2>{{ __('policy.privacy.8') }}</h2>
            <ul>
                <li>{{ __('policy.privacy.81') }}</li>
                <li>{{ __('policy.privacy.82') }}</li>
                <li>{{ __('policy.privacy.83') }}</li>
                <li>{{ __('policy.privacy.84') }}</li>
                <li>{{ __('policy.privacy.85') }}</li>
            </ul>

            <h2>{{ __('policy.privacy.9') }}</h2>
            <ul>
                <li>{{ __('policy.privacy.91') }}</li>
                <li>{{ __('policy.privacy.92') }}</li>
                <li>{{ __('policy.privacy.93') }}</li>
            </ul>

            <h2>{{ __('policy.privacy.10') }}</h2>
            <p>{{ __('policy.privacy.101') }}</p>
            <p>{{ __('policy.privacy.102') }}</p>

            <h2>{{ __('policy.privacy.11') }}</h2>
            <p>{{ __('policy.privacy.111') }}</p>

            <h2>{{ __('policy.privacy.12') }}</h2>
            <p>{{ __('policy.privacy.121') }}</p>
            <p>{{ __('policy.privacy.122') }}</p>
            <p>{{ __('policy.privacy.123') }}</p>
            <p>{{ __('policy.privacy.124') }}</p>
            <p>{{ __('policy.privacy.125') }}</p>

            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover rounded-3 overflow-hidden">
                    <thead class="table-header-custom">
                        <tr>
                            <th scope="col" class="p-3 text-start text-uppercase fw-medium fs-6 rounded-top-left">
                                DOCUMENT
                            </th>
                            <th scope="col" class="p-3 text-start text-uppercase fw-medium fs-6">
                                TERM
                            </th>
                            <th scope="col" class="p-3 text-start text-uppercase fw-medium fs-6 rounded-top-right">
                                LEGAL REF.
                            </th>
                        </tr>
                    </thead>
                    <tbody class="text-wrap">
                        <tr>
                            <td class="p-3 text-dark fw-medium">
                                Labour or social security-related documentation
                            </td>
                            <td class="p-3 text-secondary text-start">
                                4 years
                            </td>
                            <td class="p-3 text-secondary">
                                Article 21 of Royal Legislative Decree 5/2000 of 4 August approving the consolidated
                                text of the Law on Violations and Sanctions in the Social Order
                            </td>
                        </tr>
                        <tr>
                            <td class="p-3 text-dark fw-medium">
                                Accounting and tax documentation for commercial purposes
                            </td>
                            <td class="p-3 text-secondary text-start">
                                6 years
                            </td>
                            <td class="p-3 text-secondary">
                                Art. 30 Commercial Code
                            </td>
                        </tr>
                        <tr>
                            <td class="p-3 text-dark fw-medium">
                                Accounting and tax documentation for tax purposes
                            </td>
                            <td class="p-3 text-secondary text-start">
                                4 years
                            </td>
                            <td class="p-3 text-secondary">
                                Articles 66 to 70 General Tax Law
                            </td>
                        </tr>
                        <tr>
                            <td class="p-3 text-dark fw-medium">
                                Control of access to buildings
                            </td>
                            <td class="p-3 text-secondary text-start" style="white-space: nowrap;">
                                1 month
                            </td>
                            <td class="p-3 text-secondary">
                                Instruction 1/1996 Spanish Data Protection Agency (AEPD)
                            </td>
                        </tr>
                        <tr>
                            <td class="p-3 text-dark fw-medium">
                                Video surveillance
                            </td>
                            <td class="p-3 text-secondary text-start" tyle="white-space: nowrap;">
                                1 month
                            </td>
                            <td class="p-3 text-secondary">
                                Guide of 26 November 2018 of the AEPD Organic Law 4/1997. Law 5/2014 of April 4, On
                                Private Security
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <h2>User´s rights:</h2>
            <ul>
                <li>Any User who provides their personal data to Translock may exercise the following rights:</li>
                <li>Access, rectification, opposition, deletion, portability and limitation of processing, as well as
                    reject the automated processing of personal data collected by the Controller.</li>
                <li>In turn, every User shall have the right to withdraw at any time the consent he has given.</li>
                <li>These rights may be exercised free of charge by the User, referring to the request that is specified
                    in the request through the contact details contained in the link of Legal Notice.</li>
                <li>The User has the right to revoke the consent given at any time for the sending of commercial
                    communications, simply notifying Translock and informing he does not wish to continue receiving
                    commercial communications. To do this, the User may revoke their consent by referring to their
                    request through the contact details contained in the Legal Notice or by clicking the link “no more
                    commercial communications”</li>
                <li>The User has the right to file a complaint with the Spanish Data Protection Agency if he understands
                    that the Controller has committed any type of breach in the processing of his data.</li>
            </ul>
            <h2>Minors</h2>
            <p>The Controller will not collect for himself, in any case, data of minors. Given the difficulty of
                checking the age of Users, it will be the holders of the parental authority or the guardianship of
                children under the age of 14, who must establish the control measures on the devices that minors may
                access to, in order to prevent them from improperly giving their data.</p>
            <p>If the Controller has reliable knowledge at any time that a minor has accessed his/her platform and their
                data is being processed without the authorization of their legal representatives, will immediately
                unsubscribe from such User.</p>
            <h2>Security measures</h2>
            <p>The Controller undertakes to comply with the commitment of secrecy of personal data and its duty to keep
                it, processing the personal data of the User confidentially, adopting the necessary technical and
                organizational measures that guarantee the security of the data and prevent its alteration, loss,
                treatment or unauthorized access, taking into account the state of technology, the nature of the stored
                data and the risks to which they are exposed.</p>
            <h2>Changes to the privacy policy</h2>
            <p>The Responsible may modify its Privacy Policy in accordance with the applicable legislation at any time.
                In any case, any modification of the Privacy Policy will be duly notified to the User to be informed of
                the changes made in the processing of their personal data and, if the applicable regulations so require,
                the User can give their consent.</p>
        </div>
    </div>
</section>

@endsection
