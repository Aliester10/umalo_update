@extends('layouts.guest.master3')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<!-- Hero Section with Enhanced Design -->
<section class="hero">
  <div class="hero-background">
    <div class="gradient-orb orb-1"></div>
    <div class="gradient-orb orb-2"></div>
    <div class="grid-overlay"></div>
  </div>

  <div class="container">
    <div class="hero-content">
      <!-- Breadcrumb -->
      <nav class="breadcrumb-clean" aria-label="breadcrumb">
        <a href="{{ route('home') }}" class="breadcrumb-link">
          <i class="fas fa-home"></i>
          <span>{{ __('messages.home') }}</span>
        </a>
        <i class="fas fa-chevron-right breadcrumb-divider"></i>
        <span class="breadcrumb-current">{{ __('messages.faqs') }}</span>
      </nav>
      
      <!-- Title Section -->
      <div class="hero-text-wrapper">
        <div class="hero-tag">
          <span class="tag-pulse"></span>
          Support Center
        </div>
        <h1 class="hero-title">
          Frequently Asked
          <span class="text-gradient">Questions</span>
        </h1>
        <p class="hero-description">
          {{ __('messages.faq_description') ?? 'Everything you need to know about our services. Can\'t find the answer you\'re looking for? Feel free to contact our support team.' }}
        </p>
      </div>

      <!-- Hero Stats -->
      <div class="hero-stats">
        <div class="stat-item">
          <div class="stat-icon blue">
            <i class="fas fa-question-circle"></i>
          </div>
          <div class="stat-content">
            <div class="stat-number">{{ count($faqs) }}+</div>
            <div class="stat-label">Articles</div>
          </div>
        </div>
        <div class="stat-item">
          <div class="stat-icon green">
            <i class="fas fa-clock"></i>
          </div>
          <div class="stat-content">
            <div class="stat-number">24/7</div>
            <div class="stat-label">Support</div>
          </div>
        </div>
        <div class="stat-item">
          <div class="stat-icon purple">
            <i class="fas fa-star"></i>
          </div>
          <div class="stat-content">
            <div class="stat-number">98%</div>
            <div class="stat-label">Satisfaction</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- FAQ Content -->
