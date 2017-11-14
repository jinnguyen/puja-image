<?php
namespace Puja\Image;
interface ImageInterface
{
    const MODE_FIT = 'fit';
    const MODE_FIT_XY = 'fit-xy';
    const MODE_FIT_X = 'fit-x';
    const MODE_FIT_Y = 'fit-y';
    const MODE_FIT_MIN = 'fit-min';
    const MODE_FIT_MAX = 'fit-max';
    
    public function crop();
    public function resize();
    public function copyTo($dest);
    public function saveTo($dest);
    public function display();
}