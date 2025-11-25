<div class="container-fluid contact bg-light py-5">
    <div class="container py-5">
        <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
            <h4 class="text-primary">{{ __('messages.contact') }}</h4>
            <h1 class="display-4 mb-4">{{ __('messages.comments_apply') }}</h1>
        </div>
        <div class="row g-5">
            <div class="col-xl-6 wow fadeInLeft" data-wow-delay="0.2s">
                <div class="contact-img d-flex justify-content-center">
                    <div class="contact-img-inner">
                        <img src="{{ asset($company->logo ?? 'assets/img/logo.png') }}" class="img-fluid" alt="Image">
                    </div>
                </div>
            </div>

            <style>
                .contact-img {
                position: relative;
                height: 100%;
            }

            .contact-img-inner {
                position: absolute;
                top: 80%;
                left: 50%;
                transform: translate(-50%, -50%);
                max-width: 100%;
                transition: var(--transition);
            }

            .contact-img-inner:hover {
                transform: translate(-50%, -50%) scale(1.05);
            }

            @media (max-width: 768px) {
                .contact-img-inner {
                    top: 50%;
                    max-width: 100%;
                }
            }
            </style>

            <div class="col-xl-6 wow fadeInRight" data-wow-delay="0.4s">
                <div>
                    <h4 class="text-primary">{{ __('messages.send_message_title') }}</h4>
                    <p class="mb-4">{{ __('messages.send_message_description') }}</p>
                    
                    <form method="POST" action="{{ route('contact.store') }}">
                        @csrf
                        <div class="row g-3">
                            <div class="col-lg-12 col-xl-6">
                                <div class="form-floating">
                                    <input type="text" name="name" class="form-control border-0" id="name" placeholder="{{ __('messages.contact_form.your_name') }}" required>
                                    <label for="name">{{ __('messages.contact_form.your_name') }} <span class="text-danger">*</span></label>
                                </div>
                            </div>
                            <div class="col-lg-12 col-xl-6">
                                <div class="form-floating">
                                    <input type="email" name="email" class="form-control border-0" id="email" placeholder="{{ __('messages.contact_form.your_email') }}" required>
                                    <label for="email">{{ __('messages.contact_form.your_email') }} <span class="text-danger">*</span></label>
                                </div>
                            </div>
                            <div class="col-lg-12 col-xl-6">
                                <div class="form-floating">
                                    <input type="text" name="phone" class="form-control border-0" id="phone" placeholder="{{ __('messages.contact_form.your_phone') }}"
                                        pattern="[0-9]{8,15}" title="Please enter a valid phone number (8-15 digits)" inputmode="numeric"
                                        minlength="8" maxlength="15" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                                    <label for="phone">{{ __('messages.contact_form.your_phone') }}</label>
                                </div>
                            </div>
                            <div class="col-lg-12 col-xl-6">
                                <div class="form-floating">
                                    <input type="text" name="company" class="form-control border-0" id="project" placeholder="{{ __('messages.contact_form.your_company') }}">
                                    <label for="project">{{ __('messages.contact_form.your_company') }}</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" name="subject" class="form-control border-0" id="subject" placeholder="{{ __('messages.contact_form.subject') }}" required>
                                    <label for="subject">{{ __('messages.contact_form.subject') }} <span class="text-danger">*</span></label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea class="form-control border-0" name="message" placeholder="{{ __('messages.contact_form.message') }}" id="message" style="height: 120px" required></textarea>
                                    <label for="message">{{ __('messages.contact_form.message') }} <span class="text-danger">*</span></label>
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary w-100 py-3">{{ __('messages.contact_form.send_message') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-3 bg-white p-3 rounded wow fadeInUp mx-2 mt-2" data-wow-delay="0.2s">
                        <div class="contact-add-item">
                            <div class="contact-icon text-primary mb-4">
                                <i class="fas fa-map-marker-alt fa-2x"></i>
                            </div>
                            <div>
                                <h4>{{ __('messages.contact_info.address') }}</h4>
                                <p class="mb-0">{{ $company->address }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 bg-white p-3 rounded wow fadeInUp mx-2 mt-2" data-wow-delay="0.4s">
                        <div class="contact-add-item">
                            <div class="contact-icon text-primary mb-4">
                                <i class="fas fa-envelope fa-2x"></i>
                            </div>
                            <div>
                                <h4>{{ __('messages.contact_info.mail_us') }}</h4>
                                <p class="mb-0">{{ $company->email }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 bg-white p-3 rounded wow fadeInUp mx-2 mt-2" data-wow-delay="0.6s">
                        <div class="contact-add-item">
                            <div class="contact-icon text-primary mb-4">
                                <i class="fa fa-phone-alt fa-2x"></i>
                            </div>
                            <div>
                                <h4>{{ __('messages.contact_info.telephone') }}</h4>
                                <p class="mb-0">{{ $company->no_wa }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-12 wow fadeInUp" data-wow-delay="0.2s">
                <div class="rounded">
                    <iframe class="rounded w-100" 
                    style="height: 400px;" src="{{ $company->maps_iframe }}" 
                    loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>