<section class="faq-section-clean">
  <div class="container">
    <div class="content-grid-clean">
      
      <!-- Main FAQ Area -->
      <main class="faq-main-clean">
        
        <!-- FAQ Header -->
        <div class="faq-header-info">
          <div class="header-left">
            <h2 class="section-title-clean">All Questions</h2>
            <p class="section-subtitle-clean">{{ count($faqs) }} articles to help you</p>
          </div>
        </div>

        <!-- Search Bar -->
        <div class="search-wrapper">
          <div class="search-input-wrapper">
            <i class="fas fa-search"></i>
            <input 
              type="text" 
              id="faqSearch" 
              class="search-input" 
              placeholder="Search for answers..."
              onkeyup="searchFAQ()"
            />
          </div>
        </div>

        <!-- FAQ List -->
        <div class="faq-list-clean">
          @forelse($faqs as $index => $faq)
            <article class="faq-item-clean" id="faq-{{ $index }}" data-question="{{ strtolower($faq->questions) }}" data-answer="{{ strtolower($faq->answers) }}">
              <button class="faq-question-btn" onclick="toggleFaqClean({{ $index }})" aria-expanded="false">
                <div class="question-content">
                  <span class="question-number">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                  <h3 class="question-title">{{ $faq->questions }}</h3>
                </div>
                <div class="question-toggle" id="toggle-{{ $index }}">
                  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                  </svg>
                </div>
              </button>
              
              <div class="faq-answer-wrapper" id="answer-{{ $index }}">
                <div class="answer-inner">
                  <div class="answer-icon-wrapper">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                      <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                    </svg>
                  </div>
                  <div class="answer-content">
                    <p>{{ $faq->answers }}</p>
                  </div>
                </div>
              </div>
            </article>
          @empty
            <div class="empty-state-clean">
              <div class="empty-icon-clean">
                <i class="fas fa-question-circle"></i>
              </div>
              <h3>No FAQs Available</h3>
              <p>Please check back later for updates.</p>
            </div>
          @endforelse
        </div>

        <!-- No Results -->
        <div class="no-results" id="noResults" style="display: none">
          <i class="fas fa-search"></i>
          <p>No questions found. Try different keywords.</p>
        </div>

      </main>

      <!-- Sidebar -->
      <aside class="sidebar-clean">
        
        <!-- Company Card -->
        <div class="sidebar-card-clean company-card-clean">
          <div class="company-logo-box">
            <img src="{{ asset($company->logo ?? 'assets/img/logo.png') }}" alt="Company Logo" class="company-logo-img">
          </div>
        </div>

        <!-- Quick Stats Card -->
        <div class="sidebar-card-clean stats-card-clean">
          <div class="card-title-wrapper">
            <div class="card-icon-wrapper">
              <i class="fas fa-chart-bar"></i>
            </div>
            <h3 class="card-title-clean">Support Statistics</h3>
          </div>
          <div class="stats-list-clean">
            <div class="stat-item-clean">
              <div class="stat-label-clean">Total Articles</div>
              <div class="stat-value-clean">{{ count($faqs) }}+</div>
            </div>
            <div class="stat-divider"></div>
            <div class="stat-item-clean">
              <div class="stat-label-clean">Support Hours</div>
              <div class="stat-value-clean">24/7</div>
            </div>
            <div class="stat-divider"></div>
            <div class="stat-item-clean">
              <div class="stat-label-clean">Response Rate</div>
              <div class="stat-value-clean">98%</div>
            </div>
          </div>
        </div>

        <!-- Popular Topics -->
        <div class="sidebar-card-clean popular-card-clean">
          <div class="card-title-wrapper">
            <div class="card-icon-wrapper">
              <i class="fas fa-fire"></i>
            </div>
            <h3 class="card-title-clean">Popular Topics</h3>
          </div>
          <div class="popular-topics-list">
            @foreach($faqs->take(5) as $popular)
              <a href="#faq-{{ $loop->index }}" class="popular-topic-item" onclick="scrollToFaqClean({{ $loop->index }}, event)">
                <div class="topic-number">{{ $loop->iteration }}</div>
                <div class="topic-content">
                  <span class="topic-title">{{ Str::limit($popular->questions, 50) }}</span>
                </div>
                <i class="fas fa-chevron-right topic-arrow"></i>
              </a>
            @endforeach
          </div>
        </div>

        <!-- Contact Support Card -->
        <div class="sidebar-card-clean contact-card-clean">
          <div class="contact-icon-clean">
            <i class="fas fa-headset"></i>
          </div>
          <h3 class="contact-title-clean">Still Need Help?</h3>
          <p class="contact-desc-clean">Our support team is here to help you with any questions or concerns you may have.</p>
          <a href="{{ route('contact') ?? '#' }}" class="btn-support-clean">
            <span>Contact Support</span>
            <i class="fas fa-arrow-right"></i>
          </a>
        </div>

      </aside>

    </div>
  </div>
</section>

<!-- Bottom CTA -->
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
        <h2>Can't Find What You're Looking For?</h2>
        <p>
          Get in touch with our support team and we'll help you find the answers you need.
        </p>
      </div>
      <a href="{{ route('contact') ?? '#' }}" class="btn-cta">
        Get in Touch
        <i class="fas fa-arrow-right"></i>
      </a>
    </div>
  </div>
</section>

<style>
/* ========================================
   ROOT VARIABLES
   ======================================== */
