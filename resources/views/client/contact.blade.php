@extends('client.master.template')

@section('body_content')
    <!-- ===========Info Section Ends Here========== -->
    <div class="info-section margin-top padding-top padding-bottom">
        <div class="container">
            <div class="section-header">
                <p>{{ __('message.contact.head-1') }}</p>
                <h2>{{ __('message.contact.head-2') }}</h2>
            </div>
            <div class="section-wrapper">
                <div class="row justify-content-center g-4">
                    <div class="col-lg-4 col-sm-6 col-12">
                        <div class="contact-item text-center">
                            <div class="contact-thumb mb-4">
                                <img src="assets/images/contact/icon/01.png" alt="contact-thumb">
                            </div>
                            <div class="contact-content">
                                <h6 class="title">{{ __('message.contact.address') }}</h6>
                                <p style="height: 25px">
                                    {{ \App\Models\Option::where('name', 'address_site')->first()->value }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 col-12">
                        <div class="contact-item text-center">
                            <div class="contact-thumb mb-4">
                                <img src="assets/images/contact/icon/02.png" alt="contact-thumb">
                            </div>
                            <div class="contact-content">
                                <h6 class="title">{{ __('message.contact.phone') }}</h6>
                                <p style="height: 25px">
                                    {{ \App\Models\Option::where('name', 'phone_site')->first()->value }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 col-12">
                        <div class="contact-item text-center">
                            <div class="contact-thumb mb-4">
                                <img src="assets/images/contact/icon/03.png" alt="contact-thumb">
                            </div>
                            <div class="contact-content">
                                <h6 class="title">{{ __('message.contact.sendmail') }}</h6>
                                <p style="height: 25px">
                                    {{ \App\Models\Option::where('name', 'email_site')->first()->value }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ===========Info Section Ends Here========== -->


    <!-- ===========Contact Section Ends Here========== -->
    <div class="contact-section">
        <div class="contact-top padding-top padding-bottom bg-attachment"
            style="background-image:url(assets/images/video/bg.jpg)">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-lg-9">
                        <div class="contact-form-wrapper text-center">
                            <h2 class="mb-5">{{ __('message.contact.head-3') }}</h2>
                            <form class="contact-form" action="contact.php" id="contact-form" method="POST">
                                <div class="form-group">
                                    <input type="text" placeholder="Your Name" id="name" name="name"
                                        required="required">
                                </div>
                                <div class="form-group">
                                    <input type="text" placeholder="Your Email" id="email" name="email" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" placeholder="Phone" id="phone" name="phone" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" placeholder="Subject" id="subject" name="subject" required>
                                </div>
                                <div class="form-group w-100">
                                    <textarea name="message" rows="8" id="message" placeholder="Your Message" required></textarea>
                                </div>
                                <div class="form-group w-100 text-center">
                                    <button class="default-button" type="submit"><span>Send our Message</span></button>
                                </div>
                            </form>
                            <p class="form-message"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="contact-bottom">
            <div class="contac-bottom">
                <div class="row justify-content-center g-0">
                    <div class="col-12">
                        <div class="location-map">
                            <div id="map">
                                <iframe
                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3929.0600373687744!2d105.74704152190756!3d10.011899769951238!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31a089b347a30a2f%3A0xe649905c1f0a33e0!2zMyDEkC4gVHLhuqduIFbEqW5oIEtp4bq_dCwgQW4gQsOsbmgsIE5pbmggS2nhu4F1LCBD4bqnbiBUaMahLCBWaWV0bmFt!5e0!3m2!1sen!2s!4v1668429264208!5m2!1sen!2s"
                                    width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                                    referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ===========Contact Section Ends Here========== -->
@endsection
