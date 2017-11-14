<?php
namespace Puja\Image\Processor;
class Image extends ProcessorAbstract
{
    public function saveTo($oImg, $dest)
    {
        $result = false;
        switch ($this->srcInfo['mime']) {
            case 'image/jpeg':
                $result = imagejpeg($oImg, $dest);
                break;
            case 'image/gif':
                $result = imagegif($oImg, $dest);
                break;
            case 'image/png':
                $result = imagejpeg($oImg, $dest);
                break;
        }
        if (false === $result) {
            throw new \Puja\Image\Exception('Cannot save resize image to ' . dirname($dest) . DIRECTORY_SEPARATOR);
        }
        return false;
    }

    public function display($oImg)
    {
        $mapMine = array(
            'image/jpeg' => true,
            'image/gif' => true,
            'image/png' => true,
        );

        if (empty($mapMine[$this->srcInfo['mime']])) {
            throw new \Puja\Image\Exception('Cannot display image: ' . $this->srcInfo['mime']);
        }

        header('Content-Type: ' . $this->srcInfo['mime']);
        switch ($this->srcInfo['mime']) {
            case 'image/jpeg':
                imagejpeg($oImg);
                break;
            case 'image/gif':
                imagegif($oImg);
                break;
            case 'image/png':
                imagejpeg($oImg);
                break;
        }
    }

    public function copyTo($dest)
    {
        $success = copy($this->src, $dest);
        if (false === $success) {
            throw new \Puja\Image\Exception('Cannot copy file ' . $this->src . ' to ' . $dest);
        }
    }

}