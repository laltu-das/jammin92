<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="UTF-8">
    <title>@yield('title', 'Radio Station | Listen Live')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @php
        header('Content-Type: text/html; charset=utf-8');
    @endphp

            <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Righteous&display=swap"
          rel="stylesheet">

    <!-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> -->
    <style>
        :root {
            /* Professional & Subtle Color Palette */
            --primary-blue: #2c3e50; /* Sophisticated slate blue */
            --secondary-blue: #34495e; /* Muted blue-gray */
            --accent-blue: #3498db; /* Subtle professional blue */
            --accent-orange: #e67e22; /* Muted orange - professional warmth */
            --accent-orange-light: #f39c12; /* Subtle golden orange */
            --accent-teal: #16a085; /* Professional teal */
            --accent-teal-light: #1abc9c; /* Soft mint teal */
            --warm-white: #fdfdfd; /* Ultra-soft white */
            --light-gray: #f8f9fa; /* Very light background */
            --soft-yellow: #fffef7; /* Very soft yellow */
            --light-yellow: #fefcf0; /* Light yellow for gradient */
            --medium-gray: #6c757d; /* Professional gray text */
            --dark-gray: #2c3e50; /* Consistent with primary */
            --text-color: #495057; /* Subtle dark text */
            --border-color: #e9ecef; /* Soft borders */
            --success-green: #27ae60; /* Professional green */
            --player-height: 80px;
        }

        body {
            font-family: 'Poppins', sans-serif;
            color: var(--text-color);
            background: linear-gradient(135deg, #FFD700 0%, #FFD700 40%, #1E3C72 60%, #1E3C72 100%);
            background-attachment: fixed;
            overflow-x: hidden;
            padding-bottom: var(--player-height);
            margin: 0;
            line-height: 1.6;
            min-height: 100vh;
            /* Smooth scrolling */
            scroll-behavior: smooth;
        }

        .brand-font {
            font-family: 'Righteous', cursive;
        }

        .frosted-glass {
            background-color: rgba(255, 255, 255, 0.15); /* Slightly transparent white */
            backdrop-filter: blur(10px); /* The main blur effect */
            border: 1px solid rgba(255, 255, 255, 0.2); /* Subtle border to enhance the effect */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        /* Promo Slider */
        .promo-slider {
            height: 60px;
            overflow: hidden;
            background: linear-gradient(135deg, var(--primary-blue), var(--secondary-blue));
            position: relative;
        }

        .slide-container {
            position: absolute;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: transform 0.8s ease;
            color: var(--accent-blue);
            font-weight: 600;
            font-size: 1.2rem;
            text-align: center;
            padding: 0 20px;
        }

        .slide-container a {
            color: var(--accent-blue);
            text-decoration: none;
            border-bottom: 1px dashed var(--accent-blue);
            transition: all 0.3s ease;
        }

        .slide-container a:hover {
            color: var(--warm-white);
            border-bottom: 1px solid var(--warm-white);
        }

        .slide-indicators {
            position: absolute;
            bottom: 10px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 8px;
        }

        .indicator {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background-color: rgba(255, 255, 255, 0.4);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .indicator.active {
            background-color: var(--accent-blue);
            transform: scale(1.1);
        }

        /* Header Styles */
        .navbar {
            padding: 15px 0;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
        }

        .navbar-brand .logo-icon {
            width: 50px;
            height: 50px;
            background: var(--primary-blue);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--warm-white);
            font-size: 24px;
            font-weight: bold;
        }

        .navbar-brand .logo-text {
            font-size: 28px;
            font-weight: 800;
            color: var(--primary-blue);
            margin-left: 10px;
        }

        .nav-link {
            font-weight: 600;
            font-size: 18px;
            color: var(--dark-gray);
            transition: all 0.3s ease;
            position: relative;
            margin: 0 10px;
        }

        .nav-link:hover {
            color: var(--primary-blue);
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 3px;
            background-color: var(--accent-blue);
            transition: all 0.3s ease;
        }

        .nav-link:hover::after {
            width: 100%;
        }

        /* Listen Live Button */
        .listen-live-btn {
            background: linear-gradient(90deg, #FFD700 0%, #FFA500 100%);
            color: #1E3C72;
            font-weight: 600;
            border: 2px solid #1E3C72;
            border: none;
            padding: 8px 20px;
            border-radius: 30px;
            font-weight: 700;
            font-size: 1rem;
            display: flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 4px 15px rgba(0, 51, 255, 0.3);
            transition: all 0.3s ease;
            animation: pulse 2s infinite;
        }

        .listen-live-btn:hover {
            transform: translateY(-3px) scale(1.03);
            box-shadow: 0 8px 25px rgba(30, 60, 114, 0.4);
            background: linear-gradient(90deg, #FFD700 0%, #FF8C00 100%);
            color: #1E3C72;
        }

        /* Download App Button */
        .download-app-btn {
            background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
            color: white;
            font-weight: 600;
            border: none;
            padding: 8px 20px;
            border-radius: 30px;
            font-weight: 700;
            font-size: 1rem;
            display: flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
            transition: all 0.3s ease;
        }

        .download-app-btn:hover {
            transform: translateY(-3px) scale(1.03);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.6);
            background: linear-gradient(90deg, #5a67d8 0%, #6b46c1 100%);
            color: white;
            text-decoration: none;
        }

        /* Hero Section */
        .hero {
            position: relative;
            padding: 100px 0;
            color: var(--warm-white);
            overflow: hidden;
            background: linear-gradient(135deg, rgba(44, 62, 80, 0.90) 0%, rgba(60, 8, 230, 0.63) 100%),
            url('https://images.unsplash.com/photo-1507838153414-b4b713384a76?ixlib=rb-4.0.3&auto=format&fit=crop&w=1950&q=80') no-repeat center center / cover;
        }

        .hero::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="%23ffffff" fill-opacity="0.1" d="M0,128L48,133.3C96,139,192,149,288,160C384,171,480,181,576,165.3C672,149,768,107,864,112C960,117,1056,171,1152,186.7C1248,203,1344,181,1392,170.7L1440,160L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>');
            background-size: cover;
            background-position: bottom;
            opacity: 0.2;
        }

        .hero h1 {
            font-size: 3.5rem;
            margin-bottom: 20px;
            line-height: 1.2;
            font-weight: 700;
        }

        .hero p {
            font-size: 1.4rem;
            margin-bottom: 40px;
            opacity: 0.9;
        }

        /* Content Sections */
        .section {
            padding: 80px 0;
        }

        .section-header {
            text-align: center;
            margin-bottom: 50px;
        }

        .section-header h2 {
            font-size: 2.5rem;
            color: var(--primary-blue);
            margin-bottom: 15px;
            font-weight: 700;
        }

        .section-bg {
            background: rgba(255, 255, 255, 0.6);
            backdrop-filter: blur(5px);
        }

        .card {
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(44, 62, 80, 0.06);
            transition: all 0.3s ease;
            height: 100%;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
        }

        .card:hover {
            transform: translateY(-4px);
            box-shadow: 0 4px 16px rgba(44, 62, 80, 0.12);
            border-color: var(--accent-blue);
        }

        .card-img {
            height: 200px;
            background: linear-gradient(45deg, var(--primary-blue), var(--secondary-blue));
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--warm-white);
            font-size: 3rem;
            overflow: hidden;
            position: relative;
        }

        .card-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .card:hover .card-img img {
            transform: scale(1.05);
        }

        .spinner-border {
            width: 3rem;
            height: 3rem;
        }

        .card-content {
            padding: 25px;
        }

        .card h3 {
            font-size: 1.4rem;
            margin-bottom: 15px;
            color: var(--primary-blue);
            font-weight: 600;
        }

        .btn {
            display: inline-block;
            background: var(--primary-blue);
            color: var(--warm-white);
            text-decoration: none;
            padding: 12px 25px;
            border-radius: 30px;
            font-weight: 600;
            transition: all 0.3s ease;
            border: 2px solid var(--primary-blue);
        }

        .btn:hover {
            background: var(--secondary-blue);
            color: var(--warm-white);
            transform: translateY(-1px);
            box-shadow: 0 2px 8px rgba(44, 62, 80, 0.2);
        }

        .btn-accent {
            background: var(--accent-blue);
            color: var(--warm-white);
            border-color: var(--accent-blue);
        }

        .btn-accent:hover {
            background: var(--accent-teal);
            color: var(--warm-white);
            transform: translateY(-1px);
            box-shadow: 0 2px 8px rgba(22, 160, 133, 0.2);
        }

        /* Bootstrap Button Overrides */
        .btn-primary {
            background-color: var(--primary-blue) !important;
            border-color: var(--primary-blue) !important;
            color: var(--warm-white) !important;
        }

        .btn-primary:hover, .btn-primary:focus, .btn-primary:active {
            background-color: var(--secondary-blue) !important;
            border-color: var(--secondary-blue) !important;
            color: var(--warm-white) !important;
            transform: translateY(-1px);
            box-shadow: 0 2px 8px rgba(44, 62, 80, 0.2) !important;
        }

        .btn-outline-secondary {
            color: var(--medium-gray) !important;
            border-color: var(--border-color) !important;
        }

        .btn-outline-secondary:hover {
            background-color: var(--medium-gray) !important;
            border-color: var(--medium-gray) !important;
            color: var(--warm-white) !important;
        }

        /* Form Controls */
        .form-control {
            border: 1px solid var(--border-color);
            border-radius: 6px;
            padding: 12px 16px;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(5px);
        }

        .form-control:focus {
            border-color: var(--accent-blue);
            box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.15);
            outline: none;
        }

        /* Alert Styles */
        .alert-warning {
            background-color: rgba(230, 126, 34, 0.1);
            border-color: var(--accent-orange);
            color: var(--text-color);
            border-radius: 6px;
        }

        /* News Scroll Container */
        .news-scroll-container {
            max-height: 600px;
            overflow-y: auto;
            padding: 20px;
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            border: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 4px 16px rgba(44, 62, 80, 0.1);
            position: relative;
        }

        /* Scroll fade effect at bottom */
        .news-scroll-container::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 30px;
            background: linear-gradient(transparent, rgba(255, 255, 255, 0.9));
            pointer-events: none;
            border-radius: 0 0 15px 15px;
        }

        /* Custom Scrollbar */
        .news-scroll-container::-webkit-scrollbar {
            width: 8px;
        }

        .news-scroll-container::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.3);
            border-radius: 4px;
        }

        .news-scroll-container::-webkit-scrollbar-thumb {
            background: var(--accent-blue);
            border-radius: 4px;
            transition: background 0.3s ease;
        }

        .news-scroll-container::-webkit-scrollbar-thumb:hover {
            background: var(--primary-blue);
        }

        /* Billboard Card Styles */
        .billboard-card {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(248, 249, 250, 0.95) 100%);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(52, 152, 219, 0.2);
            box-shadow: 0 8px 25px rgba(44, 62, 80, 0.1);
        }

        .billboard-card .card-header {
            background: linear-gradient(135deg, var(--primary-blue), var(--secondary-blue));
            color: var(--warm-white);
            border-bottom: none;
        }

        .billboard-song-item {
            background: rgba(255, 255, 255, 0.8);
            border: 1px solid rgba(52, 152, 219, 0.1);
            border-radius: 8px;
            padding: 12px;
            margin-bottom: 8px;
            transition: all 0.3s ease;
            cursor: pointer;
            min-height: 80px;
        }

        .billboard-song-item:hover {
            background: rgba(52, 152, 219, 0.1);
            border-color: var(--accent-blue);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(52, 152, 219, 0.15);
        }

        .billboard-position {
            background: var(--accent-blue);
            color: var(--warm-white);
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 0.9rem;
        }

        .billboard-song-title {
            font-weight: 600;
            color: var(--primary-blue);
            margin-bottom: 2px;
        }

        .billboard-artist {
            color: var(--medium-gray);
            font-size: 0.9rem;
        }

        .billboard-stats {
            font-size: 0.8rem;
            color: var(--medium-gray);
        }

        .billboard-container-scroll {
            max-height: 400px;
            overflow-y: auto;
            padding-right: 10px;
        }

        .billboard-container-scroll::-webkit-scrollbar {
            width: 6px;
        }

        .billboard-container-scroll::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.3);
            border-radius: 3px;
        }

        .billboard-container-scroll::-webkit-scrollbar-thumb {
            background: var(--accent-blue);
            border-radius: 3px;
        }

        .billboard-thumbnail {
            width: 60px;
            height: 60px;
            border-radius: 6px;
            object-fit: cover;
            margin-right: 15px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
            transition: all 0.3s ease;
        }

        .billboard-song-item:hover .billboard-thumbnail {
            transform: scale(1.05);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.25);
        }

        .billboard-thumbnail-placeholder {
            width: 60px;
            height: 60px;
            border-radius: 6px;
            background: linear-gradient(135deg, var(--accent-blue), var(--accent-teal));
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--warm-white);
            font-size: 1.5rem;
            margin-right: 15px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
        }

        /* News Cards in Scroll Container */
        .news-scroll-container .card {
            margin-bottom: 0;
            transition: all 0.3s ease;
        }

        .news-scroll-container .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(44, 62, 80, 0.15);
        }

        /* Contact Form */
        .contact-form {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .form-control {
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            transition: all 0.3s ease;
            margin-bottom: 20px;
        }

        .form-control:focus {
            border-color: var(--primary-blue);
            box-shadow: 0 0 0 0.25rem rgba(0, 51, 255, 0.1);
        }

        /* Footer */
        footer {
            background: var(--dark-gray);
            color: var(--light-gray);
            padding: 60px 0 30px;
        }

        .footer-column h3 {
            color: var(--warm-white);
            font-size: 1.5rem;
            margin-bottom: 25px;
            position: relative;
            padding-bottom: 10px;
        }

        .footer-column h3::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 50px;
            height: 3px;
            background: var(--accent-blue);
        }

        .footer-links li {
            margin-bottom: 12px;
        }

        .footer-links a {
            color: var(--light-gray);
            text-decoration: none;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .footer-links a:hover {
            color: var(--accent-blue);
            transform: translateX(3px);
        }

        .social-links {
            display: flex;
            gap: 15px;
            margin-top: 20px;
        }

        .social-links a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            color: var(--warm-white);
            transition: all 0.3s ease;
            font-size: 18px;
        }

        .social-links a:hover {
            background: var(--primary-blue);
            transform: translateY(-5px);
        }

        .copyright {
            text-align: center;
            padding-top: 30px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            margin-top: 40px;
            font-size: 0.9rem;
            opacity: 0.7;
        }

        /* Animation Elements */
        .pulse {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.05);
            }
            100% {
                transform: scale(1);
            }
        }

        .floating {
            animation: floating 3s ease-in-out infinite;
        }

        @keyframes floating {
            0% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-15px);
            }
            100% {
                transform: translateY(0px);
            }
        }

        /* Sticky Player */
        .sticky-player {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            height: var(--player-height);
            background: linear-gradient(135deg, var(--primary-blue), var(--secondary-blue));
            color: white;
            display: flex;
            align-items: center;
            padding: 0 20px;
            z-index: 1000;
            box-shadow: 0 -4px 15px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
            transform: translateY(0);
        }

        .player-minimized {
            transform: translateY(calc(var(--player-height) - 20px));
        }

        .player-controls {
            display: flex;
            align-items: center;
            gap: 15px;
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
        }

        .player-info {
            flex-grow: 1;
            display: flex;
            align-items: center;
            gap: 15px;
            min-width: 0; /* Allow text truncation */
            overflow: hidden;
        }

        .mini-player-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--accent-blue);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            flex-shrink: 0;
            font-size: 16px;
        }

        .player-title {
            font-weight: 600;
            font-size: 1rem;
            color: white;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .player-song {
            font-size: 0.9rem;
            color: rgba(255, 255, 255, 0.9);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        #current-artist {
            font-weight: bold;
            text-transform: uppercase;
            color: white;
            font-size: 0.9rem;
        }

        #current-title {
            font-style: italic;
            color: rgba(255, 255, 255, 0.9);
            font-size: 0.85rem;
        }

        .player-buttons {
            display: flex;
            gap: 15px;
            align-items: center;
        }

        .player-btn {
            background: transparent;
            border: none;
            color: white;
            font-size: 18px;
            cursor: pointer;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .player-btn:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        .minimize-btn {
            background: var(--accent-yellow);
            color: var(--primary-blue);
        }

        .minimize-btn:hover {
            background: var(--accent-yellow-alt);
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .hero {
                padding: 60px 0;
            }

            .hero h1 {
                font-size: 2.5rem;
            }

            .hero p {
                font-size: 1.1rem;
            }

            .player-title, .player-song {
                font-size: 0.85rem;
            }

            .player-buttons {
                gap: 8px;
            }

            .player-btn {
                width: 35px;
                height: 35px;
                font-size: 16px;
            }
        }

        /* App Download Modal Styling */
        #appDownloadModal .modal-content {
            border: none;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
            overflow: hidden;
        }

        #appDownloadModal .modal-header {
            background: linear-gradient(135deg, #FFD700 0%, #FFA500 50%, #1E3C72 100%);
            color: white;
            padding: 20px 25px;
            border-bottom: none;
        }

        #appDownloadModal .modal-title {
            font-weight: 700;
            font-size: 1.3rem;
        }

        #appDownloadModal .btn-close {
            filter: brightness(0) invert(1);
            opacity: 1;
            background-color: rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0;
            transition: all 0.3s ease;
        }

        #appDownloadModal .btn-close:hover {
            opacity: 1;
            background-color: rgba(255, 255, 255, 0.5);
            transform: scale(1.1);
        }

        #appDownloadModal .btn-close:focus {
            box-shadow: 0 0 0 3px rgba(255, 255, 255, 0.3);
            opacity: 1;
        }

        #appDownloadModal .custom-close-btn {
            position: absolute;
            top: 15px;
            right: 15px;
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.9);
            border: none;
            border-radius: 50%;
            color: #333;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            z-index: 10;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        #appDownloadModal .custom-close-btn:hover {
            background: rgba(255, 255, 255, 1);
            transform: scale(1.1);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
        }

        #appDownloadModal .custom-close-btn:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(255, 255, 255, 0.5);
        }

        #appDownloadModal .app-icon {
            width: 160px;
            height: 160px;
            margin: 0 auto;
            background: transparent;
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: none;
        }

        #appDownloadModal .app-icon i {
            color: white;
        }

        #appDownloadModal .modal-body h4 {
            color: var(--primary-blue);
            font-weight: 700;
            margin-bottom: 10px;
        }

        #appDownloadModal .modal-body p {
            color: var(--medium-gray);
            font-size: 0.95rem;
        }

        #appDownloadModal .btn-primary {
            background: linear-gradient(135deg, #1E3C72 0%, #2c3e50 50%, #3498db 100%);
            border: none;
            border-radius: 15px;
            padding: 12px 30px;
            font-weight: 600;
            color: white;
            transition: all 0.3s ease;
        }

        #appDownloadModal .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(52, 152, 219, 0.4);
            background: linear-gradient(135deg, #1A2F5A 0%, #243447 50%, #2980b9 100%);
        }

        #appDownloadModal .btn-outline-primary {
            border: 2px solid #FFD700;
            color: #1E3C72;
            border-radius: 15px;
            padding: 15px 20px;
            font-weight: 600;
            font-size: 1rem;
            background: transparent;
            transition: all 0.3s ease;
        }

        #appDownloadModal .btn-outline-primary:hover {
            background: linear-gradient(135deg, #FFD700 0%, #FF8C00 50%, #FF6347 100%);
            border-color: transparent;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(255, 140, 0, 0.3);
        }

        #appDownloadModal .btn-success {
            background: linear-gradient(135deg, #FFD700 0%, #FFA500 100%);
            border: none;
            border-radius: 15px;
            padding: 15px 20px;
            font-weight: 600;
            font-size: 1rem;
            box-shadow: 0 5px 20px rgba(255, 215, 0, 0.3);
            color: #1E3C72;
            transition: all 0.3s ease;
        }

        #appDownloadModal .btn-success:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(255, 215, 0, 0.5);
            background: linear-gradient(135deg, #FFC700 0%, #FF8C00 100%);
        }

        /* Responsive modal */
        @media (max-width: 576px) {
            #appDownloadModal .modal-dialog {
                margin: 20px;
            }

            #appDownloadModal .modal-content {
                border-radius: 15px;
            }

            #appDownloadModal .modal-header {
                padding: 15px 20px;
            }

            #appDownloadModal .modal-body {
                padding: 25px 20px;
            }

            #appDownloadModal .app-icon {
                width: 60px;
                height: 60px;
            }

            #appDownloadModal .app-icon i {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>

