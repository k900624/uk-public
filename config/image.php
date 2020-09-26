<?php

    /*
    *--------------------------------------------------------------------------
    *  Image Sizes
    *--------------------------------------------------------------------------
    *
    *  Specify the preset sizes you want to use in your code. Only these preset
    *  will be accepted by the controller for security.
    *
    *  Example:
    *
    *  "avatars" => [                                                   // Object_name
    *      "path"   => "avatars",                                       // Path ==> storage/app/{ path }
    *      "medium" =>  [$width = null, $height = null, $crop = false],
    *      "original" => true,                                          // Create original image, default true
    *      "thumbs"  => [
    *           [
    *               'width',                                            // Width image ==> storage/app/avatars/{ width }
    *               'height',                                           // Height image
    *               'crop',                                             // Crop image, default false
    *               'keep_canvas',                                      // Keep image size, default false
    *           ],
    *       ],
    *       "watermark" => [
    *           "path"     => "",                                       // Watermark image, default null
    *           "position" => "bottom-right",                           // Position (top-left, top, top-right, left, center,
    *                                                                   //   right, bottom-left, bottom, bottom-right (default))
    *           "opacity"  => 75,                                       // Opacity in percent, default 100
    *       ]
    *  ]
    *
    */

return [

    // Max sizes original image
    'max_width'  => 1000,
    'max_height' => 1000,

    // Thumbnail options
    'thumbnails' => [

        "avatars" => [
            "path"      => 'avatars',
            "medium"    => [400, null],
            "thumbs"    => [
                [32, 32, true],
                [50, 50, true],
                [100, 100, true],
                [200, 200, true],
            ],
            "watermark" => null,
        ],

        "crop_avatars" => [
            "path"          => 'avatars',
            "medium"        => false,
            "original"      => false,
            "thumbs"        => [
                [32, 32, true],
                [50, 50, true],
                [100, 100, true],
            ],
            "watermark"     => null,
        ],

        "articles" => [
            "path"      => 'articles',
            "medium"    => [600, 400],
            "thumbs"    => [
                [100, 75, true],
                [350, 250],
            ],
            "watermark" => [
                "path"     => "images/elements/watermark.png",
                "position" => "bottom-right",
                "opacity"  => 90,
            ],
        ],

        "reviews" => [
            "path"      => 'reviews',
            "original"  => false,
            "medium"    => [600, 400],
            "thumbs"    => [
                [200, 200, true],
            ],
            "watermark" => null,
        ],

        "products" => [
            "path"      => 'shop/products',
            "medium"    => [600, 800],
            "thumbs"    => [
                [80, 80, false, true],
                [100, 150, true],
                [275, 350, true],
                [350, 466, true],
            ],
            "watermark" => [
                "path"     => "images/elements/watermark.png",
                "position" => "bottom-right",
                "opacity"  => 90,
            ],
        ],

        "additional_products" => [
            "path"      => 'shop/products/addition',
            "medium"    => [600, 800],
            "thumbs"    => [
                [80, 80, false, true],
                [100, 150, true],
                [275, 350, true],
                [350, 466, true],
            ],
            "watermark" => [
                "path"     => "images/elements/watermark.png",
                "position" => "bottom-right",
                "opacity"  => 90,
            ],
        ],
        
        "brands" => [
            "path"      => 'brands',
            "original"  => false,
            "medium"    => [600, 400],
            "thumbs"    => [
                [200, 200, true],
            ],
            "watermark" => null,
        ],

    ],

];
