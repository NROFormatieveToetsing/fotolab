<?php



$x = 200;
$y = 200;

//$gd = imagecreatetruecolor($x, $y);
 
//list($width, $height) = getimagesize('images/IMG_3611.jpg');
$filePath = 'images/IMG_3611.jpg';
//if($fileExt == 'jpg'){
$im = imagecreatefromjpeg($filePath);
    if ($im !== false) {
       header('Content-Type: image/jpeg');
       imagejpeg($im);
    }
//}
//if($fileExt == 'png'){
/*$im = imagecreatefrompng($filePath);
    if ($im !== false) {
       header('Content-Type: image/png');
       imagepng($im);
    } */
//}
?>