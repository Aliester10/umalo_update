<section class="vision-mission-section">
    <div class="vision-mission-container">
        <div class="vision-mission-grid">

            <!-- VISI -->
            <div class="vm-card">
                <div class="vm-header">
                    <div class="vm-icon"><i class="fas fa-eye"></i></div>
                    <h3 class="vm-title">Visi</h3>
                </div>
                <div class="vm-content">
                    <p>{{ __('messages.vision') ?? $company->visi }}</p>
                </div>
            </div>

            <!-- MISI -->
            <div class="vm-card">
                <div class="vm-header">
                    <div class="vm-icon"><i class="fas fa-bullseye"></i></div>
                    <h3 class="vm-title">Misi</h3>
                </div>
                <div class="vm-content">
                    <ul>
                        <li>{{ __('messages.mission_1') ?? $company->misi }}</li>
                        <li>{{ __('messages.mission_2') }}</li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</section>
