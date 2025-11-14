@extends('layouts.guest.master3')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<!-- Hero Section with Stats -->
<section class="hero">
  <div class="container">
    <div class="hero-content">
      <div class="hero-left">
        <span class="hero-badge">We're Hiring</span>
        <h1 class="hero-title">
          Build Your Career<br />With Umalo
        </h1>
        <p class="hero-description">
          Join our team of talented professionals and help shape the future
          of IT infrastructure. We're looking for passionate individuals who
          want to make an impact.
        </p>
        <div class="hero-buttons">
          <button class="btn-primary" onclick="document.getElementById('openings').scrollIntoView({ behavior: 'smooth' })">
            View Open Positions
            <i class="fas fa-arrow-right"></i>
          </button>
          <button class="btn-secondary" onclick="document.getElementById('benefits-section').scrollIntoView({ behavior: 'smooth' })">
            Learn About Us
          </button>
        </div>
      </div>
      <div class="hero-right">
        <div class="hero-stats-card">
          <div class="stat-row">
            <div class="stat-box">
              <div class="stat-number">{{ $statistics['team_members'] ?? 50 }}</div>
              <div class="stat-label">Team Members</div>
            </div>
            <div class="stat-box">
              <div class="stat-number">{{ count($positions) }}</div>
              <div class="stat-label">Open Positions</div>
            </div>
          </div>
          <div class="stat-row">
            <div class="stat-box">
              <div class="stat-number">{{ $statistics['clients'] ?? 99 }}</div>
              <div class="stat-label">Clients</div>
            </div>
            <div class="stat-box">
              <div class="stat-number">{{ $statistics['satisfaction'] ?? 95 }}%</div>
              <div class="stat-label">Satisfaction</div>
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
        <h2 class="section-title">Benefits & Perks</h2>
        <p class="section-subtitle">
          Comprehensive packages to support your well-being
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
      </div>
    </div>
  </div>
</section>

<!-- Job Openings Section -->
<section class="openings-section" id="openings">
  <div class="container">
    <div class="section-header">
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

      <select class="filter-select" id="departmentFilter" onchange="filterJobs()">
        <option value="all">All Departments</option>
        <option value="engineering">Engineering</option>
        <option value="design">Design</option>
        <option value="sales">Sales</option>
        <option value="operations">Operations</option>
      </select>

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
          data-type="{{ strtolower(str_replace(' ', '-', $position->employment_type)) }}"
        >
          <div class="job-header">
            <div class="job-left">
              <h3 class="job-title">{{ $position->title }}</h3>
              <div class="job-meta">
                <span class="job-department">{{ $position->department }}</span>
                <span class="job-type">{{ $position->employment_type }}</span>
              </div>
            </div>
            <button class="btn-apply" onclick="openModal({{ $index }}, '{{ $position->id }}', '{{ $position->title }}')">
              Apply
            </button>
          </div>
          <p class="job-description">
            {{ $position->description }}
          </p>
          @if($position->tags)
            <div class="job-tags">
              @foreach(is_array($position->tags) ? $position->tags : json_decode($position->tags, true) as $tag)
                <span>{{ $tag }}</span>
              @endforeach
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
      <i class="fas fa-briefcase"></i>
      <p>No positions found. Try adjusting your filters.</p>
    </div>
  </div>
</section>

<!-- CTA Section -->
<section class="cta-section">
  <div class="container">
    <div class="cta-card">
      <div class="cta-content">
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
}

a {
  color: inherit;
  text-decoration: none;
}

/* ========================================
   HERO SECTION - WITH FADE IN
   ======================================== */
.hero {
  padding: 140px 0 80px;
  background: var(--white);
  position: relative;
}

.container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 20px;
}

.hero-content {
  display: grid;
  grid-template-columns: 1.2fr 1fr;
  gap: 60px;
  align-items: center;
  position: relative;
  z-index: 1;
}

.hero-badge {
  display: inline-block;
  padding: 6px 16px;
  background: rgba(16, 124, 16, 0.1);
  color: var(--green);
  border-radius: 20px;
  font-size: 13px;
  font-weight: 600;
  margin-bottom: 24px;
}

.hero-title {
  font-size: 52px;
  font-weight: 700;
  color: var(--dark);
  line-height: 1.2;
  margin-bottom: 20px;
  letter-spacing: -1px;
}

.hero-description {
  font-size: 18px;
  color: var(--gray);
  line-height: 1.7;
  margin-bottom: 32px;
}

