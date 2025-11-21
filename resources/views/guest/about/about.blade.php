@extends('layouts.guest.master')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        overflow-x: hidden;
    }

    /* ==========================================
       ROOT VARIABLES
       ========================================== */
    :root {
        --primary: #228b22;
        --primary-dark: #1a6b1a;
        --primary-light: #2d9f2d;
        --accent: #207178;
        --text-primary: #111827;
        --text-secondary: #6b7280;
        --text-tertiary: #9ca3af;
        --dark: #1a1a1a;
        --gray-900: #0f172a;
        --gray-700: #334155;
        --gray-600: #475569;
        --gray-500: #64748b;
        --gray-400: #94a3b8;
        --gray-300: #cbd5e1;
        --gray-200: #e2e8f0;
        --gray-100: #f1f5f9;
        --gray-50: #f8fafc;
        --white: #ffffff;
        --bg-light: #f8f9fa;
        --border: #e5e7eb;
        
        --gradient-primary: linear-gradient(135deg, #228b22 0%, #207178 100%);
        --section-padding: 100px;
        --shadow-sm: 0 1px 3px rgba(0, 0, 0, 0.08);
        --shadow-md: 0 4px 8px rgba(0, 0, 0, 0.1);
        --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        --shadow-2xl: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        --radius-lg: 16px;
        --radius-xl: 20px;
        --radius-2xl: 24px;
        --transition: all 0.3s ease;
        --transition-smooth: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    html {
        scroll-behavior: smooth;
        scroll-padding-top: 80px;
    }

    /* ==========================================
       SUBTLE ANIMATIONS
       ========================================== */
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

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    @keyframes slideInLeft {
        from { 
            opacity: 0;
            transform: translateX(-40px); 
        }
        to { 
            opacity: 1;
            transform: translateX(0); 
        }
    }

    @keyframes slideInRight {
        from { 
            opacity: 0;
            transform: translateX(40px); 
        }
        to { 
            opacity: 1;
            transform: translateX(0); 
        }
    }
    
    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-10px); }
    }

    /* ==========================================
       UPDATED HERO SECTION - SMOOTH GRADIENT
       ========================================== */
    .hero-section {
        position: relative;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        min-height: 500px;
        height: 70vh;
        max-height: 600px;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }
    
    /* Dark overlay untuk kontras text */
    .hero-section::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, 
            rgba(0, 0, 0, 0.4), 
            rgba(0, 0, 0, 0.5));
        z-index: 1;
    }
    
    /* SMOOTH WHITE gradient - UPDATED untuk lebih halus */
    .hero-section::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 200px; /* Diperpanjang untuk transisi lebih smooth */
        background: linear-gradient(to top, 
            rgba(255, 255, 255, 1) 0%,      /* Putih solid 100% */
            rgba(255, 255, 255, 0.95) 15%,  
            rgba(255, 255, 255, 0.65) 30%,  
            rgba(255, 255, 255, 0.5) 45%,   
            rgba(255, 255, 255, 0.22) 60%,   
            rgba(255, 255, 255, 0) 75%,   
            rgba(255, 255, 255, 0) 90%,   
            transparent 100%);               /* Fade ke transparan */
        z-index: 2;
        pointer-events: none; /* Tidak menghalangi klik */
    }
    
    /* Hero Content - Simple Box with Subtle Shadow */
    .hero-content {
        position: relative;
        z-index: 10;
        text-align: center;
        color: white;
        padding: 3rem 2rem;
        max-width: 900px;
        animation: fadeInUp 0.8s ease-out;
    }
    
    .hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.625rem 1.5rem;
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.25);
        border-radius: 50px;
        font-size: 0.8125rem;
        font-weight: 600;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        margin-bottom: 1.5rem;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        animation: fadeIn 0.6s ease-out 0.2s backwards;
    }
    
    .hero-badge i {
        font-size: 1rem;
    }
    
    /* Title dengan warna PUTIH */
    .hero-title {
        font-size: clamp(2.75rem, 6vw, 4.5rem);
        font-weight: 900;
        line-height: 1.1;
        margin-bottom: 1.5rem;
        letter-spacing: -0.02em;
        color: #ffffff; /* PUTIH */
        text-shadow: 
            0 2px 10px rgba(0, 0, 0, 0.5),
            0 4px 20px rgba(0, 0, 0, 0.3);
        animation: fadeInUp 0.6s ease-out 0.3s backwards;
    }
    
    .hero-divider {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.75rem;
        margin: 2rem auto;
        animation: fadeIn 0.6s ease-out 0.4s backwards;
    }
    
    .hero-divider::before,
    .hero-divider::after {
        content: '';
        width: 50px;
        height: 2px;
        background: white;
        opacity: 0.7;
    }
    
    .divider-dot {
        width: 8px;
        height: 8px;
        background: white;
        border-radius: 50%;
        box-shadow: 0 0 10px rgba(255, 255, 255, 0.8);
    }
    
    .hero-subtitle {
        font-size: clamp(1rem, 2vw, 1.25rem);
        font-weight: 300;
        line-height: 1.7;
        color: rgba(255, 255, 255, 0.95);
        max-width: 700px;
        margin: 0 auto;
        text-shadow: 0 2px 8px rgba(0, 0, 0, 0.4);
        animation: fadeInUp 0.6s ease-out 0.5s backwards;
    }
    
    /* Decorative corner lines - subtle */
    .hero-decoration {
        position: absolute;
        z-index: 3;
        pointer-events: none;
    }
    
    .corner-line {
        position: absolute;
        background: rgba(255, 255, 255, 0.2);
    }
    
    .corner-tl-v {
        top: 30px;
        left: 30px;
        width: 2px;
        height: 60px;
    }
    
    .corner-tl-h {
        top: 30px;
        left: 30px;
        width: 60px;
        height: 2px;
    }
    
    .corner-br-v {
        bottom: 30px;
        right: 30px;
        width: 2px;
        height: 60px;
    }
    
    .corner-br-h {
        bottom: 30px;
        right: 30px;
        width: 60px;
        height: 2px;
    }
    
    /* Small decorative dots */
    .hero-dots {
        position: absolute;
        z-index: 3;
        pointer-events: none;
    }
    
    .hero-dot {
        position: absolute;
        width: 5px;
        height: 5px;
        background: rgba(255, 255, 255, 0.3);
        border-radius: 50%;
    }
    
    .hero-dot:nth-child(1) {
        top: 20%;
        left: 10%;
        animation: float 3s ease-in-out infinite;
    }
    
    .hero-dot:nth-child(2) {
        top: 30%;
        right: 15%;
        animation: float 4s ease-in-out infinite;
        animation-delay: 0.5s;
    }
    
    .hero-dot:nth-child(3) {
        bottom: 25%;
        left: 20%;
        animation: float 3.5s ease-in-out infinite;
        animation-delay: 1s;
    }
    
    .hero-dot:nth-child(4) {
        bottom: 35%;
        right: 12%;
        animation: float 4.5s ease-in-out infinite;
        animation-delay: 1.5s;
    }
    
    /* ==========================================
       PROFESSIONAL INTRO SECTION
       ========================================== */
    .intro-section {
        padding: 6rem 0;
        background: white;
        position: relative;
    }
    
    .intro-container {
        max-width: 1280px;
        margin: 0 auto;
        padding: 0 2rem;
    }
    
    .intro-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 4rem;
        align-items: center;
    }
    
    @media (min-width: 1024px) {
        .intro-grid {
            grid-template-columns: 1.1fr 0.9fr;
            gap: 5rem;
        }
    }
    
    .intro-content {
        animation: slideInLeft 0.8s ease-out;
    }
    
    .intro-label {
        display: inline-block;
        font-size: 0.8125rem;
        font-weight: 700;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        color: var(--primary);
        padding: 0.5rem 1.25rem;
        background: rgba(34, 139, 34, 0.08);
        border-radius: 50px;
        margin-bottom: 1.5rem;
    }
    
    .intro-title {
        font-size: clamp(2rem, 4vw, 2.75rem);
        font-weight: 700;
        color: var(--gray-900);
        line-height: 1.25;
        margin-bottom: 1.5rem;
        letter-spacing: -0.01em;
    }
    
    .intro-title-highlight {
        color: var(--primary);
        position: relative;
        display: inline-block;
    }
    
    .intro-title-highlight::after {
        content: '';
        position: absolute;
        bottom: 4px;
        left: 0;
        right: 0;
        height: 10px;
        background: rgba(34, 139, 34, 0.15);
        z-index: -1;
    }
    
    .intro-text {
        font-size: 1.0625rem;
        line-height: 1.8;
        color: var(--gray-600);
        text-align: justify;
        margin-bottom: 2rem;
    }
    

    .intro-visual {
        position: relative;
        animation: slideInRight 0.8s ease-out;
    }
    
    .intro-image-main {
        position: relative;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
    }
    
    .intro-image-main video,
    .intro-image-main img {
        width: 100%;
        height: auto;
        display: block;
    }
    
    .intro-image-badge {
        position: absolute;
        bottom: -20px;
        right: -20px;
        width: 180px;
        height: 180px;
        border-radius: 12px;
        overflow: hidden;
        border: 5px solid white;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
        transition: var(--transition);
    }
    
    .intro-image-badge:hover {
        transform: scale(1.05);
    }
    
    .intro-image-badge img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    @media (max-width: 1023px) {
        .intro-image-badge {
            width: 140px;
            height: 140px;
            bottom: -15px;
            right: -15px;
        }
    }
    
    /* ==========================================
       PROFESSIONAL VISION MISSION SECTION
       ========================================== */
    .vision-mission-section {
        padding: 5rem 0;
        background: linear-gradient(180deg, #f8fdf9 0%, #ffffff 100%);
    }
    
    .vision-mission-container {
        max-width: 1280px;
        margin: 0 auto;
        padding: 0 2rem;
    }
    
    .vision-mission-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 2.5rem;
    }
    
    @media (min-width: 768px) {
        .vision-mission-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 3rem;
        }
    }
    
    .vm-card {
        background: white;
        border-radius: 16px;
        padding: 3rem;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
        border: 1px solid rgba(34, 139, 34, 0.1);
        transition: var(--transition-smooth);
        position: relative;
        overflow: hidden;
    }
    
    .vm-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: var(--gradient-primary);
        transform: scaleX(0);
        transform-origin: left;
        transition: transform 0.4s ease;
    }
    
    .vm-card:hover::before {
        transform: scaleX(1);
    }
    
    .vm-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 40px rgba(34, 139, 34, 0.15);
        border-color: var(--primary);
    }
    
    .vm-header {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 2rem;
    }
    
    .vm-icon {
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, #228b22, #207178);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    
    .vm-icon i {
        font-size: 1.75rem;
        color: white;
    }
    
    .vm-title {
        font-size: 1.75rem;
        font-weight: 700;
        color: var(--gray-900);
        letter-spacing: -0.01em;
    }
    
    .vm-content {
        color: var(--gray-600);
        font-size: 1.0625rem;
        line-height: 1.8;
        text-align: justify;
    }
    
    .vm-content ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    
    .vm-content ul li {
        position: relative;
        padding-left: 1.75rem;
        margin-bottom: 0.875rem;
    }
    
    .vm-content ul li::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0.5rem;
        width: 8px;
        height: 8px;
        background: var(--primary);
        border-radius: 50%;
    }
    
    /* ==========================================
       BRAND SECTION
       ========================================== */
    .brand-section {
        position: relative;
        padding-top: 6rem;
        padding-bottom: 5rem;
        overflow: visible;
        background: white;
        z-index: 10;
    }
    
    .brand-gradient-overlay {
        position: absolute;
        top: -4rem;
        left: 0;
        width: 100%;
        height: 4rem;
        z-index: 20;
        pointer-events: none;
        background: linear-gradient(to bottom, rgba(255,255,255,0), rgba(255,255,255,1));
    }
    
    .brand-container {
        position: relative;
        z-index: 30;
        max-width: 72rem;
        margin: 0 auto;
        padding: 0 1rem;
    }
    
    .brand-grid {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 2rem;
        align-items: center;
    }
    
    @media (min-width: 768px) {
        .brand-grid {
            gap: 3rem;
        }
    }
    
    .brand-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        width: 7rem;
        transition: transform 0.5s;
    }
    
    @media (min-width: 768px) {
        .brand-item {
            width: 9rem;
        }
    }
    
    .brand-item:hover {
        transform: scale(1.05);
    }
    
    .brand-logo-wrapper {
        position: relative;
    }
    
    .brand-logo {
        height: 5rem;
        object-fit: contain;
        position: relative;
        z-index: 10;
    }
    
    @media (min-width: 768px) {
        .brand-logo {
            height: 7rem;
        }
    }
    
    .brand-shadow {
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%) translateY(0.75rem);
        width: 5rem;
        height: 0.75rem;
        background: rgba(0,0,0,0.1);
        filter: blur(4px);
        border-radius: 50%;
        z-index: 0;
    }
    
    /* ==========================================
       SECTION TITLE
       ========================================== */
    .section-title {
        font-size: 2.25rem;
        font-weight: 800;
        letter-spacing: 0.025em;
        color: #1f2937;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.15);
    }
    
    @media (min-width: 768px) {
        .section-title {
            font-size: 3rem;
        }
    }
    
    .title-underline {
        display: block;
        height: 0.25rem;
        width: 5rem;
        background-color: #16a34a;
        margin: 0.75rem auto 0;
        border-radius: 9999px;
    }

    /* ==========================================
       CORE VALUES SECTION
       ========================================== */
    .core-values-section {
        padding: var(--section-padding) 0;
        background: white;
    }

    .section-header {
        text-align: center;
        margin-bottom: 5rem;
    }

    .section-tag {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 24px;
        background: white;
        border: 2px solid var(--primary);
        border-radius: 100px;
        color: var(--primary);
        font-size: 0.8125rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        margin-bottom: 1.5rem;
        box-shadow: 0 4px 15px rgba(34, 139, 34, 0.15);
    }

    .section-title-highlight {
        background: var(--gradient-primary);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .section-subtitle {
        font-size: 1.125rem;
        color: var(--gray-600);
        max-width: 600px;
        margin: 0 auto;
    }

    .core-values-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 2rem;
    }

    @media (min-width: 640px) {
        .core-values-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (min-width: 1024px) {
        .core-values-grid {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    @media (min-width: 1280px) {
        .core-values-grid {
            grid-template-columns: repeat(5, 1fr);
        }
    }

    .core-value-item {
        background: white;
        border-radius: var(--radius-2xl);
        padding: 2.5rem 2rem;
        box-shadow: var(--shadow-md);
        text-align: center;
        transition: var(--transition);
        position: relative;
        overflow: hidden;
    }

    .core-value-item::before {
        content: '';
        position: absolute;
        inset: 0;
        background: var(--gradient-primary);
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .core-value-item:hover {
        transform: translateY(-10px);
        box-shadow: var(--shadow-xl);
    }

    .core-value-item:hover::before {
        opacity: 1;
    }

    .value-icon-wrapper {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #d1fae5, #a7f3d0);
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1.75rem;
        transition: all 0.3s ease;
        position: relative;
        z-index: 2;
    }

    .core-value-item:hover .value-icon-wrapper {
        background: white;
        transform: scale(1.1);
    }

    .value-icon {
        color: var(--primary-dark);
        font-size: 2rem;
    }

    .value-title {
        color: var(--gray-900);
        font-size: 1.25rem;
        font-weight: 800;
        margin-bottom: 1rem;
        position: relative;
        z-index: 2;
        transition: color 0.3s ease;
    }

    .core-value-item:hover .value-title {
        color: white;
    }

    .value-desc {
        color: var(--gray-600);
        font-size: 0.9375rem;
        line-height: 1.6;
        position: relative;
        z-index: 2;
        transition: color 0.3s ease;
    }

    .core-value-item:hover .value-desc {
        color: rgba(255, 255, 255, 0.95);
    }

    /* ==========================================
       TEAM SECTION
       ========================================== */
    .team-section {
        padding: var(--section-padding) 0;
        background: linear-gradient(to bottom, var(--gray-50), white);
    }

    .team-image-wrapper {
        max-width: 1000px;
        margin: 0 auto 5rem;
        border-radius: 2rem;
        overflow: hidden;
        box-shadow: var(--shadow-2xl);
        position: relative;
    }

    .team-image {
        width: 100%;
        height: auto;
        display: block;
    }

    .team-badge {
        position: absolute;
        top: 2rem;
        right: 2rem;
        background: linear-gradient(135deg, #fbbf24, #f59e0b);
        color: var(--dark);
        padding: 0.875rem 1.75rem;
        border-radius: 3rem;
        font-weight: 800;
        font-size: 0.9375rem;
        box-shadow: 0 8px 20px rgba(251, 191, 36, 0.4);
        display: flex;
        align-items: center;
        gap: 0.625rem;
    }

    .team-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 2rem;
    }

    @media (min-width: 640px) {
        .team-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (min-width: 1024px) {
        .team-grid {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    @media (min-width: 1280px) {
        .team-grid {
            grid-template-columns: repeat(5, 1fr);
        }
    }

    .team-card {
        background: white;
        border: 2px solid var(--gray-200);
        border-radius: var(--radius-2xl);
        overflow: hidden;
        transition: var(--transition-smooth);
        box-shadow: var(--shadow-sm);
        position: relative;
    }

    .team-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 80px;
        background: var(--gradient-primary);
        z-index: 1;
        transition: height 0.5s ease;
    }

    .team-card::after {
        content: '';
        position: absolute;
        inset: 0;
        background: var(--gradient-primary);
        opacity: 0;
        z-index: 0;
        transition: opacity 0.5s ease;
    }

    .team-card:hover {
        transform: translateY(-12px);
        box-shadow: var(--shadow-2xl);
        border-color: var(--primary);
    }

    .team-card:hover::before {
        height: 100%;
    }

    .team-card:hover::after {
        opacity: 1;
    }

    .team-card-content {
        position: relative;
        z-index: 2;
        padding: 1.5rem;
        text-align: center;
    }

    .team-photo-wrapper {
        width: 100px;
        height: 100px;
        margin: 0 auto 1.25rem;
        position: relative;
    }

    .team-photo-border {
        position: absolute;
        inset: -4px;
        border-radius: 50%;
        background: linear-gradient(135deg, #fbbf24, #f59e0b);
    }

    .team-photo {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid white;
        position: relative;
        z-index: 2;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
        transition: transform 0.4s ease;
    }

    .team-card:hover .team-photo {
        transform: scale(1.08);
    }

    .team-name {
        color: var(--dark);
        font-size: 1.125rem;
        font-weight: 800;
        margin-bottom: 0.5rem;
        transition: color 0.3s ease;
    }

    .team-card:hover .team-name {
        color: white;
    }

    .team-position {
        display: inline-block;
        background: var(--gradient-primary);
        color: white;
        font-size: 0.8125rem;
        font-weight: 700;
        padding: 0.5rem 1rem;
        border-radius: 2rem;
        margin-bottom: 0.875rem;
        transition: all 0.4s ease;
    }

    .team-card:hover .team-position {
        background: linear-gradient(135deg, #fbbf24, #f59e0b);
        color: var(--dark);
        transform: scale(1.05);
    }

    .team-desc {
        color: var(--gray-600);
        font-size: 0.8125rem;
        line-height: 1.5;
        margin-bottom: 1rem;
        transition: color 0.3s ease;
    }

    .team-card:hover .team-desc {
        color: rgba(255, 255, 255, 0.95);
    }

    .team-social {
        display: flex;
        justify-content: center;
        gap: 0.625rem;
        opacity: 0;
        transform: translateY(10px);
        transition: all 0.4s ease;
    }

    .team-card:hover .team-social {
        opacity: 1;
        transform: translateY(0);
    }

    .team-social-icon {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 0.875rem;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .team-social-icon:hover {
        background: white;
        transform: translateY(-3px) scale(1.1);
    }

    .team-social-icon:nth-child(1):hover { color: #0077b5; }
    .team-social-icon:nth-child(2):hover { color: #333; }
    .team-social-icon:nth-child(3):hover { color: #ea4335; }

    /* ==========================================
       PRODUCTION SECTION
       ========================================== */
    .production-section {
        padding: var(--section-padding) 0;
        background: white;
    }

    .production-timeline {
        max-width: 1100px;
        margin: 0 auto;
        position: relative;
    }

    .timeline-line {
        position: absolute;
        left: 50%;
        top: 0;
        width: 3px;
        height: 0;
        background: linear-gradient(to bottom, var(--primary), #fbbf24);
        transform: translateX(-50%);
        transition: height 0.5s ease;
    }

    @media (max-width: 1023px) {
        .timeline-line {
            display: none;
        }
    }

    .production-step {
        display: grid;
        grid-template-columns: 1fr;
        gap: 2.5rem;
        align-items: center;
        margin-bottom: 5rem;
        position: relative;
        opacity: 0;
        transform: translateY(40px);
        transition: all 0.8s ease;
    }

    .production-step.in-view {
        opacity: 1;
        transform: translateY(0);
    }

    @media (min-width: 1024px) {
        .production-step {
            grid-template-columns: 1fr auto 1fr;
        }

        .production-step:nth-child(even) .step-content {
            order: 3;
        }

        .production-step:nth-child(even) .step-image-card {
            order: 1;
        }
    }

    .step-number-circle {
        width: 80px;
        height: 80px;
        background: var(--gradient-primary);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        font-weight: 900;
        color: white;
        box-shadow: 0 10px 30px rgba(34, 139, 34, 0.3), 0 0 0 12px rgba(34, 139, 34, 0.1);
        margin: 0 auto;
        transition: all 0.5s ease;
        position: relative;
        z-index: 10;
    }

    @media (min-width: 1024px) {
        .step-number-circle {
            order: 2;
        }
    }

    .step-content {
        text-align: center;
        transition: all 0.5s ease;
    }

    @media (min-width: 1024px) {
        .production-step:nth-child(odd) .step-content {
            text-align: right;
            padding-right: 2rem;
        }

        .production-step:nth-child(even) .step-content {
            text-align: left;
            padding-left: 2rem;
        }
    }

    .step-title {
        color: var(--gray-900);
        font-size: 1.5rem;
        font-weight: 800;
        margin-bottom: 1rem;
        transition: color 0.3s ease;
    }

    .production-step.in-view .step-title {
        color: var(--primary);
    }

    .step-desc {
        color: var(--gray-600);
        font-size: 1rem;
        line-height: 1.7;
    }

    .step-image-card {
        background: white;
        border-radius: var(--radius-2xl);
        padding: 1.25rem;
        box-shadow: var(--shadow-lg);
        overflow: hidden;
        transition: all 0.5s ease;
    }

    .production-step.in-view .step-image-card {
        box-shadow: var(--shadow-2xl);
    }

    .step-image {
        width: 100%;
        height: 280px;
        object-fit: cover;
        border-radius: var(--radius-xl);
        transition: transform 0.4s ease;
    }

    .production-step:hover .step-image {
        transform: scale(1.05);
    }

    /* ==========================================
       RESPONSIVE
       ========================================== */
    @media (max-width: 768px) {
        :root {
            --section-padding: 70px;
        }

        .hero-section {
            height: 65vh;
            min-height: 450px;
        }
        
        .hero-content {
            padding: 2rem 1.5rem;
        }
        
        .hero-decoration {
            display: none;
        }

        .intro-section {
            padding: 4rem 0;
        }
        
        .vision-mission-section {
            padding: 4rem 0;
        }

        .vm-card {
            padding: 2rem;
        }

        .team-badge {
            top: 1rem;
            right: 1rem;
            padding: 0.625rem 1.25rem;
            font-size: 0.8125rem;
        }

        .production-step {
            margin-bottom: 4rem;
        }
    }
</style>

<!-- Main Wrapper -->
<div style="width: 100%; overflow-x: hidden;">

    <!-- CLEAN & ELEGANT HERO SECTION WITH SMOOTH GRADIENT -->
    <section class="hero-section" style="background-image: url('{{ asset('storage/img/kantor.jpg') }}');">
        
        <!-- Simple corner decorations -->
        <div class="hero-decoration">
            <div class="corner-line corner-tl-v"></div>
            <div class="corner-line corner-tl-h"></div>
            <div class="corner-line corner-br-v"></div>
            <div class="corner-line corner-br-h"></div>
        </div>
        
        <!-- Floating dots -->
        <div class="hero-dots">
            <div class="hero-dot"></div>
            <div class="hero-dot"></div>
            <div class="hero-dot"></div>
            <div class="hero-dot"></div>
        </div>
        
        <div class="hero-content">
            <div class="hero-badge">
                <i class="fas fa-building"></i>
                WELCOME TO
            </div>
            <h1 class="hero-title">{{ __('messages.about_us') }}</h1>
            <div class="hero-divider">
                <span class="divider-dot"></span>
            </div>
            <p class="hero-subtitle">
                {{ __('messages.about_us_slogan') }}
            </p>
        </div>
    </section>

    <!-- PROFESSIONAL INTRO SECTION -->
    <section class="intro-section">
        <div class="intro-container">
            <div class="intro-grid">
                <!-- Content -->
                <div class="intro-content">
                    <span class="intro-label">{{ $company->company_name ?? 'Umalo Sedia Tekno' }}</span>
                    
                    <h2 class="intro-title">
                        <span class="intro-title-highlight">{{ $company->slogan ?? 'Way To Know' }}</span> 
                        Transformasi Digital
                    </h2>
                    
                    <p class="intro-text">
                        {{ $company->short_history ?? 'Umalo adalah penyedia solusi teknologi pendidikan dan integrasi sistem yang didirikan pada tahun 2023 dengan komitmen mendalam terhadap transformasi digital.' }}
                    </p>
                    
                </div>
                
                <!-- Visual -->
                <div class="intro-visual">
                    <div class="intro-image-main">
                        <video autoplay muted loop playsinline preload="metadata"
                            poster="{{ asset('storage/img/kantor-umalo.webp') }}">
                            <source src="{{ asset('storage/videos/umalo_introduction.mp4') }}" type="video/mp4">
                        </video>
                    </div>
                    
                    <div class="intro-image-badge">
                        <img src="{{ asset('storage/img/kantor-umalo.webp') }}" alt="Kantor Umalo">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- PROFESSIONAL VISION MISSION SECTION -->
    <section class="vision-mission-section">
        <div class="vision-mission-container">
            <div class="vision-mission-grid">
                <!-- VISI -->
                <div class="vm-card">
                    <div class="vm-header">
                        <div class="vm-icon">
                            <i class="fas fa-eye"></i>
                        </div>
                        <h3 class="vm-title">Visi</h3>
                    </div>
                    <div class="vm-content">
                        <p>{{ __('messages.vision') ?? $company->visi }}</p>
                    </div>
                </div>

                <!-- MISI -->
                <div class="vm-card">
                    <div class="vm-header">
                        <div class="vm-icon">
                            <i class="fas fa-bullseye"></i>
                        </div>
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

    <!-- Our Brand Section -->
    <section class="brand-section">
        <div class="brand-gradient-overlay"></div>
        
        <div class="brand-container">
            <div style="text-align: center; margin-bottom: 3rem;">
                <h2 class="section-title">
                    Our Brands
                    <span class="title-underline"></span>
                </h2>
            </div>

            <div class="brand-grid">
                @foreach($brands as $brand)
                    <div class="brand-item">
                        <div class="brand-logo-wrapper">
                            <img src="{{ asset('storage/' . $brand->gambar) }}"
                                 alt="{{ $brand->nama }}"
                                 class="brand-logo" />
                            <div class="brand-shadow"></div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- CORE VALUES -->
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

    <!-- TEAM SECTION -->
<section class="team-section">
    <div class="container" style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
        <div class="section-header">
            <span class="section-tag">
                <i class="fas fa-users"></i>
                The Experts
            </span>
            <h2 class="section-title">
                Meet Our <span class="section-title-highlight">Team</span>
            </h2>
        </div>

        <div class="team-image-wrapper">
            <div class="team-badge">
                <i class="fas fa-star"></i>
                <span>Our Amazing Team</span>
            </div>
            <img src="{{ asset('storage/img/ourteam/diskusi_team.webp') }}" alt="Team" class="team-image">
        </div>

        <div class="team-grid">

            @foreach ($team as $member)
                <div class="team-card">
                    <div class="team-card-content">
                        
                        <!-- Photo -->
                        <div class="team-photo-wrapper">
                            <div class="team-photo-border"></div>
                            <img src="{{ asset('storage/' . $member->photo) }}" 
                                 class="team-photo" 
                                 alt="{{ $member->name }}">
                        </div>

                        <!-- Name -->
                        <h3 class="team-name">{{ $member->name }}</h3>

                        <!-- Position -->
                        <span class="team-position">{{ $member->position }}</span>

                        <!-- Desc -->
                        <p class="team-desc">{{ $member->description }}</p>

                        <!-- SOCIALS -->
                        <div class="team-social">

                            @if ($member->socials && $member->socials->linkedin)
                                <a href="{{ $member->socials->linkedin }}" target="_blank" class="team-social-icon">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                            @endif

                            @if ($member->socials && $member->socials->instagram)
                                <a href="{{ $member->socials->instagram }}" target="_blank" class="team-social-icon">
                                    <i class="fab fa-instagram"></i>
                                </a>
                            @endif

                            @if ($member->socials && $member->socials->github)
                                <a href="{{ $member->socials->github }}" target="_blank" class="team-social-icon">
                                    <i class="fab fa-github"></i>
                                </a>
                            @endif

                            @if ($member->socials && $member->socials->youtube)
                                <a href="{{ $member->socials->youtube }}" target="_blank" class="team-social-icon">
                                    <i class="fab fa-youtube"></i>
                                </a>
                            @endif

                            @if ($member->socials && $member->socials->facebook)
                                <a href="{{ $member->socials->facebook }}" target="_blank" class="team-social-icon">
                                    <i class="fab fa-facebook"></i>
                                </a>
                            @endif

                        </div>

                    </div>
                </div>
            @endforeach

        </div>
    </div>
</section>


    <!-- PRODUCTION SECTION -->
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

</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Production Timeline
        const productionSteps = document.querySelectorAll('.production-step');
        const timelineLine = document.querySelector('.timeline-line');

        const observerOptions = {
            threshold: 0.3,
            rootMargin: '0px 0px -100px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('in-view');
                    
                    if (timelineLine) {
                        const stepIndex = Array.from(productionSteps).indexOf(entry.target);
                        const percentage = ((stepIndex + 1) / productionSteps.length) * 100;
                        timelineLine.style.height = percentage + '%';
                    }
                }
            });
        }, observerOptions);

        productionSteps.forEach(step => {
            observer.observe(step);
        });

        // Smooth reveal animations
        const revealObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, { threshold: 0.1 });

        document.querySelectorAll('.core-value-item, .team-card, .vm-card').forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(20px)';
            el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            revealObserver.observe(el);
        });
    });
</script>
@endsection