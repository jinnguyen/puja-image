<?php
namespace Puja\Image\Processor;
use Puja\Image\ImageInterface;

class Resize extends ProcessorAbstract
{
    public function processResize($width = 0, $height = 0, $mode = ImageInterface::MODE_FIT)
    {
        list ($width, $height) = $this->getImageSize($width, $height, $mode);
        $img = $this->imageCreateFromSrc();
        $oImg = $this->imageCreateTrueColor($width, $height);
        $this->imageCopyResampled($oImg, $img, 0, 0, 0, 0, $width, $height, $this->srcInfo[0], $this->srcInfo[1]);

        return $oImg;
    }

    protected function getImageSize($width, $height, $mode)
    {
        switch ($mode) {
            case ImageInterface::MODE_FIT:
                return $this->getSizeFit($width, $height);
                break;
            case ImageInterface::MODE_FIT_XY:
                return $this->getSizeFitXY($width, $height);
                break;
            case ImageInterface::MODE_FIT_X:
                return $this->getSizeFitX($width);
                break;
            case ImageInterface::MODE_FIT_Y:
                return $this->getSizeFitY($height);
                break;
            case ImageInterface::MODE_FIT_MIN:
                return $this->getSizeFitMin($width, $height);
                break;
            case ImageInterface::MODE_FIT_MAX:
                return $this->getSizeFitMax($width, $height);
                break;
            default:
                throw new \Puja\Image\Exception('Not support mode: ' . $mode);

        }
    }

    protected function getSizeFit($width, $height)
    {
        if ($this->srcInfo[0] < $width) {
            $width = $this->srcInfo[0];
        }

        if ($this->srcInfo[1] < $height) {
            $height = $this->srcInfo[1];
        }

        return array($width, $height);
    }

    protected function getSizeFitXY($width, $height)
    {
        return array($width, $height);
    }

    protected function getSizeFitX($width)
    {
        return array(
            $width,
            round($width * $this->srcInfo[1] / $this->srcInfo[0])
        );
    }

    protected function getSizeFitY($height)
    {
        return array(
            round($this->srcInfo[0] * $height / $this->srcInfo[1]),
            $height
        );
    }

    protected function getSizeFitMin($width, $height)
    {
        if ($this->srcInfo[0] <= $this->srcInfo[1]) {
            $height = round($width * $this->srcInfo[1] / $this->srcInfo[0]);
        } else {
            $width = round($this->srcInfo[0] * $height / $this->srcInfo[1]);
        }

        return array($width, $height);
    }


    protected function getSizeFitMax($width, $height)
    {
        if ($this->srcInfo[0] >= $this->srcInfo[1]) {
            $height = round($width * $this->srcInfo[1] / $this->srcInfo[0]);
        } else {
            $width = round($this->srcInfo[0] * $height / $this->srcInfo[1]);
        }

        return array($width, $height);
    }

}