:root {
  /* Colors */
  --primary: #228b22;
  --primary-hover: #1a6b1a;
  --primary-light: #e8f5e9;
  --primary-bg: #f1f8f1;
  
  --text-primary: #111827;
  --text-secondary: #6b7280;
  --text-tertiary: #9ca3af;
  
  --border: #e5e7eb;
  --border-light: #f3f4f6;
  
  --bg-white: #ffffff;
  --bg-gray: #f9fafb;
  --bg-hover: #f3f4f6;
  
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
  
  /* Shadows */
  --shadow-xs: 0 1px 2px rgba(0, 0, 0, 0.05);
  --shadow-sm: 0 1px 3px rgba(0, 0, 0, 0.08);
  --shadow-md: 0 4px 8px rgba(0, 0, 0, 0.1);
  --shadow-lg: 0 10px 20px rgba(0, 0, 0, 0.12);
  --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
  --shadow-2xl: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
  
  /* Radius */
  --radius-sm: 8px;
  --radius-md: 12px;
  --radius-lg: 16px;
  --radius-xl: 20px;
  --radius-2xl: 24px;
  
  /* Spacing */
  --space-xs: 4px;
  --space-sm: 8px;
  --space-md: 16px;
  --space-lg: 24px;
  --space-xl: 32px;
  
  /* Transitions */
  --transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
  --transition-fast: all 0.15s ease;
  --transition-smooth: all 0.5s cubic-bezier(0.16, 1, 0.3, 1);
  
  --gradient-primary: linear-gradient(135deg, #228b22 0%, #207178 100%);
  --gradient-dark: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
}

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  font-family: -apple-system, BlinkMacSystemFont, 'Inter', 'Segoe UI', sans-serif;
  color: var(--text-primary);
  line-height: 1.6;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  background: var(--bg-white);
  overflow-x: hidden;
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
  min-height: 85vh;
  display: flex;
  align-items: center;
  padding: 140px 0 80px;
  background: var(--bg-white);
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
  opacity: 0.25;
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
  max-width: 900px;
  margin: 0 auto;
  text-align: center;
}

/* Breadcrumb */
.breadcrumb-clean {
  display: inline-flex;
  align-items: center;
  gap: var(--space-sm);
  padding: 10px 20px;
  background: var(--bg-white);
  border: 1px solid var(--border);
  border-radius: 100px;
  font-size: 14px;
  margin-bottom: var(--space-xl);
  box-shadow: var(--shadow-xs);
  transition: var(--transition);
}

.breadcrumb-clean:hover {
  box-shadow: var(--shadow-sm);
}

.breadcrumb-link {
  display: flex;
  align-items: center;
  gap: 6px;
  color: var(--text-secondary);
  text-decoration: none;
  font-weight: 500;
  transition: var(--transition-fast);
}

.breadcrumb-link:hover {
  color: var(--primary);
}

.breadcrumb-divider {
  font-size: 10px;
  color: var(--text-tertiary);
}

.breadcrumb-current {
  color: var(--primary);
  font-weight: 600;
}

/* Hero Text */
.hero-text-wrapper {
  margin-bottom: 48px;
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
  margin-bottom: 28px;
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
  font-size: clamp(36px, 6vw, 72px);
  font-weight: 800;
  line-height: 1.1;
  letter-spacing: -0.03em;
  color: var(--text-primary);
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
  color: var(--text-secondary);
  line-height: 1.7;
  max-width: 700px;
  margin: 0 auto;
  animation: slideUp 0.8s ease 0.2s backwards;
}

/* Hero Stats */
.hero-stats {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 24px;
  max-width: 800px;
  margin: 0 auto;
  animation: slideUp 0.8s ease 0.3s backwards;
}

.stat-item {
  display: flex;
  align-items: center;
  gap: 16px;
  padding: 24px;
  background: var(--bg-white);
  border: 2px solid var(--border);
  border-radius: var(--radius-xl);
  transition: var(--transition-smooth);
  box-shadow: var(--shadow-sm);
}

.stat-item:hover {
  border-color: var(--primary);
  transform: translateY(-8px);
  box-shadow: var(--shadow-xl);
}

.stat-icon {
  width: 56px;
  height: 56px;
  display: flex;
  align-items: center;
  justify-content: center;
  border-radius: var(--radius-lg);
  color: var(--bg-white);
  font-size: 24px;
  flex-shrink: 0;
  transition: transform 0.3s ease;
}

.stat-item:hover .stat-icon {
  transform: rotate(10deg) scale(1.1);
}

