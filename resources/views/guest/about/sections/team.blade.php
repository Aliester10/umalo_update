<section class="team-section">
    <div class="container" style="max-width:1200px; margin:0 auto; padding:0 20px;">

        <div class="section-header">
            <span class="section-tag"><i class="fas fa-users"></i> The Experts</span>
            <h2 class="section-title">Meet Our <span class="section-title-highlight">Team</span></h2>
        </div>

        <div class="team-image-wrapper">
            <div class="team-badge">
                <i class="fas fa-star"></i>
                <span>Our Amazing Team</span>
            </div>
            <img src="{{ asset('storage/img/ourteam/diskusi_team.webp') }}" class="team-image">
        </div>

        <div class="team-grid">
            @foreach ($team as $member)

            <div class="team-card">

                <div class="team-card-content">

                    <div class="team-photo-wrapper">
                        <div class="team-photo-border"></div>
                        <img src="{{ asset('storage/' . $member->photo) }}?v={{ $member->updated_at->timestamp }}"
                             class="team-photo"
                             alt="{{ $member->name }}">
                    </div>

                    <h3 class="team-name">{{ $member->name }}</h3>

                    <span class="team-position">{{ $member->position }}</span>

                    <p class="team-desc">{{ $member->description }}</p>

                    <div class="team-social">

                        @if ($member->socials && $member->socials->linkedin)
                            <a href="{{ $member->socials->linkedin }}" class="team-social-icon" target="_blank">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                        @endif
                        @if ($member->socials && $member->socials->instagram)
                            <a href="{{ $member->socials->instagram }}" class="team-social-icon" target="_blank">
                                <i class="fab fa-instagram"></i>
                            </a>
                        @endif
                        @if ($member->socials && $member->socials->github)
                            <a href="{{ $member->socials->github }}" class="team-social-icon" target="_blank">
                                <i class="fab fa-github"></i>
                            </a>
                        @endif
                        @if ($member->socials && $member->socials->youtube)
                            <a href="{{ $member->socials->youtube }}" class="team-social-icon" target="_blank">
                                <i class="fab fa-youtube"></i>
                            </a>
                        @endif

                    </div>

                </div>

            </div>

            @endforeach
        </div>

    </div>
</section>
