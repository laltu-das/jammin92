<?php

namespace App\Http\Controllers;

use App\Models\Contest;
use App\Models\ContestImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ContestController extends Controller
{
    /**
     * Display a listing of the contests.
     */
    public function index()
    {
        $contests = Contest::latest()->get();

        return view('admin.contests.index', compact('contests'));
    }

    /**
     * Store a newly created contest in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'is_active' => 'boolean',
        ]);

        $contest = Contest::create($validated);

        return redirect()->route('admin.contests.index')
            ->with('success', 'Contest created successfully!');
    }

    /**
     * Show the form for creating a new contest.
     */
    public function create()
    {
        return view('admin.contests.create');
    }

    /**
     * Display the specified contest.
     */
    public function show(Contest $contest)
    {
        return view('admin.contests.show', compact('contest'));
    }

    /**
     * Show the form for editing the specified contest.
     */
    public function edit(Contest $contest)
    {
        return view('admin.contests.edit', compact('contest'));
    }

    /**
     * Update the specified contest in storage.
     */
    public function update(Request $request, Contest $contest)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'is_active' => 'boolean',
        ]);

        $contest->update($validated);

        return redirect()->route('admin.contests.index')
            ->with('success', 'Contest updated successfully!');
    }

    /**
     * Remove the specified contest from storage.
     */
    public function destroy(Contest $contest)
    {
        $contest->delete();

        return redirect()->route('admin.contests.index')
            ->with('success', 'Contest deleted successfully!');
    }

    /**
     * Show the form for uploading images to a contest.
     */
    public function showUploadForm(Contest $contest)
    {
        return view('admin.contests.upload', compact('contest'));
    }

    /**
     * Store uploaded images for a contest.
     */
    public function uploadImages(Request $request, Contest $contest)
    {
        // Determine the storage source
        $storageSource = $request->input('storage_source', 'local');

        // Handle local file uploads
        if ($storageSource === 'local') {
            $request->validate([
                'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'title' => 'nullable|string|max:255',
                'description' => 'nullable|string',
            ]);

            if ($request->hasFile('images')) {
                // Ensure the directory exists
                $directory = 'contests/' . $contest->id;
                Storage::disk('public')->makeDirectory($directory);

                foreach ($request->file('images') as $image) {
                    // Generate a unique filename
                    $filename = uniqid() . '.' . $image->getClientOriginalExtension();

                    // Store the file
                    $path = $image->storeAs($directory, $filename, 'public');

                    // Create the database record
                    ContestImage::create([
                        'contest_id' => $contest->id,
                        'image_path' => $path,
                        'title' => $request->title,
                        'description' => $request->description,
                        'display_order' => $contest->images()->count() + 1,
                    ]);
                }

                return redirect()->route('admin.contests.show', $contest)
                    ->with('success', 'Images uploaded successfully!');
            }

            return back()->with('error', 'No images were uploaded.');
        } // Handle cloud storage uploads (Google Drive, OneDrive, etc.)
        else {
            $request->validate([
                'cloud_file_data' => 'required',
                'title' => 'nullable|string|max:255',
                'description' => 'nullable|string',
            ]);

            $cloudFiles = json_decode($request->input('cloud_file_data'), true);

            if (empty($cloudFiles)) {
                return back()->with('error', 'No cloud files selected.');
            }

            $uploadedCount = 0;

            foreach ($cloudFiles as $fileData) {
                // Extract file information
                $source = $fileData['source'] ?? 'Cloud Storage';
                $fileName = $fileData['name'] ?? 'unknown_file.jpg';
                $fileUrl = $fileData['url'] ?? null;

                // In a real implementation, you would download the file from the cloud storage URL
                // For demonstration purposes, we'll create a placeholder record

                // Generate a unique path for the file
                $path = 'contests/' . $contest->id . '/' . time() . '_' . $fileName;

                // In a real implementation, you would use something like:
                // if ($fileUrl) {
                //     try {
                //         $fileContents = file_get_contents($fileUrl);
                //         Storage::disk('public')->put($path, $fileContents);
                //     } catch (\Exception $e) {
                //         continue; // Skip this file if download fails
                //     }
                // }

                // Create a record in the database
                ContestImage::create([
                    'contest_id' => $contest->id,
                    'image_path' => $path,
                    'title' => $request->title ?: 'Cloud Upload: ' . $fileName,
                    'description' => $request->description ?: 'Uploaded from ' . $source,
                    'display_order' => $contest->images()->count() + 1,
                ]);

                $uploadedCount++;
            }

            if ($uploadedCount > 0) {
                return redirect()->route('admin.contests.show', $contest)
                    ->with('success', $uploadedCount . ' image(s) information saved from cloud storage. In a real implementation, the images would be downloaded from the cloud storage.');
            }

            return back()->with('error', 'Failed to process cloud storage files.');
        }
    }

    /**
     * Delete a contest image.
     */
    public function deleteImage(ContestImage $image)
    {
        Storage::disk('public')->delete($image->image_path);
        $image->delete();

        return back()->with('success', 'Image deleted successfully!');
    }
}
