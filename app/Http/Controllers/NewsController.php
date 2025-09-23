<?php

namespace App\Http\Controllers;

use App\Models\Api;
use App\Models\UploadedNews;
use App\Services\NewsService;
use Exception;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Log;

class NewsController extends Controller
{
    public function getNews()
    {
        try {
            // Get API key from environment or database
            $apiKey = config('app.news_api_key') ?: Api::getValue('news_api');

            if (!$apiKey) {
                Log::info('NewsAPI key not configured, using fallback news');
                return response()->json($this->getFallbackNews());
            }

            // Try to get cached news first
            $cacheKey = 'music_celebrity_news';
            $cachedNews = Cache::get($cacheKey);

            if ($cachedNews) {
                Log::info('Returning cached news', ['count' => count($cachedNews)]);
                return response()->json($cachedNews);
            }

            // Fetch fresh news from API
            $news = $this->fetchNewsFromAPI();

            // Cache for 30 minutes
            Cache::put($cacheKey, $news, 1800);

            Log::info('Fresh news fetched and cached', ['count' => count($news)]);
            return response()->json($news);

        } catch (Exception $e) {
            Log::error('NewsController Error: ' . $e->getMessage());
            return response()->json($this->getFallbackNews());
        }
    }

    private function getFallbackNews()
    {
        return [
            [
                'title' => 'New Album Release',
                'description' => 'Top artist announces new album dropping next month with exclusive tour dates.',
                'url' => '#',
                'image' => null,
                'publishedAt' => now(),
                'source' => 'Music News'
            ],
            [
                'title' => 'Interview with Rising Star',
                'description' => 'Exclusive interview with this month\'s breakout artist on their journey to success.',
                'url' => 'https://www.rollingstone.com/music/',
                'image' => null,
                'publishedAt' => now(),
                'source' => 'Feature'
            ],
            [
                'title' => 'Music Awards 2023',
                'description' => 'Complete list of winners and highlights from this year\'s prestigious music awards.',
                'url' => 'https://variety.com/c/music/',
                'image' => null,
                'publishedAt' => now(),
                'source' => 'Awards News'
            ]
        ];
    }

    private function fetchNewsFromAPI()
    {
        try {
            Log::info('Fetching news from API...');

            // Get API key from environment or database
            $apiKey = config('app.news_api_key') ?: Api::getValue('news_api');

            if (!$apiKey) {
                Log::error('NewsAPI key not found');
                return $this->getFallbackNews();
            }

            $params = [
                'apiKey' => $apiKey,
                'q' => 'pop music OR pop artists OR music celebrities OR new album OR music charts OR pop stars OR music industry OR pop culture',
                'language' => 'en',
                'sortBy' => 'publishedAt',
                'pageSize' => 12,
                'domains' => 'rollingstone.com,variety.com,ew.com,people.com,usmagazine.com,pitchfork.com,spin.com,nme.com'
            ];

            Log::info('API Parameters:', $params);

            $response = Http::timeout(30)
                ->withOptions(['verify' => false]) // Disable SSL verification for development
                ->get(config('app.news_base_url'), $params);

            Log::info('API Response Status:', ['status' => $response->status()]);

            if ($response->successful()) {
                $data = $response->json();
                Log::info('API Response Data:', ['total_results' => $data['totalResults'] ?? 0, 'articles_count' => count($data['articles'] ?? [])]);
                return $this->formatNewsData($data['articles'] ?? []);
            } else {
                Log::error('API Response Failed:', ['status' => $response->status(), 'body' => $response->body()]);
                return $this->getFallbackNews();
            }

        } catch (Exception $e) {
            Log::error('News API Error: ' . $e->getMessage());
            return $this->getFallbackNews();
        }
    }

    private function formatNewsData($articles)
    {
        $formattedNews = [];

        foreach (array_slice($articles, 0, 12) as $article) {
            $formattedNews[] = [
                'title' => $article['title'] ?? 'No Title',
                'description' => $this->truncateText($article['description'] ?? 'No description available', 120),
                'url' => $article['url'] ?? '#',
                'urlToImage' => $article['urlToImage'] ?? null,
                'image' => $article['urlToImage'] ?? null, // Fallback for compatibility
                'publishedAt' => $article['publishedAt'] ?? now(),
                'source' => [
                    'name' => $article['source']['name'] ?? 'Unknown Source'
                ]
            ];
        }

        return $formattedNews;
    }

    private function truncateText($text, $length = 120)
    {
        return strlen($text) > $length ? substr($text, 0, $length) . '...' : $text;
    }

    /**
     * Get uploaded news articles from the database
     */
    public function getUploadedNews()
    {
        try {
            $uploadedNews = UploadedNews::active()->ordered()->get();

            $formattedNews = [];
            foreach ($uploadedNews as $news) {
                $formattedNews[] = [
                    'title' => $news->title,
                    'description' => $news->content,
                    'url' => $news->source_url ?: '#',
                    'urlToImage' => $news->image_path ? asset('storage/' . $news->image_path) : null,
                    'source' => [
                        'name' => $news->source_name
                    ],
                    'publishedAt' => $news->published_at->toISOString(),
                    'is_uploaded' => true // Flag to identify uploaded news
                ];
            }

            return response()->json($formattedNews);

        } catch (Exception $e) {
            Log::error('Error fetching uploaded news: ' . $e->getMessage());
            return response()->json([]);
        }
    }

    /**
     * Get top 12 most relevant and recent pop culture news
     */
    public function getPopCultureNews()
    {
        try {
            $newsService = new NewsService();
            $popCultureNews = $newsService->getPopCultureNews();

            return response()->json([
                'success' => true,
                'data' => $popCultureNews,
                'count' => count($popCultureNews)
            ]);

        } catch (Exception $e) {
            Log::error('Error fetching pop culture news: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'data' => [],
                'count' => 0,
                'error' => 'Failed to fetch pop culture news'
            ]);
        }
    }

    /**
     * Get entertainment headlines
     */
    public function getEntertainmentHeadlines()
    {
        try {
            $newsService = new NewsService();
            $headlines = $newsService->getEntertainmentHeadlines();

            return response()->json([
                'success' => true,
                'data' => $headlines,
                'count' => count($headlines)
            ]);

        } catch (Exception $e) {
            Log::error('Error fetching entertainment headlines: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'data' => [],
                'count' => 0,
                'error' => 'Failed to fetch entertainment headlines'
            ]);
        }
    }
}
