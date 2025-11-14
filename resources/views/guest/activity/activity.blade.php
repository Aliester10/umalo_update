@extends('layouts.guest.master')

@section('content')
<style>
/* ========================================
   UMALO ACTIVITIES - INTERNATIONAL CORPORATE
   Version: 3.2 - Fixed Status Colors + No Metrics
   ======================================== */

:root {
  /* Primary Brand Colors */
  --primary-green: #107c10;
  --primary-dark: #0a5c0a;
  --primary-light: #e8f5e9;
  --primary-gradient: linear-gradient(135deg, #107c10 0%, #0a5c0a 100%);

  /* Status Colors - FIXED! */
  --status-completed-bg: #64748b;
  --status-completed-shadow: rgba(100, 116, 139, 0.4);
  --status-ongoing-bg: #10b981;
  --status-ongoing-shadow: rgba(16, 185, 129, 0.4);
  --status-upcoming-bg: #3b82f6;
  --status-upcoming-shadow: rgba(59, 130, 246, 0.4);
  --status-cancelled-bg: #ef4444;
  --status-cancelled-shadow: rgba(239, 68, 68, 0.4);

  /* Neutral Colors */
  --color-navy: #0f1419;
  --color-dark: #1a1d23;
  --color-gray-900: #2d3748;
  --color-gray-700: #4a5568;
  --color-gray-600: #718096;
  --color-gray-500: #718096;
  --color-gray-300: #cbd5e0;
  --color-gray-200: #e2e8f0;
  --color-gray-100: #f7fafc;
  --color-white: #ffffff;

  /* Shadows */
  --shadow-xs: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
  --shadow-sm: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
  --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
  --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
  --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
  --shadow-2xl: 0 25px 50px -12px rgba(0, 0, 0, 0.25);

  /* Border Radius */
  --radius-sm: 6px;
  --radius-md: 10px;
  --radius-lg: 16px;
  --radius-xl: 20px;
  --radius-2xl: 24px;
  --radius-full: 9999px;

  /* Spacing */
  --space-1: 4px;
  --space-2: 8px;
  --space-3: 12px;
  --space-4: 16px;
  --space-5: 20px;
  --space-6: 24px;
  --space-8: 32px;
  --space-10: 40px;
  --space-12: 48px;
  --space-16: 64px;
  --space-20: 80px;

  /* Transitions */
  --transition-fast: 150ms cubic-bezier(0.4, 0, 0.2, 1);
  --transition-base: 300ms cubic-bezier(0.4, 0, 0.2, 1);
  --transition-slow: 500ms cubic-bezier(0.4, 0, 0.2, 1);
}

/* ========================================
   ANIMATIONS
   ======================================== */
@keyframes fadeIn {
  from { opacity: 0; }
  to { opacity: 1; }
}

@keyframes fadeInUp {
  from {
    opacity: 0;
    transform: translateY(30px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

@keyframes pulse {
  0%, 100% { opacity: 1; }
  50% { opacity: 0.5; }
}

@keyframes pulseGlow {
  0%, 100% { 
    box-shadow: 0 4px 12px rgba(16, 185, 129, 0.4);
  }
  50% { 
    box-shadow: 0 4px 20px rgba(16, 185, 129, 0.7);
  }
}

/* ========================================
   HERO SECTION
   ======================================== */
.hero-international {
  position: relative;
  padding: 140px 0 100px;
  background: linear-gradient(135deg, #0f1419 0%, #1a2332 50%, #0f1419 100%);
  overflow: hidden;
}

.hero-gradient-overlay {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: radial-gradient(circle at 20% 30%, rgba(16, 124, 16, 0.15) 0%, transparent 50%),
              radial-gradient(circle at 80% 70%, rgba(59, 130, 246, 0.1) 0%, transparent 50%);
  pointer-events: none;
}

.hero-pattern {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-image: linear-gradient(rgba(255, 255, 255, 0.02) 1px, transparent 1px),
                    linear-gradient(90deg, rgba(255, 255, 255, 0.02) 1px, transparent 1px);
  background-size: 50px 50px;
  pointer-events: none;
}

.hero-content-international {
  position: relative;
  z-index: 1;
  max-width: 900px;
  margin: 0 auto;
  text-align: center;
}

.breadcrumb-international {
  display: inline-flex;
  align-items: center;
  gap: var(--space-2);
  padding: var(--space-2) var(--space-4);
  background: rgba(255, 255, 255, 0.08);
  backdrop-filter: blur(10px);
  border-radius: var(--radius-full);
  border: 1px solid rgba(255, 255, 255, 0.1);
  font-size: 13px;
  font-weight: 600;
  color: rgba(255, 255, 255, 0.7);
  margin-bottom: var(--space-8);
}

.breadcrumb-international a {
  color: rgba(255, 255, 255, 0.7);
  text-decoration: none;
  transition: color var(--transition-fast);
  display: inline-flex;
  align-items: center;
  gap: var(--space-2);
}

.breadcrumb-international a:hover {
  color: var(--color-white);
}

.breadcrumb-international .active {
  color: var(--color-white);
}

.breadcrumb-international i.fa-chevron-right {
  font-size: 10px;
  opacity: 0.5;
}

.hero-title-international {
  font-size: 64px;
  font-weight: 800;
  color: var(--color-white);
  line-height: 1.1;
  margin-bottom: var(--space-6);
  letter-spacing: -2px;
}

.highlight-text {
  background: linear-gradient(135deg, #107c10 0%, #14b8a6 100%);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}

.hero-description-international {
  font-size: 18px;
  color: rgba(255, 255, 255, 0.85);
  line-height: 1.8;
  margin-bottom: var(--space-12);
  max-width: 750px;
  margin-left: auto;
  margin-right: auto;
}

/* ========================================
   FILTER SECTION - IMPROVED & NON-STICKY
   ======================================== */
.filter-section-international {
  padding: var(--space-12) 0 var(--space-10);
  background: var(--color-white);
  border-bottom: 2px solid var(--color-gray-200);
}

.filter-wrapper {
  max-width: 1200px;
  margin: 0 auto;
}

.filter-header-section {
  text-align: center;
  margin-bottom: var(--space-8);
}

.filter-title-group h2 {
  font-size: 32px;
  font-weight: 800;
  color: var(--color-dark);
  margin-bottom: var(--space-2);
  letter-spacing: -0.5px;
}

.filter-title-group p {
  font-size: 16px;
  color: var(--color-gray-600);
  font-weight: 500;
}

.filter-controls {
  display: flex;
  flex-direction: column;
  gap: var(--space-6);
  align-items: center;
}

.search-container-international {
  position: relative;
  width: 100%;
  max-width: 700px;
}

.search-icon {
  position: absolute;
  left: var(--space-5);
  top: 50%;
  transform: translateY(-50%);
  color: var(--color-gray-500);
  font-size: 18px;
  pointer-events: none;
}

.search-input-international {
  width: 100%;
  padding: 16px 56px;
  border: 2px solid var(--color-gray-300);
  border-radius: var(--radius-lg);
  font-size: 15px;
  font-weight: 500;
  color: var(--color-dark);
  background: var(--color-white);
  transition: all var(--transition-base);
  box-shadow: var(--shadow-sm);
}

.search-input-international:focus {
  outline: none;
  border-color: var(--primary-green);
  box-shadow: 0 0 0 4px rgba(16, 124, 16, 0.1), var(--shadow-md);
}

.search-input-international::placeholder {
  color: var(--color-gray-500);
}

.clear-search {
  position: absolute;
  right: var(--space-5);
  top: 50%;
  transform: translateY(-50%);
  width: 28px;
  height: 28px;
  background: var(--color-gray-300);
  border: none;
  border-radius: 50%;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  color: var(--color-gray-700);
  transition: all var(--transition-fast);
  font-size: 12px;
}

.clear-search:hover {
  background: var(--color-gray-500);
  color: var(--color-white);
  transform: translateY(-50%) scale(1.1);
}

.filter-bottom-section {
  display: flex;
  justify-content: space-between;
  align-items: center;
  flex-wrap: wrap;
  gap: var(--space-4);
  padding-top: var(--space-6);
  border-top: 1px solid var(--color-gray-200);
}

.sort-container {
  display: flex;
  align-items: center;
  gap: var(--space-3);
}

.sort-label {
  font-size: 14px;
  font-weight: 700;
  color: var(--color-dark);
  white-space: nowrap;
}

.sort-select {
  min-width: 180px;
  padding: 10px var(--space-4);
  border: 2px solid var(--color-gray-300);
  border-radius: var(--radius-md);
  font-size: 14px;
  font-weight: 600;
  color: var(--color-dark);
  background: var(--color-white);
  transition: all var(--transition-base);
  cursor: pointer;
}

.sort-select:focus {
  outline: none;
  border-color: var(--primary-green);
  box-shadow: 0 0 0 3px rgba(16, 124, 16, 0.1);
}

.showing-info-international {
  display: flex;
  align-items: center;
  gap: var(--space-2);
}

.showing-info-international p {
  font-size: 14px;
  color: var(--color-gray-600);
  font-weight: 600;
  margin: 0;
}

.showing-info-international i {
  color: var(--primary-green);
  font-size: 16px;
}

/* ========================================
   ACTIVITIES GRID
   ======================================== */
.activities-grid-section {
  padding: var(--space-16) 0;
  background: linear-gradient(180deg, var(--color-white) 0%, var(--color-gray-100) 100%);
}

.section-header-international {
  text-align: center;
  margin-bottom: var(--space-12);
}

.section-subtitle {
  font-size: 14px;
  font-weight: 700;
  color: var(--primary-green);
  text-transform: uppercase;
  letter-spacing: 1px;
  margin-bottom: var(--space-3);
}

.section-title {
  font-size: 42px;
  font-weight: 800;
  color: var(--color-dark);
  margin-bottom: var(--space-4);
  letter-spacing: -1px;
}

.section-description {
  font-size: 16px;
  color: var(--color-gray-700);
  max-width: 700px;
  margin: 0 auto;
  line-height: 1.7;
}

.activities-grid-international {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(380px, 1fr));
  gap: var(--space-8);
}

/* ========================================
   ACTIVITY CARD
   ======================================== */
.activity-card-international {
  background: var(--color-white);
  border: 1px solid var(--color-gray-300);
  border-radius: var(--radius-xl);
  overflow: hidden;
  transition: all var(--transition-base);
  display: flex;
  flex-direction: column;
  height: 100%;
  box-shadow: var(--shadow-sm);
}

.activity-card-international:hover {
  border-color: var(--primary-green);
  transform: translateY(-8px);
  box-shadow: var(--shadow-2xl);
}

.card-image-container {
  position: relative;
  width: 100%;
  height: 280px;
  overflow: hidden;
}

.card-image-international {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94);
}

.activity-card-international:hover .card-image-international {
  transform: scale(1.08);
}

.card-image-overlay {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: linear-gradient(to bottom, rgba(15, 20, 25, 0) 0%, rgba(15, 20, 25, 0.7) 100%);
  display: flex;
  align-items: flex-start;
  justify-content: flex-end;
  padding: var(--space-4);
}

/* ========================================
   STATUS BADGES - DISTINCT COLORS! 🎨
   SUPPORT BAHASA INDONESIA & ENGLISH
   ======================================== */
.status-badge {
  padding: var(--space-2) var(--space-4);
  border-radius: var(--radius-md);
  font-size: 12px;
  font-weight: 700;
  display: inline-flex;
  align-items: center;
  gap: var(--space-2);
  backdrop-filter: blur(10px);
  text-transform: uppercase;
  letter-spacing: 0.5px;
  transition: all var(--transition-base);
}

/* ✅ COMPLETED / SELESAI - GRAY/SLATE */
.status-badge.status-completed {
  background: linear-gradient(135deg, #64748b 0%, #475569 100%);
  color: var(--color-white);
  border: 1px solid rgba(255, 255, 255, 0.2);
  box-shadow: 0 4px 12px var(--status-completed-shadow), 
              0 2px 4px rgba(0, 0, 0, 0.1);
}

.status-badge.status-completed i {
  animation: none;
}

/* ✅ ONGOING / BERLANGSUNG - VIBRANT GREEN */
.status-badge.status-ongoing {
  background: linear-gradient(135deg, #10b981 0%, #059669 100%);
  color: var(--color-white);
  border: 1px solid rgba(255, 255, 255, 0.3);
  box-shadow: 0 4px 12px var(--status-ongoing-shadow), 
              0 2px 4px rgba(0, 0, 0, 0.1);
  animation: pulseGlow 2s ease-in-out infinite;
}

.status-badge.status-ongoing i {
  animation: pulse 1.5s ease-in-out infinite;
}

/* ✅ UPCOMING / AKAN DATANG - BRIGHT BLUE */
.status-badge.status-upcoming {
  background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
  color: var(--color-white);
  border: 1px solid rgba(255, 255, 255, 0.3);
  box-shadow: 0 4px 12px var(--status-upcoming-shadow), 
              0 2px 4px rgba(0, 0, 0, 0.1);
}

/* ✅ CANCELLED / DIBATALKAN - RED */
.status-badge.status-cancelled {
  background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
  color: var(--color-white);
  border: 1px solid rgba(255, 255, 255, 0.3);
  box-shadow: 0 4px 12px var(--status-cancelled-shadow), 
              0 2px 4px rgba(0, 0, 0, 0.1);
}

/* Hover Effects */
.status-badge:hover {
  transform: translateY(-2px);
  box-shadow: 0 6px 16px rgba(0, 0, 0, 0.2);
}

.card-content-international {
  padding: var(--space-6);
  flex: 1;
  display: flex;
  flex-direction: column;
  gap: var(--space-4);
}

.card-meta-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding-bottom: var(--space-3);
  border-bottom: 2px solid var(--color-gray-100);
}

.card-date {
  display: inline-flex;
  align-items: center;
  gap: var(--space-2);
  font-size: 13px;
  font-weight: 600;
  color: var(--color-gray-700);
}

.card-category {
  padding: 4px 12px;
  background: var(--primary-light);
  border-radius: var(--radius-sm);
  font-size: 11px;
  font-weight: 700;
  color: var(--primary-green);
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

.card-title-international {
  font-size: 22px;
  font-weight: 800;
  line-height: 1.3;
  margin: 0;
}

.card-title-international a {
  color: var(--color-dark);
  text-decoration: none;
  transition: color var(--transition-fast);
}

.card-title-international a:hover {
  color: var(--primary-green);
}

.card-excerpt {
  font-size: 15px;
  color: var(--color-gray-700);
  line-height: 1.7;
  flex: 1;
  display: -webkit-box;
  -webkit-line-clamp: 3;
  -webkit-box-orient: vertical;
  overflow: hidden;
}

.card-info-grid {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: var(--space-3);
  padding: var(--space-4) 0;
  border-top: 1px solid var(--color-gray-100);
  border-bottom: 1px solid var(--color-gray-100);
}

.info-item {
  display: flex;
  align-items: center;
  gap: var(--space-2);
  font-size: 13px;
  color: var(--color-gray-700);
  font-weight: 600;
}

.info-item i {
  color: var(--primary-green);
  font-size: 14px;
  width: 16px;
  text-align: center;
}

.card-tags-international {
  display: flex;
  gap: var(--space-2);
  flex-wrap: wrap;
}

.tag-international {
  padding: 4px 12px;
  background: linear-gradient(135deg, rgba(16, 124, 16, 0.08) 0%, rgba(16, 124, 16, 0.04) 100%);
  color: var(--primary-green);
  border-radius: var(--radius-sm);
  font-size: 11px;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 0.5px;
  border: 1px solid rgba(16, 124, 16, 0.15);
  transition: all var(--transition-fast);
}

.tag-international:hover {
  background: linear-gradient(135deg, rgba(16, 124, 16, 0.15) 0%, rgba(16, 124, 16, 0.08) 100%);
  border-color: var(--primary-green);
}

.card-footer-international {
  display: flex;
  align-items: center;
  gap: var(--space-3);
  margin-top: auto;
}

.btn-view-details {
  flex: 1;
  padding: 12px var(--space-5);
  background: var(--primary-gradient);
  color: var(--color-white);
  border: none;
  border-radius: var(--radius-md);
  font-size: 14px;
  font-weight: 700;
  cursor: pointer;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: var(--space-2);
  transition: all var(--transition-base);
  text-decoration: none;
  box-shadow: 0 2px 8px rgba(16, 124, 16, 0.2);
}

.btn-view-details:hover {
  transform: translateY(-2px);
  box-shadow: 0 4px 16px rgba(16, 124, 16, 0.3);
  color: var(--color-white);
}

.btn-icon-action {
  width: 44px;
  height: 44px;
  background: var(--color-gray-100);
  border: 1px solid var(--color-gray-300);
  border-radius: var(--radius-md);
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  color: var(--color-gray-700);
  transition: all var(--transition-fast);
}

.btn-icon-action:hover {
  background: var(--primary-light);
  border-color: var(--primary-green);
  color: var(--primary-green);
  transform: translateY(-2px);
}

/* ========================================
   NO RESULTS
   ======================================== */
.no-results-international {
  text-align: center;
  padding: var(--space-16) var(--space-6);
  background: var(--color-white);
  border: 2px dashed var(--color-gray-300);
  border-radius: var(--radius-xl);
}

.no-results-icon {
  font-size: 80px;
  color: var(--color-gray-300);
  margin-bottom: var(--space-6);
}

.no-results-international h3 {
  font-size: 28px;
  font-weight: 800;
  color: var(--color-dark);
  margin-bottom: var(--space-3);
}

.no-results-international p {
  font-size: 16px;
  color: var(--color-gray-700);
  margin-bottom: var(--space-6);
}

/* ========================================
   CTA SECTION
   ======================================== */
.cta-section-international {
  padding: var(--space-16) 0;
  background: var(--color-white);
}

.cta-container-international {
  background: var(--primary-gradient);
  border-radius: var(--radius-2xl);
  padding: var(--space-12) var(--space-8);
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: var(--space-8);
  box-shadow: 0 20px 40px rgba(16, 124, 16, 0.25);
  position: relative;
  overflow: hidden;
}

.cta-container-international::before {
  content: "";
  position: absolute;
  top: -50%;
  right: -10%;
  width: 500px;
  height: 500px;
  background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
  border-radius: 50%;
  pointer-events: none;
}

.cta-icon-international {
  width: 80px;
  height: 80px;
  background: rgba(255, 255, 255, 0.2);
  backdrop-filter: blur(10px);
  border-radius: var(--radius-lg);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 36px;
  color: var(--color-white);
  flex-shrink: 0;
  position: relative;
  z-index: 1;
}

.cta-content-international {
  flex: 1;
  position: relative;
  z-index: 1;
}

.cta-content-international h2 {
  font-size: 36px;
  font-weight: 800;
  color: var(--color-white);
  margin-bottom: var(--space-3);
}

.cta-content-international p {
  font-size: 16px;
  color: rgba(255, 255, 255, 0.9);
  line-height: 1.7;
}

.btn-cta-international {
  padding: 16px var(--space-8);
  background: var(--color-white);
  color: var(--primary-green);
  border: none;
  border-radius: var(--radius-md);
  font-weight: 800;
  font-size: 16px;
  cursor: pointer;
  display: inline-flex;
  align-items: center;
  gap: var(--space-3);
  transition: all var(--transition-base);
  white-space: nowrap;
  position: relative;
  z-index: 1;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.btn-cta-international:hover {
  transform: translateY(-3px);
  box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
}

/* ========================================
   PAGINATION
   ======================================== */
.pagination-international {
  display: flex;
  justify-content: center;
  margin-top: var(--space-12);
}

/* ========================================
   RESPONSIVE
   ======================================== */
@media (max-width: 1200px) {
  .hero-title-international {
    font-size: 56px;
  }
  
  .cta-container-international {
    flex-direction: column;
    text-align: center;
  }
}

@media (max-width: 768px) {
  .hero-international {
    padding: 100px 0 80px;
  }
  
  .hero-title-international {
    font-size: 36px;
  }
  
  .hero-description-international {
    font-size: 16px;
  }
  
  .activities-grid-international {
    grid-template-columns: 1fr;
  }
  
  .filter-section-international {
    padding: var(--space-10) 0 var(--space-8);
  }

  .filter-title-group h2 {
    font-size: 28px;
  }

  .filter-bottom-section {
    flex-direction: column;
    align-items: stretch;
  }

  .sort-container {
    width: 100%;
    justify-content: space-between;
  }

  .sort-select {
    flex: 1;
  }

  .showing-info-international {
    justify-content: center;
  }
  
  .section-title {
    font-size: 32px;
  }
  
  .cta-content-international h2 {
    font-size: 28px;
  }

  .card-info-grid {
    grid-template-columns: 1fr;
  }
}

@media (max-width: 480px) {
  .hero-title-international {
    font-size: 28px;
  }
  
  .breadcrumb-international {
    font-size: 11px;
    gap: var(--space-1);
    padding: var(--space-1) var(--space-3);
  }

  .filter-title-group h2 {
    font-size: 24px;
  }

  .filter-title-group p {
    font-size: 14px;
  }

  .search-input-international {
    padding: 14px 48px;
    font-size: 14px;
  }
  
  .card-image-container {
    height: 240px;
  }
  
  .card-content-international {
    padding: var(--space-5);
  }
  
  .card-title-international {
    font-size: 20px;
  }
  
  .cta-container-international {
    padding: var(--space-8);
  }
  
  .cta-icon-international {
    width: 60px;
    height: 60px;
    font-size: 28px;
  }
}
</style>

<!-- Hero Section - International Corporate -->
<section class="hero-international">
    <div class="hero-gradient-overlay"></div>
    <div class="hero-pattern"></div>

    <div class="container">
        <div class="hero-content-international" data-aos="fade-up">
            <div class="breadcrumb-international">
                <a href="{{ route('home') }}"><i class="fas fa-home"></i> {{ __('messages.home') }}</a>
                <i class="fas fa-chevron-right"></i>
                <span class="active">{{ __('messages.company_activity') }}</span>
            </div>

            <h1 class="hero-title-international">
                {{ __('messages.company_activity') }} <span class="highlight-text">& Events</span>
            </h1>

            <p class="hero-description-international">
                Building excellence through meaningful experiences. Discover our comprehensive portfolio of professional development initiatives, team building programs, and community engagement activities.
            </p>

            {{-- ✅ REMOVED: Hero Metrics Section --}}
        </div>
    </div>
</section>

<!-- Filter Section - Improved & Non-Sticky -->
<section class="filter-section-international">
    <div class="container">
        <div class="filter-wrapper">
            <div class="filter-header-section">
                <div class="filter-title-group">
                    <h2>Explore Activities</h2>
                    <p>Sort by and discover events that matter to you</p>
                </div>
            </div>

            <div class="filter-controls">
                <div class="search-container-international">
                    <i class="fas fa-search search-icon"></i>
                    <input
                        type="text"
                        id="searchActivities"
                        class="search-input-international"
                        placeholder="Search by title, location, or category..."
                    />
                    <button class="clear-search" id="clearSearch" style="display: none">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>

            <div class="filter-bottom-section">
                <div class="sort-container">
                    <label for="sort-by" class="sort-label">
                        {{ __('messages.sort_by') }}:
                    </label>
                    <select id="sort-by" class="sort-select">
                        <option value="newest" {{ $sort == 'newest' ? 'selected' : '' }}>{{ __('messages.newest') }}</option>
                        <option value="latest" {{ $sort == 'latest' ? 'selected' : '' }}>{{ __('messages.latest') }}</option>
                    </select>
                </div>

                <div class="showing-info-international">
                    <i class="fas fa-list"></i>
                    <p>Showing {{ $activities->firstItem() }} - {{ $activities->lastItem() }} of {{ $activities->total() }}</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Activities Grid Section -->
<section class="activities-grid-section">
    <div class="container">
        @if($activities->isEmpty())
            <div class="no-results-international">
                <div class="no-results-icon">
                    <i class="fas fa-search-minus"></i>
                </div>
                <h3>{{ __('messages.no_activity') }}</h3>
                <p>We couldn't find any activities at the moment. Please check back later.</p>
            </div>
        @else
            <div class="section-header-international" data-aos="fade-up">
                <div class="section-subtitle">Our Portfolio</div>
                <h2 class="section-title">Featured Activities & Events</h2>
                <p class="section-description">
                    Carefully curated experiences designed to inspire, connect, and empower our team
                </p>
            </div>

            <div class="activities-grid-international" id="activitiesGrid">
                @foreach ($activities as $item)
                    @php
                        // ✅ FIXED: Support Bahasa Indonesia & English
                        $statusLower = strtolower(trim($item->status ?? 'completed'));
                        
                        // Normalize status - support both languages
                        $statusClass = 'status-completed'; // default
                        $statusIcon = 'fa-check-circle';
                        $statusText = ucfirst($item->status ?? 'Completed');
                        
                        // Check for ONGOING / BERLANGSUNG
                        if (str_contains($statusLower, 'berlangsung') || str_contains($statusLower, 'ongoing')) {
                            $statusClass = 'status-ongoing';
                            $statusIcon = 'fa-spinner fa-spin';
                        }
                        // Check for UPCOMING / AKAN DATANG
                        elseif (str_contains($statusLower, 'akan datang') || str_contains($statusLower, 'upcoming')) {
                            $statusClass = 'status-upcoming';
                            $statusIcon = 'fa-calendar-plus';
                        }
                        // Check for CANCELLED / DIBATALKAN
                        elseif (str_contains($statusLower, 'dibatalkan') || str_contains($statusLower, 'cancelled') || str_contains($statusLower, 'canceled')) {
                            $statusClass = 'status-cancelled';
                            $statusIcon = 'fa-times-circle';
                        }
                        // Check for COMPLETED / SELESAI
                        elseif (str_contains($statusLower, 'selesai') || str_contains($statusLower, 'completed')) {
                            $statusClass = 'status-completed';
                            $statusIcon = 'fa-check-circle';
                        }
                    @endphp

                    <article class="activity-card-international" data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
                        <div class="card-image-container">
                            <img
                                src="{{ asset($item->images) }}"
                                alt="{{ $item->title }}"
                                class="card-image-international"
                            />
                            <div class="card-image-overlay">
                                {{-- ✅ FIXED: Dynamic Status Badge with Distinct Colors --}}
                                <span class="status-badge {{ $statusClass }}">
                                    <i class="fas {{ $statusIcon }}"></i>
                                    {{ $statusText }}
                                </span>
                            </div>
                        </div>

                        <div class="card-content-international">
                            <div class="card-meta-header">
                                <div class="card-date">
                                    <i class="far fa-calendar"></i>
                                    <span>{{ optional($item->start_date)->format('M d, Y') ?? optional($item->date)->format('M d, Y') ?? '-' }}</span>
                                </div>
                                {{-- ✅ UPDATED: Dynamic Category --}}
                                <div class="card-category">{{ $item->category ?? __('messages.activity') }}</div>
                            </div>

                            <h3 class="card-title-international">
                                <a href="{{ route('activity.show', $item->slug) }}">{{ $item->title }}</a>
                            </h3>

                            <p class="card-excerpt">
                                {{ Str::limit($item->description, 120) }}
                            </p>

                            {{-- ✅ UPDATED: Dynamic Info Grid --}}
                            <div class="card-info-grid">
                                {{-- Date --}}
                                <div class="info-item">
                                    <i class="fas fa-calendar-alt"></i>
                                    <span>{{ optional($item->start_date)->format('M d, Y') ?? optional($item->date)->format('M d, Y') ?? '-' }}</span>
                                </div>
                                
                                {{-- Duration - Dynamic --}}
                                <div class="info-item">
                                    <i class="fas fa-clock"></i>
                                    <span>{{ $item->duration ?? 'Full Day' }}</span>
                                </div>
                                
                                {{-- Participants - Dynamic --}}
                                <div class="info-item">
                                    <i class="fas fa-users"></i>
                                    <span>{{ $item->participants ?? 'Umalo-Team' }}</span>
                                </div>
                                
                                {{-- Location - Dynamic (Only show if exists) --}}
                                @if($item->location)
                                <div class="info-item">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span>{{ $item->location }}</span>
                                </div>
                                @endif
                            </div>

                            {{-- ✅ UPDATED: Dynamic Tags from Database --}}
                            @if($item->tags && is_array($item->tags) && count($item->tags) > 0)
                            <div class="card-tags-international">
                                @foreach($item->tags as $tag)
                                    <span class="tag-international">{{ $tag }}</span>
                                @endforeach
                            </div>
                            @elseif($item->tags && is_string($item->tags))
                                {{-- Jika tags masih string JSON --}}
                                @php
                                    $tagsArray = json_decode($item->tags, true);
                                @endphp
                                @if($tagsArray && is_array($tagsArray) && count($tagsArray) > 0)
                                <div class="card-tags-international">
                                    @foreach($tagsArray as $tag)
                                        <span class="tag-international">{{ $tag }}</span>
                                    @endforeach
                                </div>
                                @endif
                            @endif

                            <div class="card-footer-international">
                                <a href="{{ route('activity.show', $item->slug) }}" class="btn-view-details">
                                    <span>{{ __('messages.more_detail') }}</span>
                                    <i class="fas fa-arrow-right"></i>
                                </a>
                                <button class="btn-icon-action" title="Share">
                                    <i class="fas fa-share-alt"></i>
                                </button>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="pagination-international mt-5">
                {{ $activities->links() }}
            </div>
        @endif
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section-international" data-aos="fade-up">
    <div class="container">
        <div class="cta-container-international">
            <div class="cta-icon-international">
                <i class="fas fa-lightbulb"></i>
            </div>
            <div class="cta-content-international">
                <h2>Have an Activity Idea?</h2>
                <p>
                    We value innovation and creativity. Share your ideas for future company activities and help us create even more engaging experiences for our global team.
                </p>
            </div>
            <button class="btn-cta-international" onclick="alert('Feature coming soon!')">
                <i class="fas fa-paper-plane"></i>
                <span>Submit Your Idea</span>
            </button>
        </div>
    </div>
</section>

<script>
// Sort functionality
document.getElementById('sort-by').addEventListener('change', function() {
    var sort = this.value;
    window.location.href = '?sort=' + sort;
});

// Search functionality
const searchInput = document.getElementById('searchActivities');
const clearSearchBtn = document.getElementById('clearSearch');
const activitiesGrid = document.getElementById('activitiesGrid');

if (searchInput) {
    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        const cards = activitiesGrid.querySelectorAll('.activity-card-international');
        
        if (searchTerm.length > 0) {
            clearSearchBtn.style.display = 'flex';
        } else {
            clearSearchBtn.style.display = 'none';
        }
        
        cards.forEach(card => {
            const title = card.querySelector('.card-title-international a').textContent.toLowerCase();
            const description = card.querySelector('.card-excerpt').textContent.toLowerCase();
            const category = card.querySelector('.card-category')?.textContent.toLowerCase() || '';
            const tags = Array.from(card.querySelectorAll('.tag-international')).map(tag => tag.textContent.toLowerCase()).join(' ');
            const location = Array.from(card.querySelectorAll('.info-item')).find(item => item.textContent.includes('location'))?.textContent.toLowerCase() || '';
            
            if (title.includes(searchTerm) || description.includes(searchTerm) || category.includes(searchTerm) || tags.includes(searchTerm) || location.includes(searchTerm)) {
                card.style.display = 'flex';
            } else {
                card.style.display = 'none';
            }
        });
    });
}

if (clearSearchBtn) {
    clearSearchBtn.addEventListener('click', function() {
        searchInput.value = '';
        searchInput.dispatchEvent(new Event('input'));
    });
}

// Initialize AOS if available
if (typeof AOS !== 'undefined') {
    AOS.init({
        duration: 800,
        once: true,
        offset: 100
    });
}
</script>
@endsection