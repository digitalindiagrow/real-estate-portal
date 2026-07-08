<?php

// Static marketing content for the type-filtered Buy/Rent listing pages
// (hero copy, trust badges, CTA banner stats, "why choose us" bullets).
// Same pattern as config/homepage.php — platform-wide copy, not asserted
// as fact about any specific property. Swap for an admin-editable backend
// later.

return [

    'buy' => [
        'hero_title' => 'Buy Your Dream Property',
        'hero_subtitle' => 'Verified listings. Best locations. Smarter decisions.',
        'hero_image_seed' => 'buy-hero',
        'search_label' => 'Search Properties',
        'trust_strip' => [
            ['icon' => 'M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z', 'title' => '100% Verified', 'sub' => 'Properties Only'],
            ['icon' => 'M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636', 'title' => 'No Brokerage', 'sub' => 'Direct from Owners'],
            ['icon' => 'M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z', 'title' => 'Expert Guidance', 'sub' => 'From Our Advisors'],
            ['icon' => 'M9 8.25H7.5a2.25 2.25 0 00-2.25 2.25v9a2.25 2.25 0 002.25 2.25h9a2.25 2.25 0 002.25-2.25v-9a2.25 2.25 0 00-2.25-2.25H15m-6 0V6a3 3 0 116 0v2.25m-6 0h6', 'title' => 'Best Price', 'sub' => 'Guaranteed Deals'],
        ],
        'cta_banner' => [
            'title' => "Not Sure What You're Looking For?",
            'subtitle' => 'Get personalized property matches from our expert advisors.',
            'button_label' => 'Talk to an Expert',
            'stats' => [
                ['value' => '15K+', 'label' => 'Happy Buyers'],
                ['value' => '500+', 'label' => 'Properties Sold'],
                ['value' => '10+', 'label' => 'Years of Trust'],
                ['value' => '98%', 'label' => 'Client Satisfaction'],
            ],
        ],
        'why_us' => [
            ['title' => 'Verified Listings', 'sub' => '100% genuine properties'],
            ['title' => 'Best Price Guarantee', 'sub' => 'Get the best deal always'],
            ['title' => 'Legal Assistance', 'sub' => 'Complete support'],
            ['title' => 'Home Loan Support', 'sub' => 'Easy financing options'],
            ['title' => 'After Sales Support', 'sub' => "We're with you always"],
        ],
        'why_us_heading' => 'Why Buy With :app?',
        'localities_heading' => 'Top Localities to Buy in :city',
    ],

    'rent' => [
        'hero_title' => 'Find Your Perfect Rental Home',
        'hero_subtitle' => 'Comfortable homes. Verified listings. Hassle-free renting.',
        'hero_image_seed' => 'rent-hero',
        'search_label' => 'Search Rentals',
        'trust_strip' => [
            ['icon' => 'M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z', 'title' => 'Verified Listings', 'sub' => '100% Verified Properties'],
            ['icon' => 'M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636', 'title' => 'No Brokerage', 'sub' => 'Direct from Owners'],
            ['icon' => 'M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 01-2.555-.337A5.972 5.972 0 015.41 20.97a5.969 5.969 0 01-.474-.065 4.48 4.48 0 00.978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25z', 'title' => 'Flexible Options', 'sub' => 'Short & Long Term'],
            ['icon' => 'M8.625 12a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25S3 16.556 3 12 7.03 3.75 12 3.75 21 7.444 21 12z', 'title' => '24/7 Support', 'sub' => "We're Here to Help"],
        ],
        'cta_banner' => [
            'title' => "Can't Find What You're Looking For?",
            'subtitle' => 'Let us help you find the perfect rental.',
            'button_label' => 'Talk to Our Rental Expert',
            'stats' => [
                ['value' => '1.5K+', 'label' => 'Rentals Available'],
                ['value' => '500+', 'label' => 'Happy Tenants'],
                ['value' => '10+', 'label' => 'Years of Trust'],
                ['value' => '98%', 'label' => 'Satisfaction Rate'],
            ],
        ],
        'why_us' => [
            ['title' => 'Verified Owners', 'sub' => 'Every listing is verified'],
            ['title' => 'Save & Shortlist', 'sub' => 'Save your favorites'],
            ['title' => 'Contact Directly', 'sub' => 'Chat or call owners'],
            ['title' => 'Easy Agreements', 'sub' => 'Hassle-free documentation'],
        ],
        'why_us_heading' => 'Renting Made Easy',
        'localities_heading' => 'Top Localities for Rent in :city',
    ],

];
