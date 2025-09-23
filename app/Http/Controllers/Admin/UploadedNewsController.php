<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UploadedNews;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class UploadedNewsController extends Controller
{
    /**
     * Display a listing of the uploaded news.
     */
    public function index()
    {
        $news = UploadedNews::active()->ordered()->get();
        return view('admin.uploaded_news.index', compact('news'));
    }

    /**
     * Show the form for editing the specified uploaded news.
     */
    public function edit(UploadedNews $uploaded_news)
    {
        return view('admin.uploaded_news.edit', compact('uploaded_news'));
    }

    /**
     * Update the specified uploaded news.
     */
    public function update(Request $request, UploadedNews $uploaded_news)
    {
        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'content' => 'required|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'source_url' => 'nullable|url|max:255',
                'source_name' => 'nullable|string|max:100',
                'is_active' => 'boolean',
                'display_order' => 'integer|min:0',
            ]);

            $newsData = [
                'title' => $validated['title'],
                'content' => $validated['content'],
                'source_url' => $validated['source_url'] ?? null,
                'source_name' => $validated['source_name'] ?? 'Jammin Admin',
                'is_active' => $validated['is_active'] ?? true,
                'display_order' => $validated['display_order'] ?? 0,
            ];

            // Handle image upload
            if ($request->hasFile('image')) {
                // Delete old image if exists
                if ($uploaded_news->image_path) {
                    Storage::disk('public')->delete($uploaded_news->image_path);
                }

                $image = $request->file('image');
                $path = $image->store('uploaded_news', 'public');
                $newsData['image_path'] = $path;
            }

            $uploaded_news->update($newsData);

            return redirect()->route('admin.uploaded_news.index')
                ->with('success', 'News article updated successfully!');

        } catch (\Exception $e) {
            Log::error('Error updating uploaded news: ' . $e->getMessage());
            return back()->withInput()
                ->with('error', 'Error updating news article. Please try again.');
        }
    }

    /**
     * Store a newly created uploaded news.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'content' => 'required|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'source_url' => 'nullable|url|max:255',
                'source_name' => 'nullable|string|max:100',
                'is_active' => 'boolean',
                'display_order' => 'integer|min:0',
            ]);

            $newsData = [
                'title' => $validated['title'],
                'content' => $validated['content'],
                'source_url' => $validated['source_url'] ?? null,
                'source_name' => $validated['source_name'] ?? 'Jammin Admin',
                'is_active' => $validated['is_active'] ?? true,
                'display_order' => $validated['display_order'] ?? 0,
                'published_at' => now(),
            ];

            // Handle image upload
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $path = $image->store('uploaded_news', 'public');
                $newsData['image_path'] = $path;
            }

            $news = UploadedNews::create($newsData);

            return redirect()->route('admin.uploaded_news.index')
                ->with('success', 'News article created successfully!');

        } catch (\Exception $e) {
            Log::error('Error creating uploaded news: ' . $e->getMessage());
            return back()->withInput()
                ->with('error', 'Error creating news article. Please try again.');
        }
    }

    /**
     * Show the form for creating new uploaded news.
     */
    public function create()
    {
        return view('admin.uploaded_news.create');
    }

    /**
     * Remove the specified uploaded news.
     */
    public function destroy(UploadedNews $uploaded_news)
    {
        try {
            // Delete image if exists
            if ($uploaded_news->image_path) {
                Storage::disk('public')->delete($uploaded_news->image_path);
            }

            $uploaded_news->delete();

            return redirect()->route('admin.uploaded_news.index')
                ->with('success', 'News article deleted successfully!');

        } catch (\Exception $e) {
            Log::error('Error deleting uploaded news: ' . $e->getMessage());
            return back()->with('error', 'Error deleting news article. Please try again.');
        }
    }

    /**
     * Toggle the status of the specified uploaded news.
     */
    public function toggleStatus(UploadedNews $uploaded_news)
    {
        try {
            $uploaded_news->is_active = !$uploaded_news->is_active;
            $uploaded_news->save();

            return response()->json([
                'success' => true,
                'message' => 'News article status updated successfully!',
                'is_active' => $uploaded_news->is_active
            ]);

        } catch (\Exception $e) {
            Log::error('Error toggling uploaded news status: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error updating news article status.'
            ], 500);
        }
    }
}