@include('partials.header') {{-- Shared header --}}

<main>
    @yield('content') {{-- Page-specific content --}}
</main>

@include('partials.footer') {{-- Shared footer --}}
<!-- Bootstrap JS with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Cross-tab audio persistence functionality
    class AudioPersistenceManager {
        constructor() {
            this.storageKey = 'jammin_radio_audio_state';
            this.tabId = this.generateTabId();
            this.isActiveTab = true;
            this.init();
        }

        generateTabId() {
            return 'tab_' + Date.now() + '_' + Math.random().toString(36).substr(2, 9);
        }

        init() {
            // Save current tab info
            localStorage.setItem(this.storageKey + '_current_tab', this.tabId);

            // Listen for storage events (cross-tab communication)
            window.addEventListener('storage', (e) => {
                if (e.key === this.storageKey) {
                    this.handleAudioStateChange(JSON.parse(e.newValue));
                } else if (e.key === this.storageKey + '_current_tab') {
                    this.handleTabChange(e.newValue);
                }
            });

            // Handle page visibility changes
            document.addEventListener('visibilitychange', () => {
                if (document.hidden) {
                    this.isActiveTab = false;
                } else {
                    this.isActiveTab = true;
                    localStorage.setItem(this.storageKey + '_current_tab', this.tabId);
                    this.syncAudioState();
                }
            });

            // Handle window focus
            window.addEventListener('focus', () => {
                this.isActiveTab = true;
                localStorage.setItem(this.storageKey + '_current_tab', this.tabId);
                this.syncAudioState();
            });

            // Handle window blur
            window.addEventListener('blur', () => {
                this.isActiveTab = false;
            });

            // Cleanup on page unload
            window.addEventListener('beforeunload', () => {
                this.saveAudioState();
            });
        }

        handleAudioStateChange(state) {
            if (!this.isActiveTab) return;

            const audio = document.getElementById('live-audio');
            if (!audio) return;

            // Sync audio state from other tabs
            if (state.isPlaying && audio.paused) {
                audio.play().catch(e => console.log('Autoplay prevented:', e));
            } else if (!state.isPlaying && !audio.paused) {
                audio.pause();
            }

            // Sync volume
            if (state.volume !== undefined) {
                audio.volume = state.volume;
            }

            // Update UI
            this.updatePlayPauseIcons(!audio.paused);
        }

        handleTabChange(activeTabId) {
            this.isActiveTab = (activeTabId === this.tabId);
        }

        saveAudioState() {
            const audio = document.getElementById('live-audio');
            if (!audio) return;

            const state = {
                isPlaying: !audio.paused,
                volume: audio.volume,
                currentTime: audio.currentTime,
                timestamp: Date.now()
            };

            localStorage.setItem(this.storageKey, JSON.stringify(state));
        }

        syncAudioState() {
            const savedState = localStorage.getItem(this.storageKey);
            if (savedState) {
                this.handleAudioStateChange(JSON.parse(savedState));
            }
        }

        updatePlayPauseIcons(isPlaying) {
            const navbarPlayIcon = document.getElementById('navbar-play-icon');
            const miniPlayIcon = document.getElementById('mini-play-icon');
            const playIcon = document.getElementById('play-icon');

            if (navbarPlayIcon) {
                navbarPlayIcon.className = isPlaying ? "fas fa-pause me-1" : "fas fa-play me-1";
            }
            if (miniPlayIcon) {
                miniPlayIcon.className = isPlaying ? "fas fa-pause" : "fas fa-play";
            }
            if (playIcon) {
                playIcon.className = isPlaying ? "fas fa-pause" : "fas fa-play";
            }
        }
    }

    // Initialize audio persistence manager
    const audioPersistenceManager = new AudioPersistenceManager();

    // Toggle live audio function
    function toggleLiveAudio() {
        const audio = document.getElementById('live-audio');
        const stickyPlayer = document.getElementById('sticky-player');

        if (!audio) {
            console.error('Audio element not found');
            return;
        }

        if (audio.paused) {
            audio.play().then(() => {
                console.log('Audio playback started');
                audioPersistenceManager.saveAudioState();
                if (stickyPlayer) {
                    stickyPlayer.style.display = 'flex';
                }
            }).catch(error => {
                console.error('Error playing audio:', error);
            });
        } else {
            audio.pause();
            console.log('Audio playback paused');
            audioPersistenceManager.saveAudioState();
        }
    }

    // Mobile Menu Toggle
    const navbarToggler = document.querySelector('.navbar-toggler');
    const navbarNav = document.querySelector('#navbarNav');

    // Player Elements
    const heroListenBtn = document.getElementById('hero-listen-btn');


    // Hero Listen button
    if (heroListenBtn) {
        heroListenBtn.addEventListener('click', () => {
            toggleLiveAudio();
        });
    }


    // Promo slider functionality
    const indicators = document.querySelectorAll('.indicator');
    const slides = [
        document.getElementById('slide1'),
        document.getElementById('slide2'),
        document.getElementById('slide3')
    ];

    let currentSlide = 0;

    function showSlide(index) {
        // Update indicators
        indicators.forEach((indicator, i) => {
            if (i === index) {
                indicator.classList.add('active');
                slides[i].style.transform = 'translateY(0)';
            } else {
                indicator.classList.remove('active');
                slides[i].style.transform = 'translateY(100%)';
            }
        });

        currentSlide = index;
    }

    // Set up indicator clicks
    indicators.forEach((indicator, index) => {
        indicator.addEventListener('click', () => {
            showSlide(index);
        });
    });

    // Auto-rotate slides
    setInterval(() => {
        const nextSlide = (currentSlide + 1) % slides.length;
        showSlide(nextSlide);
    }, 5000);

    // Add smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth'
            });
        });
    });

    // Track if user has manually paused the stream
    let userPaused = false;
    let playAttemptInProgress = false;
    let audioInitialized = false;

    // Initialize audio element
    function initAudio() {
        const liveAudio = document.getElementById('live-audio');
        if (!liveAudio) {
            console.error('Audio element not found!');
            return null;
        }

        // Set up error handling
        liveAudio.onerror = function () {
            console.error('Audio error:', liveAudio.error);
            const miniPlayIcon = document.getElementById('mini-play-icon');
            if (miniPlayIcon) {
                miniPlayIcon.classList.remove('fa-pause');
                miniPlayIcon.classList.add('fa-play');
            }
            playAttemptInProgress = false;
        };

        // Update play/pause button state when playback state changes
        liveAudio.onplay = function () {
            console.log('Audio playback started');
            const miniPlayIcon = document.getElementById('mini-play-icon');
            if (miniPlayIcon) {
                miniPlayIcon.classList.remove('fa-play');
                miniPlayIcon.classList.add('fa-pause');
            }
            playAttemptInProgress = false;
        };

        liveAudio.onpause = function () {
            console.log('Audio playback paused');
            const miniPlayIcon = document.getElementById('mini-play-icon');
            if (miniPlayIcon) {
                miniPlayIcon.classList.remove('fa-pause');
                miniPlayIcon.classList.add('fa-play');
            }
            playAttemptInProgress = false;
        };

        return liveAudio;
    }

    // Initialize audio player when DOM is loaded
    document.addEventListener('DOMContentLoaded', function () {
        // Smooth scrolling for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Initialize audio
        const liveAudio = initAudio();
        if (liveAudio) {
            audioInitialized = true;

            // Set up mini player controls
            const miniPlayBtn = document.getElementById('mini-play-btn');
            if (miniPlayBtn) {
                miniPlayBtn.addEventListener('click', function (e) {
                    e.stopPropagation();
                    toggleLiveAudio();
                });
            }

            // Also allow clicking anywhere in the player info area
            const playerInfo = document.querySelector('.player-info');
            if (playerInfo) {
                playerInfo.addEventListener('click', function () {
                    toggleLiveAudio();
                });
            }
        }

        // Set up other player controls
        const navbarPlayIcon = document.getElementById('navbar-play-icon');
        const miniPlayIcon = document.getElementById('mini-play-icon');
        const prevBtn = document.getElementById('prev-btn');
        const nextBtn = document.getElementById('next-btn');
        const minimizeBtn = document.getElementById('minimize-btn');
        const stickyPlayer = document.getElementById('sticky-player');

        // Ensure sticky player is visible
        if (stickyPlayer) {
            stickyPlayer.style.display = 'flex';
        }

        // Update all play/pause icons when audio state changes
        if (liveAudio) {
            liveAudio.addEventListener('play', function () {
                if (navbarPlayIcon) navbarPlayIcon.className = "fas fa-pause me-1";
                if (playIcon) playIcon.className = "fas fa-pause";
                if (miniPlayIcon) miniPlayIcon.className = "fas fa-pause";
                audioPersistenceManager.saveAudioState();
            });

            liveAudio.addEventListener('pause', function () {
                if (navbarPlayIcon) navbarPlayIcon.className = "fas fa-play me-1";
                if (playIcon) playIcon.className = "fas fa-play";
                if (miniPlayIcon) miniPlayIcon.className = "fas fa-play";
                audioPersistenceManager.saveAudioState();
            });

            liveAudio.addEventListener('volumechange', function () {
                audioPersistenceManager.saveAudioState();
            });
        }

        // Connect sticky player buttons to live audio
        if (playBtn && liveAudio) {
            playBtn.addEventListener('click', function () {
                toggleLiveAudio();
            });
        }

        if (miniPlayIcon && liveAudio) {
            miniPlayIcon.addEventListener('click', function () {
                toggleLiveAudio();
            });
        }

        // Previous and Next buttons (for live radio, these could skip to different streams or be disabled)
        if (prevBtn) {
            prevBtn.addEventListener('click', function () {
                // For live radio, you might want to disable this or implement station switching
                console.log('Previous button clicked - Live radio stream');
            });
        }

        if (nextBtn) {
            nextBtn.addEventListener('click', function () {
                // For live radio, you might want to disable this or implement station switching
                console.log('Next button clicked - Live radio stream');
            });
        }

        // Minimize/Expand sticky player
        if (minimizeBtn && stickyPlayer) {
            let isMinimized = false;
            minimizeBtn.addEventListener('click', function () {
                isMinimized = !isMinimized;
                if (isMinimized) {
                    stickyPlayer.classList.add('player-minimized');
                    minimizeBtn.innerHTML = '<i class="fas fa-chevron-up"></i>';
                    minimizeBtn.setAttribute('title', 'Expand');
                } else {
                    stickyPlayer.classList.remove('player-minimized');
                    minimizeBtn.innerHTML = '<i class="fas fa-chevron-down"></i>';
                    minimizeBtn.setAttribute('title', 'Minimize');
                }
            });
        }
    });

    // Test function for manual API testing
    window.testNewsAPI = function () {
        console.log('Testing News API...');
        const loadingElement = document.getElementById('news-loading');
        if (loadingElement) {
            loadingElement.style.display = 'block';
        }

        fetch('/api/news')
            .then(response => {
                console.log('API Response Status:', response.status);
                return response.text();
            })
            .then(text => {
                console.log('Raw API Response:', text);
                try {
                    const news = JSON.parse(text);
                    console.log('Parsed News:', news);
                    alert('API Test Successful! Check console for details.');
                    displayNews(news);
                } catch (e) {
                    console.error('JSON Parse Error:', e);
                    alert('API returned data but JSON parsing failed. Check console.');
                }
            })
            .catch(error => {
                console.error('API Test Error:', error);
                alert('API Test Failed! Check console for details.');
            })
            .finally(() => {
                const loadingElement = document.getElementById('news-loading');
                if (loadingElement) {
                    loadingElement.style.display = 'none';
                }
            });
    };

    // Load news articles automatically - only if we're on a page with news container
    if (document.getElementById('news-container')) {
        console.log('News container found, loading news...');
        setTimeout(() => {
            loadNews();
            loadBillboard(); // Load Billboard data alongside news
        }, 2000); // Wait 2 seconds for page to fully load
    } else {
        console.log('News container not found on this page');
    }

    // Billboard refresh button
    const refreshBillboardBtn = document.getElementById('refresh-billboard');
    if (refreshBillboardBtn) {
        refreshBillboardBtn.addEventListener('click', function () {
            loadBillboard(true); // Force refresh
        });
    }

    function loadNews() {
        console.log('Loading news...');

        // Use XMLHttpRequest as fallback for better compatibility
        const xhr = new XMLHttpRequest();
        xhr.open('GET', '/api/news', true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4) {
                console.log('XHR Response status:', xhr.status);
                if (xhr.status === 200) {
                    try {
                        const news = JSON.parse(xhr.responseText);
                        console.log('News loaded:', news);
                        displayNews(news);
                    } catch (e) {
                        console.error('JSON parse error:', e);
                        displayFallbackNews();
                    }
                } else {
                    console.error('XHR Error:', xhr.status, xhr.statusText);
                    displayFallbackNews();
                }
            }
        };
        xhr.send();
    }

    function displayNews(newsArticles) {
        console.log('Displaying news articles:', newsArticles);
        const newsContainer = document.getElementById('news-container');
        const loadingElement = document.getElementById('news-loading');

        console.log('News container found:', !!newsContainer);
        console.log('Loading element found:', !!loadingElement);

        if (!newsContainer) {
            console.error('News container not found!');
            return;
        }

        // Remove loading spinner
        if (loadingElement) {
            loadingElement.style.display = 'none';
            console.log('Loading spinner hidden');
        }

        // Clear existing content
        newsContainer.innerHTML = '';

        // Display news articles
        if (newsArticles && newsArticles.length > 0) {
            newsArticles.forEach((article, index) => {
                const newsCard = createNewsCard(article, index);
                newsContainer.appendChild(newsCard);
            });
            console.log(`Displayed ${newsArticles.length} news articles`);

            // Add a success message
            const successDiv = document.createElement('div');
            successDiv.className = 'col-12 text-center mt-3';
            successDiv.innerHTML = '<div class="alert alert-success">✅ News loaded successfully!</div>';
            newsContainer.appendChild(successDiv);
        } else {
            console.log('No news articles to display');
            const noNewsDiv = document.createElement('div');
            noNewsDiv.className = 'col-12 text-center';
            noNewsDiv.innerHTML = '<div class="alert alert-warning">⚠️ No news articles available at the moment.</div>';
            newsContainer.appendChild(noNewsDiv);
        }
    }

    function createNewsCard(article, index) {
        const col = document.createElement('div');
        col.className = 'col-md-4 mb-4';

        // Use urlToImage from NewsAPI as main thumbnail
        const imageUrl = article.urlToImage;
        const defaultImage = '/hero.jpg'; // Using existing hero image as placeholder

        col.innerHTML = `
                <div class="card h-100 shadow-sm">
                    <div class="position-relative" style="height: 192px; overflow: hidden;">
                        <img
                            src="${imageUrl || defaultImage}"
                            alt="${article.title || 'News article'}"
                            class="w-100 h-100"
                            style="object-fit: cover; border-radius: 0.375rem 0.375rem 0 0;"
                            onerror="this.src='${defaultImage}'"
                        >
                    </div>
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">${article.title || 'Untitled'}</h5>
                        <p class="card-text flex-grow-1">${article.description || 'No description available.'}</p>
                        <div class="mt-auto">
                            <small class="text-muted d-block mb-2">
                                Source: ${article.source?.name || article.source || 'Unknown'}
                            </small>
                            <a href="${article.url || '#'}" target="_blank" class="btn btn-primary btn-sm">
                                Read More
                            </a>
                        </div>
                    </div>
                </div>
            `;

        return col;
    }

    function displayFallbackNews() {
        const fallbackNews = [
            {
                title: 'New Album Release',
                description: 'Top artist announces new album dropping next month with exclusive tour dates.',
                url: '#',
                image: null,
                source: 'Music News'
            },
            {
                title: 'Interview with Rising Star',
                description: 'Exclusive interview with this month\'s breakout artist on their journey to success.',
                url: '#',
                image: null,
                source: 'Celebrity News'
            },
            {
                title: 'Music Awards 2023',
                description: 'Complete list of winners and highlights from this year\'s prestigious music awards.',
                url: '#',
                image: null,
                source: 'Awards News'
            }
        ];

        displayNews(fallbackNews);
    }

    // Billboard Functions
    function loadBillboard(forceRefresh = false) {
        console.log('Loading Billboard Top 40...');
        const billboardLoading = document.getElementById('billboard-loading');
        const billboardContainer = document.getElementById('billboard-container');

        if (billboardLoading) {
            billboardLoading.style.display = 'block';
        }
        if (billboardContainer) {
            billboardContainer.style.display = 'none';
        }

        const url = forceRefresh ? '/api/billboard?refresh=1' : '/api/billboard';

        fetch(url)
            .then(response => {
                console.log('Billboard API Response status:', response.status);
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                console.log('Billboard data loaded:', data);
                displayBillboard(data);
            })
            .catch(error => {
                console.error('Billboard API Error:', error);
                displayFallbackBillboard();
            })
            .finally(() => {
                if (billboardLoading) {
                    billboardLoading.style.display = 'none';
                }
            });
    }

    function displayBillboard(songs) {
        const billboardContainer = document.getElementById('billboard-container');

        if (!billboardContainer) {
            console.error('Billboard container not found!');
            return;
        }

        billboardContainer.innerHTML = '';
        billboardContainer.style.display = 'block';

        if (!songs || songs.length === 0) {
            displayFallbackBillboard();
            return;
        }

        // Create scrollable container
        const scrollContainer = document.createElement('div');
        scrollContainer.className = 'billboard-container-scroll col-12';

        songs.forEach((song, index) => {
            const songItem = createBillboardSongItem(song, index);
            scrollContainer.appendChild(songItem);
        });

        billboardContainer.appendChild(scrollContainer);

        // Add update timestamp
        const timestampDiv = document.createElement('div');
        timestampDiv.className = 'col-12 text-center mt-3';
        timestampDiv.innerHTML = `<small class="text-muted"><i class="fas fa-clock"></i> Updated: ${new Date().toLocaleString()}</small>`;
        billboardContainer.appendChild(timestampDiv);
    }

    function createBillboardSongItem(song, index) {
        const songDiv = document.createElement('div');
        songDiv.className = 'billboard-song-item d-flex align-items-center';

        // Create thumbnail element
        const thumbnailElement = song.image ?
            `<img src="${song.image}" alt="${song.title}" class="billboard-thumbnail" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                 <div class="billboard-thumbnail-placeholder" style="display: none;">
                     <i class="fas fa-music"></i>
                 </div>` :
            `<div class="billboard-thumbnail-placeholder">
                     <i class="fas fa-music"></i>
                 </div>`;

        songDiv.innerHTML = `
                <div class="billboard-position me-3">
                    ${song.position}
                </div>
                ${thumbnailElement}
                <div class="flex-grow-1">
                    <div class="billboard-song-title">${song.title}</div>
                    <div class="billboard-artist">${song.artist}</div>
                    <div class="billboard-stats">
                        <span class="me-3"><i class="fas fa-calendar-week"></i> ${song.weeks} weeks</span>
                        <span><i class="fas fa-trophy"></i> Peak: #${song.peak}</span>
                    </div>
                </div>
                <div class="text-end">
                    <i class="fas fa-music text-primary"></i>
                </div>
            `;

        // Add click event for future functionality (could link to Spotify, Apple Music, etc.)
        songDiv.addEventListener('click', function () {
            console.log(`Clicked on: ${song.title} by ${song.artist}`);
            // Future: Could open streaming service or show more details
        });

        return songDiv;
    }

    function displayFallbackBillboard() {
        // No hardcoded fallback data - show empty state
        const billboardContainer = document.getElementById('billboard-container');
        if (billboardContainer) {
            billboardContainer.innerHTML = '<p class="text-center text-gray-500 py-4">Billboard Hot 100 data temporarily unavailable. Please check API configuration.</p>';
        }
    }
