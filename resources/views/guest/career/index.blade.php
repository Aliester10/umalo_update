@extends('layouts.guest.master3')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

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
          of IT infrastructure. We're looking for passionate individuals who
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
                <div class="stat-number">{{ $statistics['team_members'] ?? 50 }}+</div>
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

<!-- Benefits Section -->
<section class="benefits-section" id="benefits-section">
  <div class="container">
    <div class="section-header-inline">
      <div class="header-left">
        <div class="section-tag">
          <i class="fas fa-gift"></i>
          Benefits & Perks
        </div>
        <h2 class="section-title">Why Join <span class="text-gradient">Umalo</span>?</h2>
        <p class="section-subtitle">
          Comprehensive packages to support your well-being and career growth
        </p>
      </div>
    </div>

    <div class="benefits-container">
      <div class="benefit-card">
        <div class="benefit-header">
          <div class="benefit-icon-wrapper green">
            <i class="fas fa-heart-pulse"></i>
          </div>
          <h3>Health Insurance</h3>
        </div>
        <p>
          Comprehensive medical, dental, and vision coverage for you and
          your family
        </p>
        <div class="benefit-features">
          <span><i class="fas fa-check"></i> Medical Coverage</span>
          <span><i class="fas fa-check"></i> Dental Care</span>
          <span><i class="fas fa-check"></i> Vision Insurance</span>
        </div>
      </div>

      <div class="benefit-card">
        <div class="benefit-header">
          <div class="benefit-icon-wrapper blue">
            <i class="fas fa-dumbbell"></i>
          </div>
          <h3>Sport & Wellness</h3>
        </div>
        <p>
          Stay active and healthy with our regular sports sessions and
          wellness programs
        </p>
        <div class="benefit-features">
          <span><i class="fas fa-check"></i> Gym Membership</span>
          <span><i class="fas fa-check"></i> Sports Events</span>
          <span><i class="fas fa-check"></i> Wellness Programs</span>
        </div>
      </div>

      <div class="benefit-card">
        <div class="benefit-header">
          <div class="benefit-icon-wrapper red">
            <i class="fas fa-trophy"></i>
          </div>
          <h3>Performance Bonus</h3>
        </div>
        <p>
          Quarterly and annual bonuses based on individual and company
          performance
        </p>
        <div class="benefit-features">
          <span><i class="fas fa-check"></i> Quarterly Bonus</span>
          <span><i class="fas fa-check"></i> Annual Rewards</span>
          <span><i class="fas fa-check"></i> Recognition Program</span>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Job Openings Section -->
<section class="openings-section" id="openings">
  <div class="container">
    <div class="section-header">
      <div class="section-tag">
        <i class="fas fa-briefcase"></i>
        Career Opportunities
      </div>
      <h2 class="section-title">Open Positions</h2>
      <p class="section-subtitle">Find your perfect role and apply today</p>
    </div>

    <!-- Filter Bar -->
    <div class="filter-bar">
      <div class="search-input-job">
        <i class="fas fa-search"></i>
        <input
          type="text"
          id="searchJob"
          placeholder="Search positions..."
          onkeyup="filterJobs()"
        />
      </div>

      <select class="filter-select" id="typeFilter" onchange="filterJobs()">
        <option value="all">All Types</option>
        <option value="full-time">Full Time</option>
        <option value="part-time">Part Time</option>
        <option value="contract">Contract</option>
        <option value="internship">Internship</option>
      </select>
    </div>

    <!-- Jobs List -->
    <div class="jobs-list" id="jobsList">
      @forelse($positions as $index => $position)
        <div
          class="job-item"
          data-department="{{ strtolower(str_replace(' ', '-', $position->department)) }}"
          data-location="{{ strtolower($position->location) }}"
          data-type="{{ strtolower(str_replace('_', '-', $position->employment_type)) }}"
        >
          <div class="job-item-header">
            <div class="job-title-section">
              <h3 class="job-title">{{ $position->title }}</h3>
              <div class="job-meta-badges">
                <span class="badge badge-department">
                  <i class="fas fa-building"></i> 
                  {{ $position->department }}
                </span>
                <span class="badge badge-type">
                  <i class="fas fa-clock"></i> 
                  {{ $position->employment_type }}
                </span>
                @if($position->location)
                <span class="badge badge-location">
                  <i class="fas fa-map-marker-alt"></i> 
                  {{ $position->location }}
                </span>
                @endif
              </div>
            </div>
            <button class="btn-apply" onclick="openModal({{ $index }}, '{{ $position->id }}', '{{ $position->title }}')">
              <span>Apply Now</span>
              <i class="fas fa-arrow-right"></i>
            </button>
          </div>

          <div class="job-description-wrapper">
            <p class="job-description">{{ $position->description }}</p>
          </div>

          @if($position->tags)
            <div class="job-tags-wrapper">
              <div class="job-tags-label">
                <i class="fas fa-tags"></i>
                <span>Skills Required:</span>
              </div>
              <div class="job-tags">
                @foreach(is_array($position->tags) ? $position->tags : json_decode($position->tags, true) as $tag)
                  <span class="tag-item">{{ $tag }}</span>
                @endforeach
              </div>
            </div>
          @endif
        </div>
      @empty
        <div class="no-results">
          <i class="fas fa-briefcase"></i>
          <p>No positions available at the moment. Please check back later!</p>
        </div>
      @endforelse
    </div>

    <!-- No Results -->
    <div class="no-results" id="noResults" style="display: none">
      <i class="fas fa-search"></i>
      <p>No positions found. Try adjusting your filters.</p>
    </div>
  </div>
</section>

<!-- CTA Section -->
<section class="cta-section">
  <div class="container">
    <div class="cta-card">
      <div class="cta-background">
        <div class="cta-orb"></div>
      </div>
      <div class="cta-content">
        <div class="cta-icon">
          <i class="fas fa-envelope-open-text"></i>
        </div>
        <h2>Don't See the Right Position?</h2>
        <p>
          We're always looking for talented people. Send us your resume and
          we'll keep you in mind for future opportunities.
        </p>
      </div>
      <button class="btn-cta" onclick="openModal(-1, 0, 'General Application')">
        Send Your Resume
        <i class="fas fa-arrow-right"></i>
      </button>
    </div>
  </div>
</section>

