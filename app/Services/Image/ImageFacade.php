<?php

namespace App\Services\Image;

use Illuminate\Support\Facades\Facade;

class ImageFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'imageThumb';
    }
}
