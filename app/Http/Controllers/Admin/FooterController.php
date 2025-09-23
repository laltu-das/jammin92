<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Footer;
use Illuminate\Http\Request;

class FooterController extends Controller
{
    /**
     * Display the footer management page.
     */
    public function index()
    {
        try {
            $footer = Footer::getFooter();
            return view('admin.footer.index', compact('footer'));
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);
        }
    }

    /**
     * Update the footer content.
     */
    public function update(Request $request)
    {
        $request->validate([
            // Company Info Section
            'brand_name' => 'required|string|max:255',
            'description' => 'required|string',

            // Quick Links Section
            'home_link_text' => 'required|string|max:255',
            'home_link_url' => 'required|string|max:255',
            'news_link_text' => 'required|string|max:255',
            'news_link_url' => 'required|string|max:255',
            'concerts_link_text' => 'required|string|max:255',
            'concerts_link_url' => 'required|string|max:255',
            'events_link_text' => 'required|string|max:255',
            'events_link_url' => 'required|string|max:255',
            'contact_link_text' => 'required|string|max:255',
            'contact_link_url' => 'required|string|max:255',

            // Contact Info Section
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'frequency' => 'required|string|max:255',

            // Social Media Links
            'facebook_url' => 'nullable|url|max:255',
            'instagram_url' => 'nullable|url|max:255',
            'twitter_url' => 'nullable|url|max:255',
            'youtube_url' => 'nullable|url|max:255',

            // Copyright
            'copyright_text' => 'required|string|max:255',
        ]);

        $footer = Footer::getFooter();
        $footer->update($request->all());

        return redirect()->route('admin.footer.index')
            ->with('success', 'Footer content updated successfully!');
    }
}
