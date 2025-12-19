<!-- Hero Section with Stats -->
<section class="hero">
  <div class="hero-background">
    <div class="gradient-orb orb-1"></div>
    <div class="gradient-orb orb-2"></div>
    <div class="grid-overlay"></div>
  </div>

  <div class="container">
    <div class="hero-content">
      <div class="hero-left">
        <div class="hero-tag">
          <span class="tag-pulse"></span>
          We're Hiring
        </div>
        <h1 class="hero-title">
          Build Your Career<br />
          <span class="text-gradient">With Umalo</span>
        </h1>
        <p class="hero-description">
          Join our team of talented professionals and help shape the future
          of IT infrastructure.We're looking for passionate individuals who
          want to make an impact.
        </p>
        <div class="hero-buttons">
          <button class="btn-primary" onclick="document.getElementById('openings').scrollIntoView({ behavior: 'smooth' })">
            <span>View Open Positions</span>
            <i class="fas fa-arrow-right"></i>
          </button>
          <button class="btn-secondary" onclick="document.getElementById('benefits-section').scrollIntoView({ behavior: 'smooth' })">
            <i class="fas fa-info-circle"></i>
            <span>Learn About Us</span>
          </button>
        </div>
      </div>
      <div class="hero-right">
        <div class="hero-stats-card">
          <div class="stats-header">
            <div class="stats-icon">
              <i class="fas fa-chart-line"></i>
            </div>
            <h3>Company Overview</h3>
          </div>
          <div class="stat-row">
            <div class="stat-box">
              <div class="stat-icon-wrapper blue">
                <i class="fas fa-users"></i>
              </div>
              <div class="stat-content">
                <div class="stat-number">{{ $statistics['team_members'] ??  50 }}+</div>
                <div class="stat-label">Team Members</div>
              </div>
            </div>
            <div class="stat-box">
              <div class="stat-icon-wrapper green">
                <i class="fas fa-briefcase"></i>
              </div>
              <div class="stat-content">
                <div class="stat-number">{{ count($positions) }}</div>
                <div class="stat-label">Open Positions</div>
              </div>
            </div>
          </div>
          <div class="stat-row">
            <div class="stat-box">
              <div class="stat-icon-wrapper purple">
                <i class="fas fa-building"></i>
              </div>
              <div class="stat-content">
                <div class="stat-number">{{ $statistics['clients'] ?? 99 }}+</div>
                <div class="stat-label">Happy Clients</div>
              </div>
            </div>
            <div class="stat-box">
              <div class="stat-icon-wrapper orange">
                <i class="fas fa-star"></i>
              </div>
              <div class="stat-content">
                <div class="stat-number">{{ $statistics['satisfaction'] ?? 95 }}%</div>
                <div class="stat-label">Satisfaction</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>