</script>
<!-- Stream Metadata Script -->
<script>
    // Global error handler
    window.onerror = function (message, source, lineno, colno, error) {
        console.error('Global error:', {message, source, lineno, colno, error});
        return true; // Prevent default error handling
    };

    // Metadata persistence system
    let currentSongMetadata = {
        artist: 'Now Playing',
        title: 'Live Stream',
        timestamp: 0
    };

    // Function to persist metadata only if it's valid and newer
    function persistMetadata(artist, title) {
        let now = Date.now();

        // Only update if we have valid metadata
        if (artist && title &&
            artist !== 'Now Playing' &&
            title !== 'Live Stream' &&
            artist !== 'Loading...' &&
            title !== 'Loading metadata...' &&
            artist !== 'Error loading stream' &&
            title !== 'Error loading metadata') {

            // Update the persisted metadata in localStorage for cross-page persistence
            const metadata = {
                artist: artist,
                title: title,
                timestamp: now
            };

            try {
                localStorage.setItem('jammin_current_song_metadata', JSON.stringify(metadata));
                console.log('💾 Persisted metadata to localStorage:', metadata);
                return true;
            } catch (e) {
                console.error('❌ Failed to persist metadata to localStorage:', e);
                return false;
            }
        }

        return false;
    }

    // Function to get the current persisted metadata
    function getPersistedMetadata() {
        console.log('📖 getPersistedMetadata called');
        try {
            const stored = localStorage.getItem('jammin_current_song_metadata');
            console.log('📦 Raw stored data:', stored);
            if (stored) {
                const metadata = JSON.parse(stored);
                console.log('📋 Parsed metadata:', metadata);
                // Check if metadata is recent (within last 10 minutes)
                const now = Date.now();
                const age = now - metadata.timestamp;
                console.log('⏱️ Metadata age:', age, 'ms (limit: 600000ms)');
                if (age < 600000) { // 10 minutes
                    console.log('📖 Retrieved metadata from localStorage:', metadata);
                    return metadata;
                } else {
                    console.log('⏰ Persisted metadata is too old, clearing');
                    localStorage.removeItem('jammin_current_song_metadata');
                }
            } else {
                console.log('📭 No stored metadata found in localStorage');
            }
        } catch (e) {
            console.error('❌ Failed to get persisted metadata from localStorage:', e);
        }

        // Return empty metadata if nothing valid found
        return {artist: '', title: '', timestamp: 0};
    }

    // Function to restore persisted metadata to display
    function restorePersistedMetadata() {
        console.log('🔄 restorePersistedMetadata called');
        const metadata = getPersistedMetadata();
        console.log('📖 Retrieved metadata:', metadata);
        if (metadata.artist && metadata.title && metadata.artist !== '' && metadata.title !== '') {
            console.log('🔄 Restoring persisted metadata:', metadata);

            const artistElement = document.getElementById('current-artist');
            const titleElement = document.getElementById('current-title');

            if (artistElement && titleElement) {
                // Clean up persisted metadata to remove time patterns
                let cleanArtist = metadata.artist;
                let cleanTitle = metadata.title;

                // Remove time patterns from title (like 02:35, 2.57, etc.)
                cleanTitle = cleanTitle.replace(/\s*[0-9]{1,2}[:.][0-9]{2}\s*$/, '').trim();
                cleanTitle = cleanTitle.replace(/\s*[0-9]{1,2}[:.][0-9]{2}\s*[0-9]{1,2}[:.][0-9]{2}\s*$/, '').trim(); // For duration like 02:35:45

                // Remove trailing dashes and separators from title
                cleanTitle = cleanTitle.replace(/[\s\-\–\—\|•:]+$/, '').trim();

                // Add prefixes to the display
                artistElement.textContent = cleanArtist;
                titleElement.textContent = cleanTitle;

                // Also update document title
                try {
                    document.title = `${metadata.title} - ${metadata.artist} | Jammin 92.3`;
                } catch (e) {
                    console.warn('⚠️ Could not update document title:', e);
                }

                return true;
            }
        }
        return false;
    }

    // Main player initialization
    document.addEventListener('DOMContentLoaded', function () {
        console.log('DOM fully loaded, initializing player...');

        try {
            // Make sure sticky player is visible on page load
            const stickyPlayer = document.getElementById('sticky-player');
            if (stickyPlayer) {
                stickyPlayer.style.display = 'flex';
            }

            const audio = document.getElementById("mini-player-audio");
            // Ensure stream URL is properly escaped for JavaScript
            const streamUrl = "{{ addslashes(env('STREAM_URL', 'https://streams.radiomast.io/jammin92_live')) }}";

            console.log('Stream URL:', streamUrl);

            // List of CORS proxies to try
            const corsProxies = [
                'https://api.allorigins.win/raw?url=',
                'https://cors-anywhere.herokuapp.com/',
                'https://corsproxy.io/?' + encodeURIComponent,
                '' // Try direct as last resort
            ];

            // Common metadata endpoints to try
            const metadataEndpoints = [
                '/status-json.xsl',
                '/status-json',
                '/status.xsl',
                '/status',
                '/7.html'
            ];

            let currentProxyIndex = 0;
            let currentEndpointIndex = 0;
            let metadataInterval;
            let retryCount = 0;
            const maxRetries = 3;
            const miniPlayIcon = document.getElementById('mini-play-icon');
            let lastMetadata = '';

            // Fallback metadata for when we can't fetch from the stream
            const fallbackMetadata = [
                {artist: 'Jammin 92', title: 'Playing the best music'},
                {artist: 'Live Radio', title: 'Streaming now'},
                {artist: 'Jammin 92', title: 'Tune in for great music'}
            ];
            let fallbackIndex = 0;

            // Function to update the player with song information
            function updateSongInfo(info) {
                if (!info) {
                    console.warn('⚠️ No song info provided to updateSongInfo');
                    return;
                }

                console.log('🔄 Updating song info:', info);

                const artistElement = document.getElementById('current-artist');
                const titleElement = document.getElementById('current-title');

                if (!artistElement || !titleElement) {
                    console.error('❌ Could not find artist or title elements in the DOM');
                    return;
                }

                // Default values
                let artist = 'Now Playing';
                let title = 'Live Stream';

                // Check if info is an object with artist and title properties
                if (typeof info === 'object' && info !== null) {
                    if (info.artist || info.song) {
                        artist = info.artist || 'Unknown Artist';
                        title = info.song || info.title || 'Unknown Song';
                    } else if (info.title) {
                        // If only title is present, try to split it
                        const titleStr = info.title;
                        const separators = [' - ', ' – ', ' — ', ' • ', ' | ', ':'];
                        for (const sep of separators) {
                            if (titleStr.includes(sep)) {
                                const parts = titleStr.split(sep).map(part => part.trim());
                                if (parts.length >= 2) {
                                    artist = parts[0];
                                    title = parts.slice(1).join(sep);
                                    break;
                                }
                            }
                        }
                        if (title === 'Live Stream') {
                            title = titleStr;
                        }
                    }
                } else {
                    // Handle string input (legacy format)
                    const infoStr = String(info).trim();
                    if (!infoStr) {
                        console.warn('⚠️ Empty song info received');
                    } else {
                        const separators = [' - ', ' – ', ' — ', ' • ', ' | ', ':'];
                        let separatorUsed = false;

                        for (const sep of separators) {
                            if (infoStr.includes(sep)) {
                                const parts = infoStr.split(sep).map(part => part.trim());
                                if (parts.length >= 2) {
                                    artist = parts[0];
                                    title = parts.slice(1).join(sep);
                                    separatorUsed = true;
                                    break;
                                }
                            }
                        }

                        if (!separatorUsed) {
                            title = infoStr;
                        }
                    }
                }

                // Clean up the extracted values
                artist = artist.replace(/^[^\w\s]*|[^\w\s]*$/g, '').trim() || 'Unknown Artist';
                title = title.replace(/^[^\w\s]*|[^\w\s]*$/g, '').trim() || 'Unknown Song';

                // Remove time patterns from title (like 02:35, 2.57, etc.)
                title = title.replace(/\s*[0-9]{1,2}[:.][0-9]{2}\s*$/, '').trim();
                title = title.replace(/\s*[0-9]{1,2}[:.][0-9]{2}\s*[0-9]{1,2}[:.][0-9]{2}\s*$/, '').trim(); // For duration like 02:35:45

                // Remove trailing dashes and separators from title
                title = title.replace(/[\s\-\–\—\|•:]+$/, '').trim();

                // If the title is empty but we have an artist, swap them
                if (!title && artist && artist !== 'Now Playing') {
                    title = artist;
                    artist = 'Now Playing';
                }

                // Fallback if we still don't have a valid title
                if (!title) {
                    title = 'Live Stream';
                }

                console.log('📝 Extracted metadata:', {artist, title});

                // Try to persist the metadata if it's valid
                console.log('🔄 Attempting to persist metadata:', {artist, title});
                const wasPersisted = persistMetadata(artist, title);
                console.log('📝 Persistence result:', wasPersisted);

                // If this is invalid metadata (loading, error, etc.), try to restore persisted metadata
                if (!wasPersisted) {
                    console.log('🔄 Received invalid metadata, attempting to restore persisted data...');
                    if (restorePersistedMetadata()) {
                        console.log('✅ Successfully restored persisted metadata');
                        return; // Exit early to avoid overwriting restored metadata
                    }
                }

                // Check if current display has valid metadata that shouldn't be overridden
                const currentArtist = artistElement.textContent;
                const currentTitle = titleElement.textContent;

                // Don't override valid metadata with generic data
                const isGeneric = artist === 'Jammin Radio' ||
                    title === 'Jammin Radio' ||
                    artist === 'Live Stream' ||
                    title === 'Live Stream' ||
                    artist === 'Loading...' ||
                    title === 'Loading metadata...' ||
                    artist === 'Player not available' ||
                    title === 'Player not available' ||
                    artist === 'Now Playing' && title === 'Live Stream' ||
                    artist === 'Unknown Artist' ||
                    title === 'Unknown Song';

                // Check if current display has valid metadata (not loading states)
                const hasValidMetadata = currentArtist !== 'Loading...' &&
                    currentTitle !== 'Loading metadata...' &&
                    currentArtist !== 'Now Playing' &&
                    currentTitle !== 'Live Stream' &&
                    currentArtist !== 'Unknown Artist' &&
                    currentTitle !== 'Unknown Song' &&
                    currentArtist.trim() !== '' &&
                    currentTitle.trim() !== '';

                // If we have valid current metadata and incoming is generic, skip update
                if (isGeneric && hasValidMetadata &&
                    currentArtist !== 'Jammin Radio' &&
                    currentTitle !== 'Live Stream' &&
                    currentArtist !== 'Loading...' &&
                    currentTitle !== 'Loading metadata...' &&
                    currentArtist !== 'Now Playing' &&
                    currentTitle !== 'Live Stream' &&
                    currentArtist !== 'Unknown Artist' &&
                    currentTitle !== 'Unknown Song') {
                    console.log('⚠️ Skipping update - generic metadata would override valid display:', {
                        currentArtist,
                        currentTitle,
                        incomingArtist: artist,
                        incomingTitle: title
                    });
                    return;
                }

                // Only update the DOM if we didn't restore metadata (i.e., we have valid new metadata)
                try {
                    // Add prefixes to the display
                    artistElement.textContent = (artist || 'Now Playing');
                    titleElement.textContent = title;
                    console.log('✅ Updated DOM with song info');
                } catch (e) {
                    console.error('❌ Error updating DOM elements:', e);
                    return;
                }

                // Update the document title
                try {
                    document.title = `${title} - ${artist} | Jammin 92.3`;
                    console.log('📌 Updated document title');
                } catch (e) {
                    console.warn('⚠️ Could not update document title:', e);
                }

                // Update the Media Session API if available
                try {
                    if ('mediaSession' in navigator) {
                        navigator.mediaSession.metadata = new MediaMetadata({
                            title: title,
                            artist: artist,
                            album: 'Jammin 92.3 Live',
                            artwork: [
                                {src: '/images/logo.png', sizes: '512x512', type: 'image/png'},
                                {src: '/images/logo-192x192.png', sizes: '192x192', type: 'image/png'},
                                {src: '/images/logo-512x512.png', sizes: '512x512', type: 'image/png'}
                            ]
                        });
                        console.log('📱 Updated Media Session API');
                    } else {
                        console.log('ℹ️ Media Session API not available');
                    }
                } catch (e) {
                    console.warn('⚠️ Error updating Media Session API:', e);
                }

                // Make sure the player is visible
                if (stickyPlayer) {
                    stickyPlayer.style.display = 'flex';
                    console.log('👁️ Ensured player is visible');
                }

                console.log('✅ Song info update complete');
            }

            // Function to get the next metadata URL to try
            function getNextMetadataUrl() {
                currentEndpointIndex++;
                if (currentEndpointIndex >= metadataEndpoints.length) {
                    currentEndpointIndex = 0;
                    currentProxyIndex = (currentProxyIndex + 1) % corsProxies.length;
                }

                const baseUrl = streamUrl.replace(/\/$/, ''); // Remove trailing slash if exists
                const endpoint = metadataEndpoints[currentEndpointIndex];
                const proxy = corsProxies[currentProxyIndex];

                // Special handling for corsproxy.io which needs the URL as a query parameter
                if (proxy.includes('corsproxy.io')) {
                    return proxy + encodeURIComponent(baseUrl + endpoint);
                }

                return proxy + baseUrl + endpoint;
            }

            // Test if we can access fetchMetadata
            console.log('Defining fetchMetadata function');

            // Test if fetchMetadata is callable
            try {
                console.log('Testing fetchMetadata callable:', typeof fetchMetadata === 'function');
                if (typeof fetchMetadata === 'function') {
                    console.log('Calling fetchMetadata directly...');
                    fetchMetadata().then(() => {
                        console.log('fetchMetadata call completed');
                    }).catch(err => {
                        console.error('Error in fetchMetadata:', err);
                    });
                } else {
                    console.error('fetchMetadata is not a function');
                }
            } catch (e) {
                console.error('Error testing fetchMetadata:', e);
            }

            // Function to set up Radiomast SSE metadata streaming
            function setupRadiomastMetadata() {
                console.log('🎵 Setting up Radiomast SSE metadata...');

                try {
                    const metadataUrl = streamUrl + '/metadata';
                    console.log('Connecting to metadata endpoint:', metadataUrl);

                    const eventSource = new EventSource(metadataUrl);

                    eventSource.onopen = function () {
                        console.log('✅ Connected to Radiomast metadata stream');
                        // Don't override metadata when connecting to stream
                        // Let the persisted metadata remain visible
                    };

                    eventSource.onmessage = function (event) {
                        try {
                            console.log('📡 Received metadata event:', event.data);

                            const metadata = JSON.parse(event.data);
                            const artistTitle = metadata['metadata'];

                            if (artistTitle) {
                                console.log('🎵 Now Playing:', artistTitle);

                                // Parse artist and title from the metadata string
                                // Format is typically "Artist - Title"
                                let artist = 'Jammin Radio';
                                let title = artistTitle;

                                if (artistTitle.includes(' - ')) {
                                    const parts = artistTitle.split(' - ');
                                    if (parts.length >= 2) {
                                        artist = parts[0].trim();
                                        title = parts.slice(1).join(' - ').trim();
                                    }
                                }

                                // Check if this is generic metadata that would override persisted data
                                const isGeneric = artist === 'Jammin Radio' ||
                                    title === 'Jammin Radio' ||
                                    artist === 'Live Stream' ||
                                    title === 'Live Stream' ||
                                    artist === 'Loading...' ||
                                    title === 'Loading metadata...';

                                if (isGeneric) {
                                    console.log('⚠️ Received generic metadata from SSE, checking for persisted data first...');
                                    // Try to restore persisted metadata instead of showing generic data
                                    if (restorePersistedMetadata()) {
                                        console.log('✅ Restored persisted metadata, ignoring generic SSE data');
                                        return;
                                    }
                                }

                                // Update the mini player with parsed metadata
                                updateSongInfo({
                                    title: title,
                                    artist: artist,
                                    song: title
                                });
                            }
                        } catch (error) {
                            console.error('❌ Error parsing metadata:', error);
                        }
                    };

                    eventSource.onerror = function (error) {
                        console.error('❌ EventSource error:', error);
                        console.log('Attempting to reconnect in 5 seconds...');

                        // Close the current connection
                        eventSource.close();

                        // Try to reconnect after 5 seconds
                        setTimeout(setupRadiomastMetadata, 5000);
                    };

                    // Store the eventSource for cleanup
                    window.radiomastEventSource = eventSource;

                } catch (error) {
                    console.error('❌ Failed to setup Radiomast metadata:', error);
                    // Fallback to old method
                    fetchMetadataFallback();
                }
            }

            // Function to fetch metadata from the stream (fallback method)
            async function fetchMetadata() {
                console.log('fetchMetadata called with streamUrl:', streamUrl);

                if (!streamUrl) {
                    console.error('❌ Stream URL is empty or undefined');
                    updateSongInfo('Stream URL not configured');
                    return;
                }

                // If using a blob URL, try to get the original stream URL
                let metadataUrl = streamUrl;
                if (streamUrl.startsWith('blob:')) {
                    // Try to get the original stream URL from the audio element
                    if (audio && audio.src && !audio.src.startsWith('blob:')) {
                        metadataUrl = audio.src;
                    } else {
                        console.log('Using fallback stream URL for metadata');
                        metadataUrl = 'https://streams.radiomast.io/jammin92_live';
                    }
                }

                console.log('🔍 Starting metadata fetch from:', streamUrl);

                // Try to restore persisted metadata instead of showing loading state
                if (!restorePersistedMetadata()) {
                    updateSongInfo('Loading metadata...');
                }

                try {
                    // 1. First try: Server-side endpoint with direct stream URL
                    console.log('1️⃣ Trying server-side metadata endpoint with stream URL:', metadataUrl);
                    try {
                        const response = await fetch(`/admin/api/stream-metadata?streamUrl=${encodeURIComponent(metadataUrl)}`, {
                            method: 'GET',
                            headers: {
                                'Accept': 'application/json',
                                'Cache-Control': 'no-cache',
                                'Pragma': 'no-cache',
                                'X-Requested-With': 'XMLHttpRequest'
                            },
                            cache: 'no-store',
                            credentials: 'same-origin'
                        });

                        console.log('📡 Server response status:', response.status, response.statusText);

                        if (response.ok) {
                            const data = await response.json();
                            console.log('✅ Server metadata response:', data);

                            if (data && (data.title || data.artist || data.song)) {
                                // Pass the entire data object to handle structured metadata
                                updateSongInfo({
                                    artist: data.artist,
                                    song: data.song,
                                    title: data.title
                                });
                                console.log('🎵 Updated from server metadata:', data);
                                return true;
                            } else {
                                console.warn('⚠️ No valid metadata in server response');
                            }
                        } else {
                            console.warn(`⚠️ Server responded with ${response.status}: ${response.statusText}`);
                        }
                    } catch (serverError) {
                        console.warn('⚠️ Server metadata fetch failed:', serverError);
                    }

                    // 2. Second try: Direct stream metadata endpoints
                    console.log('2️⃣ Trying direct stream metadata endpoints...');
                    const endpoints = [
                        '/status-json.xsl',
                        '/status-json',
                        '/status.xsl',
                        '/status',
                        '/7.html',
                        '/currentsong',
                        '/now_playing',
                        '/streaminfo',
                        '/nowplaying',
                        '/api/nowplaying',
                        '/api/nowplaying/1',
                        '/api/nowplaying/0',
                        '/live-32.aac',
                        '/live-64.aac',
                        '/live-128.aac',
                        '/live-256.aac'
                    ];

                    for (const endpoint of endpoints) {
                        try {
                            const url = new URL(streamUrl);
                            const metadataUrl = `${url.origin}${endpoint}`;

                            console.log(`   🔄 Trying endpoint: ${metadataUrl}`);

                            const response = await fetch(metadataUrl, {
                                method: 'GET',
                                cache: 'no-store',
                                headers: {
                                    'Accept': 'application/json, text/plain, */*',
                                    'X-Requested-With': 'XMLHttpRequest'
                                }
                            });

                            if (!response.ok) {
                                console.log(`   ⚠️ Endpoint ${endpoint} returned ${response.status}`);
                                continue;
                            }

                            const contentType = response.headers.get('content-type') || '';
                            let data;

                            try {
                                if (contentType.includes('application/json')) {
                                    data = await response.json();
                                } else {
                                    const text = await response.text();
                                    // Try to parse as JSON even if content-type doesn't match
                                    try {
                                        data = JSON.parse(text);
                                    } catch {
                                        data = text;
                                    }
                                }

                                console.log(`   ✅ Got response from ${endpoint}:`, data);

                                // Try to extract title from common formats
                                let title = '';

                                // Check for common JSON formats
                                if (data && typeof data === 'object') {
                                    const source = data.icestats?.source ||
                                        data.shoutcast?.source ||
                                        data.source ||
                                        (data.icestats?.sources && data.icestats.sources[0]) ||
                                        (data.shoutcast?.sources && data.shoutcast.sources[0]);

                                    title = source?.title ||
                                        data.now_playing?.song?.text ||
                                        data.now_playing?.song?.title ||
                                        data.songtitle ||
                                        data.title ||
                                        data.now_playing?.title ||
                                        data.stream_title;
                                }
                                // Check for SHOUTcast 7.html format (CSV)
                                else if (typeof data === 'string' && data.includes(',')) {
                                    const parts = data.split(',');
                                    if (parts.length >= 7) {
                                        title = parts[6].trim();
                                    }
                                }
                                // Check for plain text response
                                else if (typeof data === 'string') {
                                    title = data.trim();
                                }

                                if (title) {
                                    console.log('   🎵 Extracted title:', title);
                                    updateSongInfo(title);
                                    return true;
                                }

                            } catch (parseError) {
                                console.warn(`   ⚠️ Error parsing response from ${endpoint}:`, parseError);
                            }

                        } catch (endpointError) {
                            console.warn(`   ⚠️ Error fetching ${endpoint}:`, endpointError.message);
                        }
                    }

                    console.log('3️⃣ Trying audio element metadata as last resort...');
                    // 3. Final fallback: Audio element metadata
                    const success = updateSongInfoFromAudio();
                    if (success) {
                        console.log('✅ Successfully got metadata from audio element');
                        return true;
                    }

                    // If we get here, all methods failed
                    console.warn('❌ All metadata fetch methods failed');
                    // Try to restore persisted metadata instead of showing fallback
                    if (!restorePersistedMetadata()) {
                        console.log('ℹ️ No persisted metadata to restore, showing fallback');
                        updateSongInfo('Live Stream');
                    }
                    return false;

                } catch (error) {
                    console.error('❌ Critical error in fetchMetadata:', error);
                    // Try to restore persisted metadata instead of showing error
                    if (!restorePersistedMetadata()) {
                        console.log('ℹ️ No persisted metadata to restore, showing error');
                        updateSongInfo('Error loading metadata');
                    }
                    return false;
                }
            }

            // Function to update song info from audio element metadata
            function updateSongInfoFromAudio() {
                try {
                    const audio = document.getElementById('mini-player-audio');
                    if (!audio) {
                        console.warn('⚠️ Audio element not found');
                        return false;
                    }

                    // Try to get metadata from audio element
                    const title = audio.getAttribute('data-title') || audio.title || '';
                    const artist = audio.getAttribute('data-artist') || '';

                    if (title || artist) {
                        const metadata = {
                            title: title || 'Unknown Song',
                            artist: artist || 'Unknown Artist'
                        };
                        updateSongInfo(metadata);
                        return true;
                    }

                    // Try to extract from audio src if available
                    const src = audio.src || '';
                    if (src && src.includes('title=')) {
                        try {
                            const url = new URL(src);
                            const title = url.searchParams.get('title');
                            const artist = url.searchParams.get('artist');

                            if (title || artist) {
                                const metadata = {
                                    title: title || 'Unknown Song',
                                    artist: artist || 'Unknown Artist'
                                };
                                updateSongInfo(metadata);
                                return true;
                            }
                        } catch (e) {
                            console.warn('⚠️ Could not parse URL for metadata:', e);
                        }
                    }

                    console.log('⚠️ No metadata found in audio element');
                    return false;

                } catch (error) {
                    console.error('❌ Error in updateSongInfoFromAudio:', error);
                    return false;
                }
            }

            // Helper function to fetch with credentials and handle CORS
            async function fetchWithFallback(url, useProxy = false) {
                try {
                    const init = {
                        method: 'GET',
                        headers: {'Accept': 'application/json'},
                        cache: 'no-store',
                        credentials: useProxy ? 'omit' : 'include',
                        mode: useProxy ? 'cors' : 'no-cors'
                    };

                    return await fetch(url, init);
                } catch (error) {
                    console.error('Fetch error:', error);
                    throw error;
                }
            }

            // Fallback to rotating metadata when we can't fetch from the stream
            function useFallbackMetadata() {
                const fallback = fallbackMetadata[fallbackIndex];
                // Use updateSongInfo to ensure persistence system is respected
                updateSongInfo({
                    artist: fallback.artist,
                    title: fallback.title,
                    song: fallback.title
                });
                fallbackIndex = (fallbackIndex + 1) % fallbackMetadata.length;

                // Try to reconnect after a delay
                if (retryCount < maxRetries * metadataEndpoints.length) {
                    retryCount++;
                    setTimeout(fetchMetadata, 5000);
                }
            }

            // Fallback method using audio element (slower)
            function fetchMetadataFallback() {
                if (retryCount >= maxRetries) return;

                const audioMeta = new Audio(streamUrl);
                audioMeta.crossOrigin = 'anonymous';
                audioMeta.preload = 'metadata';

                const timeout = setTimeout(() => {
                    audioMeta.pause();
                    audioMeta.src = '';
                    retryCount++;
                    if (retryCount < maxRetries) {
                        setTimeout(fetchMetadata, 2000 * retryCount); // Exponential backoff
                    }
                }, 2000); // Shorter timeout for fallback

                audioMeta.onloadedmetadata = function () {
                    clearTimeout(timeout);
                    if (audioMeta.metadata && audioMeta.metadata.title) {
                        updateSongInfo(audioMeta.metadata.title);
                        retryCount = 0;
                    }
                    audioMeta.pause();
                    audioMeta.src = '';
                };

                audioMeta.onerror = function () {
                    clearTimeout(timeout);
                    audioMeta.pause();
                    audioMeta.src = '';
                    retryCount++;
                    if (retryCount < maxRetries) {
                        setTimeout(fetchMetadata, 2000 * retryCount);
                    }
                };

                try {
                    audioMeta.load();
                } catch (e) {
                    console.error('Error loading audio metadata:', e);
                }
            }

            // Set up the audio element for playback
            if (audio) {
                audio.crossOrigin = 'anonymous'; // Required for some streams to allow metadata access

                // Listen for play events
                document.querySelectorAll('.listen-btn').forEach(btn => {
                    btn.addEventListener('click', function (e) {
                        e.preventDefault();
                        if (audio.paused) {
                            audio.src = streamUrl;
                            audio.play().then(() => {
                                if (stickyPlayer) {
                                    stickyPlayer.style.display = 'flex';
                                }
                                if (miniPlayIcon) {
                                    miniPlayIcon.className = 'fas fa-pause';
                                }
                                startMetadataUpdates();
                            }).catch(error => {
                                console.error('Error playing audio:', error);
                            });
                        } else {
                            audio.pause();
                            if (miniPlayIcon) {
                                miniPlayIcon.className = 'fas fa-play';
                            }
                        }
                    });
                });

                // Set up play/pause button in the sticky player
                const playBtn = document.getElementById('play-btn');
                if (playBtn) {
                    playBtn.addEventListener('click', function () {
                        if (audio.paused) {
                            audio.play().then(() => {
                                if (miniPlayIcon) {
                                    miniPlayIcon.className = 'fas fa-pause';
                                }
                            });
                        } else {
                            audio.pause();
                            if (miniPlayIcon) {
                                miniPlayIcon.className = 'fas fa-play';
                            }
                        }
                    });
                }

                // Clean up on page unload
                window.addEventListener('beforeunload', function () {
                    if (metadataInterval) {
                        clearInterval(metadataInterval);
                    }
                });
            }

            // Function to check audio element for metadata
            function checkAudioMetadata() {
                if (!audio) return;

                console.log('Checking audio element for metadata...');

                // Try to get metadata from the audio element
                try {
                    // Create a temporary audio context to analyze the stream
                    const AudioContext = window.AudioContext || window.webkitAudioContext;
                    if (AudioContext) {
                        const audioContext = new AudioContext();
                        const source = audioContext.createMediaElementSource(audio);

                        // Just connect to destination to keep the context alive
                        source.connect(audioContext.destination);

                        console.log('Audio context created, checking for metadata...');
                    }

                    // Check for metadata events
                    audio.onloadedmetadata = function () {
                        console.log('Audio metadata loaded:', {
                            duration: audio.duration,
                            readyState: audio.readyState,
                            error: audio.error
                        });
                    };

                    // Check for errors
                    audio.onerror = function () {
                        console.error('Audio element error:', audio.error);
                    };

                    // Check for metadata updates
                    if ('mediaSession' in navigator) {
                        navigator.mediaSession.setActionHandler('play', () => audio.play());
                        navigator.mediaSession.setActionHandler('pause', () => audio.pause());
                    }

                } catch (e) {
                    console.error('Error checking audio metadata:', e);
                }
            }

            // Function to initialize the player
            // Global variable to store the metadata update interval

            function initializePlayer() {
                console.log('Initializing player...');

                // Show the player immediately
                if (stickyPlayer) {
                    stickyPlayer.style.display = 'flex';
                    console.log('Sticky player shown');
                } else {
                    console.error('Sticky player element not found');
                }

                // Set initial metadata - try to restore persisted metadata first
                if (!restorePersistedMetadata()) {
                    updateSongInfo('Loading...');
                }

                // Set up audio element if it exists
                if (audio) {
                    console.log('Audio element found, setting up...');

                    // Set the audio source
                    audio.src = streamUrl;
                    audio.preload = 'metadata';
                    audio.crossOrigin = 'anonymous'; // Important for CORS

                    // Store the original stream URL for metadata fetching
                    audio.dataset.originalSrc = streamUrl;

                    // Set up event listeners
                    audio.onplay = function () {
                        console.log('Audio playback started');
                        if (miniPlayIcon) {
                            miniPlayIcon.className = 'fas fa-pause';
                        }
                        // Start updating metadata when playback starts
                        startMetadataUpdates();

                        // Try to get metadata from audio element
                        setTimeout(() => {
                            console.log('🎵 Checking audio element metadata...');
                            console.log('Audio src:', audio.src);
                            console.log('Audio currentSrc:', audio.currentSrc);
                            console.log('Audio mediaKeys:', audio.mediaKeys);
                            console.log('Audio readyState:', audio.readyState);
                            console.log('Audio networkState:', audio.networkState);

                            // Check for audio tracks metadata
                            if (audio.audioTracks && audio.audioTracks.length > 0) {
                                console.log('Audio tracks:', audio.audioTracks);
                                for (let i = 0; i < audio.audioTracks.length; i++) {
                                    console.log(`Track ${i}:`, audio.audioTracks[i]);
                                }
                            }

                            // Check for text tracks (might contain metadata)
                            if (audio.textTracks && audio.textTracks.length > 0) {
                                console.log('Text tracks:', audio.textTracks);
                                for (let i = 0; i < audio.textTracks.length; i++) {
                                    console.log(`Text track ${i}:`, audio.textTracks[i]);
                                }
                            }

                            // Try to extract from audio attributes
                            const title = audio.getAttribute('data-title') || audio.title;
                            const artist = audio.getAttribute('data-artist');

                            if (title || artist) {
                                console.log('Found metadata in audio attributes:', {title, artist});
                                updateSongInfo({title, artist});
                            }
                        }, 2000); // Check after 2 seconds
                    };

                    audio.onerror = function () {
                        console.error('Audio element error:', audio.error);
                        // Try to restore persisted metadata instead of showing error
                        if (!restorePersistedMetadata()) {
                            updateSongInfo('Error loading stream');
                        }
                        stopMetadataUpdates();
                    };

                    audio.onloadedmetadata = function () {
                        console.log('Audio metadata loaded:', {
                            duration: audio.duration,
                            readyState: audio.readyState,
                            error: audio.error
                        });

                        // Try to get metadata from the audio element
                        if (audio.mozHasAudioMetadata || audio.webkitAudioDecodedByteCount) {
                            console.log('Audio has metadata');
                            updateSongInfoFromAudio();
                        } else {
                            console.log('No metadata available in audio element');
                            // Try to restore persisted metadata instead of showing fallback
                            if (!restorePersistedMetadata()) {
                                updateSongInfo('Live Stream');
                            }
                        }
                    };

                    // Try to play the audio
                    const playPromise = audio.play();

                    if (playPromise !== undefined) {
                        playPromise.catch(error => {
                            console.error('Play error:', error);
                            // If autoplay is blocked, update UI to show play button
                            if (miniPlayIcon) {
                                miniPlayIcon.className = 'fas fa-play';
                            }
                            // Don't override metadata when autoplay is blocked
                            // Let the persisted metadata remain visible
                        });
                    }

                } else {
                    console.error('Audio element not found');
                    // Try to restore persisted metadata instead of showing error
                    if (!restorePersistedMetadata()) {
                        console.log('ℹ️ No persisted metadata to restore, showing player error');
                        updateSongInfo('Player not available');
                    }
                }

                // Set up play/pause button
                const playBtn = document.getElementById('play-btn');
                if (playBtn) {
                    playBtn.onclick = function () {
                        if (audio.paused) {
                            audio.play().catch(e => console.error('Play error:', e));
                        } else {
                            audio.pause();
                        }
                    };
                }

                console.log('Player initialization complete');
            }

            function startMetadataUpdates() {
                console.log('🔄 Starting metadata updates...');

                // First, try to restore any persisted metadata with a small delay to ensure DOM is ready
                console.log('🔄 Attempting to restore persisted metadata on page load...');
                setTimeout(() => {
                    const restoreResult = restorePersistedMetadata();
                    console.log('📝 Restore result:', restoreResult);
                    if (restoreResult) {
                        console.log('✅ Successfully restored persisted metadata on page load');
                    } else {
                        console.log('ℹ️ No persisted metadata found or metadata was invalid');
                    }
                }, 100); // Small delay to ensure DOM elements are available

                // Clear any existing interval
                stopMetadataUpdates();

                // Close any existing EventSource connection
                if (window.radiomastEventSource) {
                    window.radiomastEventSource.close();
                    console.log('Closed existing EventSource connection');
                }

                // Add a flag to track if we have restored metadata
                let hasRestoredMetadata = false;

                // Use Radiomast SSE for real-time metadata, but with protection
                setTimeout(() => {
                    console.log('🎵 Setting up Radiomast SSE with metadata protection...');
                    setupRadiomastMetadata();
                }, 2000); // Delay SSE setup to allow restoration to complete

                // Fallback: Set up periodic updates using old method (every 5 minutes)
                // This is much less frequent to avoid interfering with persisted metadata
                metadataInterval = setInterval(() => {
                    console.log('🔄 Running fallback metadata check (infrequent)...');
                    // Only fetch if we don't have restored metadata or it's been a long time
                    const persisted = getPersistedMetadata();
                    if (!persisted.artist || !persisted.title || Date.now() - persisted.timestamp > 600000) {
                        fetchMetadata().catch(console.error);
                    } else {
                        console.log('⏭️ Skipping fallback check - valid persisted metadata exists');
                    }
                }, 300000); // 5 minutes instead of 30 seconds

                console.log('Started metadata updates with SSE + fallback');
            }

            function stopMetadataUpdates() {
                console.log('⏹️ Stopping metadata updates...');

                // Clear the interval
                if (metadataInterval) {
                    clearInterval(metadataInterval);
                    metadataInterval = null;
                }

                // Close EventSource connection
                if (window.radiomastEventSource) {
                    window.radiomastEventSource.close();
                    window.radiomastEventSource = null;
                    console.log('Closed EventSource connection');
                }

                console.log('Stopped metadata updates');
            }

            // Debug: Log all available functions
            console.log('Available functions:', {
                initializePlayer: typeof initializePlayer,
                startMetadataUpdates: typeof startMetadataUpdates,
                fetchMetadata: typeof fetchMetadata,
                updateSongInfo: typeof updateSongInfo
            });

            // Start the player
            console.log('Initializing player...');
            try {
                initializePlayer();
                console.log('Player initialized successfully');
            } catch (e) {
                console.error('Error initializing player:', e);
            }

            // Set up metadata updates with error handling
            function startUpdates() {
                console.log('Starting metadata updates...');
                try {
                    startMetadataUpdates();
                    console.log('Metadata updates started');

                    // Note: Removed immediate fetchMetadata call to avoid overriding persisted metadata
                    // The SSE connection and fallback polling will handle metadata updates

                } catch (e) {
                    console.error('Error starting metadata updates:', e);
                }
            }

            // Start updates after a short delay
            setTimeout(startUpdates, 1000);

            // Clean up on page unload
            window.addEventListener('beforeunload', function () {
                console.log('Cleaning up...');
                if (window.metadataInterval) {
                    console.log('Clearing metadata interval');
                    clearInterval(window.metadataInterval);
                }
            });

            // Start the player
            console.log('Initializing player...');
            try {
                initializePlayer();
                console.log('Player initialized successfully');

                // Start metadata updates for persistence
                console.log('Starting metadata updates...');
                startMetadataUpdates();
            } catch (e) {
                console.error('Error initializing player:', e);
            }
        } catch (e) {
            console.error('Error in player initialization:', e);
        }
    });
