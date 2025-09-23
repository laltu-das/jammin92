@php
    // Professional device detection
    $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? '';
    $isIOS = stripos($userAgent, 'iPhone') !== false || stripos($userAgent, 'iPad') !== false;
    $isAndroid = stripos($userAgent, 'Android') !== false;
    $isMobile = $isIOS || $isAndroid;
    
    // Professional app store URLs
    $appStoreURL = $isIOS ? 'https://apps.apple.com/us/app/jammin-radio/id123456789' : 
                   ($isAndroid ? 'https://play.google.com/store/apps/details?id=com.jammin.radio' : '#');
    
    // Professional messaging
    $bannerTitle = 'Jammin Radio';
    $bannerSubtitle = $isMobile ? 'Listen anywhere, anytime' : 'Get the app for the best experience';
    $buttonText = $isIOS ? 'Download on the App Store' : 
                  ($isAndroid ? 'Get it on Google Play' : 'Download App');
    
    // Generate unique banner ID for this session
    $bannerId = 'app-banner-' . uniqid();
@endphp

@if(true)
    // Show on all devices for testing
    <!-- Professional App Download Banner -->
    <div id="{{ $bannerId }}" class="professional-app-banner" data-banner-id="{{ $bannerId }}">
        <div class="app-banner-container">
            <div class="app-banner-logo">
                <div class="app-logo-wrapper">
                    <i class="fas fa-broadcast-tower"></i>
                </div>
            </div>

            <div class="app-banner-content">
                <div class="app-banner-title">{{ $bannerTitle }}</div>
                <div class="app-banner-subtitle">{{ $bannerSubtitle }}</div>
            </div>

            <div class="app-banner-actions">
                <a href="{{ $appStoreURL }}" class="app-banner-cta" target="_blank" rel="noopener noreferrer">
                    <i class="fas fa-download"></i>
                    <span class="cta-text">{{ $buttonText }}</span>
                    <i class="fas fa-external-link-alt cta-icon"></i>
                </a>
                <button class="app-banner-dismiss" aria-label="Dismiss banner">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
    </div>

    @push('styles')
        <style>
            .professional-app-banner {
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                z-index: 10000;
                background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%) !important;
                border-bottom: 3px solid #667eea !important;
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15) !important;
                font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
                transform: translateY(0);
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                backdrop-filter: blur(10px);
                -webkit-backdrop-filter: blur(10px);
                opacity: 1 !important;
                display: block !important;
            }

            .professional-app-banner.hidden {
                transform: translateY(-100%);
                opacity: 0;
            }

            .app-banner-container {
                max-width: 1200px;
                margin: 0 auto;
                padding: 0 16px;
                display: flex;
                align-items: center;
                min-height: 64px;
                gap: 16px;
            }

            .app-banner-logo {
                flex-shrink: 0;
            }

            .app-logo-wrapper {
                width: 44px;
                height: 44px;
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                border-radius: 12px;
                display: flex;
                align-items: center;
                justify-content: center;
                box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
                transition: transform 0.2s ease;
            }

            .app-logo-wrapper:hover {
                transform: scale(1.05);
            }

            .app-logo-wrapper i {
                color: white;
                font-size: 22px;
                font-weight: 600;
            }

            .app-banner-content {
                flex: 1;
                min-width: 0;
            }

            .app-banner-title {
                font-size: 16px;
                font-weight: 600;
                color: #1a1a1a;
                margin-bottom: 2px;
                letter-spacing: -0.01em;
            }

            .app-banner-subtitle {
                font-size: 13px;
                color: #6b7280;
                font-weight: 400;
                line-height: 1.4;
            }

            .app-banner-actions {
                display: flex;
                align-items: center;
                gap: 8px;
                flex-shrink: 0;
            }

            .app-banner-cta {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
                color: white !important;
                border: none;
                padding: 12px 24px !important;
                border-radius: 25px;
                font-size: 16px !important;
                font-weight: 700 !important;
                text-decoration: none;
                display: inline-flex !important;
                align-items: center;
                gap: 8px;
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4) !important;
                white-space: nowrap;
                cursor: pointer;
                opacity: 1 !important;
                visibility: visible !important;
            }

            .app-banner-cta:hover {
                transform: translateY(-1px);
                box-shadow: 0 4px 16px rgba(102, 126, 234, 0.4);
                background: linear-gradient(135deg, #5a67d8 0%, #6b46c1 100%);
            }

            .app-banner-cta:active {
                transform: translateY(0);
            }

            .cta-text {
                font-weight: 500;
            }

            .cta-icon {
                font-size: 11px;
                opacity: 0.8;
            }

            .app-banner-dismiss {
                width: 32px;
                height: 32px;
                border-radius: 50%;
                border: none;
                background: rgba(0, 0, 0, 0.04);
                color: #6b7280;
                cursor: pointer;
                display: flex;
                align-items: center;
                justify-content: center;
                transition: all 0.2s ease;
                flex-shrink: 0;
            }

            .app-banner-dismiss:hover {
                background: rgba(0, 0, 0, 0.08);
                color: #374151;
                transform: scale(1.05);
            }

            .app-banner-dismiss:active {
                transform: scale(0.95);
            }

            /* Body padding adjustment */
            body.has-professional-app-banner {
                padding-top: 80px !important;
            }

            /* Debug styles - force visibility */
            .professional-app-banner {
                position: fixed !important;
                top: 0 !important;
                left: 0 !important;
                right: 0 !important;
                height: auto !important;
                min-height: 70px !important;
                z-index: 99999 !important;
                visibility: visible !important;
                opacity: 1 !important;
                display: flex !important;
                align-items: center !important;
                background: linear-gradient(135deg, #ff6b6b 0%, #ee5a24 100%) !important;
                border: 2px solid #000 !important;
            }

            /* Responsive design */
            @media (max-width: 640px) {
                .app-banner-container {
                    padding: 0 12px;
                    min-height: 60px;
                    gap: 12px;
                }

                .app-logo-wrapper {
                    width: 40px;
                    height: 40px;
                }

                .app-logo-wrapper i {
                    font-size: 20px;
                }

                .app-banner-title {
                    font-size: 15px;
                }

                .app-banner-subtitle {
                    font-size: 12px;
                }

                .app-banner-cta {
                    padding: 6px 12px;
                    font-size: 12px;
                }

                .app-banner-dismiss {
                    width: 28px;
                    height: 28px;
                }

                body.has-professional-app-banner {
                    padding-top: 60px;
                }
            }

            @media (max-width: 480px) {
                .app-banner-subtitle {
                    display: none;
                }

                .app-banner-cta .cta-icon {
                    display: none;
                }

                .app-banner-cta {
                    padding: 6px 10px;
                }
            }
        </style>
    @endpush

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const bannerId = '{{ $bannerId }}';
                const banner = document.getElementById(bannerId);

                if (!banner) return;

                const dismissBtn = banner.querySelector('.app-banner-dismiss');
                const ctaBtn = banner.querySelector('.app-banner-cta');

                // Always show banner for testing
                let shouldShow = true;

                if (shouldShow) {
                    // Force banner visibility
                    banner.style.display = 'flex';
                    banner.style.opacity = '1';
                    banner.style.visibility = 'visible';
                    document.body.classList.add('has-professional-app-banner');

                    // Debug: log banner visibility
                    console.log('App banner should be visible:', banner);
                    console.log('Banner styles:', window.getComputedStyle(banner));
                } else {
                    banner.style.display = 'none';
                    return;
                }

                // Dismiss functionality
                if (dismissBtn) {
                    dismissBtn.addEventListener('click', function () {
                        banner.classList.add('hidden');
                        document.body.classList.remove('has-professional-app-banner');

                        // Remember dismissal
                        localStorage.setItem(storageKey, now.toString());

                        // Remove from DOM after animation
                        setTimeout(() => {
                            if (banner.parentNode) {
                                banner.parentNode.removeChild(banner);
                            }
                        }, 300);
                    });
                }

                // CTA button analytics (optional)
                if (ctaBtn) {
                    ctaBtn.addEventListener('click', function () {
                        // Track CTA clicks (you can integrate with your analytics)
                        console.log('App banner CTA clicked');

                        // Optional: Mark as converted after successful download
                        // localStorage.setItem(`app-banner-converted-${bannerId}`, now.toString());
                    });
                }

                // Smart dismissal after scroll (optional enhancement)
                let scrollTimeout;
                window.addEventListener('scroll', function () {
                    clearTimeout(scrollTimeout);
                    scrollTimeout = setTimeout(function () {
                        const scrollPercent = (window.scrollY / (document.documentElement.scrollHeight - window.innerHeight)) * 100;
                        if (scrollPercent > 50) {
                            // Auto-dismiss after user scrolls 50% of the page
                            if (dismissBtn && banner.style.display !== 'none') {
                                dismissBtn.click();
                            }
                        }
                    }, 1000);
                });
            });
        </script>
    @endpush
@endif
