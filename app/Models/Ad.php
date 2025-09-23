<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    protected $fillable = [
        'title',
        'image_path',
        'target_url',
        'is_active',
        'display_order'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    /**
     * Get the image URL.
     *
     * @return string
     */
    /**
     * Get the full URL to the ad image
     */
    public function getImageUrlAttribute()
    {
        try {
            // First check if the attribute is set in the model
            if (!isset($this->attributes) || !array_key_exists('image_path', $this->attributes)) {
                return null;
            }
            
            // Safely get the image path using direct array access with null coalescing
            $imagePath = $this->attributes['image_path'] ?? null;
            
            // If no image path is set, return null
            if (empty($imagePath)) {
                return null;
            }

            // If it's already a full URL, return as is
            if (is_string($imagePath) && (str_starts_with($imagePath, 'http') || str_starts_with($imagePath, 'https'))) {
                return $imagePath;
            }
            
            // Ensure we have a string to work with
            $path = (string)$imagePath;
            
            // Convert backslashes to forward slashes and clean up the path
            $path = str_replace('\\', '/', $path);
            $path = ltrim($path, '/');
            
            // Remove storage/ prefix if it exists
            if (strpos($path, 'storage/') === 0) {
                $path = substr($path, 8);
            }
            
            // Split the path into parts and encode each part
            $encodedParts = array_map('rawurlencode', explode('/', $path));
            
            // Rebuild the path with encoded parts
            $encodedPath = implode('/', $encodedParts);
            
            // Generate the full URL
            return asset('storage/' . ltrim($encodedPath, '/'));
            
        } catch (\Exception $e) {
            \Log::error(sprintf(
                'Error generating image URL for ad ID %s: %s\n%s',
                $this->id ?? 'unknown',
                $e->getMessage(),
                $e->getTraceAsString()
            ));
            return null;
        }
    }
    
    /**
     * Get the URL to view this ad on the landing page
     */
    public function getLandingPageUrl()
    {
        return route('ads.show', ['ad' => $this->id]);
    }
}