<!-- Application Modal -->
<div class="modal" id="applicationModal">
  <div class="modal-overlay" onclick="closeModal()"></div>
  <div class="modal-container">
    <div class="modal-header">
      <h2>Apply for <span id="positionTitle">Position</span></h2>
      <button class="modal-close" onclick="closeModal()">
        <i class="fas fa-times"></i>
      </button>
    </div>

    <!-- Error Alert -->
    <div id="errorAlert" class="error-alert" style="display: none;">
      <i class="fas fa-exclamation-circle"></i>
      <div>
        <strong>Error!</strong>
        <p id="errorMessage"></p>
      </div>
      <button onclick="document.getElementById('errorAlert').style.display='none'" class="close-alert">
        <i class="fas fa-times"></i>
      </button>
    </div>

    <form class="application-form" id="applicationForm" action="{{ route('career.apply') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <input type="hidden" name="position_id" id="positionId" value="">

      <div class="form-row">
        <div class="form-group">
          <label>Full Name <span class="required">*</span></label>
          <input type="text" name="full_name" placeholder="Your full name" required />
        </div>

        <div class="form-group">
          <label>Email <span class="required">*</span></label>
          <input type="email" name="email" placeholder="your@email.com" required />
        </div>
      </div>

      <div class="form-row">
        <div class="form-group">
          <label>Phone Number <span class="required">*</span></label>
          <input type="tel" name="phone" placeholder="+62 8xx xxxx xxxx" required />
        </div>

        <div class="form-group">
          <label>Location (optional)</label>
          <input type="text" name="location" placeholder="City, Country" />
        </div>
      </div>

      <div class="form-group">
        <label>LinkedIn Profile (optional)</label>
        <input
          type="text"
          name="linkedin"
          placeholder="linkedin.com/in/yourprofile"
        />
      </div>

      <div class="form-group">
        <label>Resume/CV <span class="required">*</span></label>
        <div class="file-input">
          <input
            type="file"
            id="resume"
            name="resume"
            accept=".pdf,.doc,.docx"
            hidden
            required
          />
          <label for="resume" class="file-label">
            <i class="fas fa-upload"></i>
            <span class="file-text">Choose file</span>
          </label>
          <span class="file-name" id="fileName"></span>
        </div>
        <small>PDF, DOC, DOCX (Max 5MB)</small>
      </div>

      <div class="form-group">
        <label>Cover Letter</label>
        <textarea
          name="cover_letter"
          rows="5"
          placeholder="Tell us why you're interested in this position... (optional)"
        ></textarea>
        <small>Optional - Maximum 5000 characters</small>
      </div>

      <div class="form-actions">
        <button type="button" class="btn-cancel" onclick="closeModal()">
          Cancel
        </button>
        <button type="submit" class="btn-submit" id="submitBtn">
          <span id="submitText">Submit Application</span>
          <span id="submitSpinner" style="display: none;">
            <i class="fas fa-spinner fa-spin"></i> Submitting...
          </span>
        </button>
      </div>
    </form>
  </div>
</div>

<!-- Success Modal -->
<div class="modal" id="successModal">
  <div class="modal-overlay" onclick="closeSuccessModal()"></div>
  <div class="modal-container modal-success">
    <div class="success-icon">
      <i class="fas fa-check-circle"></i>
    </div>
    <h2>Application Submitted!</h2>
    <p>
      Thank you for your interest. We'll review your application and get
      back to you soon.
    </p>
    <button class="btn-submit" onclick="closeSuccessModal()">Close</button>
  </div>
</div>

<style>
/* ========================================
   ROOT VARIABLES
   ======================================== */
:root {
  --white: #ffffff;
  --dark: #1a1a1a;
  --gray: #6b7280;
  --light-gray: #f3f4f6;
  --border: #e5e7eb;
  --green: #107c10;
  --dark-green: #0d5c0d;
  --blue: #0066cc;
  --purple: #7c3aed;
  --orange: #ff9800;
  --teal: #06b6d4;
  --red: #dc2626;
  --navy: #1f2937;
  
  --primary: #228b22;
  --primary-dark: #1a6b1a;
  --secondary: #207178;
  --darker: #020617;
  --gray-900: #0f172a;
  --gray-800: #1e293b;
  --gray-700: #334155;
  --gray-600: #475569;
  --gray-500: #64748b;
  --gray-400: #94a3b8;
  --gray-300: #cbd5e1;
  --gray-200: #e2e8f0;
  --gray-100: #f1f5f9;
  --gray-50: #f8fafc;
  
  --gradient-primary: linear-gradient(135deg, #228b22 0%, #207178 100%);
  --gradient-dark: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
  
  --section-padding: 120px;
  
  --shadow-sm: 0 1px 2px rgba(0, 0, 0, 0.05);
  --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
  --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
  --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
  --shadow-2xl: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
  
  --radius-sm: 8px;
  --radius-md: 12px;
  --radius-lg: 16px;
  --radius-xl: 20px;
  --radius-2xl: 24px;
  
  --transition-base: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  --transition-smooth: all 0.5s cubic-bezier(0.16, 1, 0.3, 1);
}

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
  color: var(--dark);
  background: var(--white);
  overflow-x: hidden;
}

a {
  color: inherit;
  text-decoration: none;
}

/* ========================================
   ANIMATIONS
   ======================================== */
@keyframes float {
  0%, 100% {
    transform: translate(0, 0) rotate(0deg);
  }
  33% {
    transform: translate(30px, -50px) rotate(120deg);
  }
  66% {
    transform: translate(-20px, 20px) rotate(240deg);
  }
}

@keyframes pulse {
  0%, 100% {
    opacity: 1;
    transform: scale(1);
  }
  50% {
    opacity: 0.5;
    transform: scale(1.1);
  }
}

@keyframes fadeIn {
  from {
    opacity: 0;
  }
  to {
    opacity: 1;
  }
}

