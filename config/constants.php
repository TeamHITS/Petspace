<?php

return [
    'google'        => [
        'maps' => [
//            'api_key' => 'e5ce287884c213bb27c4189f9e0a748043f6ee91',
            'api_key' => 'AIzaSyBaqAOKxwrCNbg_Vb6S5DV5XatDsQ1Ydfo',
        ]
    ],
    'distance_unit' => env(env('DISTANCE_UNIT', 'MILES')),
    'min_distance'  => env('MIN_DISTANCE', '10'),
    'notifications' => [
        'technician-on-way'      => 'Technician on the way.',
        'technician-at-location' => 'Technician at your location.',
        'service-in-progress'    => 'Service in Progress.',
        'service-completed'      => 'Service Completed.',
        'service-reminder'       => 'Service reminder.',
        'rating-reminder'        => 'Rate service.',
        'promotion'              => 'promotion.'
    ]
];