<?php
namespace Puja\Image\Processor;
abstract class ProcessorAbstract
{
    protected $src;
    protected $srcInfo;
    public function __construct($srcImg, $srcInfo = null)
    {
        $this->src = $srcImg;
        $this->srcInfo = $srcInfo;
        
    }

    protected function imageCopy($dst_im, $src_im, $dst_x, $dst_y, $src_x, $src_y, $src_w, $src_h)
    {
        return imagecopy($dst_im, $src_im, $dst_x, $dst_y, $src_x, $src_y, $src_w, $src_h);
    }

    protected function imageCreateTrueColor($width, $height)
    {
        return imagecreatetruecolor($width, $height);
    }

    protected function imageCreateFromSrc()
    {
        switch ($this->srcInfo['mime']) {
            case 'image/jpeg':
                return imagecreatefromjpeg($this->src);
                break;
            case 'image/gif':
                return imagecreatefromgif($this->src);
                break;
            case 'image/png':
                return imagecreatefrompng($this->src);
                break;
        }

        return false;
    }

    protected function imageCopyResampled ($dst_image, $src_image, $dst_x, $dst_y, $src_x, $src_y, $dst_w, $dst_h, $src_w, $src_h)
    {
        return imagecopyresampled ($dst_image, $src_image, $dst_x, $dst_y, $src_x, $src_y, $dst_w, $dst_h, $src_w, $src_h);
    }

    protected function imageDestroy($image)
    {
        imagedestroy($image);
    }
}