.hero-buttons {
  display: flex;
  gap: 16px;
}

.btn-primary,
.btn-secondary {
  padding: 14px 28px;
  border-radius: 6px;
  font-weight: 600;
  font-size: 15px;
  text-decoration: none;
  display: inline-flex;
  align-items: center;
  gap: 8px;
  transition: all 0.3s ease;
  border: none;
  cursor: pointer;
}

.btn-primary {
  background: var(--green);
  color: var(--white);
  box-shadow: 0 4px 12px rgba(16, 124, 16, 0.2);
}

.btn-primary:hover {
  background: var(--dark-green);
  transform: translateY(-2px);
  box-shadow: 0 6px 20px rgba(16, 124, 16, 0.3);
}

.btn-secondary {
  background: var(--light-gray);
  color: var(--dark);
  border: 1px solid var(--border);
}

.btn-secondary:hover {
  border-color: var(--green);
  color: var(--green);
  transform: translateY(-2px);
}

/* Hero Stats Card */
.hero-stats-card {
  background: var(--light-gray);
  border: 1px solid var(--border);
  border-radius: 12px;
  padding: 32px;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
  transition: all 0.3s ease;
}

.hero-stats-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
}

.stat-row {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 24px;
}

.stat-row:first-child {
  margin-bottom: 24px;
  padding-bottom: 24px;
  border-bottom: 1px solid var(--border);
}

.stat-box {
  text-align: center;
  transition: transform 0.3s ease;
}

.stat-box:hover {
  transform: scale(1.05);
}

.stat-number {
  font-size: 36px;
  font-weight: 700;
  color: var(--green);
  margin-bottom: 4px;
}

.stat-label {
  font-size: 14px;
  color: var(--gray);
}

/* ========================================
   BENEFITS SECTION
   ======================================== */
.benefits-section {
  padding: 80px 0;
  background: var(--light-gray);
}

.section-header-inline {
  margin-bottom: 40px;
}

.header-left .section-title {
  font-size: 36px;
  font-weight: 700;
  color: var(--dark);
  margin-bottom: 8px;
}

.header-left .section-subtitle {
  font-size: 16px;
  color: var(--gray);
}

.benefits-container {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 24px;
}

.benefit-card {
  background: var(--white);
  border: 1px solid var(--border);
  border-radius: 8px;
  padding: 24px;
  transition: all 0.3s ease;
}

.benefit-card:hover {
  border-color: var(--green);
  transform: translateY(-5px);
  box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
}

.benefit-header {
  display: flex;
  align-items: center;
  gap: 16px;
  margin-bottom: 12px;
}

.benefit-icon-wrapper {
  width: 44px;
  height: 44px;
  border-radius: 8px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 20px;
  color: var(--white);
  flex-shrink: 0;
  transition: transform 0.3s ease;
}

.benefit-card:hover .benefit-icon-wrapper {
  transform: rotate(10deg) scale(1.1);
}

.benefit-icon-wrapper.green {
  background: var(--green);
}
.benefit-icon-wrapper.blue {
  background: var(--blue);
}
.benefit-icon-wrapper.red {
  background: var(--red);
}

.benefit-card h3 {
  font-size: 16px;
  font-weight: 600;
  color: var(--dark);
}

.benefit-card p {
  font-size: 14px;
  color: var(--gray);
  line-height: 1.6;
}

/* ========================================
   OPENINGS SECTION
   ======================================== */
.openings-section {
  padding: 80px 0;
  background: var(--white);
}

.section-header {
  text-align: center;
  margin-bottom: 48px;
}

.section-title {
  font-size: 36px;
  font-weight: 700;
  color: var(--dark);
  margin-bottom: 8px;
}

.section-subtitle {
  font-size: 16px;
  color: var(--gray);
}

/* Filter Bar */
.filter-bar {
  display: grid;
  grid-template-columns: 2fr 1fr 1fr 1fr;
  gap: 16px;
  margin-bottom: 32px;
}

.search-input-job {
  position: relative;
}

.search-input-job i {
  position: absolute;
  left: 16px;
  top: 50%;
  transform: translateY(-50%);
  color: var(--gray);
}

.search-input-job input {
  width: 100%;
  padding: 12px 16px 12px 44px;
  border: 1px solid var(--border);
  border-radius: 6px;
  font-size: 15px;
  background: var(--white);
  transition: all 0.3s ease;
}

