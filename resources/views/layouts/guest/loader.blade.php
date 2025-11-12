{{-- Page Loader - Minimalist with Curtain Effect --}}
<div class="page-loader">
    <div class="loader-content">
        {{-- Logo with Breathing Animation --}}
        <img src="{{ asset($company->logo ?? 'assets/img/logo.png') }}" 
             alt="Loading" 
             class="loader-logo"
             onerror="this.src='{{ asset('assets/img/logo.png') }}'">
        
        {{-- Loading Text with Animated Dots --}}
        <p class="loader-text">LOADING</p>
        
        {{-- Minimal Progress Line --}}
        <div class="loader-line"></div>
    </div>
</div>

{{-- Page Transition Overlay --}}
<div class="page-transition-overlay"></div>

<style>
    /* Ensure loader is on top */
    .page-loader {
        position: fixed !important;
        z-index: 99999 !important;
    }
    
    /* Prevent scrolling during load */
    body.loading {
        overflow: hidden !important;
    }
</style>