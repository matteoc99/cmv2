<?php

namespace App\Services;

class DownsizerService
{

    public static function scaleDown($file,$mime,$factor){
        if($mime=="png"){
            $image = imagecreatefrompng($file);   // For PNG
        }else{
            $image = imagecreatefromjpeg($file); // For JPEG
        }

        $oldw = imagesx($image);
        $oldh = imagesy($image);
        $factor = max($factor*$oldw,1);

        $imgResized = imagescale($image , $oldw/$factor, $oldh/$factor);
        if($mime=="png"){
            imagepng($imgResized, $file); //for png
        }else{
            imagejpeg($imgResized, $file); //for jpeg
        }

    }
}