@keyframes slideUp {
  from {
    opacity: 0;
    transform: translateY(30px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

/* ========================================
   HERO SECTION
   ======================================== */
.hero {
  position: relative;
  min-height: 100vh;
  display: flex;
  align-items: center;
  padding: 140px 0 80px;
  background: var(--white);
  overflow: hidden;
}

.hero-background {
  position: absolute;
  inset: 0;
  z-index: 0;
}

.gradient-orb {
  position: absolute;
  border-radius: 50%;
  filter: blur(100px);
  opacity: 0.3;
  animation: float 20s ease-in-out infinite;
}

.orb-1 {
  width: 600px;
  height: 600px;
  background: var(--gradient-primary);
  top: -200px;
  right: -100px;
}

.orb-2 {
  width: 500px;
  height: 500px;
  background: var(--gradient-primary);
  bottom: -150px;
  left: -100px;
  animation-delay: -10s;
}

.grid-overlay {
  position: absolute;
  inset: 0;
  background-image: 
    linear-gradient(var(--gray-200) 1px, transparent 1px),
    linear-gradient(90deg, var(--gray-200) 1px, transparent 1px);
  background-size: 50px 50px;
  opacity: 0.3;
}

.container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 20px;
  position: relative;
  z-index: 1;
  width: 100%;
}

.hero-content {
  display: grid;
  grid-template-columns: 1.2fr 1fr;
  gap: 60px;
  align-items: center;
}

.hero-tag {
  display: inline-flex;
  align-items: center;
  gap: 10px;
  padding: 8px 20px;
  background: rgba(34, 139, 34, 0.1);
  border: 1px solid rgba(34, 139, 34, 0.2);
  border-radius: 100px;
  color: var(--primary);
  font-size: 13px;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 1px;
  margin-bottom: 32px;
  animation: slideUp 0.8s ease;
}

.tag-pulse {
  width: 8px;
  height: 8px;
  background: var(--primary);
  border-radius: 50%;
  animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
}

.hero-title {
  font-family: 'Space Grotesk', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
  font-size: clamp(32px, 6vw, 72px);
  font-weight: 700;
  line-height: 1.1;
  letter-spacing: -0.02em;
  color: var(--dark);
  margin-bottom: 28px;
  animation: slideUp 0.8s ease 0.1s backwards;
}

.text-gradient {
  background: var(--gradient-primary);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}

.hero-description {
  font-size: clamp(16px, 2vw, 20px);
  color: var(--gray-600);
  line-height: 1.7;
  margin-bottom: 40px;
  max-width: 600px;
  animation: slideUp 0.8s ease 0.2s backwards;
}

.hero-buttons {
  display: flex;
  gap: 16px;
  flex-wrap: wrap;
  animation: slideUp 0.8s ease 0.3s backwards;
}

.btn-primary,
.btn-secondary {
  padding: 14px 28px;
  border-radius: var(--radius-lg);
  font-weight: 600;
  font-size: 15px;
  text-decoration: none;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 10px;
  transition: var(--transition-base);
  border: none;
  cursor: pointer;
  white-space: nowrap;
}

.btn-primary {
  background: var(--dark);
  color: var(--white);
  box-shadow: var(--shadow-md);
}

.btn-primary:hover {
  background: var(--gray-900);
  transform: translateY(-2px);
  box-shadow: var(--shadow-xl);
}

.btn-primary:hover i {
  transform: translateX(3px);
}

.btn-secondary {
  background: var(--light-gray);
  color: var(--dark);
  border: 2px solid var(--border);
}

.btn-secondary:hover {
  border-color: var(--primary);
  background: var(--white);
  color: var(--primary);
  transform: translateY(-2px);
}

/* Hero Stats Card */
.hero-stats-card {
  background: var(--white);
  border: 1px solid var(--border);
  border-radius: var(--radius-2xl);
  padding: 32px;
  box-shadow: var(--shadow-2xl);
  transition: var(--transition-smooth);
  animation: slideUp 0.8s ease 0.4s backwards;
}

.hero-stats-card:hover {
  transform: translateY(-8px);
  box-shadow: 0 30px 60px -12px rgba(0, 0, 0, 0.15);
}

.stats-header {
  display: flex;
  align-items: center;
  gap: 12px;
  margin-bottom: 24px;
  padding-bottom: 20px;
  border-bottom: 2px solid var(--gray-100);
}

.stats-icon {
  width: 48px;
  height: 48px;
  display: flex;
  align-items: center;
  justify-content: center;
  background: var(--gradient-primary);
  border-radius: var(--radius-lg);
  color: var(--white);
  font-size: 20px;
  flex-shrink: 0;
}

.stats-header h3 {
  font-size: clamp(16px, 2vw, 18px);
  font-weight: 700;
  color: var(--dark);
}

.stat-row {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 20px;
  margin-bottom: 20px;
}

.stat-row:last-child {
  margin-bottom: 0;
}

.stat-box {
  display: flex;
  align-items: center;
  gap: 12px;
  padding: 16px;
  background: var(--gray-50);
  border-radius: var(--radius-lg);
  transition: var(--transition-base);
  border: 2px solid transparent;
}

.stat-box:hover {
  background: var(--white);
  border-color: var(--primary);
  transform: scale(1.05);
}

.stat-icon-wrapper {
  width: 40px;
  height: 40px;
  display: flex;
  align-items: center;
  justify-content: center;
  border-radius: var(--radius-md);
  color: var(--white);
  font-size: 18px;
  flex-shrink: 0;
}

.stat-icon-wrapper.green {
  background: linear-gradient(135deg, #10b981 0%, #059669 100%);
}
.stat-icon-wrapper.blue {
  background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
}
.stat-icon-wrapper.purple {
  background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
}
.stat-icon-wrapper.orange {
  background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
}

.stat-content {
  flex: 1;
  min-width: 0;
}

.stat-number {
  font-size: clamp(20px, 3vw, 28px);
  font-weight: 800;
  color: var(--dark);
  margin-bottom: 2px;
  line-height: 1;
}

.stat-label {
  font-size: clamp(11px, 1.5vw, 12px);
  color: var(--gray-600);
  font-weight: 500;
}

/* ========================================
   BENEFITS SECTION
   ======================================== */
.benefits-section {
  padding: var(--section-padding) 0;
  background: var(--gray-50);
}

.section-header-inline {
  margin-bottom: 60px;
}

.section-tag {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  padding: 8px 20px;
  background: var(--white);
  border: 1px solid var(--border);
  border-radius: 100px;
  color: var(--gray-700);
  font-size: 13px;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 1px;
  margin-bottom: 20px;
}

.section-tag i {
  color: var(--primary);
}

.header-left .section-title {
  font-family: 'Space Grotesk', sans-serif;
  font-size: clamp(28px, 5vw, 48px);
  font-weight: 700;
  color: var(--dark);
  margin-bottom: 12px;
  line-height: 1.2;
  letter-spacing: -0.02em;
}

.header-left .section-subtitle {
  font-size: clamp(16px, 2vw, 18px);
  color: var(--gray-600);
  line-height: 1.6;
}

.benefits-container {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
  gap: 28px;
}

.benefit-card {
  background: var(--white);
  border: 1px solid var(--border);
  border-radius: var(--radius-xl);
  padding: 32px;
  transition: var(--transition-smooth);
  position: relative;
  overflow: hidden;
}

.benefit-card::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 4px;
  background: var(--gradient-primary);
  transform: scaleX(0);
  transition: transform 0.3s ease;
}

.benefit-card:hover::before {
  transform: scaleX(1);
}

.benefit-card:hover {
  border-color: var(--primary);
  transform: translateY(-8px);
  box-shadow: var(--shadow-2xl);
}

.benefit-header {
  display: flex;
  align-items: center;
  gap: 16px;
  margin-bottom: 16px;
}

.benefit-icon-wrapper {
  width: 56px;
  height: 56px;
  border-radius: var(--radius-lg);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 24px;
  color: var(--white);
  flex-shrink: 0;
  transition: transform 0.3s ease;
}

.benefit-card:hover .benefit-icon-wrapper {
  transform: rotate(10deg) scale(1.1);
}

.benefit-icon-wrapper.green {
  background: linear-gradient(135deg, #10b981 0%, #059669 100%);
}
.benefit-icon-wrapper.blue {
  background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
}
.benefit-icon-wrapper.red {
  background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
}

.benefit-card h3 {
  font-size: clamp(18px, 2.5vw, 20px);
  font-weight: 700;
  color: var(--dark);
}

.benefit-card > p {
  font-size: clamp(14px, 1.5vw, 15px);
  color: var(--gray-600);
  line-height: 1.7;
  margin-bottom: 20px;
}

.benefit-features {
  display: flex;
  flex-direction: column;
  gap: 8px;
}

.benefit-features span {
  display: flex;
  align-items: center;
  gap: 8px;
  font-size: 13px;
  color: var(--gray-700);
  font-weight: 500;
}

.benefit-features i {
  color: var(--primary);
  font-size: 12px;
}

/* ========================================
   OPENINGS SECTION
   ======================================== */
.openings-section {
  padding: var(--section-padding) 0;
  background: var(--white);
}

.section-header {
  text-align: center;
  margin-bottom: 60px;
}

.section-title {
  font-family: 'Space Grotesk', sans-serif;
  font-size: clamp(28px, 5vw, 48px);
  font-weight: 700;
  color: var(--dark);
  margin-bottom: 12px;
  line-height: 1.2;
  letter-spacing: -0.02em;
}

.section-subtitle {
  font-size: clamp(16px, 2vw, 18px);
  color: var(--gray-600);
}

/* Filter Bar */
.filter-bar {
  display: grid;
  grid-template-columns: 2fr 1fr;
  gap: 16px;
  margin-bottom: 40px;
}

.search-input-job {
  position: relative;
}

.search-input-job i {
  position: absolute;
  left: 20px;
  top: 50%;
  transform: translateY(-50%);
  color: var(--gray-500);
  font-size: 16px;
  pointer-events: none;
}

.search-input-job input {
  width: 100%;
  padding: 14px 20px 14px 52px;
  border: 2px solid var(--border);
  border-radius: var(--radius-lg);
  font-size: 15px;
  background: var(--white);
  transition: var(--transition-base);
  font-family: inherit;
}

.search-input-job input:focus {
  outline: none;
  border-color: var(--primary);
  box-shadow: 0 0 0 4px rgba(34, 139, 34, 0.1);
}

.filter-select {
  padding: 14px 20px;
  border: 2px solid var(--border);
  border-radius: var(--radius-lg);
  font-size: 15px;
  background: var(--white);
  cursor: pointer;
  transition: var(--transition-base);
  font-family: inherit;
  font-weight: 500;
  color: var(--dark);
}

.filter-select:focus {
  outline: none;
  border-color: var(--primary);
  box-shadow: 0 0 0 4px rgba(34, 139, 34, 0.1);
}

/* Jobs List */
.jobs-list {
  display: flex;
  flex-direction: column;
  gap: 24px;
}

.job-item {
  background: var(--white);
  border: 2px solid var(--border);
  border-radius: var(--radius-xl);
  padding: 36px;
  transition: var(--transition-smooth);
  opacity: 1;
  position: relative;
  overflow: hidden;
}

.job-item::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  bottom: 0;
  width: 5px;
  background: var(--gradient-primary);
  transform: scaleY(0);
  transition: transform 0.3s ease;
}

.job-item:hover::before {
  transform: scaleY(1);
}

.job-item:hover {
  border-color: var(--primary);
  box-shadow: var(--shadow-xl);
  transform: translateX(8px);
}

.job-item.hidden {
  display: none;
}

/* Job Item Header */
.job-item-header {
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
  margin-bottom: 24px;
  gap: 24px;
  padding-bottom: 20px;
  border-bottom: 2px solid var(--gray-100);
}

.job-title-section {
  flex: 1;
  min-width: 0;
}

.job-title {
  font-size: clamp(20px, 3vw, 24px);
  font-weight: 700;
  color: var(--dark);
  margin-bottom: 16px;
  transition: color 0.3s ease;
  line-height: 1.3;
}

.job-item:hover .job-title {
  color: var(--primary);
}

/* Meta Badges */
.job-meta-badges {
  display: flex;
  gap: 10px;
  flex-wrap: wrap;
  align-items: center;
}

.badge {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  padding: 8px 16px;
  border-radius: 100px;
  font-size: 13px;
  font-weight: 600;
  transition: var(--transition-base);
}

.badge i {
  font-size: 12px;
}

.badge-department {
  background: rgba(34, 139, 34, 0.1);
  color: var(--primary);
  border: 1px solid rgba(34, 139, 34, 0.2);
}

.badge-type {
  background: rgba(59, 130, 246, 0.1);
  color: #2563eb;
  border: 1px solid rgba(59, 130, 246, 0.2);
}

.badge-location {
  background: rgba(139, 92, 246, 0.1);
  color: var(--purple);
  border: 1px solid rgba(139, 92, 246, 0.2);
}

.badge:hover {
  transform: translateY(-2px);
  box-shadow: var(--shadow-sm);
}

.btn-apply {
  padding: 12px 28px;
  background: var(--dark);
  color: var(--white);
  border: none;
  border-radius: var(--radius-lg);
  font-weight: 600;
  font-size: 15px;
  cursor: pointer;
  transition: var(--transition-base);
  white-space: nowrap;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 8px;
  box-shadow: var(--shadow-md);
  flex-shrink: 0;
}

.btn-apply:hover {
  background: var(--gray-900);
  transform: translateY(-2px);
  box-shadow: var(--shadow-xl);
}

.btn-apply:hover i {
  transform: translateX(3px);
}

/* Job Description */
.job-description-wrapper {
  margin-bottom: 24px;
}

.job-description {
  font-size: clamp(14px, 1.5vw, 16px);
  color: var(--gray-700);
  line-height: 1.8;
  letter-spacing: 0.01em;
}

/* Job Tags */
.job-tags-wrapper {
  background: var(--gray-50);
  padding: 20px;
  border-radius: var(--radius-lg);
  border: 1px solid var(--gray-200);
}

.job-tags-label {
  display: flex;
  align-items: center;
  gap: 8px;
  margin-bottom: 12px;
  font-size: 13px;
  font-weight: 700;
  color: var(--gray-700);
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

.job-tags-label i {
  color: var(--primary);
  font-size: 14px;
}

.job-tags {
  display: flex;
  gap: 10px;
  flex-wrap: wrap;
}

.tag-item {
  padding: 8px 16px;
  background: var(--white);
  border: 1px solid var(--gray-300);
  border-radius: 100px;
  font-size: 13px;
  color: var(--gray-700);
  font-weight: 500;
  transition: var(--transition-base);
}

.tag-item:hover {
  background: var(--primary);
  color: var(--white);
  border-color: var(--primary);
  transform: translateY(-2px);
  box-shadow: var(--shadow-sm);
}

/* No Results */
.no-results {
  text-align: center;
  padding: 80px 20px;
  background: var(--gray-50);
  border: 2px dashed var(--border);
  border-radius: var(--radius-xl);
}

.no-results i {
  font-size: clamp(48px, 8vw, 64px);
  color: var(--gray-400);
  margin-bottom: 20px;
  opacity: 0.5;
}

.no-results p {
  font-size: clamp(14px, 2vw, 16px);
  color: var(--gray-600);
  font-weight: 500;
}

/* ========================================
   CTA SECTION
   ======================================== */
.cta-section {
  padding: var(--section-padding) 0;
  background: var(--gray-50);
}

.cta-card {
  position: relative;
  background: var(--gradient-dark);
  border-radius: var(--radius-2xl);
  padding: 64px;
  display: flex;
  justify-content: space-between;
  align-items: center;
  gap: 48px;
  transition: var(--transition-smooth);
  overflow: hidden;
}

.cta-background {
  position: absolute;
  inset: 0;
  z-index: 0;
}

.cta-orb {
  position: absolute;
  width: 500px;
  height: 500px;
  background: var(--gradient-primary);
  border-radius: 50%;
  filter: blur(100px);
  opacity: 0.2;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  animation: float 15s ease-in-out infinite;
}

.cta-card:hover {
  transform: translateY(-8px);
  box-shadow: 0 30px 60px -12px rgba(0, 0, 0, 0.3);
}

.cta-content {
  position: relative;
  z-index: 1;
  flex: 1;
}

.cta-icon {
  width: 64px;
  height: 64px;
  display: flex;
  align-items: center;
  justify-content: center;
  background: rgba(255, 255, 255, 0.1);
  backdrop-filter: blur(10px);
  border-radius: var(--radius-lg);
  color: var(--white);
  font-size: 28px;
  margin-bottom: 24px;
}

.cta-content h2 {
  font-family: 'Space Grotesk', sans-serif;
  font-size: clamp(24px, 4vw, 36px);
  font-weight: 700;
  color: var(--white);
  margin-bottom: 12px;
  line-height: 1.2;
}

.cta-content p {
  font-size: clamp(14px, 2vw, 16px);
  color: rgba(255, 255, 255, 0.85);
  line-height: 1.7;
  max-width: 600px;
}

.btn-cta {
  position: relative;
  z-index: 1;
  padding: 16px 36px;
  background: var(--white);
  color: var(--dark);
  border: none;
  border-radius: var(--radius-lg);
  font-weight: 700;
  font-size: 16px;
  cursor: pointer;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 12px;
  transition: var(--transition-base);
  white-space: nowrap;
  box-shadow: var(--shadow-xl);
}

.btn-cta:hover {
  background: var(--gray-100);
  transform: translateY(-3px);
  box-shadow: 0 20px 40px -12px rgba(0, 0, 0, 0.4);
}

.btn-cta:hover i {
  transform: translateX(5px);
}

/* ========================================
   MODAL
   ======================================== */
.modal {
  display: none;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.7);
  backdrop-filter: blur(8px);
  z-index: 1000;
  align-items: center;
  justify-content: center;
  padding: 20px;
  overflow-y: auto;
}

.modal.active {
  display: flex;
}

.modal-overlay {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  cursor: pointer;
}

.modal-container {
  position: relative;
  background: var(--white);
  border-radius: var(--radius-2xl);
  width: 100%;
  max-width: 650px;
  max-height: 90vh;
  overflow-y: auto;
  z-index: 1001;
  box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
  animation: slideUp 0.4s cubic-bezier(0.16, 1, 0.3, 1);
  margin: auto;
  
  /* HIDE SCROLLBAR */
  scrollbar-width: none;
  -ms-overflow-style: none;
}

.modal-container::-webkit-scrollbar {
  display: none;
}

@keyframes slideUp {
  from {
    opacity: 0;
    transform: translateY(40px) scale(0.95);
  }
  to {
    opacity: 1;
    transform: translateY(0) scale(1);
  }
}

.modal-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 24px 28px;
  border-bottom: 2px solid var(--gray-100);
  background: var(--white);
  position: sticky;
  top: 0;
  z-index: 2;
}

.modal-header h2 {
  font-size: clamp(18px, 3vw, 24px);
  font-weight: 700;
  color: var(--dark);
  margin: 0;
  line-height: 1.3;
  padding-right: 10px;
}

.modal-close {
  background: var(--gray-100);
  border: none;
  width: 40px;
  height: 40px;
  border-radius: 50%;
  font-size: 18px;
  cursor: pointer;
  color: var(--gray-700);
  transition: var(--transition-base);
  padding: 0;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
}

.modal-close:hover {
  background: var(--dark);
  color: var(--white);
  transform: rotate(90deg);
}

/* Error Alert */
.error-alert {
  display: flex;
  align-items: flex-start;
  gap: 14px;
  padding: 16px 20px;
  background: #fee;
  border: 2px solid #fcc;
  border-radius: var(--radius-lg);
  margin: 20px 28px 0 28px;
  animation: slideUp 0.3s ease;
}

.error-alert i {
  color: var(--red);
  font-size: 20px;
  flex-shrink: 0;
  margin-top: 2px;
}

.error-alert div {
  flex: 1;
}

.error-alert strong {
  color: var(--red);
  display: block;
  margin-bottom: 6px;
  font-size: 14px;
}

.error-alert p {
  color: #c00;
  margin: 0;
  font-size: 13px;
  line-height: 1.5;
}

.close-alert {
  background: none;
  border: none;
  color: var(--red);
  cursor: pointer;
  font-size: 18px;
  padding: 0;
  width: 24px;
  height: 24px;
  flex-shrink: 0;
  transition: color 0.2s ease;
}

.close-alert:hover {
  color: #c00;
}

/* Form */
.application-form {
  padding: 28px;
}

.form-row {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 20px;
  margin-bottom: 24px;
}

.form-group {
  margin-bottom: 24px;
}

.form-row .form-group {
  margin-bottom: 0;
}

.form-group label {
  display: block;
  font-size: 14px;
  font-weight: 600;
  color: var(--dark);
  margin-bottom: 10px;
}

.required {
  color: var(--red);
}

.form-group input,
.form-group textarea {
  width: 100%;
  padding: 12px 16px;
  border: 2px solid var(--border);
  border-radius: var(--radius-lg);
  font-size: 15px;
  font-family: inherit;
  transition: var(--transition-base);
  background: var(--white);
  color: var(--dark);
}

.form-group input:focus,
.form-group textarea:focus {
  outline: none;
  border-color: var(--primary);
  box-shadow: 0 0 0 4px rgba(34, 139, 34, 0.1);
}

.form-group input::placeholder,
.form-group textarea::placeholder {
  color: var(--gray-400);
}

.form-group textarea {
  resize: vertical;
  min-height: 120px;
}

.form-group small {
  font-size: 13px;
  color: var(--gray-600);
  display: block;
  margin-top: 8px;
}

/* File Input */
.file-input {
  display: flex;
  align-items: center;
  gap: 14px;
  margin-bottom: 8px;
  flex-wrap: wrap;
}

.file-label {
  display: inline-flex;
  align-items: center;
  gap: 10px;
  padding: 12px 24px;
  background: var(--gray-100);
  border: 2px solid var(--border);
  border-radius: var(--radius-lg);
  cursor: pointer;
  font-weight: 600;
  font-size: 14px;
  transition: var(--transition-base);
  white-space: nowrap;
}

.file-label:hover {
  background: var(--white);
  border-color: var(--primary);
  color: var(--primary);
  transform: translateY(-2px);
}

.file-name {
  font-size: 14px;
  color: var(--gray-600);
  flex: 1;
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
  font-weight: 500;
}

/* Form Actions */
.form-actions {
  display: flex;
  gap: 14px;
  margin-top: 32px;
  padding-top: 28px;
  border-top: 2px solid var(--gray-100);
}

.btn-cancel,
.btn-submit {
  flex: 1;
  padding: 14px 28px;
  border: none;
  border-radius: var(--radius-lg);
  font-weight: 600;
  font-size: 15px;
  cursor: pointer;
  transition: var(--transition-base);
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 10px;
}

.btn-cancel {
  background: var(--gray-100);
  color: var(--dark);
  border: 2px solid var(--border);
}

.btn-cancel:hover {
  background: var(--white);
  border-color: var(--gray-400);
}

.btn-submit {
  background: var(--dark);
  color: var(--white);
  box-shadow: var(--shadow-md);
}

.btn-submit:hover:not(:disabled) {
  background: var(--gray-900);
  transform: translateY(-2px);
  box-shadow: var(--shadow-xl);
}

.btn-submit:disabled {
  opacity: 0.6;
  cursor: not-allowed;
}

/* Success Modal */
.modal-success {
  text-align: center;
  padding: 56px 40px;
}

.success-icon {
  width: 96px;
  height: 96px;
  background: rgba(16, 185, 129, 0.1);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  margin: 0 auto 28px;
  animation: scaleIn 0.5s cubic-bezier(0.16, 1, 0.3, 1);
}

@keyframes scaleIn {
  from {
    transform: scale(0);
  }
  to {
    transform: scale(1);
  }
}

.success-icon i {
  font-size: 48px;
  color: #10b981;
}

.modal-success h2 {
  font-family: 'Space Grotesk', sans-serif;
  font-size: clamp(24px, 4vw, 32px);
  font-weight: 700;
  color: var(--dark);
  margin-bottom: 16px;
}

.modal-success p {
  font-size: clamp(14px, 2vw, 16px);
  color: var(--gray-600);
  margin-bottom: 32px;
  line-height: 1.7;
  max-width: 400px;
  margin-left: auto;
  margin-right: auto;
}

/* ========================================
   RESPONSIVE - ENHANCED
   ======================================== */

/* Large Tablets and Small Desktops (1024px - 1199px) */
@media (max-width: 1199px) {
  :root {
    --section-padding: 100px;
  }

  .container {
    max-width: 960px;
  }

  .hero-content {
    gap: 50px;
  }

  .cta-card {
    padding: 48px;
  }
}

/* Tablets (768px - 1023px) */
@media (max-width: 1023px) {
  :root {
    --section-padding: 80px;
  }

  .container {
    max-width: 720px;
  }

  .hero {
    padding: 120px 0 60px;
    min-height: auto;
  }

  .hero-content {
    grid-template-columns: 1fr;
    gap: 40px;
  }

  .hero-right {
    max-width: 500px;
    margin: 0 auto;
  }

  .benefits-container {
    grid-template-columns: repeat(2, 1fr);
    gap: 24px;
  }

  .filter-bar {
    grid-template-columns: 1.5fr 1fr;
  }

  .job-item {
    padding: 28px;
  }

  .cta-card {
    padding: 40px 32px;
    gap: 32px;
  }
}

/* Mobile Landscape and Small Tablets (640px - 767px) */
@media (max-width: 767px) {
  :root {
    --section-padding: 60px;
  }

  .hero {
    padding: 100px 0 50px;
  }

  .hero-tag {
    font-size: 11px;
    padding: 6px 16px;
    margin-bottom: 24px;
  }

  .hero-title {
    margin-bottom: 20px;
  }

  .hero-description {
    margin-bottom: 32px;
  }

  .hero-buttons {
    flex-direction: column;
    width: 100%;
  }

  .btn-primary,
  .btn-secondary {
    width: 100%;
    justify-content: center;
    padding: 16px 24px;
    font-size: 14px;
  }

  .stat-row {
    grid-template-columns: 1fr;
    gap: 16px;
  }

  .section-header-inline,
  .section-header {
    margin-bottom: 40px;
  }

  .section-tag {
    font-size: 11px;
    padding: 6px 16px;
  }

  .benefits-container {
    grid-template-columns: 1fr;
    gap: 20px;
  }

  .benefit-card {
    padding: 24px;
  }

  .filter-bar {
    grid-template-columns: 1fr;
    gap: 12px;
  }

  .search-input-job input,
  .filter-select {
    padding: 12px 16px;
    font-size: 14px;
  }

  .search-input-job input {
    padding-left: 44px;
  }

  .search-input-job i {
    left: 16px;
    font-size: 14px;
  }

  .job-item {
    padding: 24px;
  }

  .job-item-header {
    flex-direction: column;
    gap: 16px;
    padding-bottom: 16px;
  }

  .job-title {
    margin-bottom: 12px;
  }

  .job-meta-badges {
    gap: 8px;
  }

  .badge {
    padding: 6px 12px;
    font-size: 12px;
  }

  .btn-apply {
    width: 100%;
    justify-content: center;
    padding: 14px 24px;
  }

  .job-tags-wrapper {
    padding: 16px;
  }

  .job-tags {
    gap: 8px;
  }

  .tag-item {
    padding: 6px 12px;
    font-size: 12px;
  }

  .cta-card {
    flex-direction: column;
    text-align: center;
    padding: 36px 24px;
    gap: 28px;
  }

  .cta-icon {
    margin: 0 auto 20px;
  }

  .cta-content p {
    max-width: 100%;
  }

  .btn-cta {
    width: 100%;
    justify-content: center;
    padding: 14px 28px;
  }

  .modal {
    padding: 16px;
  }

  .modal-container {
    width: 100%;
    max-height: 85vh;
  }

  .modal-header {
    padding: 20px 24px;
  }

  .application-form {
    padding: 24px;
  }

  .error-alert {
    margin: 16px 24px 0 24px;
    padding: 14px 16px;
  }

  .form-row {
    grid-template-columns: 1fr;
    gap: 0;
    margin-bottom: 0;
  }

  .form-row .form-group {
    margin-bottom: 24px;
  }

  .form-group {
    margin-bottom: 20px;
  }

  .form-actions {
    flex-direction: column;
    gap: 12px;
  }

  .btn-cancel,
  .btn-submit {
    width: 100%;
  }

  .modal-success {
    padding: 40px 28px;
  }

  .success-icon {
    width: 80px;
    height: 80px;
    margin-bottom: 24px;
  }

  .success-icon i {
    font-size: 40px;
  }
}

/* Small Mobile (480px - 639px) */
@media (max-width: 639px) {
  .container {
    padding: 0 16px;
  }

  .hero-stats-card {
    padding: 24px;
  }

  .stats-header {
    margin-bottom: 20px;
    padding-bottom: 16px;
  }

  .stats-icon {
    width: 40px;
    height: 40px;
    font-size: 18px;
  }

  .stat-box {
    padding: 14px;
    gap: 10px;
  }

  .stat-icon-wrapper {
    width: 36px;
    height: 36px;
    font-size: 16px;
  }

  .benefit-icon-wrapper {
    width: 48px;
    height: 48px;
    font-size: 20px;
  }

  .job-item {
    padding: 20px;
  }

  .job-item:hover {
    transform: translateX(4px);
  }

  .job-description-wrapper {
    margin-bottom: 20px;
  }

  .no-results {
    padding: 60px 16px;
  }

  .cta-card {
    padding: 32px 20px;
  }

  .cta-icon {
    width: 56px;
    height: 56px;
    font-size: 24px;
    margin-bottom: 16px;
  }
}

/* Extra Small Mobile (320px - 479px) */
@media (max-width: 479px) {
  :root {
    --section-padding: 50px;
  }

  .container {
    padding: 0 14px;
  }

  .hero {
    padding: 90px 0 40px;
  }

  .hero-tag {
    font-size: 10px;
    padding: 5px 14px;
    gap: 6px;
  }

  .tag-pulse {
    width: 6px;
    height: 6px;
  }

  .hero-description {
    margin-bottom: 28px;
  }

  .hero-stats-card {
    padding: 20px;
  }

  .stats-header h3 {
    font-size: 16px;
  }

  .stat-number {
    font-size: 22px;
  }

  .stat-label {
    font-size: 11px;
  }

  .section-tag {
    font-size: 10px;
    padding: 5px 14px;
  }

  .benefit-card {
    padding: 20px;
  }

  .benefit-header {
    gap: 12px;
  }

  .benefit-icon-wrapper {
    width: 44px;
    height: 44px;
    font-size: 18px;
  }

  .benefit-features span {
    font-size: 12px;
  }

  .filter-bar {
    margin-bottom: 32px;
  }

  .search-input-job input,
  .filter-select {
    padding: 11px 14px;
    font-size: 13px;
  }

  .search-input-job input {
    padding-left: 40px;
  }

  .search-input-job i {
    left: 14px;
    font-size: 13px;
  }

  .job-item {
    padding: 18px;
  }

  .job-item-header {
    margin-bottom: 20px;
    padding-bottom: 14px;
  }

  .job-title {
    margin-bottom: 10px;
  }

  .badge {
    padding: 5px 10px;
    font-size: 11px;
  }

  .badge i {
    font-size: 10px;
  }

  .btn-apply {
    padding: 12px 20px;
    font-size: 14px;
  }

  .job-tags-wrapper {
    padding: 14px;
  }

  .job-tags-label {
    font-size: 11px;
    margin-bottom: 10px;
  }

  .tag-item {
    padding: 5px 10px;
    font-size: 11px;
  }

  .cta-card {
    padding: 28px 18px;
  }

  .cta-icon {
    width: 52px;
    height: 52px;
    font-size: 22px;
  }

  .btn-cta {
    padding: 13px 24px;
    font-size: 14px;
  }

  .modal {
    padding: 12px;
  }

  .modal-container {
    border-radius: var(--radius-xl);
    max-height: 88vh;
  }

  .modal-header {
    padding: 18px 20px;
  }

  .modal-close {
    width: 36px;
    height: 36px;
    font-size: 16px;
  }

  .application-form {
    padding: 20px;
  }

  .error-alert {
    margin: 14px 20px 0 20px;
    padding: 12px 14px;
  }

  .form-group label {
    font-size: 13px;
    margin-bottom: 8px;
  }

  .form-group input,
  .form-group textarea {
    padding: 11px 14px;
    font-size: 14px;
  }

  .form-group small {
    font-size: 12px;
  }

  .file-label {
    padding: 11px 20px;
    font-size: 13px;
  }

  .file-name {
    font-size: 13px;
  }

  .form-actions {
    margin-top: 28px;
    padding-top: 24px;
  }

  .btn-cancel,
  .btn-submit {
    padding: 13px 24px;
    font-size: 14px;
  }

  .modal-success {
    padding: 36px 24px;
  }

  .success-icon {
    width: 72px;
    height: 72px;
    margin-bottom: 20px;
  }

  .success-icon i {
    font-size: 36px;
  }
}

/* Landscape Mode Fixes for Mobile */
@media (max-height: 600px) and (orientation: landscape) {
  .hero {
    padding: 80px 0 40px;
    min-height: auto;
  }

  .modal-container {
    max-height: 95vh;
  }

  .modal {
    padding: 10px;
  }

  .modal-header {
    padding: 16px 20px;
  }

  .application-form {
    padding: 20px;
  }

  .form-group {
    margin-bottom: 16px;
  }

  .form-actions {
    margin-top: 24px;
    padding-top: 20px;
  }

  .modal-success {
    padding: 32px 28px;
  }

  .success-icon {
    width: 64px;
    height: 64px;
    margin-bottom: 16px;
  }

  .success-icon i {
    font-size: 32px;
  }
}

/* Very Large Screens (1920px+) */
@media (min-width: 1920px) {
  .container {
    max-width: 1400px;
  }

  .hero {
    padding: 160px 0 100px;
  }

  .hero-stats-card {
    padding: 40px;
  }

  .benefit-card {
    padding: 40px;
  }

  .job-item {
    padding: 40px;
  }

  .cta-card {
    padding: 72px;
  }
}

/* Accessibility Improvements */
@media (prefers-reduced-motion: reduce) {
  *,
  *::before,
  *::after {
    animation-duration: 0.01ms !important;
    animation-iteration-count: 1 !important;
    transition-duration: 0.01ms !important;
  }
}

/* Dark Mode Support (Optional) */
@media (prefers-color-scheme: dark) {
  /* You can add dark mode styles here if needed */
}

/* Print Styles */
@media print {
  .hero-background,
  .cta-background,
  .gradient-orb,
  .modal,
  .hero-buttons,
  .btn-apply,
  .filter-bar {
    display: none !important;
  }

  body {
    background: white;
    color: black;
  }

  .job-item {
    page-break-inside: avoid;
    border: 1px solid #ddd;
    margin-bottom: 20px;
  }
}

/* Hover Effects - Disable on Touch Devices */
@media (hover: none) and (pointer: coarse) {
  .btn-primary:hover,
  .btn-secondary:hover,
  .btn-apply:hover,
  .btn-cta:hover,
  .benefit-card:hover,
  .job-item:hover,
  .stat-box:hover,
  .tag-item:hover {
    transform: none;
  }

  .job-item:hover {
    transform: none;
  }

  .modal-close:hover {
    transform: none;
  }

  .benefit-card:hover .benefit-icon-wrapper {
    transform: none;
  }
}
</style>

<script>
  // ==========================================
  // MODAL FUNCTIONS
  // ==========================================
  function openModal(index, positionId, positionTitle) {
    document.getElementById('positionId').value = positionId || '';
    document.getElementById('positionTitle').textContent = positionTitle;
    document.getElementById('applicationModal').classList.add('active');
    document.getElementById('errorAlert').style.display = 'none';
    document.getElementById('applicationForm').reset();
    document.getElementById('fileName').textContent = '';
    document.body.style.overflow = 'hidden';
  }

  function closeModal() {
    document.getElementById('applicationModal').classList.remove('active');
    document.getElementById('applicationForm').reset();
    document.getElementById('fileName').textContent = '';
    document.getElementById('errorAlert').style.display = 'none';
    document.body.style.overflow = '';
  }

  function closeSuccessModal() {
    document.getElementById('successModal').classList.remove('active');
    document.body.style.overflow = '';
    closeModal();
  }

  // ==========================================
  // FILE UPLOAD HANDLER
  // ==========================================
  document.getElementById('resume').addEventListener('change', function (e) {
    const fileName = e.target.files[0]?.name;
    if (fileName) {
      document.getElementById('fileName').textContent = fileName;
    }
  });

  // ==========================================
  // FORM SUBMIT HANDLER - AJAX
  // ==========================================
  document.getElementById('applicationForm').addEventListener('submit', function (e) {
    e.preventDefault();

    const formData = new FormData(this);
    const actionUrl = this.action;

    const submitBtn = document.getElementById('submitBtn');
    const submitText = document.getElementById('submitText');
    const submitSpinner = document.getElementById('submitSpinner');

    submitBtn.disabled = true;
    submitText.style.display = 'none';
    submitSpinner.style.display = 'inline';

    fetch(actionUrl, {
      method: 'POST',
      body: formData,
      headers: {
        'X-Requested-With': 'XMLHttpRequest',
      }
    })
    .then(response => {
      if (response.ok) {
        return response.json().then(data => ({
          status: response.status,
          data: data
        }));
      } else if (response.status === 422) {
        return response.json().then(data => ({
          status: response.status,
          data: data
        }));
      } else {
        return response.json().then(data => ({
          status: response.status,
          data: data
        }));
      }
    })
    .then(result => {
      submitBtn.disabled = false;
      submitText.style.display = 'inline';
      submitSpinner.style.display = 'none';

      if (result.status === 200 && result.data.success) {
        document.getElementById('applicationModal').classList.remove('active');
        document.getElementById('successModal').classList.add('active');
        document.getElementById('applicationForm').reset();
        document.getElementById('fileName').textContent = '';
      } else {
        const errorAlert = document.getElementById('errorAlert');
        const errorMessage = document.getElementById('errorMessage');

        if (result.data.errors) {
          const errorList = Object.values(result.data.errors)
            .flat()
            .join(', ');
          errorMessage.textContent = errorList;
        } else {
          errorMessage.textContent = result.data.message || 'An error occurred. Please try again.';
        }

        errorAlert.style.display = 'flex';
        document.querySelector('.modal-container').scrollTop = 0;
      }
    })
    .catch(error => {
      console.error('Error:', error);
      submitBtn.disabled = false;
      submitText.style.display = 'inline';
      submitSpinner.style.display = 'none';

      const errorAlert = document.getElementById('errorAlert');
      const errorMessage = document.getElementById('errorMessage');
      errorMessage.textContent = 'Network error. Please try again.';
      errorAlert.style.display = 'flex';
      document.querySelector('.modal-container').scrollTop = 0;
    });
  });

  // ==========================================
  // JOB FILTER FUNCTIONS
  // ==========================================
  function filterJobs() {
    const searchTerm = document.getElementById('searchJob').value.toLowerCase();
    const typeFilter = document.getElementById('typeFilter').value;

    const jobItems = document.querySelectorAll('.job-item');
    let visibleCount = 0;

    jobItems.forEach(item => {
      const title = item.querySelector('.job-title').textContent.toLowerCase();
      const description = item.querySelector('.job-description').textContent.toLowerCase();
      const type = item.dataset.type;

      const matchSearch = title.includes(searchTerm) || description.includes(searchTerm);
      const matchType = typeFilter === 'all' || type === typeFilter;

      if (matchSearch && matchType) {
        item.style.display = '';
        visibleCount++;
      } else {
        item.style.display = 'none';
      }
    });

    document.getElementById('noResults').style.display = visibleCount === 0 ? 'block' : 'none';
  }

  // ==========================================
  // MODAL OVERLAY CLICK HANDLER
  // ==========================================
  document.getElementById('applicationModal').addEventListener('click', function (e) {
    if (e.target === this || e.target.classList.contains('modal-overlay')) {
      closeModal();
    }
  });

  document.getElementById('successModal').addEventListener('click', function (e) {
    if (e.target === this || e.target.classList.contains('modal-overlay')) {
      closeSuccessModal();
    }
  });

  // ==========================================
  // INITIALIZATION
  // ==========================================
  document.addEventListener('DOMContentLoaded', function() {
    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
      anchor.addEventListener('click', function (e) {
        const href = this.getAttribute('href');
        if (href !== '#' && href.length > 1) {
          e.preventDefault();
          const target = document.querySelector(href);
          if (target) {
            const offsetTop = target.offsetTop - 90;
            window.scrollTo({ 
              top: offsetTop, 
              behavior: 'smooth' 
            });
          }
        }
      });
    });

    // Close modal with ESC key
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape') {
        if (document.getElementById('applicationModal').classList.contains('active')) {
          closeModal();
        }
        if (document.getElementById('successModal').classList.contains('active')) {
          closeSuccessModal();
        }
      }
    });

    // Animation on scroll for elements
    const observerOptions = {
      threshold: 0.2,
      rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.style.opacity = '1';
          entry.target.style.transform = 'translateY(0)';
        }
      });
    }, observerOptions);

    // Observe elements for animation
    document.querySelectorAll('.stat-box, .benefit-card, .job-item').forEach(el => {
      el.style.opacity = '0';
      el.style.transform = 'translateY(30px)';
      el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
      observer.observe(el);
    });

    // Touch device detection
    const isTouchDevice = 'ontouchstart' in window || navigator.maxTouchPoints > 0;
    if (isTouchDevice) {
      document.body.classList.add('touch-device');
    }

    // Viewport height fix for mobile browsers
    const setVH = () => {
      const vh = window.innerHeight * 0.01;
      document.documentElement.style.setProperty('--vh', `${vh}px`);
    };
    setVH();
    window.addEventListener('resize', setVH);
    window.addEventListener('orientationchange', setVH);

    // Console log
    console.log('%c╔═══════════════════════════════════════════════════════╗', 'color: #228B22; font-weight: bold; font-size: 14px');
    console.log('%c║   UMALO CAREER PAGE - FULLY RESPONSIVE               ║', 'color: #228B22; font-weight: bold; font-size: 16px');
    console.log('%c║   Updated: 2025-11-18 09:25:26 UTC                   ║', 'color: #228B22; font-weight: bold; font-size: 14px');
    console.log('%c║   User: karinaamiriti                                ║', 'color: #228B22; font-weight: bold; font-size: 14px');
    console.log('%c╚═══════════════════════════════════════════════════════╝', 'color: #228B22; font-weight: bold; font-size: 14px');
    console.log('\n%c✅ RESPONSIVE FEATURES:', 'color: #10b981; font-weight: bold; font-size: 14px; background: #d1fae5; padding: 8px; border-radius: 4px');
    console.log('%c  ✓ Desktop (1920px+)', 'color: #059669; font-size: 12px; font-weight: bold');
    console.log('%c  ✓ Laptop (1200px - 1919px)', 'color: #059669; font-size: 12px; font-weight: bold');
    console.log('%c  ✓ Tablet (768px - 1199px)', 'color: #059669; font-size: 12px; font-weight: bold');
    console.log('%c  ✓ Mobile Landscape (640px - 767px)', 'color: #059669; font-size: 12px; font-weight: bold');
    console.log('%c  ✓ Mobile Portrait (480px - 639px)', 'color: #059669; font-size: 12px; font-weight: bold');
    console.log('%c  ✓ Small Mobile (320px - 479px)', 'color: #059669; font-size: 12px; font-weight: bold');
    console.log('\n%c📱 MOBILE OPTIMIZATIONS:', 'color: #2563eb; font-weight: bold; font-size: 14px; background: #dbeafe; padding: 8px; border-radius: 4px');
    console.log('%c  • Touch-friendly buttons & inputs', 'color: #1d4ed8; font-size: 12px');
    console.log('%c  • Optimized modal for small screens', 'color: #1d4ed8; font-size: 12px');
    console.log('%c  • Responsive typography (clamp)', 'color: #1d4ed8; font-size: 12px');
    console.log('%c  • Flexible grid layouts', 'color: #1d4ed8; font-size: 12px');
    console.log('%c  • Landscape mode support', 'color: #1d4ed8; font-size: 12px');
    console.log('%c  • Reduced motion support', 'color: #1d4ed8; font-size: 12px');
    console.log('\n%c🎨 Ready for all devices!', 'color: #228B22; font-weight: bold; font-size: 16px; background: #e6ffe6; padding: 12px; border-radius: 6px');
  });
</script>
@endsection