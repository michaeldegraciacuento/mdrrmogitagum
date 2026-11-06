<?php

/*
|--------------------------------------------------------------------------
| MDRRMO Gitagum — Site Content
|--------------------------------------------------------------------------
| Edit the values below to update the website without touching the views.
| IMPORTANT: Replace the placeholder hotline numbers / email with the
| official ones from the MDRRMO Gitagum office before going live.
*/

return [

    'name' => 'MDRRMO Gitagum',
    'full_name' => 'Municipal Disaster Risk Reduction and Management Office of Gitagum',
    'tagline' => 'Handa. Ligtas. Matatag.',
    'description' => 'Official website of the Municipal Disaster Risk Reduction and Management Office (MDRRMO) of Gitagum, Misamis Oriental. Emergency hotlines, disaster preparedness tips, advisories, and community safety information.',
    'keywords' => 'MDRRMO Gitagum, Gitagum Misamis Oriental, disaster risk reduction, emergency hotline Gitagum, rescue Gitagum, disaster preparedness, typhoon advisory, flood, earthquake, Northern Mindanao',

    'address' => [
        'street' => 'Municipal Hall, Poblacion',
        'locality' => 'Gitagum',
        'region' => 'Misamis Oriental',
        'postal_code' => '9020',
        'country' => 'PH',
    ],

    // The first hotline is shown as the primary number across the site.
    'hotlines' => [
        ['label' => 'MDRRMO Rescue (24/7)', 'number' => '0975 840 3809'],
        ['label' => 'MDRRMO Alternate Line', 'number' => '0981 136 8638'],
        ['label' => 'BFP Gitagum', 'number' => '0966 994 9840'],
        ['label' => 'PNP Gitagum', 'number' => '0998 598 6952'],
        ['label' => 'National Emergency Hotline', 'number' => '911'],
    ],

    'email' => 'mdrrmcgitagum@gmail.com',
    'facebook' => 'https://www.facebook.com/profile.php?id=100089103559985',

    'barangays' => [
        'Burnay', 'Carlos P. Garcia', 'Cogon', 'Gregorio Pelaez', 'Kilangit', 'Matangad',
        'Pangayawan', 'Poblacion', 'Quezon', 'Tala-o', 'Ulab',
    ],
];