.search-input-job input:focus {
  outline: none;
  border-color: var(--green);
  box-shadow: 0 0 0 3px rgba(16, 124, 16, 0.1);
}

.filter-select {
  padding: 12px 16px;
  border: 1px solid var(--border);
  border-radius: 6px;
  font-size: 15px;
  background: var(--white);
  cursor: pointer;
  transition: all 0.3s ease;
}

.filter-select:focus {
  outline: none;
  border-color: var(--green);
  box-shadow: 0 0 0 3px rgba(16, 124, 16, 0.1);
}

/* Jobs List */
.jobs-list {
  display: flex;
  flex-direction: column;
  gap: 16px;
}

.job-item {
  background: var(--white);
  border: 1px solid var(--border);
  border-radius: 8px;
  padding: 28px;
  transition: all 0.3s ease;
  opacity: 1;
}

.job-item:hover {
  border-color: var(--green);
  box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
  transform: translateY(-3px);
}

.job-item.hidden {
  display: none;
}

.job-header {
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
  margin-bottom: 16px;
}

.job-title {
  font-size: 20px;
  font-weight: 600;
  color: var(--dark);
  margin-bottom: 12px;
  transition: color 0.3s ease;
}

.job-item:hover .job-title {
  color: var(--green);
}

.job-meta {
  display: flex;
  gap: 16px;
  flex-wrap: wrap;
}

.job-meta span {
  font-size: 14px;
  color: var(--gray);
}

.job-department {
  color: var(--green);
  font-weight: 600;
}

.job-location i {
  margin-right: 4px;
}

.job-type {
  padding: 4px 12px;
  background: var(--light-gray);
  border-radius: 12px;
  font-weight: 500;
}

.btn-apply {
  padding: 10px 24px;
  background: var(--green);
  color: var(--white);
  border: none;
  border-radius: 6px;
  font-weight: 600;
  font-size: 14px;
  cursor: pointer;
  transition: all 0.3s ease;
  white-space: nowrap;
}

.btn-apply:hover {
  background: var(--dark-green);
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(16, 124, 16, 0.3);
}

.job-description {
  font-size: 15px;
  color: var(--gray);
  line-height: 1.7;
  margin-bottom: 16px;
}

.job-tags {
  display: flex;
  gap: 8px;
  flex-wrap: wrap;
}

.job-tags span {
  padding: 6px 12px;
  background: var(--light-gray);
  border-radius: 4px;
  font-size: 13px;
  color: var(--dark);
  font-weight: 500;
  transition: all 0.3s ease;
}

.job-tags span:hover {
  background: var(--green);
  color: var(--white);
  transform: translateY(-2px);
}

/* No Results */
.no-results {
  text-align: center;
  padding: 60px 20px;
  background: var(--white);
  border: 1px solid var(--border);
  border-radius: 8px;
}

.no-results i {
  font-size: 48px;
  color: var(--gray);
  margin-bottom: 16px;
  opacity: 0.5;
}

.no-results p {
  font-size: 16px;
  color: var(--gray);
}

/* ========================================
   CTA SECTION
   ======================================== */
.cta-section {
  padding: 80px 0;
  background: var(--white);
}

.cta-card {
  background: var(--navy);
  border-radius: 12px;
  padding: 48px;
  display: flex;
  justify-content: space-between;
  align-items: center;
  gap: 40px;
  transition: all 0.3s ease;
}

.cta-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 12px 32px rgba(0, 0, 0, 0.2);
}

.cta-content h2 {
  font-size: 28px;
  font-weight: 700;
  color: var(--white);
  margin-bottom: 8px;
}

.cta-content p {
  font-size: 16px;
  color: rgba(255, 255, 255, 0.8);
  line-height: 1.6;
}

.btn-cta {
  padding: 14px 32px;
  background: var(--green);
  color: var(--white);
  border: none;
  border-radius: 6px;
  font-weight: 600;
  font-size: 16px;
  cursor: pointer;
  display: inline-flex;
  align-items: center;
  gap: 10px;
  transition: all 0.3s ease;
  white-space: nowrap;
}

.btn-cta:hover {
  background: var(--dark-green);
  transform: translateY(-2px);
  box-shadow: 0 6px 20px rgba(16, 124, 16, 0.4);
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
  background: rgba(0, 0, 0, 0.5);
  z-index: 1000;
  align-items: center;
  justify-content: center;
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
  border-radius: 8px;
  width: 90%;
  max-width: 600px;
  max-height: 90vh;
  overflow-y: auto;
  z-index: 1001;
  box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
}

