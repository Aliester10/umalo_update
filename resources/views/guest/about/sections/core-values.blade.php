<section class="core-values-section">
    <div class="container" style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">

        <div class="section-header">
            <span class="section-tag">
                <i class="fas fa-heart"></i>
                Our Principles
            </span>

            <h2 class="section-title">
                Core <span class="section-title-highlight">Values</span>
            </h2>
        </div>

        <div class="core-values-grid">
            @foreach ([
                ['icon'=>'fas fa-lightbulb','title'=>__('messages.innovation'),'desc'=>__('messages.innovation_description')],
                ['icon'=>'fas fa-shield-alt','title'=>__('messages.integrity'),'desc'=>__('messages.integrity_description')],
                ['icon'=>'fas fa-users','title'=>__('messages.customer_focus'),'desc'=>__('messages.customer_focus_description')],
                ['icon'=>'fas fa-handshake','title'=>__('messages.collaboration'),'desc'=>__('messages.collaboration_description')],
                ['icon'=>'fas fa-trophy','title'=>__('messages.excellence'),'desc'=>__('messages.excellence_description')],
            ] as $item)

                <div class="core-value-item">
                    <div class="value-icon-wrapper">
                        <i class="{{ $item['icon'] }} value-icon"></i>
                    </div>
                    <h4 class="value-title">{{ $item['title'] }}</h4>
                    <p class="value-desc">{{ $item['desc'] }}</p>
                </div>

            @endforeach
        </div>

    </div>
</section>
