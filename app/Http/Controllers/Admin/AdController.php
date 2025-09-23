<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ad;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdController extends Controller
{
    public function index()
    {
        $ads = Ad::orderBy('display_order')->get();

        return view('admin.ads.index', compact('ads'));
    }

    public function edit(Ad $ad)
    {
        return view('admin.ads.edit', compact('ad'));
    }

    public function destroy(Ad $ad)
    {
        if ($ad->image_path) {
            $path = str_replace('/storage', 'public', $ad->image_path);
            Storage::delete($path);
        }

        $ad->delete();
        return redirect()->route('admin.ads.index')->with('success', 'Ad deleted successfully!');
    }

    /**
     * Toggle the active status of an ad.
     *
     * @param Ad $ad
     * @return JsonResponse
     */
    public function toggleStatus(Ad $ad)
    {
        $ad->update([
            'is_active' => !$ad->is_active
        ]);

        return response()->json([
            'success' => true,
            'is_active' => $ad->is_active,
            'message' => 'Ad status updated successfully!'
        ]);
    }

    public function update(Request $request, Ad $ad)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'target_url' => 'nullable|url',
            'is_active' => 'boolean',
            'display_order' => 'integer|min:0'
        ]);

        $data = [
            'title' => $validated['title'],
            'target_url' => $validated['target_url'] ?? null,
            'is_active' => $validated['is_active'] ?? true,
            'display_order' => $validated['display_order'] ?? 0
        ];

        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($ad->image_path) {
                $oldImage = str_replace('storage/', 'public/', $ad->image_path);
                if (Storage::exists($oldImage)) {
                    Storage::delete($oldImage);
                }
            }
            // Store new image
            $path = $request->file('image')->store('ads', 'public');
            $data['image_path'] = 'storage/' . $path;
        }

        $ad->update($data);

        return redirect()->route('admin.ads.index')->with('success', 'Ad updated successfully!');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'target_url' => 'nullable|url',
            'is_active' => 'boolean',
            'display_order' => 'integer|min:0'
        ]);

        // Store the image in the public disk
        $path = $request->file('image')->store('ads', 'public');

        // Get the public URL for the stored image
        $publicPath = 'storage/' . $path;

        // Create the ad with the correct image path
        Ad::create([
            'title' => $validated['title'],
            'image_path' => $publicPath,
            'target_url' => $validated['target_url'] ?? null,
            'is_active' => $validated['is_active'] ?? true,
            'display_order' => $validated['display_order'] ?? 0
        ]);

        return redirect()->route('admin.ads.index')->with('success', 'Ad created successfully!');
    }

    public function create()
    {
        return view('admin.ads.create');
    }
}
