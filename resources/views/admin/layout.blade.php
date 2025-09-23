<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Jammin'</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .sidebar {
            min-height: 100vh;
            background: #343a40;
            color: white;
        }
        .sidebar a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            padding: 10px 15px;
            display: block;
        }
        .sidebar a:hover, .sidebar a.active {
            color: white;
            background: rgba(255, 255, 255, 0.1);
        }
        .sidebar i {
            width: 20px;
            margin-right: 10px;
            text-align: center;
        }
        .main-content {
            padding: 20px;
        }
        
        /* Sticky Player Styles */
        :root {
            --player-height: 80px;
            --accent-blue: #667eea;
            --dark-bg: #1a1a1a;
        }
        
        .sticky-player {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            height: var(--player-height);
            background: var(--dark-bg);
            border-top: 1px solid rgba(255, 255, 255, 0.1);
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
            min-width: 0;
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
            color: rgba(255, 255, 255, 0.8);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        
        .player-buttons {
            display: flex;
            gap: 10px;
            align-items: center;
        }
        
        .player-btn {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: none;
            background: rgba(255, 255, 255, 0.1);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 18px;
        }
        
        .player-btn:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: scale(1.1);
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-2 p-0 sidebar">
                <div class="p-3">
                    <h4>Jammin' Admin</h4>
                </div>
                <ul class="nav flex-column">
                    <li><a href="{{ route('admin.index') }}" class="{{ request()->is('admin') ? 'active' : '' }}"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                    <li><a href="{{ route('admin.contests.index') }}" class="{{ request()->is('admin/contests*') ? 'active' : '' }}"><i class="fas fa-trophy"></i> Contests</a></li>
                    <li><a href="{{ route('admin.uploaded-news.index') }}" class="{{ request()->is('admin/uploaded-news*') ? 'active' : '' }}"><i class="fas fa-newspaper"></i> Uploaded News</a></li>
                    <li><a href="{{ route('admin.ads.index') }}" class="{{ request()->is('admin/ads*') ? 'active' : '' }}"><i class="fas fa-ad"></i> Ads Management</a></li>
                    <li><a href="{{ route('admin.footer.index') }}" class="{{ request()->is('admin/footer*') ? 'active' : '' }}"><i class="fas fa-cog"></i> Footer Management</a></li>
                    <li><a href="{{ route('admin.apis') }}" class="{{ request()->is('admin/apis*') ? 'active' : '' }}"><i class="fas fa-plug"></i> API Settings</a></li>
                </ul>
                
                <!-- Logout Button -->
                <div class="p-3 mt-auto">
                    <form method="POST" action="{{ route('admin.logout') }}" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-outline-light btn-sm w-100">
                            <i class="fas fa-sign-out-alt me-2"></i> Logout
                        </button>
                    </form>
                </div>
            </div>

            <!-- Main content -->
            <div class="col-md-10 main-content">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @yield('content')
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
    
    <script>
        // Mini Player JavaScript
        document.addEventListener('DOMContentLoaded', function() {
            const audio = document.getElementById('live-audio');
            const stickyPlayer = document.getElementById('sticky-player');
            const miniPlayBtn = document.getElementById('mini-play-btn');
            const miniPlayIcon = document.getElementById('mini-play-icon');
            const minimizeBtn = document.getElementById('minimize-btn');
            const currentArtist = document.getElementById('current-artist');
            const currentTitle = document.getElementById('current-title');
            
            if (!audio || !stickyPlayer) {
                console.error('Player elements not found');
                return;
            }
            
            // Play/Pause functionality
            miniPlayBtn.addEventListener('click', function() {
                if (audio.paused) {
                    audio.play().then(() => {
                        miniPlayIcon.className = 'fas fa-pause';
                        console.log('Audio playback started');
                    }).catch(error => {
                        console.error('Error playing audio:', error);
                    });
                } else {
                    audio.pause();
                    miniPlayIcon.className = 'fas fa-play';
                    console.log('Audio playback paused');
                }
            });
            
            // Minimize functionality
            minimizeBtn.addEventListener('click', function() {
                stickyPlayer.classList.toggle('player-minimized');
                const icon = minimizeBtn.querySelector('i');
                icon.className = stickyPlayer.classList.contains('player-minimized') ? 'fas fa-chevron-up' : 'fas fa-chevron-down';
            });
            
            // Audio event listeners
            audio.addEventListener('play', function() {
                miniPlayIcon.className = 'fas fa-pause';
                stickyPlayer.style.display = 'flex';
                console.log('Audio playing');
            });
            
            audio.addEventListener('pause', function() {
                miniPlayIcon.className = 'fas fa-play';
                console.log('Audio paused');
            });
            
            audio.addEventListener('error', function() {
                console.error('Audio error:', audio.error);
                currentArtist.textContent = 'Stream Error';
                currentTitle.textContent = 'Unable to connect';
            });
            
            // Initialize player state
            console.log('Mini player initialized');
            
            // Function to update the player with song information
            function updateSongInfo(info) {
                if (!info) {
                    console.warn('⚠️ No song info provided to updateSongInfo');
                    return;
                }
                
                console.log('🔄 Updating song info:', info);
                
                if (!currentArtist || !currentTitle) {
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
                        const separators = [' - ', ' – ', ' — ', ' • ', ' | ', ':' ];
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
                        const separators = [' - ', ' – ', ' — ', ' • ', ' | ', ':' ];
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
                title = title.replace(/\s*[0-9]{1,2}[:.][0-9]{2}\s*[0-9]{1,2}[:.][0-9]{2}\s*$/, '').trim();
                
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
                
                console.log('📝 Extracted metadata:', { artist, title });
                
                // Only update the DOM if we have valid metadata
                try {
                    // Add prefixes to the display
                    currentArtist.textContent = 'artist- ' + (artist || 'Now Playing');
                    currentTitle.textContent = 'song- ' + title;
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
            }
            
            // Function to fetch metadata from the audio stream
            function fetchMetadata() {
                // Try to get metadata from the audio element
                if (audio && audio.currentSrc) {
                    // For demo purposes, we'll simulate metadata
                    // In a real implementation, this would fetch from the stream API
                    const demoMetadata = [
                        { artist: 'The Weeknd', title: 'Blinding Lights' },
                        { artist: 'Dua Lipa', title: 'Levitating' },
                        { artist: 'Ed Sheeran', title: 'Shape of You' },
                        { artist: 'Jammin Radio', title: 'Live Stream' }
                    ];
                    
                    const randomMetadata = demoMetadata[Math.floor(Math.random() * demoMetadata.length)];
                    updateSongInfo(randomMetadata);
                }
            }
            
            // Update metadata periodically
            setInterval(fetchMetadata, 30000); // Update every 30 seconds
            fetchMetadata(); // Initial update
            
            // Also try to get metadata when audio starts playing
            audio.addEventListener('play', function() {
                setTimeout(fetchMetadata, 2000); // Wait 2 seconds then fetch metadata
            });
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
            <audio id="live-audio" preload="none" style="display: none;">
                <source src="{{ config('app.stream_url') }}" type="audio/mpeg">
                Your browser does not support the audio element.
            </audio>
        </div>
    </div>
</body>
</html>
