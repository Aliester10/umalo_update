        <section class="production-section">
            <div class="container" style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
                <div class="section-header">
                    <span class="section-tag">
                        <i class="fas fa-cogs"></i>
                        Our Process
                    </span>
                    <h2 class="section-title">
                        From Idea to <span class="section-title-highlight">Innovation</span>
                    </h2>
                </div>

                <div class="production-timeline">
                    <div class="timeline-line"></div>

                    @for($i = 1; $i <= 7; $i++)
                        <div class="production-step" data-step="{{ $i }}">
                            <div class="step-content">
                                <h3 class="step-title">
                                    {{ __('messages.production_line_' . $i . '_title') }}
                                </h3>
                                <p class="step-desc">
                                    {{ __('messages.production_line_' . $i . '_desc') }}
                                </p>
                            </div>
                            
                            <div class="step-number-circle">{{ $i }}</div>
                            
                            <div class="step-image-card">
                                <img src="{{ asset('storage/img/production/step' . $i . '.webp') }}" alt="Step {{ $i }}" class="step-image">
                            </div>
                        </div>
                    @endfor
                </div>
            </div>
        </section>