<div class="container-fluid contact bg-light py-5 smooth-section">
    <div class="container py-5">

        <div class="text-center mb-5">
            <h4 class="text-primary">{{ __('messages.contact') }}</h4>
            <h1 class="display-4">{{ __('messages.comments_apply') }}</h1>
        </div>

        <div class="row g-5 align-items-center">

            <div class="col-xl-6">
                <img src="{{ asset($company->logo ?? 'assets/img/logo.png') }}" class="img-fluid">
            </div>

            <div class="col-xl-6">
                <h4 class="text-primary">{{ __('messages.send_message_title') }}</h4>
                <p>{{ __('messages.send_message_description') }}</p>

                <form method="POST" action="{{ route('contact.store') }}">
                    @csrf

                    <div class="row g-3">

                        <div class="col-md-6">
                            <input type="text" name="name" class="form-control" placeholder="{{ __('messages.contact_form.your_name') }}" required>
                        </div>

                        <div class="col-md-6">
                            <input type="email" name="email" class="form-control" placeholder="{{ __('messages.contact_form.your_email') }}" required>
                        </div>

                        <div class="col-md-6">
                            <input type="text" name="phone" class="form-control" placeholder="{{ __('messages.contact_form.your_phone') }}">
                        </div>

                        <div class="col-md-6">
                            <input type="text" name="company" class="form-control" placeholder="{{ __('messages.contact_form.your_company') }}">
                        </div>

                        <div class="col-12">
                            <input type="text" name="subject" class="form-control" placeholder="{{ __('messages.contact_form.subject') }}" required>
                        </div>

                        <div class="col-12">
                            <textarea class="form-control" name="message" placeholder="{{ __('messages.contact_form.message') }}" style="height: 120px" required></textarea>
                        </div>

                        <div class="col-12">
                            <button class="btn btn-primary w-100 py-3">
                                {{ __('messages.contact_form.send_message') }}
                            </button>
                        </div>

                    </div>

                </form>
            </div>

        </div>

    </div>
</div>
