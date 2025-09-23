<div class="pop-culture-news-section" id="popCultureNewsSection">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="display-5">
                        <i class="fas fa-newspaper me-2 text-warning"></i>
                        Pop Culture News
                    </h2>
                    <button class="btn btn-outline-primary btn-sm" onclick="refreshPopCultureNews()">
                        <i class="fas fa-sync-alt me-1"></i>Refresh
                    </button>
                </div>
            </div>
        </div>

        <!-- Loading State -->
        <div id="newsLoading" class="text-center py-5">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <p class="mt-3 text-muted">Loading latest pop culture news...</p>
        </div>

        <!-- Error State -->
        <div id="newsError" class="alert alert-danger d-none" role="alert">
            <i class="fas fa-exclamation-triangle me-2"></i>
            <span id="newsErrorMessage">Failed to load news. Please try again.</span>
            <button class="btn btn-outline-danger btn-sm ms-2" onclick="refreshPopCultureNews()">
                <i class="fas fa-redo me-1"></i>Retry
            </button>
        </div>

        <!-- News Grid -->
        <div id="newsGrid" class="row g-4 d-none">
            <!-- News articles will be dynamically inserted here -->
        </div>

        <!-- Empty State -->
        <div id="newsEmpty" class="text-center py-5 d-none">
            <i class="fas fa-newspaper text-muted" style="font-size: 3rem;"></i>
            <h4 class="mt-3 text-muted">No news available</h4>
            <p class="text-muted">Check back later for the latest pop culture updates.</p>
        </div>
    </div>
</div>

<style>
.pop-culture-news-section {
    margin: 40px 0;
}

.news-card {
    background: white;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
    height: 100%;
    display: flex;
    flex-direction: column;
}

.news-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
}

.news-card-image {
    width: 100%;
    height: 200px;
    object-fit: cover;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
}

.news-card-body {
    padding: 20px;
    flex: 1;
    display: flex;
    flex-direction: column;
}

.news-card-title {
    font-size: 1.1rem;
    font-weight: 600;
    margin-bottom: 10px;
    color: #2c3e50;
    line-height: 1.4;
}

.news-card-description {
    color: #6c757d;
    font-size: 0.9rem;
    line-height: 1.5;
    margin-bottom: 15px;
    flex: 1;
}

.news-card-meta {
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 0.8rem;
    color: #6c757d;
    margin-top: auto;
}

.news-card-source {
    background: #e9ecef;
    padding: 4px 8px;
    border-radius: 12px;
    font-weight: 500;
}

.news-card-date {
    font-style: italic;
}

.news-card-link {
    color: #1E3C72;
    text-decoration: none;
    display: block;
}

.news-card-link:hover {
    text-decoration: none;
}

.news-card-link:hover .news-card-title {
    color: #FFD700;
}

@media (max-width: 768px) {
    .news-card-image {
        height: 150px;
    }
    
    .news-card-title {
        font-size: 1rem;
    }
    
    .news-card-description {
        font-size: 0.85rem;
    }
}
</style>

<script>
function fetchPopCultureNews() {
    const loadingEl = document.getElementById('newsLoading');
    const errorEl = document.getElementById('newsError');
    const gridEl = document.getElementById('newsGrid');
    const emptyEl = document.getElementById('newsEmpty');
    
    // Show loading state
    loadingEl.classList.remove('d-none');
    errorEl.classList.add('d-none');
    gridEl.classList.add('d-none');
    emptyEl.classList.add('d-none');
    
    fetch('/api/news/pop-culture')
        .then(response => response.json())
        .then(data => {
            loadingEl.classList.add('d-none');
            
            if (data.success && data.data && data.data.length > 0) {
                displayNewsArticles(data.data);
                gridEl.classList.remove('d-none');
            } else {
                emptyEl.classList.remove('d-none');
            }
        })
        .catch(error => {
            console.error('Error fetching pop culture news:', error);
            loadingEl.classList.add('d-none');
            errorEl.classList.remove('d-none');
            document.getElementById('newsErrorMessage').textContent = 
                'Failed to load news. Please check your connection and try again.';
        });
}

function displayNewsArticles(articles) {
    const gridEl = document.getElementById('newsGrid');
    gridEl.innerHTML = '';
    
    articles.forEach(article => {
        const newsCard = createNewsCard(article);
        gridEl.appendChild(newsCard);
    });
}

function createNewsCard(article) {
    const col = document.createElement('div');
    col.className = 'col-lg-4 col-md-6';
    
    const imageUrl = article.urlToImage || `https://picsum.photos/seed/${article.title}/400/200.jpg`;
    
    col.innerHTML = `
        <a href="${article.url}" target="_blank" class="news-card-link">
            <div class="news-card">
                <img src="${imageUrl}" 
                     alt="${article.title}" 
                     class="news-card-image"
                     onerror="this.src='https://picsum.photos/seed/fallback/400/200.jpg'">
                <div class="news-card-body">
                    <h5 class="news-card-title">${article.title}</h5>
                    <p class="news-card-description">${article.description || 'No description available'}</p>
                    <div class="news-card-meta">
                        <span class="news-card-source">${article.source}</span>
                        <span class="news-card-date">${article.formattedDate}</span>
                    </div>
                </div>
            </div>
        </a>
    `;
    
    return col;
}

function refreshPopCultureNews() {
    fetchPopCultureNews();
}

// Initialize news fetching when page loads
document.addEventListener('DOMContentLoaded', function() {
    fetchPopCultureNews();
});
</script>
