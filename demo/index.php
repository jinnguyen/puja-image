<?php
include '../vendor/autoload.php';
$image = \Puja\Image\Image::getInstance(__DIR__ . '/image.jpg');
$image->crop(150, 150)->saveTo(__DIR__ . '/image-crop150x150.jpg');
$image->resize(200, 200, \Puja\Image\Image::MODE_FIT)->saveTo(__DIR__ . '/image-resize200x200-fit.jpg');
$image->resize(200, 200, \Puja\Image\Image::MODE_FIT_XY)->saveTo(__DIR__ . '/image-resize200x200-fitxy.jpg');
$image->resize(150, 150, \Puja\Image\Image::MODE_FIT_X)->saveTo(__DIR__ . '/image-resize150x150-fitx.jpg');
$image->resize(150, 150, \Puja\Image\Image::MODE_FIT_Y)->saveTo(__DIR__ . '/image-resize150x150-fity.jpg');
$image->resize(150, 150, \Puja\Image\Image::MODE_FIT_MIN)->saveTo(__DIR__ . '/image-resize150x150-fitmin.jpg');
$image->resize(150, 150, \Puja\Image\Image::MODE_FIT_MAX)->saveTo(__DIR__ . '/image-resize150x150-fitmax.jpg');