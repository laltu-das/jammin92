@extends('layouts.app')

@section('title', 'Home Page')

@push('styles')
<meta charset="UTF-8">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<style>
    /* Remove scrolling behavior from news section */
    .news-container {
        max-height: none !important;
        overflow: visible !important;
        overflow-y: visible !important;
        overflow-x: visible !important;
    }
    
    /* Ensure news items display properly without scroll */
    #news-container {
        max-height: none !important;
        overflow: visible !important;
    }
    
    /* Remove any scroll-related styling */
    .news-scroll-container {
        max-height: none !important;
        overflow: visible !important;
        overflow-y: visible !important;
    }
    
    /* Concert Card Styles */
    .concert-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border: none;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    
    .concert-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
    }
    
    .concert-card .card-img-top {
        border-bottom: 3px solid #0d6efd;
    }
    
    .concert-card .card-title {
        color: #2c3e50;
        font-weight: 600;
        font-size: 1.1rem;
        margin-bottom: 0.5rem;
    }
    
    .concert-card .card-text {
        color: #e74c3c;
        font-weight: 500;
        margin-bottom: 1rem;
    }
    
    .concert-card .btn-primary {
        background-color: #0d6efd;
        border-color: #0d6efd;
        border-radius: 8px;
        padding: 0.5rem 1rem;
        font-weight: 500;
        transition: all 0.3s ease;
    }
    
    .concert-card .btn-primary:hover {
        background-color: #0b5ed7;
        border-color: #0a58ca;
        transform: translateY(-2px);
    }
    
    .concert-card .text-muted {
        font-size: 0.875rem;
        line-height: 1.4;
    }
    
    .concert-card .text-muted i {
        width: 16px;
        margin-right: 6px;
        color: #6c757d;
    }
    
    /* Location Status Styles */
    .location-status .alert {
        border-radius: 12px;
        border: none;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
    
    /* Manual Search Styles */
    #homepage-manual-search {
        background-color: #f8f9fa;
        padding: 2rem;
        border-radius: 12px;
        border: 1px solid #e9ecef;
    }
    
    #homepage-manual-search .input-group {
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
    
    #homepage-manual-search .form-control {
        border: none;
        border-right: 1px solid #e9ecef;
    }
    
    #homepage-manual-search .form-control:focus {
        box-shadow: none;
    }
    
    #homepage-manual-search .btn-primary {
        border: none;
        border-radius: 0 8px 8px 0;
        padding: 0.5rem 1.5rem;
    }
    
    /* Location Search Button */
    .location-search-btn {
        border-radius: 0 8px 8px 0;
        padding: 0.5rem 1.5rem;
    }
    
    /* Trending Concert Card Styles */
    .trending-concert-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        position: relative;
    }
    
    .trending-concert-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
    }
    
    .trending-concert-card .card-img-top {
        border-bottom: 3px solid #0d6efd;
        height: 160px !important;
        object-fit: cover;
    }
    
    .trending-concert-card .card-body {
        padding: 1rem !important;
    }
    
    .trending-concert-card .card-title {
        font-size: 0.9rem;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 0.5rem !important;
        line-height: 1.3;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    .trending-concert-card .text-primary {
        font-size: 0.8rem;
        font-weight: 600;
    }
    
    .trending-concert-card .text-muted {
        font-size: 0.75rem;
        line-height: 1.4;
    }
    
    .trending-concert-card .btn-sm {
        font-size: 0.75rem;
        padding: 0.375rem 0.75rem;
    }
    
    .trending-concert-card .badge {
        font-size: 0.65rem;
        padding: 0.25rem 0.5rem;
    }
    
    /* Ads Carousel Styles */
    .ads-section {
        position: relative;
        overflow: hidden;
    }
    
    .carousel-item {
        transition: transform 0.6s ease-in-out, opacity 0.5s ease-in-out;
    }
    
    .carousel-item img {
        transition: transform 5s ease-in-out;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .carousel-inner {
        height: 400px; /* Fixed height for the carousel */
    }
    
    .carousel-item {
        height: 400px;
    }
    
    .carousel-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .carousel-inner {
        border-radius: 0.5rem;
        overflow: hidden;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
    }
    
    .carousel-indicators [data-bs-target] {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        margin: 0 5px;
        background-color: rgba(0, 0, 0, 0.5);
        border: none;
    }
    
    .carousel-indicators .active {
        background-color: #0d6efd;
    }
    
    .carousel-control-prev-icon,
    .carousel-control-next-icon {
        width: 2.5rem;
        height: 2.5rem;
        background-size: 1.5rem 1.5rem;
    }
    
    .player-song {
        font-size: 0.9rem;
        color: rgba(255, 255, 255, 0.9);
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        line-height: 1.2;
    }
    
    .player-song div {
        display: block;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    
    .floating-request-btn {
        position: fixed;
        bottom: 40px;
        right: 40px;
        z-index: 9999;
    }
    
    .request-btn {
        background: linear-gradient(135deg, #FF416C, #FF4B2B);
        border: none;
        border-radius: 50px;
        color: white;
        padding: 18px 30px;
        font-size: 18px;
        font-weight: 700;
        cursor: pointer;
        box-shadow: 0 6px 20px rgba(255, 65, 108, 0.5);
        display: flex;
        align-items: center;
</style>
@endpush

@section('content')
    <!-- Top Anchor for navigation -->
    <div id="top"></div>
    
    <!-- Enhanced Ads Carousel Section -->
    <section class="ads-section py-5" style="background-color: #f8f9fa;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-10">
                    <div id="adsCarousel" class="carousel slide carousel-fade shadow-lg" data-bs-ride="carousel" data-bs-interval="5000" style="border: 2px solid #0d6efd;">
                        <!-- Indicators -->
                        <div class="carousel-indicators">
                            @if($activeAds->isNotEmpty())
                                @foreach($activeAds as $index => $ad)
                                    <button type="button" data-bs-target="#adsCarousel" data-bs-slide-to="{{ $index }}" 
                                            class="{{ $index === 0 ? 'active' : '' }}" 
                                            aria-current="{{ $index === 0 ? 'true' : 'false' }}"
                                            aria-label="Slide {{ $index + 1 }}"></button>
                                @endforeach
                            @endif
                        </div>
                        
                        <!-- Controls -->
                        @if($activeAds->count() > 1)
                            <button class="carousel-control-prev" type="button" data-bs-target="#adsCarousel" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon bg-dark bg-opacity-50 rounded-pill p-3" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#adsCarousel" data-bs-slide="next">
                                <span class="carousel-control-next-icon bg-dark bg-opacity-50 rounded-pill p-3" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        @endif
                        
                        <!-- Carousel items -->
                        <div class="carousel-inner rounded-3 overflow-hidden">
                            @if($activeAds->isNotEmpty())
                                @foreach($activeAds as $index => $ad)
                                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}" data-bs-interval="5000">
                                        <div class="position-relative w-100" style="height: 400px; overflow: hidden;">
                                            @if($ad->image_url)
                                                <a href="{{ $ad->getLandingPageUrl() }}" class="d-block w-100 h-100">
                                                    <img src="{{ $ad->image_url }}" 
                                                         class="position-absolute w-100 h-100" 
                                                         style="object-fit: cover; top: 50%; left: 50%; transform: translate(-50%, -50%);"
                                                         alt="{{ $ad->title }}" 
                                                         onerror="console.error('Failed to load image:', this.src)">
                                                    
                                                    @if($ad->title)
                                                        <div class="position-absolute bottom-0 start-0 end-0 bg-dark bg-opacity-50 text-white p-3">
                                                            <h5 class="mb-0">{{ $ad->title }}</h5>
                                                        </div>
                                                    @endif
                                                </a>
                                            @endif
                                            
                                            <!-- Debug Overlay -->
                                            <div class="position-absolute top-0 start-0 bg-dark bg-opacity-75 text-white p-2" style="z-index: 10;">
                                                <small>Ad #{{ $index + 1 }}</small>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <!-- Fallback content if no ads are available -->
                                <div class="carousel-item active">
                                    <div class="text-center p-5 bg-light rounded d-flex flex-column justify-content-center" style="min-height: 200px;">
                                        <div class="mb-3">
                                            <i class="fas fa-ad fa-3x text-muted mb-2"></i>
                                            <h4 class="text-muted mb-2">Advertisement Space</h4>
                                            <p class="text-muted mb-0">No active advertisements at the moment</p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    
                    <style>
                    /* Ads Carousel Styles */
        .ads-section {
            position: relative;
            overflow: hidden;
        }
        
        .carousel-item {
            transition: transform 0.6s ease-in-out, opacity 0.5s ease-in-out;
        }
        
        .carousel-item img {
            transition: transform 5s ease-in-out;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .carousel-inner {
            height: 400px; /* Fixed height for the carousel */
        }
        
        .carousel-item {
            height: 400px;
        }
        
        .carousel-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .carousel-inner {
            border-radius: 0.5rem;
            overflow: hidden;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }
        
        .carousel-indicators [data-bs-target] {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            margin: 0 5px;
            background-color: rgba(0, 0, 0, 0.5);
            border: none;
        }
        
        .carousel-indicators .active {
            background-color: #0d6efd;
        }
        
        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            width: 2.5rem;
            height: 2.5rem;
            background-size: 1.5rem 1.5rem;
        }
        
        .promo-slider {
            background-color: #2c3e50;
            color: white;
            padding: 10px 0;
            overflow: hidden;
            position: relative;
        }
                    
                    .player-song {
            font-size: 0.9rem;
            color: rgba(255, 255, 255, 0.9);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            line-height: 1.2;
        }
        
        .player-song div {
            display: block;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
                    
                    .floating-request-btn {
                        position: fixed;
                        bottom: 40px;
                        right: 40px;
                        z-index: 9999;
                    }
                    
                    .request-btn {
                        background: linear-gradient(135deg, #FF416C, #FF4B2B);
                        border: none;
                        border-radius: 50px;
                        color: white;
                        padding: 18px 30px;
                        font-size: 18px;
                        font-weight: 700;
                        cursor: pointer;
                        box-shadow: 0 6px 20px rgba(255, 65, 108, 0.5);
                        display: flex;
                        align-items: center;
                        gap: 12px;
                        transition: all 0.3s ease;
                        animation: pulse 1.5s infinite;
                        text-transform: uppercase;
                        letter-spacing: 1px;
                        position: relative;
                        overflow: hidden;
                    }
                    
                    .request-btn:before {
                        content: '';
                        position: absolute;
                        top: 0;
                        left: -100%;
                        width: 100%;
                        height: 100%;
                        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
                        transition: 0.5s;
                    }
                    
                    .request-btn:hover:before {
                        left: 100%;
                    }
                    
                    .request-btn:hover {
                        transform: translateY(-3px);
                        box-shadow: 0 6px 20px rgba(255, 107, 107, 0.6);
                    }
                    
                    .request-btn i {
                        font-size: 20px;
                    }
                    
                    /* Modal Styles */
                    .modal-overlay {
                        display: none;
                        position: fixed;
                        top: 0;
                        left: 0;
                        right: 0;
                        bottom: 0;
                        background-color: rgba(0, 0, 0, 0.7);
                        backdrop-filter: blur(5px);
                        z-index: 1000;
                        justify-content: center;
                        align-items: center;
                        padding: 20px;
                    }
                    
                    .modal-overlay.show {
                        display: flex;
                        animation: fadeIn 0.3s;
                    }
                    
                    .modal-content {
                        background: white;
                        border-radius: 10px;
                        width: 90%;
                        max-width: 800px;
                        max-height: 90vh;
                        display: flex;
                        flex-direction: column;
                        overflow: hidden;
                        box-shadow: 0 5px 25px rgba(0,0,0,0.3);
                    }
                    
                    .modal-header {
                        background: linear-gradient(135deg, #FF416C, #FF4B2B);
                        color: white;
                        padding: 15px 20px;
                        display: flex;
                        justify-content: space-between;
                        align-items: center;
                    }
                    
                    .modal-header h4 {
                        margin: 0;
                        font-size: 1.2rem;
                    }
                    
                    .modal-header button {
                        background: rgba(255, 255, 255, 0.2);
                        border: none;
                        color: white;
                        width: 30px;
                        height: 30px;
                        border-radius: 50%;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        cursor: pointer;
                        font-size: 1.2rem;
                        line-height: 1;
                    }
                    
                    .modal-body {
                        flex: 1;
                        overflow: hidden;
                    }
                    
                    .request-iframe {
                        width: 100%;
                        height: 70vh;
                        min-height: 500px;
                        border: none;
                        background: white;
                    }
                    
                    .btn-request {
                        display: inline-block;
                        background: linear-gradient(135deg, #FF416C, #FF4B2B);
                        color: white;
                        padding: 10px 20px;
                        border-radius: 50px;
                        text-decoration: none;
                        font-weight: 500;
                        transition: all 0.3s ease;
                    }
                    
                    .btn-request:hover {
                        transform: translateY(-2px);
                        box-shadow: 0 4px 15px rgba(255, 107, 107, 0.4);
                        color: white;
                    }
                    
                    /* Close Modal Button Styling */
                    .close-modal {
                        position: absolute;
                        top: 15px;
                        right: 15px;
                        background: rgba(255, 255, 255, 0.9);
                        border: none;
                        color: #333;
                        width: 35px;
                        height: 35px;
                        border-radius: 50%;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        cursor: pointer;
                        font-size: 1.5rem;
                        line-height: 1;
                        z-index: 1001;
                        transition: all 0.3s ease;
                        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
                    }
                    
                    .close-modal:hover {
                        background: rgba(255, 255, 255, 1);
                        color: #FF416C;
                        transform: scale(1.1);
                        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
                    }
                    
                    .close-modal:focus {
                        outline: none;
                        box-shadow: 0 0 0 3px rgba(255, 65, 108, 0.3);
                    }
                    
                    @keyframes pulse {
                        0% {
                            transform: scale(1);
                            box-shadow: 0 0 0 0 rgba(255, 65, 108, 0.7);
                        }
                        70% {
                            transform: scale(1.05);
                            box-shadow: 0 0 0 15px rgba(255, 65, 108, 0);
                        }
                        100% {
                            transform: scale(1);
                            box-shadow: 0 0 0 0 rgba(255, 65, 108, 0);
                        }
                    }
                    </style>
                    
                    <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const requestBtn = document.getElementById('floatingRequestBtn');
                        const modal = document.getElementById('requestModal');
                        const closeModal = document.getElementById('closeModal');
                        
                        requestBtn.addEventListener('click', function(e) {
                            e.preventDefault();
                            modal.classList.add('show');
                            document.body.style.overflow = 'hidden'; // Prevent scrolling
                        });
                        
                        closeModal.addEventListener('click', function() {
                            modal.classList.remove('show');
                            document.body.style.overflow = ''; // Re-enable scrolling
                        });
                        
                        // Close when clicking outside the modal content
                        modal.addEventListener('click', function(e) {
                            if (e.target === modal) {
                                modal.classList.remove('show');
                                document.body.style.overflow = ''; // Re-enable scrolling
                            }
                        });
                        
                        // Close with Escape key
                        document.addEventListener('keydown', function(e) {
                            if (e.key === 'Escape' && modal.classList.contains('show')) {
                                modal.classList.remove('show');
                                document.body.style.overflow = ''; // Re-enable scrolling
                            }
                        });
                    });
                    </script>
                </div>
            </div>
        </div>
    </section>
    

    <!-- Floating Request Button -->
    <div class="floating-request-btn">
        <button class="request-btn" id="openRequestModal">
            <i class="fas fa-headphones"></i> Request a Song
        </button>
    </div>

    <!-- Request Modal -->
    <div class="modal-overlay" id="requestModal">
        <div class="modal-content">
            <button class="close-modal" id="closeRequestModal">&times;</button>
            <div class="modal-body">
                <iframe src="https://jammin92.com/website/request/request.php" 
                        class="request-iframe" 
                        allowfullscreen>
                </iframe>
            </div>
        </div>
    </div>

    <script>
        // Request Modal Functionality
        const openModalBtn = document.getElementById('openRequestModal');
        const closeModalBtn = document.getElementById('closeRequestModal');
        const modal = document.getElementById('requestModal');
        const iframe = document.querySelector('.request-iframe');
        let formSubmitted = false;

        openModalBtn.addEventListener('click', () => {
            modal.style.display = 'flex';
            document.body.style.overflow = 'hidden';
            formSubmitted = false; // Reset form submission flag
        });

        closeModalBtn.addEventListener('click', () => {
            modal.style.display = 'none';
            document.body.style.overflow = 'auto';
        });

        // Close modal when clicking outside the modal content
        window.addEventListener('click', (e) => {
            if (e.target === modal) {
                modal.style.display = 'none';
                document.body.style.overflow = 'auto';
            }
        });

        // Monitor iframe for form submission
        iframe.addEventListener('load', function() {
            // Check if the iframe URL has changed (indicates form submission)
            const currentUrl = iframe.contentWindow.location.href;
            
            // If the iframe URL contains success, thank you, or similar indicators
            if (currentUrl.includes('success') || 
                currentUrl.includes('thank') || 
                currentUrl.includes('submitted') ||
                currentUrl.includes('complete') ||
                iframe.contentDocument.body.innerText.toLowerCase().includes('thank') ||
                iframe.contentDocument.body.innerText.toLowerCase().includes('success') ||
                iframe.contentDocument.body.innerText.toLowerCase().includes('submitted')) {
                
                if (!formSubmitted) {
                    formSubmitted = true;
                    
                    // Show success message briefly
                    const modalBody = document.querySelector('.modal-body');
                    modalBody.innerHTML = '<div style="text-align: center; padding: 50px;">';
                    modalBody.innerHTML += '<div style="font-size: 48px; color: #28a745; margin-bottom: 20px;"><i class="fas fa-check-circle"></i></div>';
                    modalBody.innerHTML += '<h3 style="color: #28a745; margin-bottom: 15px;">Request Submitted Successfully!</h3>';
                    modalBody.innerHTML += '<p style="color: #666; margin-bottom: 30px;">Thank you for your song request. Redirecting to home page...</p>';
                    modalBody.innerHTML += '</div>';
                    
                    // Redirect to home page after 2 seconds
                    setTimeout(() => {
                        window.location.href = '/';
                    }, 2000);
                }
            }
        });

        // Monitor for form submission attempts
        iframe.addEventListener('load', function() {
            try {
                // Look for form submission indicators in the iframe content
                const iframeDoc = iframe.contentDocument || iframe.contentWindow.document;
                const forms = iframeDoc.querySelectorAll('form');
                const submitButtons = iframeDoc.querySelectorAll('input[type="submit"], button[type="submit"]');
                
                // Add submit event listeners to all forms in the iframe
                forms.forEach(form => {
                    form.addEventListener('submit', function(e) {
                        // Immediately redirect to homepage
                        window.location.href = '/';
                    });
                });
                
                // Add click event listeners to all submit buttons
                submitButtons.forEach(button => {
                    button.addEventListener('click', function(e) {
                        // Immediately redirect to homepage
                        window.location.href = '/';
                    });
                });
                
                // Also monitor for any button clicks that might submit the form
                const allButtons = iframeDoc.querySelectorAll('button');
                allButtons.forEach(button => {
                    const buttonText = button.textContent.toLowerCase();
                    if (buttonText.includes('submit') || buttonText.includes('send') || buttonText.includes('request')) {
                        button.addEventListener('click', function(e) {
                            // Immediately redirect to homepage
                            window.location.href = '/';
                        });
                    }
                });
                
            } catch (e) {
                // Cross-origin iframe access may be blocked
                console.log('Cannot access iframe content due to cross-origin restrictions');
                
                // Enhanced fallback: Monitor iframe reloads and URL changes
                let iframeLoadCount = 0;
                const originalSrc = iframe.src;
                
                // Monitor iframe reloads
                iframe.addEventListener('load', function() {
                    iframeLoadCount++;
                    if (iframeLoadCount > 1) {
                        // Iframe has reloaded (form submitted), redirect immediately
                        window.location.href = '/';
                    }
                });
                
                // Monitor iframe URL changes every 100ms
                setInterval(() => {
                    try {
                        const currentSrc = iframe.contentWindow.location.href;
                        if (currentSrc !== originalSrc && currentSrc !== 'about:blank') {
                            // URL changed, redirect immediately
                            window.location.href = '/';
                        }
                    } catch (e) {
                        // Cross-origin restriction, can't access URL
                        // Try alternative method: check if iframe has been reloaded
                        if (iframeLoadCount > 1) {
                            window.location.href = '/';
                        }
                    }
                }, 100);
            }
        });
    </script>

    <!-- Pop Culture News Section -->
    <section class="section" id="pop-culture-news">
        <x-pop-culture-news />
    </section>

    <!-- Concerts Section -->
    <section class="section section-bg" id="concerts">
        <div class="container">
            <div class="section-header">
                <h2 class="brand-font">Pop Concerts Near You</h2>
                <p class="lead">Discover amazing Pop concerts happening in your area, including shows by trending artists like Taylor Swift, Ed Sheeran, and more</p>
            </div>

            <!-- Location Search -->
            <div class="row mb-4">
                <div class="col-md-8 mx-auto">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0">
                            <i class="fas fa-map-marker-alt text-primary"></i>
                        </span>
                        <input type="text" 
                               class="form-control border-start-0" 
                               id="location-search-input" 
                               placeholder="Search concerts by city (e.g., New York, Los Angeles, Chicago)..."
                               autocomplete="off">
                        <button class="btn btn-outline-secondary" type="button" id="use-my-location-btn" title="Use my current location">
                            <i class="fas fa-crosshairs"></i>
                        </button>
                        <button class="btn btn-primary" type="button" id="location-search-btn">
                            <i class="fas fa-search me-2"></i>Search
                        </button>
                    </div>
                    <div class="form-text text-center mt-2">
                        <small>Enter any city name or click <i class="fas fa-crosshairs"></i> to use your current location</small>
                    </div>
                </div>
            </div>

            <!-- Concerts Container -->
            <div class="row g-4" id="homepage-concerts-container">
                <!-- Loading placeholder -->
                <div class="col-12 text-center" id="homepage-concerts-loading">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading concerts...</span>
                    </div>
                    <p class="mt-2">Loading Pop concerts...</p>
                </div>
                
                <!-- Concerts will be loaded here -->
                <div id="homepage-concerts-grid" class="row g-4" style="display: none;"></div>
                
                <!-- No concerts message -->
                <div class="col-12 text-center" id="homepage-no-concerts" style="display: none;">
                    <div class="alert alert-warning">
                        <i class="fas fa-music fa-2x mb-3 text-warning"></i>
                        <h4>No Pop Concerts Found</h4>
                        <p class="mb-0">No Pop concerts found at the moment. Please check back later!</p>
                    </div>
                </div>
                
                <!-- Error message -->
                <div class="col-12 text-center" id="homepage-concerts-error" style="display: none;">
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-triangle fa-2x mb-3 text-danger"></i>
                        <h4>Unable to Load Concerts</h4>
                        <p class="mb-0" id="homepage-error-message">Please try again later.</p>
                    </div>
                </div>
            </div>
            
            <!-- Trending Artists Subsection -->
            <div class="mt-5 pt-4 border-top border-light">
                <div class="section-header mb-4">
                    <h3 class="brand-font text-primary">🔥 Trending Artists</h3>
                    <p class="lead">Catch the biggest names in Pop music on tour</p>
                </div>
                
                <!-- Trending Artists Loading -->
                <div class="row g-4" id="trending-artists-loading" style="display: none;">
                    <div class="col-12 text-center">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading trending artists...</span>
                        </div>
                        <p class="mt-2">Loading trending artists...</p>
                    </div>
                </div>
                
                <!-- Trending Artists Grid -->
                <div class="row g-4" id="trending-artists-grid" style="display: none;"></div>
                
                <!-- No trending artists message -->
                <div class="col-12 text-center" id="trending-no-artists" style="display: none;">
                    <div class="alert alert-info">
                        <i class="fas fa-music fa-2x mb-3 text-info"></i>
                        <h4>No Trending Artists Found</h4>
                        <p class="mb-0">No trending Pop artists currently have scheduled concerts. Check back later for updates!</p>
                    </div>
                </div>
                
                <!-- Trending artists error message -->
                <div class="col-12 text-center" id="trending-artists-error" style="display: none;">
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-triangle fa-2x mb-3 text-danger"></i>
                        <h4>Unable to Load Trending Artists</h4>
                        <p class="mb-0">We're having trouble loading trending artists. Please try again later.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

<!-- Events Section -->
    <section class="section" id="events">
        <div class="container">
            <div class="section-header">
                <h2 class="brand-font">Community Events</h2>
                <p class="lead">Join us for these exciting events happening in your community</p>
            </div>
            
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-img">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="card-content">
                            <h3>Meet & Greet</h3>
                            <p>Meet your favorite radio hosts and win exclusive merchandise at our monthly event.</p>
                            <a href="#" class="btn">Learn More</a>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-img">
                            <i class="fas fa-broadcast-tower"></i>
                        </div>
                        <div class="card-content">
                            <h3>Studio Tour</h3>
                            <p>Get a behind-the-scenes look at our broadcasting facilities and see how radio magic happens.</p>
                            <a href="#" class="btn">Learn More</a>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-img">
                            <i class="fas fa-calendar-check"></i>
                        </div>
                        <div class="card-content">
                            <h3>Charity Event</h3>
                            <p>Join us for our annual charity event supporting music education in local schools.</p>
                            <a href="#" class="btn">Learn More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="section section-bg" id="contact">
        <div class="container">
            <div class="section-header">
                <h2 class="brand-font">Contact Us</h2>
                <p class="lead">We'd love to hear from you! Send us a message and we'll get back to you soon.</p>
            </div>
            
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="contact-form">
                        <div class="mb-3">
                            <label for="name" class="form-label">Your Name</label>
                            <input type="text" class="form-control" id="name" placeholder="Enter your name">
                        </div>
                        
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="email" placeholder="Enter your email">
                        </div>
                        
                        <div class="mb-3">
                            <label for="subject" class="form-label">Subject</label>
                            <input type="text" class="form-control" id="subject" placeholder="Enter subject">
                        </div>
                        
                        <div class="mb-3">
                            <label for="message" class="form-label">Message</label>
                            <textarea class="form-control" id="message" rows="5" placeholder="Enter your message"></textarea>
                        </div>
                        
                        <button type="submit" class="btn w-100">
                            <i class="fas fa-paper-plane me-2"></i> Send Message
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('scripts')
<script>
console.log('Script started');

// Load homepage concerts
function loadHomepageConcerts() {
    console.log('Loading homepage concerts...');
    
    // Main concerts elements
    const mainLoading = document.getElementById('homepage-concerts-loading');
    const mainGrid = document.getElementById('homepage-concerts-grid');
    const mainNoConcerts = document.getElementById('homepage-no-concerts');
    const mainError = document.getElementById('homepage-concerts-error');
    
    // Trending artists elements
    const trendingLoading = document.getElementById('trending-artists-loading');
    const trendingGrid = document.getElementById('trending-artists-grid');
    const trendingNoArtists = document.getElementById('trending-no-artists');
    const trendingError = document.getElementById('trending-artists-error');
    
    // Show loading states
    if (mainLoading) mainLoading.style.display = 'block';
    if (mainGrid) mainGrid.style.display = 'none';
    if (mainNoConcerts) mainNoConcerts.style.display = 'none';
    if (mainError) mainError.style.display = 'none';
    
    if (trendingLoading) trendingLoading.style.display = 'block';
    if (trendingGrid) trendingGrid.style.display = 'none';
    if (trendingNoArtists) trendingNoArtists.style.display = 'none';
    if (trendingError) trendingError.style.display = 'none';
    
    // Fetch both regular concerts and trending artists concerts
    Promise.all([
        fetch('/api/concerts/homepage'),
        fetch('/api/concerts/trending')
    ])
    .then(responses => Promise.all(responses.map(response => response.json())))
    .then(data => {
        console.log('Combined concerts response:', data);
        
        // Hide loading states
        if (mainLoading) mainLoading.style.display = 'none';
        if (trendingLoading) trendingLoading.style.display = 'none';
        
        const homepageData = data[0];
        const trendingData = data[1];
        
        // Handle main concerts (location-based only, no trending artists)
        if (homepageData.success && homepageData.concerts && homepageData.concerts.length > 0) {
            // Filter out trending artists from main concerts
            const trendingArtists = [
                'Taylor Swift', 'Ed Sheeran', 'Harry Styles', 'Olivia Rodrigo', 
                'The Weeknd', 'Billie Eilish', 'Dua Lipa', 'Bruno Mars', 
                'Ariana Grande', 'Justin Bieber'
            ];
            
            const regularConcerts = homepageData.concerts.filter(concert => {
                const artistName = concert.artist || concert.name;
                return !trendingArtists.some(artist => 
                    artistName.toLowerCase().includes(artist.toLowerCase())
                );
            });
            
            displayConcerts(regularConcerts);
        } else {
            if (mainNoConcerts) mainNoConcerts.style.display = 'block';
        }
        
        // Handle trending artists separately
        if (trendingData.success && trendingData.concerts && Object.keys(trendingData.concerts).length > 0) {
            displayTrendingArtists(trendingData.concerts);
        } else {
            if (trendingNoArtists) trendingNoArtists.style.display = 'block';
        }
    })
    .catch(err => {
        console.error('Error:', err);
        
        // Hide loading states
        if (mainLoading) mainLoading.style.display = 'none';
        if (trendingLoading) trendingLoading.style.display = 'none';
        
        // Show error states
        if (mainError) mainError.style.display = 'block';
        if (trendingError) trendingError.style.display = 'block';
    });
}

function displayConcerts(concerts) {
    console.log('Displaying concerts:', concerts.length);
    
    const grid = document.getElementById('homepage-concerts-grid');
    const noConcerts = document.getElementById('homepage-no-concerts');
    
    if (!grid) return;
    
    let html = '';
    concerts.forEach(concert => {
        html += '<div class="col-md-6 col-lg-4">';
        html += '<div class="card h-100">';
        html += '<img src="' + (concert.image || 'https://via.placeholder.com/300x200') + '" class="card-img-top" alt="' + concert.name + '" style="height: 200px; object-fit: cover;">';
        html += '<div class="card-body">';
        html += '<h5 class="card-title">' + concert.name + '</h5>';
        html += '<p class="card-text"><strong>' + (concert.artist || concert.name) + '</strong></p>';
        html += '<p class="card-text">';
        html += '<i class="fas fa-calendar"></i> ' + (concert.date || 'Date TBD') + '<br>';
        html += '<i class="fas fa-map-marker-alt"></i> ' + (concert.venue?.name || 'Venue') + ', ' + (concert.venue?.city || 'City');
        html += '</p>';
        html += '<a href="' + (concert.url || '#') + '" target="_blank" class="btn btn-primary w-100">Get Tickets</a>';
        html += '</div>';
        html += '</div>';
        html += '</div>';
    });
    
    grid.innerHTML = html;
    grid.style.display = 'flex';
    
    if (noConcerts) noConcerts.style.display = 'none';
}

function displayTrendingArtists(concertsByArtist) {
    console.log('Displaying trending artists:', Object.keys(concertsByArtist));
    
    const grid = document.getElementById('trending-artists-grid');
    const noArtists = document.getElementById('trending-no-artists');
    
    if (!grid) return;
    
    // Flatten all concerts from all artists
    let allConcerts = [];
    Object.values(concertsByArtist).forEach(artistConcerts => {
        allConcerts = allConcerts.concat(artistConcerts);
    });
    
    // Sort concerts by date
    allConcerts.sort((a, b) => {
        const dateA = new Date(a.date + ' ' + (a.time || '00:00'));
        const dateB = new Date(b.date + ' ' + (b.time || '00:00'));
        return dateA - dateB;
    });
    
    // Limit to 12 concerts for compact display
    const limitedConcerts = allConcerts.slice(0, 12);
    
    let html = '';
    limitedConcerts.forEach(concert => {
        html += '<div class="col-md-6 col-lg-3">';
        html += '<div class="card h-100 border-0 shadow-sm trending-concert-card">';
        
        // Add trending badge
        html += '<div class="position-absolute top-0 end-0 m-2 z-1">';
        html += '<span class="badge bg-primary">Trending</span>';
        html += '</div>';
        
        html += '<img src="' + (concert.image || 'https://via.placeholder.com/300x200') + '" class="card-img-top" alt="' + concert.name + '" style="height: 160px; object-fit: cover;">';
        html += '<div class="card-body p-3">';
        html += '<h6 class="card-title mb-2 fw-bold">' + concert.name + '</h6>';
        html += '<p class="card-text small text-primary mb-2"><strong>' + (concert.artist || concert.name) + '</strong></p>';
        html += '<p class="card-text small text-muted mb-3">';
        html += '<i class="fas fa-calendar me-1"></i> ' + (concert.date || 'Date TBD') + '<br>';
        html += '<i class="fas fa-map-marker-alt me-1"></i> ' + (concert.venue?.name || 'Venue') + ', ' + (concert.venue?.city || 'City');
        html += '</p>';
        html += '<a href="' + concert.url + '" target="_blank" class="btn btn-sm btn-primary w-100">Get Tickets</a>';
        html += '</div>';
        html += '</div>';
        html += '</div>';
    });
    
    grid.innerHTML = html;
    grid.style.display = 'flex';
    
    if (noArtists) noArtists.style.display = 'none';
}

document.addEventListener('DOMContentLoaded', function() {
    console.log('Page loaded, starting concert loader');
    
    // Load concerts after a short delay
    setTimeout(loadHomepageConcerts, 1000);
    
    // Location search functionality
    const locationSearchInput = document.getElementById('location-search-input');
    const locationSearchBtn = document.getElementById('location-search-btn');
    const useMyLocationBtn = document.getElementById('use-my-location-btn');
    
    if (locationSearchInput && locationSearchBtn) {
        // Search on button click
        locationSearchBtn.addEventListener('click', function() {
            performLocationSearch();
        });
        
        // Search on Enter key press
        locationSearchInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                performLocationSearch();
            }
        });
    }
    
    // Use My Location button functionality
    if (useMyLocationBtn) {
        useMyLocationBtn.addEventListener('click', function() {
            getUserLocation();
        });
    }
    
    function getUserLocation() {
        if (!navigator.geolocation) {
            alert('Geolocation is not supported by this browser. Please enter a city name manually.');
            return;
        }
        
        // Show loading state on the button
        const originalHtml = useMyLocationBtn.innerHTML;
        useMyLocationBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
        useMyLocationBtn.disabled = true;
        
        navigator.geolocation.getCurrentPosition(
            // Success callback
            function(position) {
                const latitude = position.coords.latitude;
                const longitude = position.coords.longitude;
                
                console.log('Got user location:', latitude, longitude);
                
                // Reverse geocode to get city name
                reverseGeocode(latitude, longitude)
                    .then(cityName => {
                        if (cityName) {
                            locationSearchInput.value = cityName;
                            // Automatically trigger search
                            performLocationSearch();
                        } else {
                            alert('Unable to determine your city name. Please enter it manually.');
                        }
                    })
                    .catch(error => {
                        console.error('Reverse geocoding error:', error);
                        alert('Unable to determine your location. Please enter a city name manually.');
                    })
                    .finally(() => {
                        // Restore button state
                        useMyLocationBtn.innerHTML = originalHtml;
                        useMyLocationBtn.disabled = false;
                    });
            },
            // Error callback
            function(error) {
                console.error('Geolocation error:', error);
                let errorMessage = 'Unable to get your location. ';
                
                switch(error.code) {
                    case error.PERMISSION_DENIED:
                        errorMessage += 'Please allow location access and try again.';
                        break;
                    case error.POSITION_UNAVAILABLE:
                        errorMessage += 'Location information is unavailable.';
                        break;
                    case error.TIMEOUT:
                        errorMessage += 'Location request timed out.';
                        break;
                    default:
                        errorMessage += 'Please enter a city name manually.';
                        break;
                }
                
                alert(errorMessage);
                
                // Restore button state
                useMyLocationBtn.innerHTML = originalHtml;
                useMyLocationBtn.disabled = false;
                
                // Fallback to IP-based location
                getIPLocation();
            },
            // Options
            {
                enableHighAccuracy: true,
                timeout: 10000,
                maximumAge: 300000 // 5 minutes
            }
        );
    }
    
    function reverseGeocode(latitude, longitude) {
        return new Promise((resolve, reject) => {
            const url = `https://nominatim.openstreetmap.org/reverse?format=json&lat=${latitude}&lon=${longitude}&zoom=10`;
            
            fetch(url, {
                headers: {
                    'User-Agent': 'Jammin Concert App/1.0'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data && data.address) {
                    // Try to get city name from different possible fields
                    const city = data.address.city || 
                                data.address.town || 
                                data.address.village || 
                                data.address.municipality ||
                                data.address.county ||
                                data.address.state;
                    
                    if (city) {
                        resolve(city);
                    } else {
                        reject(new Error('No city found in reverse geocoding response'));
                    }
                } else {
                    reject(new Error('Invalid reverse geocoding response'));
                }
            })
            .catch(error => {
                reject(error);
            });
        });
    }
    
    function getIPLocation() {
        // Try IP-based location as fallback
        fetch('/debug/location')
            .then(response => response.json())
            .then(data => {
                if (data.ip_location && data.ip_location.city) {
                    locationSearchInput.value = data.ip_location.city;
                    // Automatically trigger search
                    performLocationSearch();
                }
            })
            .catch(error => {
                console.error('IP location fallback failed:', error);
            });
    }
    
    function performLocationSearch() {
        const location = locationSearchInput.value.trim();
        
        if (!location) {
            alert('Please enter a city name');
            return;
        }
        
        console.log('Searching concerts for location:', location);
        
        // Show loading state
        const loading = document.getElementById('homepage-concerts-loading');
        const grid = document.getElementById('homepage-concerts-grid');
        const error = document.getElementById('homepage-concerts-error');
        const noConcerts = document.getElementById('homepage-no-concerts');
        
        if (loading) loading.style.display = 'block';
        if (grid) grid.style.display = 'none';
        if (error) error.style.display = 'none';
        if (noConcerts) noConcerts.style.display = 'none';
        
        // Update loading text
        if (loading) {
            const loadingText = loading.querySelector('p');
            if (loadingText) {
                loadingText.textContent = `Searching Pop concerts in ${location}...`;
            }
        }
        
        // Fetch concerts for the location
        fetch(`/api/concerts/location?location=${encodeURIComponent(location)}`)
            .then(response => response.json())
            .then(data => {
                console.log('Location search response:', data);
                
                if (loading) loading.style.display = 'none';
                
                if (data.success && data.concerts && data.concerts.length > 0) {
                    displayConcerts(data.concerts);
                    // Update section title to show location
                    const sectionTitle = document.querySelector('#concerts .section-header h2');
                    if (sectionTitle) {
                        sectionTitle.textContent = `Pop Concerts in ${data.location}`;
                    }
                } else {
                    // Show no concerts message with location context
                    if (noConcerts) {
                        const noConcertsTitle = noConcerts.querySelector('h4');
                        const noConcertsText = noConcerts.querySelector('p');
                        if (noConcertsTitle) {
                            noConcertsTitle.textContent = `No Pop Concerts Found in ${location}`;
                        }
                        if (noConcertsText) {
                            noConcertsText.textContent = `No Pop concerts found in ${location}. Try a different city or check back later!`;
                        }
                        noConcerts.style.display = 'block';
                    }
                }
            })
            .catch(err => {
                console.error('Location search error:', err);
                if (loading) loading.style.display = 'none';
                if (error) {
                    const errorTitle = error.querySelector('h4');
                    const errorText = error.querySelector('p');
                    if (errorTitle) {
                        errorTitle.textContent = 'Search Error';
                    }
                    if (errorText) {
                        errorText.textContent = `Unable to search concerts in ${location}. Please try again later.`;
                    }
                    error.style.display = 'block';
                }
            });
    }
    
    // Load homepage concerts when page is ready
    document.addEventListener('DOMContentLoaded', function() {
        // Load homepage concerts after a short delay
        setTimeout(loadHomepageConcerts, 1000);
    });
});

</script>

<!-- Contest Modal Component -->
<x-contest-modal />
@endpush
