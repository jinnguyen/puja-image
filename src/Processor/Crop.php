<?php
namespace Puja\Image\Processor;
class Crop extends ProcessorAbstract
{
    public function processCrop($width = 0, $height = 0, $x = 0, $y = 0)
    {

        try {
            $img = $this->imageCreateTrueColor($width, $height);
            $src = $this->imageCreateFromSrc($this->src);

            $this->imageCopy($img, $src, 0, 0, $x, $y, $width, $height);
            return $img;

        } catch (\Puja\Image\Exception $e) {
            throw new \Puja\Image\Exception($e->getMessage());
        }

        return null;
    }
}