@php
    // Debug: Check if component is being loaded
    error_log('Contest Modal Component is being loaded');
    
    // Get the active contest data
    try {
        $contest = \App\Models\Contest::where('is_active', 1)
            ->where('start_date', '<=', now())
            ->where('end_date', '>=', now())
            ->with(['images' => function($query) {
                $query->orderBy('display_order', 'asc');
            }])
            ->first();
            
        $hasImages = $contest && $contest->images->isNotEmpty();
        
        if ($contest) {
            $contest->images->each(function($image) {
                $image->url = asset('storage/' . ltrim($image->image_path, '/'));
                $image->storage_path = storage_path('app/public/' . ltrim($image->image_path, '/'));
                $image->exists = file_exists($image->storage_path);
            });
        }
    } catch (\Exception $e) {
        $contest = null;
        $hasImages = false;
    }
@endphp

        <!-- Contest Modal - DEBUG: This should be visible if component loads -->
<div class="modal fade" id="contestModal" tabindex="-1" aria-labelledby="contestModalLabel" aria-hidden="true">
    <!-- Debug comment: Contest modal HTML is being rendered -->
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content contest-modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title" id="contestModalLabel">
                    <i class="fas fa-trophy me-2"></i>
                    {{ $contest->title ?? 'Contest' }}
                </h5>
                <button type="button" class="btn-close btn-close-white contest-modal-close" data-bs-dismiss="modal"
                        aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                @if($contest)
                    <!-- Contest Header -->
                    <div class="text-center mb-4">
                        <p class="lead">{{ $contest->description }}</p>

                        @if($contest->start_date && $contest->end_date)
                            <div class="contest-dates">
                                <span class="badge bg-primary p-2">
                                    <i class="fas fa-calendar-alt me-2"></i>
                                    {{ $contest->start_date->format('M d, Y') }} - {{ $contest->end_date->format('M d, Y') }}
                                </span>
                            </div>
                        @endif
                    </div>

                    <!-- Contest Images Gallery -->
                    @if($hasImages)
                        <div class="contest-gallery mb-4">
                            <div class="row g-3">
                                @foreach($contest->images as $image)
                                    <div class="col-md-6">
                                        <div class="card h-100 shadow-sm">
                                            @if($image->exists)
                                                <img src="{{ $image->url }}"
                                                     class="card-img-top"
                                                     alt="{{ $image->title ?? 'Contest Image' }}"
                                                     style="height: 150px; object-fit: cover;">
                                            @else
                                                <div class="bg-light d-flex align-items-center justify-content-center"
                                                     style="height: 150px;">
                                                    <div class="text-center p-3">
                                                        <i class="fas fa-image fa-2x text-muted mb-2"></i>
                                                        <p class="mb-0 text-muted small">Image not found</p>
                                                    </div>
                                                </div>
                                            @endif

                                            @if($image->title || $image->description)
                                                <div class="card-body">
                                                    @if($image->title)
                                                        <h6 class="card-title">{{ $image->title }}</h6>
                                                    @endif
                                                    @if($image->description)
                                                        <p class="card-text text-muted small">{{ $image->description }}</p>
                                                    @endif
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Contest Details -->
                    <div class="card shadow-sm">
                        <div class="card-body p-3">
                            <h6 class="mb-3">Contest Details</h6>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-2">
                                        <small class="text-muted d-block">Status</small>
                                        @if($contest->is_active && $contest->start_date <= now() && $contest->end_date >= now())
                                            <span class="badge bg-success p-1">Active</span>
                                        @elseif($contest->start_date > now())
                                            <span class="badge bg-info p-1">Upcoming</span>
                                        @else
                                            <span class="badge bg-secondary p-1">Ended</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-2">
                                        <small class="text-muted d-block">Duration</small>
                                        <p class="mb-0 small">
                                            {{ $contest->start_date->format('M j, Y') }} -
                                            {{ $contest->end_date->format('M j, Y') }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            @if($contest->rules)
                                <div class="mt-3">
                                    <small class="text-muted d-block">Contest Rules</small>
                                    <div class="bg-light p-2 rounded">
                                        {!! nl2br(e($contest->rules)) !!}
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @else
                    <!-- No Active Contest -->
                    <div class="text-center py-4">
                        <i class="fas fa-trophy fa-3x text-muted mb-3"></i>
                        <h5 class="mb-3">No Active Contest</h5>
                        <p class="text-muted">There are no active contests at the moment. Please check back later for
                            upcoming contests and exciting opportunities to win VIP tickets!</p>
                    </div>
                @endif
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-2"></i>Close
                </button>
                @if($contest)
                    <a href="{{ route('contest') }}" class="btn btn-primary">
                        <i class="fas fa-external-link-alt me-2"></i>View Full Page
                    </a>
                @endif
            </div>
        </div>
    </div>
</div>

@push('styles')
    <style>
        .contest-modal-content {
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 50%, var(--accent-blue) 100%);
            backdrop-filter: blur(10px);
            border: 1px solid var(--accent-blue);
            border-radius: 15px;
            box-shadow: 0 20px 60px rgba(44, 62, 80, 0.4);
            color: var(--warm-white);
        }

        .contest-gallery .card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: 1px solid var(--accent-blue);
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(5px);
        }

        .contest-gallery .card:hover {
            transform: translateY(-3px);
            box-shadow: 0 0.5rem 1rem rgba(52, 152, 219, 0.3) !important;
            background: rgba(255, 255, 255, 0.15);
        }

        .contest-dates .badge {
            font-size: 0.9rem;
            border-radius: 50px;
            padding: 0.4rem 1rem;
            background: var(--accent-blue) !important;
            color: var(--warm-white) !important;
            border: 1px solid var(--primary-blue);
        }

        .modal-backdrop.show {
            backdrop-filter: blur(5px);
            background-color: rgba(44, 62, 80, 0.8);
        }

        /* Blur background when modal is open */
        body.modal-open .container,
        body.modal-open main,
        body.modal-open header,
        body.modal-open .promo-slider,
        body.modal-open .sticky-player {
            filter: blur(3px);
            transition: filter 0.3s ease;
        }

        /* Ensure modal content is not blurred */
        body.modal-open .modal,
        body.modal-open .modal-backdrop {
            filter: none !important;
        }

        /* Smooth transitions */
        .modal.fade .modal-dialog {
            transition: transform 0.3s ease-out, opacity 0.3s ease-out;
        }

        .modal-content {
            transition: all 0.3s ease;
        }

        /* Enhanced Close Button */
        .contest-modal-close {
            position: absolute;
            top: 15px;
            right: 15px;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: var(--warm-white);
            border: 2px solid var(--accent-blue);
            color: var(--accent-blue);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            z-index: 1050;
            opacity: 1;
            box-shadow: 0 2px 8px rgba(52, 152, 219, 0.3);
        }

        .contest-modal-close:hover {
            background: var(--accent-blue);
            color: var(--warm-white);
            transform: scale(1.1);
            box-shadow: 0 4px 12px rgba(52, 152, 219, 0.5);
        }

        .contest-modal-close:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.3);
        }

        /* Position modal header to accommodate absolute positioned close button */
        .contest-modal-content .modal-header {
            position: relative;
            padding-right: 60px; /* Make space for close button */
        }

        /* Contest Details Card Styling */
        .contest-modal-content .card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(5px);
            border: 1px solid var(--accent-blue);
            color: var(--warm-white);
        }

        .contest-modal-content .card .card-body {
            background: transparent;
        }

        .contest-modal-content .card .card-body h6 {
            color: var(--accent-blue);
            font-weight: 600;
        }

        .contest-modal-content .card .card-body small {
            color: rgba(255, 255, 255, 0.7);
        }

        .contest-modal-content .card .card-body .bg-light {
            background: rgba(255, 255, 255, 0.1) !important;
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: var(--warm-white);
        }

        .contest-modal-content .modal-title {
            color: var(--accent-blue);
            font-weight: 700;
        }

        .contest-modal-content .lead {
            color: var(--warm-white);
            font-weight: 500;
        }

        .contest-modal-content .text-muted {
            color: rgba(255, 255, 255, 0.7) !important;
        }

        .contest-modal-content .btn-primary {
            background: var(--accent-blue);
            border-color: var(--primary-blue);
            color: var(--warm-white);
            font-weight: 600;
        }

        .contest-modal-content .btn-primary:hover {
            background: var(--primary-blue);
            border-color: var(--accent-blue);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(52, 152, 219, 0.4);
        }

        .contest-modal-content .btn-secondary {
            background: transparent;
            border-color: var(--accent-blue);
            color: var(--warm-white);
            font-weight: 600;
        }

        .contest-modal-content .btn-secondary:hover {
            background: var(--accent-blue);
            border-color: var(--accent-blue);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(52, 152, 219, 0.4);
        }
    </style>
@endpush
