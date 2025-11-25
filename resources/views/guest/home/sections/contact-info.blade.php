<div class="container py-5">
    <div class="row justify-content-center">

        <div class="col-md-3 bg-white p-4 rounded text-center shadow-sm m-2">
            <i class="fas fa-map-marker-alt fa-2x text-primary mb-3"></i>
            <h4>{{ __('messages.contact_info.address') }}</h4>
            <p>{{ $company->address }}</p>
        </div>

        <div class="col-md-3 bg-white p-4 rounded text-center shadow-sm m-2">
            <i class="fas fa-envelope fa-2x text-primary mb-3"></i>
            <h4>{{ __('messages.contact_info.mail_us') }}</h4>
            <p>{{ $company->email }}</p>
        </div>

        <div class="col-md-3 bg-white p-4 rounded text-center shadow-sm m-2">
            <i class="fas fa-phone-alt fa-2x text-primary mb-3"></i>
            <h4>{{ __('messages.contact_info.telephone') }}</h4>
            <p>{{ $company->no_wa }}</p>
        </div>

    </div>
</div>