</script>

<!-- Test script to verify JavaScript is running -->
<script>
    // Simple metadata initialization fallback
    document.addEventListener('DOMContentLoaded', function () {
        setTimeout(function () {
            const currentArtist = document.getElementById('current-artist');
            const currentTitle = document.getElementById('current-title');

            if (currentArtist && currentTitle) {
                // If metadata is still loading, set fallback values
                if (currentArtist.textContent === 'Loading...' || !currentArtist.textContent.trim()) {
                    currentArtist.textContent = 'Jammin Radio';
                    currentTitle.textContent = 'Live Stream';
                    console.log('📝 Set fallback metadata');
                }
            }
        }, 3000); // Wait 3 seconds for other scripts to load
    });
</script>
<script>
    console.log('Test script loaded');
</script>

<!-- Concert Search Script -->
<script>
    // Load concerts on page load
    document.addEventListener('DOMContentLoaded', function () {
        console.log('DOM loaded, initializing concert search...');
        loadConcerts();

        // Add event listeners to buttons using IDs
        const searchBtn = document.getElementById('searchConcertsBtn');
        const cityInput = document.getElementById('cityInput');

        console.log('Found elements:', {searchBtn, cityInput});

        if (searchBtn) {
            console.log('✅ Adding click listener to search button');
            searchBtn.addEventListener('click', function (e) {
                e.preventDefault();
                console.log('🖱️ Search button clicked via event listener');
                searchConcertsByCity();
            });

            // Also test direct onclick
            searchBtn.onclick = function (e) {
                e.preventDefault();
                console.log('🖱️ Search button clicked via onclick');
                searchConcertsByCity();
            };
        } else {
            console.error('❌ Search button not found');
        }


        // Allow Enter key in city input
        if (cityInput) {
            cityInput.addEventListener('keypress', function (e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    console.log('Enter key pressed in city input');
                    searchConcertsByCity();
                }
            });
        } else {
            console.error('City input not found');
        }

        // Make functions globally accessible for debugging
        window.searchConcertsByCity = searchConcertsByCity;

        console.log('🌍 Functions made globally accessible');
    });

    // Search concerts by city
    function searchConcertsByCity() {
        console.log('🔍 searchConcertsByCity() called');
        const city = document.getElementById('cityInput').value.trim();
        console.log('City input value:', city);

        // Clear any previous location data
        sessionStorage.removeItem('userLocation');

        if (city) {
            console.log('Loading concerts for city:', city);
            loadConcerts(city);
        } else {
            console.log('Loading default concerts');
            loadConcerts();
        }
    }


    // Load concerts from API
    function loadConcerts(city = null, latitude = null, longitude = null) {
        console.log('🎵 loadConcerts called with:', {city, latitude, longitude});

        try {
            showConcertsLoading();

            let url = '/api/concerts';
            let params = new URLSearchParams();

            if (city) {
                params.append('city', city);
                console.log('Loading concerts for city:', city);
            }
            if (latitude && longitude) {
                params.append('latitude', latitude);
                params.append('longitude', longitude);
                console.log('Loading concerts near location:', {latitude, longitude});
            }

            if (params.toString()) {
                url += '?' + params.toString();
            }

            console.log('🌐 Fetching concerts from:', url);

            fetch(url)
                .then(response => {
                    console.log('📡 Response received:', response.status, response.statusText);
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('✅ Concerts loaded successfully:', data);

                    if (data.error) {
                        throw new Error(data.message || 'API returned an error');
                    }

                    displayConcerts(data, city, latitude, longitude);
                })
                .catch(error => {
                    console.error('❌ Error loading concerts:', error);

                    // Clear container first
                    const container = document.getElementById('concerts-container');
                    if (container) {
                        container.innerHTML = '';

                        // Show user-friendly error message
                        const errorDiv = document.createElement('div');
                        errorDiv.className = 'col-12';
                        errorDiv.innerHTML = `
                                <div class="alert alert-warning">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    <strong>Unable to load live concert data.</strong>
                                    Error: ${error.message}. Showing sample concerts instead.
                                </div>
                            `;
                        container.appendChild(errorDiv);
                    }

                    displayFallbackConcerts();
                })
                .finally(() => {
                    hideConcertsLoading();
                });
        } catch (error) {
            console.error('❌ Critical error in loadConcerts:', error);
            hideConcertsLoading();
            displayFallbackConcerts();
        }
    }

    // Display concerts in the UI
    function displayConcerts(concerts, city = null, latitude = null, longitude = null) {
        const container = document.getElementById('concerts-container');
        container.innerHTML = '';

        // Add location info header
        if (city || (latitude && longitude)) {
            const locationHeader = document.createElement('div');
            locationHeader.className = 'col-12 mb-3';

            let locationText = '';
            if (city) {
                locationText = `Concerts in ${city}`;
            } else if (latitude && longitude) {
                locationText = `Concerts near your location (sorted by distance)`;
            }

            locationHeader.innerHTML = `
                    <div class="alert alert-info">
                        <i class="fas fa-map-marker-alt"></i>
                        <strong>${locationText}</strong>
                        ${concerts && concerts.length > 0 ? ` - Found ${concerts.length} events` : ''}
                    </div>
                `;
            container.appendChild(locationHeader);
        }

        if (!concerts || concerts.length === 0) {
            displayFallbackConcerts();
            return;
        }

        concerts.forEach((concert, index) => {
            const concertCard = createConcertCard(concert, index);
            container.appendChild(concertCard);
        });
    }

    // Create individual concert card
    function createConcertCard(concert, index) {
        const col = document.createElement('div');
        col.className = 'col-md-4 mb-4';

        const icons = ['fas fa-guitar', 'fas fa-drum', 'fas fa-microphone', 'fas fa-music', 'fas fa-headphones', 'fas fa-compact-disc'];
        const icon = icons[index % icons.length];

        const formatDate = (dateStr, timeStr) => {
            if (!dateStr) return 'Date TBA';

            const date = new Date(dateStr + (timeStr ? 'T' + timeStr : ''));
            const options = {
                weekday: 'short',
                year: 'numeric',
                month: 'short',
                day: 'numeric',
                hour: timeStr ? 'numeric' : undefined,
                minute: timeStr ? '2-digit' : undefined
            };

            return date.toLocaleDateString('en-US', options);
        };

        const venueText = concert.venue ?
            `${concert.venue.name}${concert.venue.city ? ', ' + concert.venue.city : ''}` :
            'Venue TBA';

        col.innerHTML = `
                <div class="card h-100 shadow-sm">
                    ${concert.image ?
            `<div class="position-relative" style="height: 192px; overflow: hidden;">
                            <img src="${concert.image}" alt="${concert.name}"
                                 class="w-100 h-100" style="object-fit: cover; border-radius: 0.375rem 0.375rem 0 0;"
                                 onerror="this.parentElement.innerHTML='<div class=\\'card-img\\' style=\\'height: 192px; display: flex; align-items: center; justify-content: center; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);\\' ><i class=\\'${icon} text-white\\'></i></div>'">
                         </div>` :
            `<div class="card-img" style="height: 192px;"><i class="${icon}"></i></div>`
        }
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">${concert.name}</h5>
                        <div class="mb-2">
                            <small class="text-muted">
                                <i class="fas fa-calendar-alt"></i> ${formatDate(concert.date, concert.time)}
                            </small>
                        </div>
                        <div class="mb-2">
                            <small class="text-muted">
                                <i class="fas fa-map-marker-alt"></i> ${venueText}
                            </small>
                        </div>
                        ${concert.genre ?
            `<div class="mb-2">
                                <span class="badge bg-secondary">${concert.genre}</span>
                            </div>` : ''
        }
                        ${concert.price_range ?
            `<div class="mb-2">
                                <small class="text-success">
                                    <i class="fas fa-ticket-alt"></i> ${concert.price_range}
                                </small>
                            </div>` : ''
        }
                        <div class="mt-auto">
                            <a href="${concert.ticket_url || '#'}" target="_blank"
                               class="btn btn-primary btn-sm w-100">
                                <i class="fas fa-ticket-alt"></i> Get Tickets
                            </a>
                            <small class="text-muted d-block mt-1 text-center">
                                via ${concert.source || 'Ticketmaster'}
                            </small>
                        </div>
                    </div>
                </div>
            `;

        return col;
    }

    // Show loading state
    function showConcertsLoading() {
        const loadingElement = document.getElementById('concerts-loading');
        if (loadingElement) {
            loadingElement.style.display = 'block';
            console.log('✅ Loading state shown');
        } else {
            console.error('❌ Loading element not found');
        }
    }

    // Hide loading state
    function hideConcertsLoading() {
        const loadingElement = document.getElementById('concerts-loading');
        if (loadingElement) {
            loadingElement.style.display = 'none';
            console.log('✅ Loading state hidden');
        } else {
            console.error('❌ Loading element not found');
        }
    }

    // Display ticket booking website links when no concerts found
    function displayFallbackConcerts() {
        const container = document.getElementById('concerts-container');
        container.innerHTML = '';

        const fallbackDiv = document.createElement('div');
        fallbackDiv.className = 'col-12 text-center';
        fallbackDiv.innerHTML = `
                <div class="card p-5">
                    <div class="mb-4">
                        <i class="fas fa-search fa-3x text-muted mb-3"></i>
                        <h4>No concerts found in your area</h4>
                        <p class="text-muted">You might find your search results in these popular ticket booking websites:</p>
                    </div>

                    <div class="row g-3 justify-content-center">
                        <div class="col-md-4">
                            <a href="https://www.ticketmaster.com" target="_blank" class="btn btn-outline-primary btn-lg w-100 d-flex align-items-center justify-content-center">
                                <i class="fas fa-ticket-alt me-2"></i>
                                Ticketmaster
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="https://www.stubhub.com" target="_blank" class="btn btn-outline-primary btn-lg w-100 d-flex align-items-center justify-content-center">
                                <i class="fas fa-music me-2"></i>
                                StubHub
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="https://www.vivid-seats.com" target="_blank" class="btn btn-outline-primary btn-lg w-100 d-flex align-items-center justify-content-center">
                                <i class="fas fa-calendar-alt me-2"></i>
                                Vivid Seats
                            </a>
                        </div>
                    </div>

                    <div class="mt-4">
                        <small class="text-muted">
                            <i class="fas fa-info-circle me-1"></i>
                            These are popular USA-based concert ticket booking platforms
                        </small>
                    </div>
                </div>
            `;

        container.appendChild(fallbackDiv);
    }

    // Smart App Detection and Deep Linking
    document.addEventListener('DOMContentLoaded', function () {
        // App configuration - Update these with your actual app details
        const appConfig = {
            ios: {
                scheme: 'jamminradio://', // Your iOS app scheme
                storeUrl: 'https://apps.apple.com/app/idYOUR_IOS_APP_ID', // Your iOS App Store URL
                packageName: null
            },
            android: {
                scheme: 'com.jamminradio.app', // Your Android app package name
                storeUrl: 'https://play.google.com/store/apps/details?id=com.jamminradio.app', // Your Play Store URL
                packageName: 'com.jamminradio.app'
            }
        };

        // Get device type
        function getDeviceType() {
            const userAgent = navigator.userAgent.toLowerCase();

            if (/iphone|ipad|ipod/.test(userAgent)) {
                return 'ios';
            } else if (/android/.test(userAgent)) {
                return 'android';
            }
            return 'unknown';
        }

        // Try to open app via deep link
        function openApp(deepLink, fallbackUrl) {
            console.log('Attempting to open app with deep link:', deepLink);

            // Try to open the app
            window.location.href = deepLink;

            // Set a timeout to redirect to app store if app doesn't open
            setTimeout(function () {
                console.log('App not detected, redirecting to app store');
                window.location.href = fallbackUrl;
            }, 2000); // 2 second delay
        }

        // Open App button click handler
        document.getElementById('openAppBtn').addEventListener('click', function () {
            const deviceType = getDeviceType();
            const config = appConfig[deviceType];

            if (deviceType === 'unknown' || !config) {
                alert('Please use a mobile device to open the app');
                return;
            }

            if (deviceType === 'ios') {
                openApp(config.scheme, config.storeUrl);
            } else if (deviceType === 'android') {
                const deepLink = `intent://${config.scheme}/#Intent;scheme=${config.scheme};package=${config.packageName};end;`;
                openApp(deepLink, config.storeUrl);
            }
        });

        // Download App button click handler
        document.getElementById('downloadAppBtn').addEventListener('click', function () {
            const deviceType = getDeviceType();
            const config = appConfig[deviceType];

            if (deviceType === 'unknown' || !config) {
                // If device type is unknown, show both options
                const choice = confirm('Are you using iOS or Android?\n\nClick OK for iOS, Cancel for Android');
                if (choice) {
                    window.open(appConfig.ios.storeUrl, '_blank');
                } else {
                    window.open(appConfig.android.storeUrl, '_blank');
                }
                return;
            }

            // Open the appropriate app store
            window.open(config.storeUrl, '_blank');
        });

        // Log device detection for debugging
        console.log('Device type detected:', getDeviceType());
    });

