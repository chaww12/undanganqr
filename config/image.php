<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Intervention Image Configuration
    |--------------------------------------------------------------------------
    |
    | Here you can set the configuration options for the Intervention Image
    | library. The settings in this file will override the default values.
    |
    */
    'driver' => \Intervention\Image\Drivers\Gd\Driver::class,

    'options' => [
        'autoOrientation' => true,
        'decodeAnimation' => true,
        'blendingColor' => 'ffffff',
    ]
];
