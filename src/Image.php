<?php
namespace Puja\Image;

class Image implements ImageInterface
{
    protected $src;
    protected $compiledObj;
    protected static $instances;


    /**
     * @param $srcImage
     * @return static
     */
    public static function getInstance($srcImage)
    {
        if (empty(static::$instances[$srcImage])) {
            static::$instances[$srcImage] = new static($srcImage);
        }

        return static::$instances[$srcImage];
    }

    public function __construct($srcImage)
    {
        if (false === file_exists($srcImage)) {
            throw new Exception(sprintf('File %s dont exist', $srcImage));
        }

        $this->src = $srcImage;
        $this->srcInfo = getimagesize($this->src);
        if (false === $this->srcInfo) {
            throw new Exception('Cannot resize a no image file ' . $this->src);
        }
    }

    public function copyTo($dest)
    {
        $processor = new Processor\Image($this->src, $this->srcInfo);
        $processor->copyTo($dest);
    }


    public function resize($width = 0, $height = 0, $mode = self::MODE_FIT)
    {
        $processor = new Processor\Resize($this->src, $this->srcInfo);
        $this->compiledObj = $processor->processResize($width, $height, $mode);
        return $this;
    }


    public function crop($width = 0, $height = 0, $x = 0, $y = 0)
    {
        $processor = new Processor\Crop($this->src, $this->srcInfo);
        $this->compiledObj = $processor->processCrop($width, $height, $x, $y);
        return $this;
    }

    public function saveTo($dest)
    {
        if (empty($this->compiledObj)) {
            throw new Exception('Need crop/resize before save');
        }

        $processor = new Processor\Image($this->src, $this->srcInfo);
        $processor->saveTo($this->compiledObj, $dest);
        $this->compiledObj = null;
    }

    public function display()
    {
        if (empty($this->compiledObj)) {
            throw new Exception('Need crop/resize before save');
        }

        $processor = new Processor\Image($this->src, $this->srcInfo);
        $processor->display($this->compiledObj);
        $this->compiledObj = null;
    }
    
}