.modal-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 24px 28px;
  border-bottom: 1px solid var(--border);
  background: var(--white);
  position: sticky;
  top: 0;
  z-index: 2;
}

.modal-header h2 {
  font-size: 24px;
  font-weight: 600;
  color: var(--dark);
  margin: 0;
}

.modal-close {
  background: none;
  border: none;
  font-size: 24px;
  cursor: pointer;
  color: var(--gray);
  transition: color 0.3s ease;
  padding: 0;
  width: 36px;
  height: 36px;
  display: flex;
  align-items: center;
  justify-content: center;
}

.modal-close:hover {
  color: var(--dark);
}

/* Error Alert */
.error-alert {
  display: flex;
  align-items: flex-start;
  gap: 12px;
  padding: 14px 16px;
  background: #fee;
  border: 1px solid #fcc;
  border-radius: 6px;
  margin: 16px 28px 0 28px;
  animation: slideDown 0.3s ease;
}

@keyframes slideDown {
  from {
    opacity: 0;
    transform: translateY(-10px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.error-alert i {
  color: var(--red);
  font-size: 18px;
  flex-shrink: 0;
  margin-top: 2px;
}

.error-alert div {
  flex: 1;
}

.error-alert strong {
  color: var(--red);
  display: block;
  margin-bottom: 4px;
}

.error-alert p {
  color: #c00;
  margin: 0;
  font-size: 14px;
}

.close-alert {
  background: none;
  border: none;
  color: var(--red);
  cursor: pointer;
  font-size: 16px;
  padding: 0;
  width: 20px;
  height: 20px;
  flex-shrink: 0;
  margin-top: 2px;
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
  gap: 16px;
}

.form-group {
  margin-bottom: 20px;
}

.form-row .form-group {
  margin-bottom: 0;
}

.form-group label {
  display: block;
  font-size: 14px;
  font-weight: 600;
  color: var(--dark);
  margin-bottom: 8px;
}

.required {
  color: var(--red);
}

.form-group input,
.form-group textarea {
  width: 100%;
  padding: 12px 16px;
  border: 1px solid var(--border);
  border-radius: 6px;
  font-size: 15px;
  font-family: inherit;
  transition: all 0.3s ease;
  background: var(--white);
}

.form-group input:focus,
.form-group textarea:focus {
  outline: none;
  border-color: var(--green);
  box-shadow: 0 0 0 3px rgba(16, 124, 16, 0.1);
}

.form-group input::placeholder,
.form-group textarea::placeholder {
  color: rgba(0, 0, 0, 0.4);
}

.form-group textarea {
  resize: vertical;
}

.form-group small {
  font-size: 13px;
  color: var(--gray);
  display: block;
  margin-top: 6px;
}

/* File Input */
.file-input {
  display: flex;
  align-items: center;
  gap: 12px;
}

.file-label {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  padding: 10px 20px;
  background: var(--light-gray);
  border: 1px solid var(--border);
  border-radius: 6px;
  cursor: pointer;
  font-weight: 500;
  font-size: 14px;
  transition: all 0.3s ease;
  white-space: nowrap;
}

.file-label:hover {
  background: var(--border);
  transform: translateY(-2px);
}

.file-name {
  font-size: 13px;
  color: var(--gray);
  flex: 1;
  overflow: hidden;
  text-overflow: ellipsis;
}

/* Form Actions */
.form-actions {
  display: flex;
  gap: 12px;
  margin-top: 28px;
}

.btn-cancel,
.btn-submit {
  flex: 1;
  padding: 12px 24px;
  border: none;
  border-radius: 6px;
  font-weight: 600;
  font-size: 15px;
  cursor: pointer;
  transition: all 0.3s ease;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 8px;
}

.btn-cancel {
  background: var(--light-gray);
  color: var(--dark);
}

.btn-cancel:hover {
  background: var(--border);
}

.btn-submit {
  background: var(--green);
  color: var(--white);
}

.btn-submit:hover:not(:disabled) {
  background: var(--dark-green);
  transform: translateY(-2px);
}

.btn-submit:disabled {
  opacity: 0.7;
  cursor: not-allowed;
}

/* Success Modal */
.modal-success {
  text-align: center;
  padding: 48px 32px;
}

.success-icon {
  width: 80px;
  height: 80px;
  background: rgba(16, 124, 16, 0.1);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  margin: 0 auto 24px;
  animation: scaleIn 0.5s ease;
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
  font-size: 40px;
  color: var(--green);
}

.modal-success h2 {
  font-size: 28px;
  font-weight: 700;
  color: var(--dark);
  margin-bottom: 12px;
}

.modal-success p {
  font-size: 16px;
  color: var(--gray);
  margin-bottom: 28px;
  line-height: 1.7;
}

/* ========================================
   RESPONSIVE
   ======================================== */
@media (max-width: 1023px) {
  .hero-content {
    grid-template-columns: 1fr;
  }

  .benefits-container {
    grid-template-columns: repeat(2, 1fr);
  }

  .filter-bar {
    grid-template-columns: 1fr 1fr;
  }
}

@media (max-width: 767px) {
  .hero {
    padding: 110px 0 60px;
  }

  .hero-title {
    font-size: 40px;
  }

  .hero-buttons {
    flex-direction: column;
  }

  .btn-primary,
  .btn-secondary {
    width: 100%;
    justify-content: center;
  }

  .benefits-container {
    grid-template-columns: 1fr;
  }

  .filter-bar {
    grid-template-columns: 1fr;
  }

  .form-row {
    grid-template-columns: 1fr;
  }

  .job-header {
    flex-direction: column;
    gap: 16px;
  }

  .btn-apply {
    width: 100%;
  }

  .cta-card {
    flex-direction: column;
    text-align: center;
    padding: 32px;
  }

  .btn-cta {
    width: 100%;
    justify-content: center;
  }

  .modal-container {
    width: 95%;
    max-height: 95vh;
  }
}

@media (max-width: 479px) {
  .hero-title {
    font-size: 32px;
  }

  .section-title {
    font-size: 28px;
  }

  .form-actions {
    flex-direction: column;
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
  }

  function closeModal() {
    document.getElementById('applicationModal').classList.remove('active');
    document.getElementById('applicationForm').reset();
    document.getElementById('fileName').textContent = '';
    document.getElementById('errorAlert').style.display = 'none';
  }

  function closeSuccessModal() {
    document.getElementById('successModal').classList.remove('active');
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

    // Get form data
    const formData = new FormData(this);
    const actionUrl = this.action;

    // Disable submit button
    const submitBtn = document.getElementById('submitBtn');
    const submitText = document.getElementById('submitText');
    const submitSpinner = document.getElementById('submitSpinner');

    submitBtn.disabled = true;
    submitText.style.display = 'none';
    submitSpinner.style.display = 'inline';

    // Send request
    fetch(actionUrl, {
      method: 'POST',
      body: formData,
      headers: {
        'X-Requested-With': 'XMLHttpRequest',
      }
    })
    .then(response => {
      // Handle all status codes
      if (response.ok) {
        return response.json().then(data => ({
          status: response.status,
          data: data
        }));
      } else if (response.status === 422) {
        // Validation error
        return response.json().then(data => ({
          status: response.status,
          data: data
        }));
      } else {
        // Server error
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
        // Success
        document.getElementById('applicationModal').classList.remove('active');
        document.getElementById('successModal').classList.add('active');
        document.getElementById('applicationForm').reset();
        document.getElementById('fileName').textContent = '';
      } else {
        // Error - show error alert
        const errorAlert = document.getElementById('errorAlert');
        const errorMessage = document.getElementById('errorMessage');

        if (result.data.errors) {
          // Validation errors
          const errorList = Object.values(result.data.errors)
            .flat()
            .join(', ');
          errorMessage.textContent = errorList;
        } else {
          errorMessage.textContent = result.data.message || 'An error occurred. Please try again.';
        }

        errorAlert.style.display = 'flex';
        // Scroll to error
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
    const departmentFilter = document.getElementById('departmentFilter').value;
    const typeFilter = document.getElementById('typeFilter').value;

    const jobItems = document.querySelectorAll('.job-item');
    let visibleCount = 0;

    jobItems.forEach(item => {
      const title = item.querySelector('.job-title').textContent.toLowerCase();
      const department = item.dataset.department;
      const type = item.dataset.type;

      const matchSearch = title.includes(searchTerm);
      const matchDepartment = departmentFilter === 'all' || department === departmentFilter;
      const matchType = typeFilter === 'all' || type === typeFilter;

      if (matchSearch && matchDepartment && matchType) {
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
</script>
@endsection