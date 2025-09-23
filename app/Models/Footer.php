<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Footer extends Model
{
    protected $fillable = [
        // Company Info Section
        'brand_name',
        'description',

        // Quick Links Section
        'home_link_text',
        'home_link_url',
        'news_link_text',
        'news_link_url',
        'concerts_link_text',
        'concerts_link_url',
        'events_link_text',
        'events_link_url',
        'contact_link_text',
        'contact_link_url',

        // Contact Info Section
        'address',
        'phone',
        'email',
        'frequency',

        // Social Media Links
        'facebook_url',
        'instagram_url',
        'twitter_url',
        'youtube_url',

        // Copyright
        'copyright_text',
    ];

    /**
     * Get the first footer record or create a default one
     */
    public static function getFooter()
    {
        try {
            $footer = self::first();
            if (!$footer) {
                $footer = new self();
                $footer->brand_name = 'Radio Station';
                $footer->description = 'Your favorite source for music, news, and entertainment. Tune in 24/7 for the best experience.';
                $footer->home_link_text = 'Home';
                $footer->home_link_url = '#';
                $footer->news_link_text = 'News';
                $footer->news_link_url = '#news';
                $footer->concerts_link_text = 'Concerts';
                $footer->concerts_link_url = '#concerts';
                $footer->events_link_text = 'Events';
                $footer->events_link_url = '#events';
                $footer->contact_link_text = 'Contact';
                $footer->contact_link_url = '#contact';
                $footer->address = '123 Radio Street, City, Country';
                $footer->phone = '+1 (123) 456-7890';
                $footer->email = 'info@radiostation.com';
                $footer->frequency = '98.5 FM';
                $footer->facebook_url = '#';
                $footer->instagram_url = '#';
                $footer->twitter_url = '#';
                $footer->youtube_url = '#';
                $footer->copyright_text = '2023 Radio Station. All Rights Reserved.';
                $footer->save();
            }
            return $footer;
        } catch (\Exception $e) {
            // Return a default footer object if database fails
            $footer = new self();
            $footer->brand_name = 'Radio Station';
            $footer->description = 'Your favorite source for music, news, and entertainment. Tune in 24/7 for the best experience.';
            $footer->home_link_text = 'Home';
            $footer->home_link_url = '#';
            $footer->news_link_text = 'News';
            $footer->news_link_url = '#news';
            $footer->concerts_link_text = 'Concerts';
            $footer->concerts_link_url = '#concerts';
            $footer->events_link_text = 'Events';
            $footer->events_link_url = '#events';
            $footer->contact_link_text = 'Contact';
            $footer->contact_link_url = '#contact';
            $footer->address = '123 Radio Street, City, Country';
            $footer->phone = '+1 (123) 456-7890';
            $footer->email = 'info@radiostation.com';
            $footer->frequency = '98.5 FM';
            $footer->facebook_url = '#';
            $footer->instagram_url = '#';
            $footer->twitter_url = '#';
            $footer->youtube_url = '#';
            $footer->copyright_text = '2023 Radio Station. All Rights Reserved.';
            return $footer;
        }
    }
}