</script>

<!-- Sticky Player -->
<div class="sticky-player" id="sticky-player">
    <div class="player-controls">
        <div class="player-info" style="cursor: pointer;">
            <div class="mini-player-icon" id="mini-play-btn">
                <i class="fas fa-play" id="mini-play-icon"></i>
            </div>
            <div>
                <div class="player-title">Radio Station Live</div>
                <div class="player-song" id="mini-song">
                    <div id="current-artist">Loading...</div>
                    <div id="current-title"></div>
                </div>
            </div>
        </div>
        <div class="player-buttons">
            <button class="player-btn minimize-btn" id="minimize-btn" title="Minimize">
                <i class="fas fa-chevron-down"></i>
            </button>
        </div>
        <!-- Hidden audio element -->
        <audio id="live-audio" preload="metadata" style="display: none;" crossorigin="anonymous">
            <source src="{{ config('app.stream_url') }}" type="audio/mpeg">
            Your browser does not support the audio element.
        </audio>
    </div>
</div>

<!-- App Download Modal -->
<div class="modal fade" id="appDownloadModal" tabindex="-1" aria-labelledby="appDownloadModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title" id="appDownloadModalLabel">
                    <i class="fas fa-mobile-alt me-2"></i>Get Jammin Radio App
                </h5>
                <button type="button" class="custom-close-btn" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body text-center">
                <div class="app-icon mb-3">
                    <img src="{{ asset('Landscape_Logo.png') }}" alt="Jammin Radio Logo" class="img-fluid"
                         style="max-width: 160px; height: auto; background: transparent;">
                </div>
                <p class="text-muted mb-4">Listen to your favorite music anytime, anywhere</p>

                <p class="mb-3 fw-bold">Choose your platform:</p>

                <div class="d-grid gap-3">
                    <button class="btn btn-success btn-lg" id="openAppBtn">
                        <i class="fas fa-external-link-alt me-2"></i>Open App
                    </button>
                    <button class="btn btn-primary btn-lg" id="iosAppBtn">
                        <i class="fab fa-apple me-2"></i>Download for iOS
                    </button>
                    <button class="btn btn-outline-primary btn-lg" id="androidAppBtn">
                        <i class="fab fa-google-play me-2"></i>Download for Android
                    </button>
                </div>

                <div class="mt-4">
                    <small class="text-muted">
                        Available on App Store and Google Play Store
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // App Download Modal Functionality
    document.addEventListener('DOMContentLoaded', function () {
        const openAppBtn = document.getElementById('openAppBtn');
        const iosAppBtn = document.getElementById('iosAppBtn');
        const androidAppBtn = document.getElementById('androidAppBtn');

        // App configuration - UPDATE THESE WITH YOUR ACTUAL APP DETAILS
        const appConfig = {
            ios: {
                scheme: 'jamminradio://', // Your iOS app scheme
                storeUrl: 'https://apps.apple.com/app/idYOUR_IOS_APP_ID', // Your iOS App Store URL
                packageName: null
            },
            android: {
                scheme: 'com.jamminradio.app', // Your Android app package name
                storeUrl: 'https://play.google.com/store/apps/details?id=com.jamminradio.app', // Your Play Store URL
                packageName: 'com.jamminradio.app'
            }
        };

        // Function to detect device type
        function getDeviceType() {
            const userAgent = navigator.userAgent.toLowerCase();

            if (/iphone|ipad|ipod/.test(userAgent)) {
                return 'ios';
            } else if (/android/.test(userAgent)) {
                return 'android';
            } else {
                return 'desktop';
            }
        }

        // Function to open app or redirect to store
        function openAppOrStore(platform) {
            const config = appConfig[platform];

            if (platform === 'ios') {
                // iOS deep linking
                const startTime = Date.now();

                // Try to open the app
                window.location.href = config.scheme;

                // If app is not installed, redirect to App Store after 2 seconds
                setTimeout(function () {
                    if (Date.now() - startTime < 2000) {
                        window.location.href = config.storeUrl;
                    }
                }, 2000);

            } else if (platform === 'android') {
                // Android deep linking
                const intentUrl = `intent://${config.scheme}#Intent;scheme=${config.scheme};package=${config.packageName};end;`;

                // Try to open the app
                window.location.href = intentUrl;

                // If app is not installed, redirect to Play Store after 2 seconds
                setTimeout(function () {
                    window.location.href = config.storeUrl;
                }, 2000);
            }
        }

        // Open App button click handler - automatically detects device
        if (openAppBtn) {
            openAppBtn.addEventListener('click', function () {
                const deviceType = getDeviceType();

                if (deviceType === 'desktop') {
                    // On desktop, show a message or redirect to a download page
                    alert('Please visit this page on your mobile device to open the app, or choose your platform below to download.');
                } else {
                    // On mobile, try to open the app for the detected platform
                    openAppOrStore(deviceType);
                }
            });
        }

        // iOS button click handler
        if (iosAppBtn) {
            iosAppBtn.addEventListener('click', function () {
                openAppOrStore('ios');
            });
        }

        // Android button click handler
        if (androidAppBtn) {
            androidAppBtn.addEventListener('click', function () {
                openAppOrStore('android');
            });
        }

        // Optional: Auto-highlight the user's platform and update Open App button
        const deviceType = getDeviceType();
        if (deviceType === 'ios') {
            if (openAppBtn) {
                openAppBtn.innerHTML = '<i class="fas fa-external-link-alt me-2"></i>Open on iOS';
            }
            if (iosAppBtn) {
                iosAppBtn.classList.add('btn-lg');
                iosAppBtn.innerHTML = '<i class="fab fa-apple me-2"></i>Download for iOS';
            }
        } else if (deviceType === 'android') {
            if (openAppBtn) {
                openAppBtn.innerHTML = '<i class="fas fa-external-link-alt me-2"></i>Open on Android';
            }
            if (androidAppBtn) {
                androidAppBtn.classList.add('btn-lg');
                androidAppBtn.innerHTML = '<i class="fab fa-google-play me-2"></i>Download for Android';
            }
        } else {
            // On desktop, hide or disable the Open App button
            if (openAppBtn) {
                openAppBtn.innerHTML = '<i class="fas fa-mobile-alt me-2"></i>Open on Mobile';
                openAppBtn.title = 'Visit on mobile to open app';
            }
        }
    });

    // Contest Modal Functionality
    console.log('Contest Modal JavaScript loading...');

    // Wait for DOM to be fully loaded
    document.addEventListener('DOMContentLoaded', function () {
        console.log('DOM loaded, checking contest modal elements...');

        // Check if contest modal HTML is present in the DOM
        const contestModalHtml = document.querySelector('#contestModal');
        if (!contestModalHtml) {
            console.error('CONTEST MODAL HTML NOT FOUND! The modal component may not be loaded.');
            // Let's check what's actually in the body
            console.log('Body HTML contains contest modal:', document.body.innerHTML.includes('contestModal'));
            console.log('Body HTML contains contest-nav-link:', document.body.innerHTML.includes('contest-nav-link'));
            return;
        }

        const contestModal = document.getElementById('contestModal');
        const contestNavLink = document.getElementById('contest-nav-link');

        console.log('Contest modal elements found:', {
            modal: !!contestModal,
            link: !!contestNavLink,
            modalId: contestModal ? contestModal.id : 'not found',
            linkId: contestNavLink ? contestNavLink.id : 'not found'
        });

        if (contestModal && contestNavLink) {
            console.log('Setting up contest modal event handlers...');

            // Direct click handler for contest navigation link
            contestNavLink.addEventListener('click', function (e) {
                e.preventDefault();
                console.log('CONTEST LINK CLICKED! Attempting to open modal...');

                // Try to show modal using Bootstrap API
                try {
                    if (typeof bootstrap !== 'undefined') {
                        console.log('Bootstrap is available, using Bootstrap Modal API');
                        const modal = new bootstrap.Modal(contestModal);
                        modal.show();
                        console.log('Contest modal opened via Bootstrap');
                    } else {
                        console.error('Bootstrap is not defined!');
                        // Fallback: manually show modal
                        contestModal.classList.add('show');
                        contestModal.style.display = 'block';
                        document.body.classList.add('modal-open');

                        // Create backdrop if it doesn't exist
                        let backdrop = document.querySelector('.modal-backdrop');
                        if (!backdrop) {
                            backdrop = document.createElement('div');
                            backdrop.className = 'modal-backdrop fade show';
                            document.body.appendChild(backdrop);
                            console.log('Created modal backdrop manually');
                        }
                        console.log('Contest modal opened manually (fallback)');
                    }
                } catch (error) {
                    console.error('Error opening contest modal:', error);
                    // Fallback: manually show modal
                    contestModal.classList.add('show');
                    contestModal.style.display = 'block';
                    document.body.classList.add('modal-open');

                    // Create backdrop if it doesn't exist
                    let backdrop = document.querySelector('.modal-backdrop');
                    if (!backdrop) {
                        backdrop = document.createElement('div');
                        backdrop.className = 'modal-backdrop fade show';
                        document.body.appendChild(backdrop);
                    }
                    console.log('Contest modal opened via error fallback');
                }
            });

            console.log('Contest modal event handlers set up successfully');

            // Handle modal show event
            contestModal.addEventListener('show.bs.modal', function () {
                console.log('Contest modal show event triggered');
                // Ensure audio continues playing when modal opens
                const liveAudio = document.getElementById('live-audio');
                if (liveAudio && !liveAudio.paused) {
                    console.log('Contest modal opening - audio will continue playing');
                }

                // Add modal-open class to body for blur effect
                document.body.classList.add('modal-open');
            });

            // Handle modal hidden event
            contestModal.addEventListener('hidden.bs.modal', function () {
                console.log('Contest modal hidden event triggered');
                // Remove modal-open class from body
                document.body.classList.remove('modal-open');

                // Remove backdrop
                const backdrop = document.querySelector('.modal-backdrop');
                if (backdrop) {
                    backdrop.remove();
                }

                // Restore audio state if needed
                const liveAudio = document.getElementById('live-audio');
                if (liveAudio) {
                    console.log('Contest modal closed - audio state maintained');
                }
            });

            // Handle close button clicks
            const closeButtons = contestModal.querySelectorAll('[data-bs-dismiss="modal"], .btn-close');
            console.log('Found close buttons:', closeButtons.length);
            closeButtons.forEach(button => {
                button.addEventListener('click', function () {
                    console.log('Close button clicked');
                    try {
                        const modal = bootstrap.Modal.getInstance(contestModal);
                        if (modal) {
                            modal.hide();
                        } else {
                            // Fallback: manually hide modal
                            contestModal.classList.remove('show');
                            contestModal.style.display = 'none';
                            document.body.classList.remove('modal-open');
                            const backdrop = document.querySelector('.modal-backdrop');
                            if (backdrop) {
                                backdrop.remove();
                            }
                        }
                    } catch (error) {
                        console.error('Error closing contest modal:', error);
                        // Fallback: manually hide modal
                        contestModal.classList.remove('show');
                        contestModal.style.display = 'none';
                        document.body.classList.remove('modal-open');
                        const backdrop = document.querySelector('.modal-backdrop');
                        if (backdrop) {
                            backdrop.remove();
                        }
                    }
                });
            });
        } else {
            console.error('Contest modal or navigation link not found:', {
                modal: !!contestModal,
                link: !!contestNavLink
            });
        }
    });

    // Handle direct contest page access - redirect to modal if on homepage
    function checkContestAccess() {
        // Check if we're on the homepage and contest parameter is present
        if (window.location.pathname === '/' || window.location.pathname === '/home') {
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.get('contest') === 'true') {
                // Open contest modal
                const contestModal = new bootstrap.Modal(document.getElementById('contestModal'));
                if (contestModal) {
                    contestModal.show();
                    // Remove contest parameter from URL without reloading
                    const newUrl = window.location.pathname + (window.location.search ? window.location.search.replace(/\?contest=true&?|&contest=true/, '') : '');
                    window.history.replaceState({}, document.title, newUrl);
                }
            }
        }
    }

    // Check contest access on page load
    checkContestAccess();
</script>

<!-- Stack Scripts -->
@stack('scripts')

<!-- Contest Modal Component -->
<x-contest-modal/>
</body>
</html>
