
<div class="container-fluid service py-5 mb-5 smooth-section">
    <div class="container py-5">

        <div class="text-center mx-auto pb-5" style="max-width: 800px;">
            <h4 class="text-primary">{{ __('messages.services_subtitle') }}</h4>
            <h1 class="display-4 mb-4">{{ __('messages.services_title') }}</h1>
            <p>{{ __('messages.services_description') }}</p>
        </div>

        <div class="row g-4 justify-content-center">

            @php
                $services = [
                    ['img'=>'iot.webp',    'icon'=>'fa-network-wired', 'title'=>__('messages.iot_integration'),      'desc'=>__('messages.iot_description')],
                    ['img'=>'ai.webp',     'icon'=>'fa-robot',         'title'=>__('messages.ai_solutions'),        'desc'=>__('messages.ai_description')],
                    ['img'=>'cyber.webp',  'icon'=>'fa-lock',          'title'=>__('messages.cybersecurity'),       'desc'=>__('messages.cybersecurity_description')],
                    ['img'=>'labor.webp',  'icon'=>'fa-microscope',    'title'=>__('messages.labor_simulator'),     'desc'=>__('messages.labor_description')],
                    ['img'=>'smart.webp',  'icon'=>'fa-cogs',          'title'=>__('messages.smart_automation'),    'desc'=>__('messages.smart_automation_description')],
                    ['img'=>'smart2.webp', 'icon'=>'fa-desktop',       'title'=>__('messages.smart_it_solutions'),  'desc'=>__('messages.smart_it_description')],
                ];
            @endphp

            @foreach ($services as $index => $service)
                <div class="col-md-6 col-lg-4 col-xl-3 wow fadeInUp"
                     data-wow-delay="{{ 0.2 + $index * 0.1 }}s">
                    <div class="service-item">
                        <div class="service-img">
                            <img
                                src="{{ asset('assets/img/' . $service['img']) }}"
                                class="img-fluid rounded-top w-100"
                                alt="{{ $service['title'] }}"
                                loading="lazy"
                                decoding="async">
                            <div class="service-icon p-3">
                                <i class="fa {{ $service['icon'] }} fa-2x"></i>
                            </div>
                        </div>
                        <div class="service-content p-4">
                            <a href="#" class="d-inline-block h4 mb-4">{{ $service['title'] }}</a>
                            <p>{{ $service['desc'] }}</p>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</div>
