<?php

// Static marketing content for the homepage. Once an admin-managed backend
// exists for these concepts (investment projects, builders, testimonials),
// swap these array reads for real Eloquent queries.

return [

    'stats' => [
        ['value' => '15K+', 'label' => 'Properties'],
        ['value' => '8K+', 'label' => 'Happy Clients'],
        ['value' => '500+', 'label' => 'Builders'],
        ['value' => '10K+', 'label' => 'Daily Visitors'],
    ],

    'investment_projects' => [
        [
            'title' => 'BCM Downtown',
            'location' => 'Super Corridor, Indore',
            'badge' => 'High Return',
            'expected_return' => '18% - 24% P.A.',
            'min_investment' => '5,000',
            'image_seed' => 'bcm-downtown',
        ],
        [
            'title' => 'Green City Township',
            'location' => 'Ujjain Road, Indore',
            'badge' => 'New Launch',
            'expected_return' => '16% - 22% P.A.',
            'min_investment' => '5,000',
            'image_seed' => 'green-city-township',
        ],
        [
            'title' => 'Skyline Heights',
            'location' => 'AB Road, Indore',
            'badge' => 'Popular',
            'expected_return' => '20% - 26% P.A.',
            'min_investment' => '5,000',
            'image_seed' => 'skyline-heights',
        ],
    ],

    'builders' => [
        ['name' => 'BCM Group'],
        ['name' => 'Silver Group'],
        ['name' => 'OB City Group'],
        ['name' => 'Agarwal Builders'],
        ['name' => 'Sarthak Builders'],
        ['name' => 'Purnam Group'],
    ],

    'why_choose_us' => [
        ['title' => 'Verified Deals', 'description' => '100% verified properties for a safe experience.'],
        ['title' => 'Investment Guidance', 'description' => 'Get the best advice for high return investments.'],
        ['title' => 'Zero Brokerage', 'description' => 'Save more with zero brokerage on select listings.'],
        ['title' => 'Personalized Support', 'description' => 'Dedicated relationship manager at every step.'],
    ],

    'testimonials' => [
        [
            'name' => 'Ankit Sharma',
            'location' => 'Indore',
            'rating' => 5,
            'quote' => 'Found my dream home through this platform. The team was professional, transparent and helped me through every step.',
        ],
        [
            'name' => 'Priya Verma',
            'location' => 'Bhopal',
            'rating' => 5,
            'quote' => 'Listing my property was completely free and I got genuine buyer enquiries within days. Highly recommend.',
        ],
        [
            'name' => 'Rahul Nair',
            'location' => 'Pune',
            'rating' => 4,
            'quote' => 'The investment project section helped me pick a high-return project confidently. Great support throughout.',
        ],
    ],

];
