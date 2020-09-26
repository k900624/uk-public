<?php

namespace App\Services\Image;

use Intervention\Image\Facades\Image as InterventionImage;
use Illuminate\Support\Facades\Storage;
use \Str;

class Image {
    
    private $width;
    private $height;
    private $maxWidth = 1000;
    private $outputExtention = null; // extention of file

    public function __construct()
    {
        $config = config('image');
        $this->_initialize($config);
    }
    
    /**
     * Initialize the configuration options
     *
     * @param    array $config
     * @return void
     */
    private function _initialize($config = [])
    {
        foreach ($config['thumbnails'] as $key => $val) {
            $this->$key = $val;
        }

        $this->maxWidth = $config['max_width'];
        $this->maxHeight = $config['max_height'];
    }

    /**
     * Set extention
     *
     * @access public
     * @param    string $ext
     * @return obj
     */
    public function setExtention($ext)
    {
        $this->outputExtention = $ext;
        return $this;
    }

    /**
     * Set height
     *
     * @access public
     * @param    int $height
     * @return obj
     */
    public function setHeight($height)
    {
        $this->height = $height;
        return $this;
    }

    /**
     * Set width
     *
     * @access public
     * @param    int $width
     * @return obj
     */
    public function setWidth($width)
    {
        $this->width = $width;
        return $this;
    }

    /**
     * Return path to image
     * 
     * @param  string $path
     * @param  string $object
     * @param  int $width
     * @return string
     */
    public function get($path, $object, $width = null)
    {
        if ($path) {
            $pathParts = pathinfo($path);
        
            if ( ! $width) {
                $filename = $path;
                $defaultName = '/default';
            } else {
                $filename = $pathParts['dirname'] .'/thumbs/'. $width .'/'. $pathParts['basename'];
                $defaultName = '/default_'. $width;
            }

            // Exist file or thumbnail?
            if ( ! $this->fileExist($filename)) {
                // Exist original file?
                if ( ! $this->fileExist($path)) {
                    return url('storage/'. $pathParts['dirname'] . $defaultName .'.png');
                } else {
                    return url('storage/'. $path);
                }
            } else {
                return url('storage/'. $filename);
            }
        } else {
            $props = $this->$object;

            $path = $props['path'];
            
            if ( ! $width) {
                $defaultName = '/default';
            } else {
                $defaultName = '/default_'. $width;
            }
            
            return url('storage/'. $path . $defaultName .'.png');
        }
        
        return null;
    }
    
    /**
     * Create thumbnails from config
     *
     * @access public
     * @param    object    $file
     * @param    string    $object
     * @return void
     */
    public function thumbs($imageForm, $object)
    {
        // get filename with extension
        $filenamewithextension = $imageForm->getClientOriginalName();
        // get filename without extension
        $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
        // get file extension
        $extension = $imageForm->getClientOriginalExtension();

        if ($this->outputExtention) {
            $extension = $this->outputExtention;
        }

        $props = $this->$object;

        $path = $props['path'];
        $mediumSize = $props['medium'];
        $thumbsSize = $props['thumbs'];
        $watermark  = $props['watermark'];

        // filename to store
        $filenametostore = Str::random() .'.'. $extension;

        if ($mediumSize) {
            $this->width = $mediumSize[0];
            $this->height = $mediumSize[1];
        } else {
            $this->width = $this->maxWidth;
            $this->height = $this->maxHeight;
        }

        //
        // Upload Files
        // 
        
        // Main image
        $imageForm->storeAs('public/'. $path, $filenametostore);
        $this->uploadImage('storage/'. $path .'/'. $filenametostore);

        // Create thumbnails
        if ($thumbsSize) {
            foreach ($thumbsSize as $size) {
                $this->width  = $size[0];
                $this->height = $size[1];
                $crop = isset($size[2]) ? $size[2] : false;
                $keep_canvas = isset($size[3]) ? $size[3] : false;

                $this->createThumbnail('storage/'. $path .'/'. $filenametostore, [
                    'crop'        => $crop,
                    'keep_canvas' => $keep_canvas,
                    'watermark'   => $watermark,
                ]);
            }
        }
        return $path .'/'. $filenametostore;
    }