.stat-icon.blue {
  background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
}

.stat-icon.green {
  background: linear-gradient(135deg, #10b981 0%, #059669 100%);
}

.stat-icon.purple {
  background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
}

.stat-content {
  flex: 1;
  min-width: 0;
}

.stat-number {
  font-size: clamp(24px, 3vw, 32px);
  font-weight: 800;
  color: var(--text-primary);
  margin-bottom: 2px;
  line-height: 1;
}

.stat-label {
  font-size: clamp(12px, 1.5vw, 14px);
  color: var(--text-secondary);
  font-weight: 500;
}

/* ========================================
   FAQ SECTION
   ======================================== */
.faq-section-clean {
  padding: 80px 0 100px;
  background: var(--bg-gray);
}

.content-grid-clean {
  display: grid;
  grid-template-columns: 1fr 400px;
  gap: 60px;
  align-items: start;
}

/* FAQ Main */
.faq-main-clean {
  min-width: 0;
}

.faq-header-info {
  display: flex;
  justify-content: space-between;
  align-items: flex-end;
  margin-bottom: var(--space-xl);
  padding-bottom: var(--space-lg);
  border-bottom: 2px solid var(--border-light);
}

.header-left {
  flex: 1;
}

.section-title-clean {
  font-size: 28px;
  font-weight: 700;
  color: var(--text-primary);
  margin-bottom: 6px;
  letter-spacing: -0.01em;
}

.section-subtitle-clean {
  font-size: 15px;
  color: var(--text-secondary);
  font-weight: 500;
}

/* Search Bar */
.search-wrapper {
  margin-bottom: 32px;
}

.search-input-wrapper {
  position: relative;
  width: 100%;
}

.search-input-wrapper i {
  position: absolute;
  left: 20px;
  top: 50%;
  transform: translateY(-50%);
  color: var(--gray-500);
  font-size: 16px;
  pointer-events: none;
  z-index: 1;
}

.search-input {
  width: 100%;
  padding: 16px 20px 16px 52px;
  border: 2px solid var(--border);
  border-radius: var(--radius-lg);
  font-size: 15px;
  background: var(--bg-white);
  transition: var(--transition);
  font-family: inherit;
  color: var(--text-primary);
}

.search-input:focus {
  outline: none;
  border-color: var(--primary);
  box-shadow: 0 0 0 4px rgba(34, 139, 34, 0.1);
}

.search-input::placeholder {
  color: var(--gray-400);
}

/* FAQ List */
.faq-list-clean {
  display: flex;
  flex-direction: column;
  gap: var(--space-md);
}

.faq-item-clean {
  background: var(--bg-white);
  border: 2px solid var(--border);
  border-radius: var(--radius-md);
  overflow: hidden;
  transition: var(--transition);
}

.faq-item-clean:hover {
  border-color: var(--primary);
  box-shadow: var(--shadow-md);
}

.faq-item-clean.active {
  border-color: var(--primary);
  box-shadow: var(--shadow-md);
}

.faq-item-clean.hidden {
  display: none;
}

.faq-question-btn {
  width: 100%;
  display: flex;
  justify-content: space-between;
  align-items: center;
  gap: var(--space-lg);
  padding: 28px;
  background: transparent;
  border: none;
  cursor: pointer;
  text-align: left;
  transition: var(--transition);
  font-family: inherit;
}

.faq-question-btn:hover {
  background: var(--bg-gray);
}

.question-content {
  display: flex;
  align-items: flex-start;
  gap: var(--space-md);
  flex: 1;
  min-width: 0;
}

.question-number {
  display: flex;
  align-items: center;
  justify-content: center;
  min-width: 42px;
  height: 42px;
  background: var(--bg-gray);
  border-radius: var(--radius-sm);
  font-size: 15px;
  font-weight: 700;
  color: var(--text-secondary);
  flex-shrink: 0;
  transition: var(--transition);
}

.faq-item-clean.active .question-number {
  background: var(--primary);
  color: var(--bg-white);
  transform: scale(1.05);
}

.question-title {
  font-size: 19px;
  font-weight: 600;
  color: var(--text-primary);
  line-height: 1.5;
  padding-top: 8px;
}

.faq-item-clean.active .question-title {
  color: var(--primary);
}

.question-toggle {
  display: flex;
  align-items: center;
  justify-content: center;
  width: 42px;
  height: 42px;
  background: var(--bg-gray);
  border-radius: 50%;
  flex-shrink: 0;
  transition: var(--transition);
}

.question-toggle svg {
  color: var(--text-secondary);
  transition: var(--transition);
}

.faq-item-clean.active .question-toggle {
  background: var(--primary);
  transform: rotate(45deg);
}

.faq-item-clean.active .question-toggle svg {
  color: var(--bg-white);
}

/* FAQ Answer */
.faq-answer-wrapper {
  max-height: 0;
  overflow: hidden;
  transition: max-height 0.4s cubic-bezier(0.4, 0, 0.2, 1);
}

.faq-answer-wrapper.active {
  max-height: 1000px;
}

.answer-inner {
  display: flex;
  gap: var(--space-md);
  padding: 0 28px 28px;
  border-top: 1px solid var(--border);
  margin: 0 28px 28px;
}

.answer-icon-wrapper {
  display: flex;
  align-items: flex-start;
  justify-content: center;
  width: 42px;
  height: 42px;
  padding-top: var(--space-lg);
  flex-shrink: 0;
}

.answer-icon-wrapper svg {
  color: var(--primary);
}

.answer-content {
  flex: 1;
  padding-top: var(--space-lg);
}

.answer-content p {
  font-size: 16px;
  line-height: 1.8;
  color: var(--text-secondary);
}

/* Empty State */
.empty-state-clean {
  text-align: center;
  padding: 80px var(--space-lg);
  background: var(--bg-white);
  border-radius: var(--radius-lg);
  border: 2px dashed var(--border);
}

.empty-icon-clean {
  width: 80px;
  height: 80px;
  display: flex;
  align-items: center;
  justify-content: center;
  background: var(--bg-gray);
  border-radius: 50%;
  margin: 0 auto var(--space-lg);
}

.empty-icon-clean i {
  font-size: 36px;
  color: var(--text-tertiary);
}

.empty-state-clean h3 {
  font-size: 20px;
  font-weight: 700;
  color: var(--text-primary);
  margin-bottom: var(--space-sm);
}

.empty-state-clean p {
  font-size: 16px;
  color: var(--text-secondary);
}

/* No Results */
.no-results {
  text-align: center;
  padding: 80px 20px;
  background: var(--bg-white);
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
   SIDEBAR
   ======================================== */
.sidebar-clean {
  position: sticky;
  top: 100px;
  display: flex;
  flex-direction: column;
  gap: var(--space-lg);
}

.sidebar-card-clean {
  background: var(--bg-white);
  border: 2px solid var(--border);
  border-radius: var(--radius-md);
  padding: 28px;
  transition: var(--transition);
}

.sidebar-card-clean:hover {
  border-color: var(--primary);
  box-shadow: var(--shadow-md);
}

/* Company Card */
.company-logo-box {
  display: flex;
  align-items: center;
  justify-content: center;
  padding: var(--space-lg);
  background: var(--bg-gray);
  border-radius: var(--radius-sm);
}

.company-logo-img {
  max-width: 100%;
  height: auto;
  max-height: 80px;
  object-fit: contain;
}

/* Card Title */
.card-title-wrapper {
  display: flex;
  align-items: center;
  gap: 12px;
  margin-bottom: var(--space-lg);
  padding-bottom: var(--space-md);
  border-bottom: 2px solid var(--border-light);
}

.card-icon-wrapper {
  display: flex;
  align-items: center;
  justify-content: center;
  width: 36px;
  height: 36px;
  background: var(--primary-light);
  border-radius: var(--radius-sm);
  color: var(--primary);
  font-size: 16px;
}

.card-title-clean {
  font-size: 17px;
  font-weight: 700;
  color: var(--text-primary);
}

/* Stats Card */
.stats-list-clean {
  display: flex;
  flex-direction: column;
  gap: var(--space-md);
}

.stat-item-clean {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.stat-label-clean {
  font-size: 14px;
  font-weight: 500;
  color: var(--text-secondary);
}

.stat-value-clean {
  font-size: 24px;
  font-weight: 800;
  color: var(--primary);
}

.stat-divider {
  height: 1px;
  background: var(--border-light);
}

/* Popular Topics */
.popular-topics-list {
  display: flex;
  flex-direction: column;
  gap: 2px;
}

.popular-topic-item {
  display: flex;
  align-items: center;
  gap: 12px;
  padding: 14px;
  border-radius: var(--radius-sm);
  text-decoration: none;
  transition: var(--transition-fast);
}

.popular-topic-item:hover {
  background: var(--bg-gray);
}

.topic-number {
  display: flex;
  align-items: center;
  justify-content: center;
  min-width: 32px;
  height: 32px;
  background: var(--bg-gray);
  border-radius: 50%;
  font-size: 14px;
  font-weight: 700;
  color: var(--text-secondary);
  flex-shrink: 0;
  transition: var(--transition-fast);
}

.popular-topic-item:hover .topic-number {
  background: var(--primary);
  color: var(--bg-white);
}

.topic-content {
  flex: 1;
  min-width: 0;
}

.topic-title {
  font-size: 14px;
  font-weight: 500;
  color: var(--text-primary);
  line-height: 1.5;
  display: block;
}

.topic-arrow {
  font-size: 12px;
  color: var(--text-tertiary);
  flex-shrink: 0;
  transition: var(--transition-fast);
}

.popular-topic-item:hover .topic-arrow {
  color: var(--primary);
  transform: translateX(4px);
}

/* Contact Card */
.contact-card-clean {
  text-align: center;
  background: linear-gradient(135deg, var(--primary-bg) 0%, var(--bg-white) 100%);
}

.contact-icon-clean {
  width: 64px;
  height: 64px;
  display: flex;
  align-items: center;
  justify-content: center;
  background: var(--primary);
  border-radius: 50%;
  color: var(--bg-white);
  font-size: 28px;
  margin: 0 auto var(--space-lg);
  box-shadow: var(--shadow-sm);
}

.contact-title-clean {
  font-size: 19px;
  font-weight: 700;
  color: var(--text-primary);
  margin-bottom: var(--space-sm);
}

.contact-desc-clean {
  font-size: 14px;
  color: var(--text-secondary);
  line-height: 1.6;
  margin-bottom: var(--space-lg);
}

.btn-support-clean {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: var(--space-sm);
  width: 100%;
  padding: 14px var(--space-lg);
  font-size: 15px;
  font-weight: 600;
  color: var(--bg-white);
  background: var(--primary);
  border-radius: var(--radius-md);
  text-decoration: none;
  transition: var(--transition);
  box-shadow: var(--shadow-sm);
}

.btn-support-clean:hover {
  background: var(--primary-hover);
  transform: translateY(-2px);
  box-shadow: var(--shadow-md);
}

.btn-support-clean i {
  font-size: 14px;
  transition: transform 0.3s ease;
}

.btn-support-clean:hover i {
  transform: translateX(4px);
}

/* ========================================
   CTA SECTION
   ======================================== */
.cta-section {
  padding: 60px 0;
  background: var(--bg-white);
}

.cta-card {
  position: relative;
  background: var(--gradient-dark);
  border-radius: var(--radius-2xl);
  padding: 56px;
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
  color: var(--bg-white);
  font-size: 28px;
  margin-bottom: 24px;
}

.cta-content h2 {
  font-family: 'Space Grotesk', sans-serif;
  font-size: clamp(24px, 4vw, 32px);
  font-weight: 700;
  color: var(--bg-white);
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
  background: var(--bg-white);
  color: var(--text-primary);
  border: none;
  border-radius: var(--radius-lg);
  font-weight: 700;
  font-size: 16px;
  cursor: pointer;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 12px;
  transition: var(--transition);
  white-space: nowrap;
  box-shadow: var(--shadow-xl);
  text-decoration: none;
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
   RESPONSIVE
   ======================================== */

@media (max-width: 1024px) {
  .content-grid-clean {
    grid-template-columns: 1fr;
    gap: 48px;
  }

  .sidebar-clean {
    position: static;
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: var(--space-lg);
  }

  .hero-stats {
    grid-template-columns: 1fr;
    max-width: 500px;
  }
}

@media (max-width: 768px) {
  .hero {
    padding: 120px 0 60px;
    min-height: auto;
  }

  .hero-stats {
    gap: 16px;
  }

  .stat-item {
    padding: 20px;
  }

  .stat-icon {
    width: 48px;
    height: 48px;
    font-size: 20px;
  }

  .faq-section-clean {
    padding: 60px 0 80px;
  }

  .faq-question-btn {
    padding: var(--space-lg);
  }

  .question-content {
    gap: 12px;
  }

  .question-number {
    min-width: 36px;
    height: 36px;
    font-size: 14px;
  }

  .question-title {
    font-size: 17px;
    padding-top: 6px;
  }

  .question-toggle {
    width: 36px;
    height: 36px;
  }

  .answer-inner {
    flex-direction: column;
    gap: 0;
    padding: 0 var(--space-lg) var(--space-lg);
    margin: 0 var(--space-lg) var(--space-lg);
  }

  .answer-icon-wrapper {
    width: 100%;
    height: auto;
    padding-top: var(--space-md);
    padding-bottom: var(--space-sm);
    justify-content: flex-start;
  }

  .answer-content {
    padding-top: 0;
  }

  .sidebar-clean {
    grid-template-columns: 1fr;
  }

  .cta-card {
    flex-direction: column;
    text-align: center;
    padding: 40px 32px;
    gap: 32px;
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
  }
}

@media (max-width: 480px) {
  .container {
    padding: 0 var(--space-md);
  }

  .hero {
    padding: 100px 0 50px;
  }

  .breadcrumb-clean {
    padding: 8px 16px;
    font-size: 13px;
    margin-bottom: var(--space-lg);
  }

  .hero-tag {
    font-size: 11px;
    padding: 6px 16px;
    gap: 6px;
  }

  .tag-pulse {
    width: 6px;
    height: 6px;
  }

  .hero-text-wrapper {
    margin-bottom: 36px;
  }

  .stat-item {
    padding: 16px;
    gap: 12px;
  }

  .stat-icon {
    width: 44px;
    height: 44px;
    font-size: 18px;
  }

  .stat-number {
    font-size: 24px;
  }

  .stat-label {
    font-size: 12px;
  }

  .faq-section-clean {
    padding: 50px 0 60px;
  }

  .section-title-clean {
    font-size: 24px;
  }

  .section-subtitle-clean {
    font-size: 14px;
  }

  .search-input {
    padding: 14px 16px 14px 44px;
    font-size: 14px;
  }

  .search-input-wrapper i {
    left: 16px;
    font-size: 14px;
  }

  .faq-question-btn {
    padding: var(--space-md);
  }

  .question-number {
    min-width: 32px;
    height: 32px;
    font-size: 13px;
  }

  .question-title {
    font-size: 16px;
  }

  .answer-content p {
    font-size: 15px;
  }

  .sidebar-card-clean {
    padding: var(--space-lg);
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

/* Print Styles */
@media print {
  .hero-background,
  .cta-background,
  .gradient-orb,
  .hero-stats,
  .sidebar-clean,
  .cta-section,
  .search-wrapper {
    display: none !important;
  }

  .faq-item-clean {
    page-break-inside: avoid;
    border: 1px solid #ddd;
    margin-bottom: var(--space-md);
  }

  .faq-answer-wrapper {
    display: block !important;
    max-height: none !important;
  }

  .content-grid-clean {
    grid-template-columns: 1fr;
  }
}

/* Reduced Motion */
@media (prefers-reduced-motion: reduce) {
  *,
  *::before,
  *::after {
    animation-duration: 0.01ms !important;
    transition-duration: 0.01ms !important;
  }
}

/* Hover Effects - Disable on Touch Devices */
@media (hover: none) and (pointer: coarse) {
  .btn-support-clean:hover,
  .btn-cta:hover,
  .sidebar-card-clean:hover,
  .faq-item-clean:hover,
  .stat-item:hover,
  .popular-topic-item:hover {
    transform: none;
  }
}
</style>

<script>
// ==========================================
// FAQ FUNCTIONALITY
// ==========================================
document.addEventListener('DOMContentLoaded', function() {
  console.log('%c✨ Enhanced FAQ Page Loaded', 'color: #228B22; font-weight: bold; font-size: 14px;');
  
  // Auto-expand first FAQ
  const firstFaq = document.querySelector('.faq-item-clean');
  if (firstFaq) {
    toggleFaqClean(0);
  }
  
  // Initialize animations
  initScrollAnimations();
  
  // Initialize smooth scroll
  initSmoothScroll();
});

// Toggle FAQ
function toggleFaqClean(index) {
  const faqItem = document.querySelectorAll('.faq-item-clean')[index];
  const answerWrapper = document.getElementById(`answer-${index}`);
  
  if (!faqItem || !answerWrapper) return;
  
  const isActive = faqItem.classList.contains('active');
  
  if (isActive) {
    faqItem.classList.remove('active');
    answerWrapper.classList.remove('active');
  } else {
    faqItem.classList.add('active');
    answerWrapper.classList.add('active');
    
    // Smooth scroll to FAQ
    setTimeout(() => {
      faqItem.scrollIntoView({ 
        behavior: 'smooth', 
        block: 'nearest',
        inline: 'nearest'
      });
    }, 300);
  }
}

// Search FAQ
function searchFAQ() {
  const searchTerm = document.getElementById('faqSearch').value.toLowerCase().trim();
  const faqItems = document.querySelectorAll('.faq-item-clean');
  let visibleCount = 0;

  faqItems.forEach(item => {
    const question = item.dataset.question || '';
    const answer = item.dataset.answer || '';
    
    const matchSearch = question.includes(searchTerm) || answer.includes(searchTerm);

    if (matchSearch || searchTerm === '') {
      item.style.display = '';
      item.classList.remove('hidden');
      visibleCount++;
    } else {
      item.style.display = 'none';
      item.classList.add('hidden');
    }
  });

  // Show/hide no results message
  const noResults = document.getElementById('noResults');
  const faqList = document.querySelector('.faq-list-clean');
  
  if (visibleCount === 0) {
    noResults.style.display = 'block';
    faqList.style.display = 'none';
  } else {
    noResults.style.display = 'none';
    faqList.style.display = 'flex';
  }
}

// Scroll to FAQ
function scrollToFaqClean(index, event) {
  event.preventDefault();
  
  const faqItem = document.querySelectorAll('.faq-item-clean')[index];
  if (!faqItem) return;
  
  // Open FAQ if closed
  if (!faqItem.classList.contains('active')) {
    toggleFaqClean(index);
  }
  
  // Scroll to FAQ
  setTimeout(() => {
    const offsetTop = faqItem.offsetTop - 100;
    window.scrollTo({ 
      top: offsetTop, 
      behavior: 'smooth'
    });
  }, 100);
}

// Smooth scroll for links
function initSmoothScroll() {
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
}

// Scroll animations
function initScrollAnimations() {
  const observerOptions = {
    threshold: 0.1,
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

  // Observe FAQ items for animation
  document.querySelectorAll('.faq-item-clean, .sidebar-card-clean').forEach(el => {
    el.style.opacity = '0';
    el.style.transform = 'translateY(30px)';
    el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
    observer.observe(el);
  });
}

// Keyboard navigation
document.addEventListener('keydown', (e) => {
  // ESC to close all FAQs
  if (e.key === 'Escape') {
    document.querySelectorAll('.faq-item-clean.active').forEach((item, index) => {
      toggleFaqClean(index);
    });
  }
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
</script>

@endsection