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
                    <h2 style="overflow: hidden; white-space: nowrap;">{{ 'Cookie Policy' }}</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ __('landing.Home') }}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ 'Cookie Policy' }}
                            </li>
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
            <h2>PRIVACY POLICY</h2>
            <p>This document regulates the rules regarding the Privacy Policy on which the Company Translock IT SLU
                (hereinafter <b>“Translock“</b> ) as Data Controller, will carry out the processing of the personal data
                of its customers (buyers or not of its services) and suppliers or third parties, provided by those
                during their access to the website <a href="www.translockit.com"
                    class="text-primary">www.translockit.com</a> in their registration process or provided by any other
                means valid in law valid in law.</p>
            <p>If you expressly agree to the transfer of your data to Translock, whatever means you do so, provided that
                your consent is express, you will be deemed to be giving it in a free, informed, specific and
                unambiguous way to Translock to process your personal data, in accordance with the General Data
                Protection Regulation of the Parliament and of the Council 679/2016, of April 27 (hereinafter “GDPR”)
                and Organic Law 3/2018, of December 5, On Data Protection and Guarantee of Digital Rights.</p>

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
                    <td style="padding:6px 8px;"><a href="https://www.translockit.com"
                            target="_blank">www.translockit.com</a></td>
                </tr>
                <tr>
                    <td style="font-weight:bold; color:#555; padding:6px 8px;">Email</td>
                    <td style="padding:6px 8px;">:</td>
                    <td style="padding:6px 8px;">sales@translockit.local</td>
                </tr>
                <tr>
                    <td style="font-weight:bold; color:#555; padding:6px 8px;">Social Address</td>
                    <td style="padding:6px 8px;">:</td>
                    <td style="padding:6px 8px;">Calle Joaquin Montes Jovellar, 4 – 28002 Madrid</td>
                </tr>
                <tr>
                    <td style="font-weight:bold; color:#555; padding:6px 8px;">Registration Data</td>
                    <td style="padding:6px 8px;">:</td>
                    <td style="padding:6px 8px;">Registered in the Commercial Register of Madrid, volume 37683, folio
                        101, section 8, sheet M 671389</td>
                </tr>
            </table>
            <p>
                Translock may collect on its website the data of its customers, suppliers and other third parties
                (hereinafter collectively referred to as “the User” or “the Users”) when they access it and register or
                request their services through the contact link.
            </p>
            <p>The User must enter all the data that the Platform requires at all times (especially those marked with an
                asterisk), because if not, he/she will not be able to complete his registration as a User or the use of
                certain functionalities or services available through that.</p>
            <p>Data from Users will also be collected where by other means the Data Subjects have provided it to
                Translock, within the normal development of a commercial or professional activity.</p>
            <p>In addition, the User shall ensure that the Personal Data provided is true and accurate and shall notify
                through the appropriate conduit any changes or modifications thereto.</p>
            <p>In the event that the User provides data of third parties, he/she shall assume responsibility for having
                previously informed him/her and having his/her consent to it, in accordance with Article 14 of the GDPR.
            </p>

            <h2>Category of data collected</h2>
            <p>Translock may collect and process the following personal data of the User:</p>
            <p>Identifying data of the user or their legal representatives; First and last name; NIF Contact details;
                Telephone number; Email and postal address; Company the User works for; Credit or debit card number;
                Bank account.</p>

            <h2>Recipients of the data</h2>
            <p>Those Interested Parties who perform services for Translock, related to the service that Translock
                provides to the User, or vice versa, will have access to the User’s data. Translock will maintain the
                corresponding custom processing contracts with each of the suppliers providing services to it, with the
                aim of ensuring that these providers will process your data in accordance with the provisions of current
                legislation. </p>
            <p>Personal data may also be transferred to the competent authorities provided there is a legal obligation.
            </p>
            <p>Likewise, they may be communicated to financial institutions through which the management of collections
                and payments is articulated.</p>
            <p>They may also be transferred to third parties related to Translock’s activity, in order to send the User
                commercial information that might be of interest to him, always connected to the Translock business and
                provided that the User has expressly accepted it.</p>

            <h2>Purpose of the treatment</h2>
            <p>Translock will process personal data for the purposes set out below, depending on the reason for which
                they were provided to it:</p>
            <ul>
                <li>Carry out the provision of the contracted services, the maintenance of the contractual relationship
                    and the monitoring of the same.</li>
                <li>Contact, process, manage and respond to the request, request, incident or query of the User (whether
                    via email, contact form or telephone).</li>
                <li>Manage, where appropriate, the User’s participation in the customer’s private area.</li>
                <li>Manage, where appropriate, the sending of commercial communications about products and services
                    marketed by Translock by electronic and/or conventional means.</li>
                <li>Make, where appropriate, a User profile to offer you Translock-related products and services in
                    accordance with your interests.</li>
            </ul>
            <p>Assess and manage, where appropriate, the User-provided curriculum for selection processes that fit your
                professional profile and carry out the necessary actions for the selection and recruitment of staff.</p>



            <h2>Clients:</h2>
            <ul>
                <li>Budgeting Billing</li>
                <li>Sending commercial communications</li>
                <li>Updates of service conditions</li>
                <li>Regular communication within the contracted service provision</li>
                <li>Perform a professional profile for the offer of services</li>
            </ul>

            <h2>Providers</h2>
            <ul>
                <li>Budgeting</li>
                <li>Billing</li>
                <li>Sending commercial communications</li>
                <li>Updates of service conditions</li>
                <li>Regular communication within the contracted service provision</li>
            </ul>
            <h2>Social Media Contacts</h2>
            <ul>
                <li>Creating a followers community</li>
                <li>Handling friend requests</li>
                <li>Sending business information</li>
                <li>Make a professional profile for the service offering</li>
                <li>Service Conditions updates</li>
            </ul>

            <h2>Job applicants</h2>
            <ul>
                <li>Valuation of the data included in the curriculum to analyse the suitability to the needs of
                    Translock</li>
                <li>Sending relevant information related to the job sought in the organization</li>
                <li>In case the User expressly accepts it, the data may be transferred to collaborating or related
                    companies in order to help the User to get a job.</li>
            </ul>

            <h2>Information collected by the mobile applications</h2>
            <p>Our Services can be provided through the Mobile Application. We may collect and use technical data and
                related information, including but not limited to, technical information about your device, system and
                application software, and peripherals, that is gathered periodically to facilitate the provision of
                software updates, product support and other services to you (if any) related to such Mobile
                Applications.</p>
            <p>When you use our Mobile Application, it may automatically collect and store some or all of the following
                information from your mobile device (Mobile Device Information), in addition to the Device Information,
                including without limitation: The manufacturer and model of your mobile device; Your mobile operating
                system; Information about how you interact with the Mobile Application and any of our web sites to which
                the Mobile Application links, such as how many times you use a specific part of the Mobile Application
                over a given time period; the amount of time you spend using the Mobile Application; how often you use
                the Mobile Application; actions you take in the Mobile Application and how you engage with the Mobile.
                This information allow us to personalize the services and content available through the Mobile
                Application</p>

            <h2>Legitimation for the collection and processing of data</h2>
            <p>The legal basis for the collection and processing of User data are, on the one hand, the mandatory
                obligation to be able to provide the contracted services and on the other, the consent expressly granted
                by the User for their collection and processing.</p>

            <h2>Duration of the treatment and conservation of the data</h2>
            <p>The data for the management of the relationship with the customer, for the billing and for the collection
                of the services will be kept while the contract is in force. Once this relationship is terminated, if
                applicable, the data may be kept for the time required by the applicable legislation and until they
                prescribe any responsibilities arising from the contract.</p>
            <p>Data for the management of queries and requests will be kept for the time necessary to respond to them,
                with a maximum period of one year.</p>
            <p>The data for the sending of commercial communications and commercial profiling of our products or
                services will be kept for as long as the commercial relationship with the User is maintained and does
                not withdraw their consent to this.</p>
            <p>Resume data for selection processes will be retained for two years.</p>
            <p>For information purposes, the legal time limits for the retention of information in relation to different
                matters are set out below</p>

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