    public function deleteImage($item, $object)
    {
        $props = $this->$object;

        $thumbsSize = $props['thumbs'];

        // Delete old image
        $oldImage = $item->image;

        Storage::disk('public')->delete($oldImage);
        // Delete old thumbnails
        if ($thumbsSize) {
            foreach ($thumbsSize as $size) {
                $path_parts = pathinfo($oldImage);
                $thumbnailPath = $path_parts['dirname'] .'/thumbs/'. $size[0] .'/'. $path_parts['basename'];
                Storage::disk('public')->delete($thumbnailPath);
            }
        }
    }

    /**
     * Upload a image of max size
     *
     * @param string $path path of image
     */
    private function uploadImage($path)
    {
        $img = InterventionImage::make($path)->resize($this->width, $this->height, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });
        $img->save($path);
    }

    /**
     * Create a thumbnail of specified size
     *
     * @param string $path path of thumbnail
     * @param array $options, array('crop','grayscale','watermark','keep_canvas')
     */
    private function createThumbnail($path, $options = [])
    {
        $image = InterventionImage::make($path);

        $pathParts = pathinfo($path);
        $part = str_replace('storage/', '', $pathParts['dirname']);
        $thumbnailPathDir = $part .'/thumbs/'. $this->width;
        $thumbnailPath = $part .'/thumbs/'. $this->width .'/'. $pathParts['basename'];

        // If real image width and height more that max
        if ($image->width() >= $this->width || $image->height() >= $this->height) {

            // Not null
            if ($this->width != null && $this->height != null) {

                if ($options['crop']) {

                    $img = $this->crop($image, $this->width, $this->height);

                } else {

                    if ($options['keep_canvas']) {

                        if ($image->width() > $this->width) {
                            $this->resize($image, $this->width, null, false);
                        }
                        if ($image->height() > $this->height) {
                            $this->resize($image, null, $this->height, false);
                        }

                        $this->resizeCanvas($image, $this->width, $this->height);

                    } else {
                        $this->resize($image, $this->width, $this->height);
                    }
                }

            // Height is null
            } elseif ($this->width != null && $this->height == null) {

                if ($options['crop']) {
                    $this->fit($image, $this->width, $image->height());
                } else {
                    $this->Widen($image, $this->width);
                }
            }
        }

        // Watermark
        if (isset($watermark)) {
            $this->watermark($image, $watermark['path'], $watermark['position'], $watermark['opacity']);
        }

        // Create directory in not exist
        if ( ! $this->fileExist($thumbnailPathDir)) {
            Storage::disk('public')->makeDirectory($thumbnailPathDir, 0755, true);
        }

        // Save image
        $image->save('storage/'. $thumbnailPath);

        $image->destroy();
    }

    private function resize($image, $width, $height, $upsize = true)
    {
        $image->resize($width, $height, function ($constraint) use ($upsize) {
            $constraint->aspectRatio();
            if ($upsize) {
                $constraint->upsize();
            }
        });
    }

    private function resizeCanvas($image, $width, $height)
    {
        $image->resizeCanvas($width, $height, 'center', false, '#ffffff');
    }

    private function fit($image, $width, $height, $upsize = true)
    {
        $image->fit($width, $height, function ($constraint) use ($upsize) {
            $constraint->aspectRatio();
            if ($upsize) {
                $constraint->upsize();
            }
        });
    }

    private function crop($image, $width, $height)
    {
        $image->fit($width, $height);
    }

    private function Widen($image, $width)
    {
        $image->Widen($width);
    }

    /**
     * Watermark
     *
     * @param object  $image
     * @param string  $path
     * @param string  $position (top-left (default), top, top-right, left, center, right, bottom-left, bottom, bottom-right)
     * @param integer $opacity
     * @return Imagine
     */
    private function watermark($image, $path, $position = 'bottom-right', $opacity = 100)
    {
        $watermark = InterventionImage::make($path);

        $width = $image->width();
        $height = $image->height();

        if ($watermark->width() > $width || $watermark->height() > $height) {
            $this->resize($watermark, $width, $height);
        }

        if ( ! is_null($opacity) && $opacity >= 0 && $opacity <= 100) {
            $watermark->opacity($opacity);
        }
        $image->insert($watermark, $position, 10, 10);
        
        return $this;
    }
    
    /**
     * Is Image Exist
     *
     * @param    string $file
     * @return boolean
     */
    private function fileExist($file)
    {
        return Storage::disk('public')->exists($file);
    }
}
