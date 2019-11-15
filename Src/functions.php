<?php
include 'students_functions.php';
function imagespec ($image)   //this function recieves an image path/name and returns its spec
{
  $target_file = $image;
  $width = 0;
  $height = 0;
  
  //$im="";
  
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
     
  if($imageFileType == "jpg" or $imageFileType == "jpeg")
          $im = imagecreatefromjpeg($target_file);

  if($imageFileType == "png")
          $im = imagecreatefrompng($target_file);

  if($imageFileType == "gif")
          $im = imagecreatefromgif($target_file);
 
  //list($width, $height) = getimagesize($target_file);     
  $width = imagesx($im);
  $height = imagesy ($im);
  return array($target_file, $width, $height, $im,$imageFileType);
}


function outputimage ($im, $imageFileType){      //this function recieves an image and its type (i.e. jpg, png) and send it to the index page
    
    if($imageFileType == "jpg" or $imageFileType == "jpeg"){
           //header('Content-Type: image/jpeg');
           $convertedfile = 'temp/outputimage.jpg';
           if (file_exists($convertedfile)) 
               unlink ($convertedfile);
           
            imagejpeg($im, $convertedfile);
            //$greyfile = $greyimagejpg;
            imagedestroy($im);
            
           //imagejpeg($im, 'simpletext.jpg');
           
      }
      
   if($imageFileType == "png"){
           //header('Content-Type: image/png');
       
           $convertedfile = 'temp/outputimage.png';
           if (file_exists($convertedfile)) 
               unlink ( $convertedfile);
           
            imagepng($im, $convertedfile);
            
           
           imagedestroy($im);
      }   
      
   if($imageFileType == "gif"){
           //header('Content-Type: image/gif');
           $convertedfile = 'temp/outputimage.gif';
           if (file_exists($convertedfile)) 
               unlink ( $convertedfile);
           
            imagegif($im, $convertedfile);
           
           imagedestroy($im);
      }   
    
      
      
      header('Location:index.php?convertedfile='.$convertedfile);
    
    
}



function colorcomponents ($rgb){
    $r = ($rgb >> 16) & 0xFF;
    $g = ($rgb >> 8) & 0xFF;
    $b = $rgb & 0xFF;
    
    return array($r, $b, $g);
}

function colordistance ($r1,$g1,$b1,$r2,$g2,$b2)   //calculates and return the distance between two colors (r1,g1,b1) and (r2,g2,b2)
  {
    return sqrt(pow(($r1-$r2),2)+pow(($g1-$g2),2)+pow(($b1-$b2),2));
}





function grey ($image)
  {
   
   list ($target_file, $width, $height, $im,$imageFileType) = imagespec ($image);

  for ($i = 0; $i < $width; $i++) 
      for ($j = 0; $j < $height; $j++) {
        $rgb = imagecolorat($im, $i, $j);
       
       list ($r, $b, $g) = colorcomponents ($rgb);

       $grey = ($r+$g+$b)/3;
       $color = imagecolorallocate($im, round($grey), round($grey), round($grey));  //grey picture
       //list ($new_red, $new_green, $new_blue) = grey_pixel ($r, $b, $g);
       //$color = imagecolorallocate($im, round($new_red), round($new_green), round($new_blue));  //grey picture
       imagesetpixel($im, $i, $j, $color);
       }       
    
    //header("location:index.php?img=".$image);   
      outputimage($im, $imageFileType);
      
   
  }

  
  
  
  

  
  
  
function darker ($image)
  {
  
    
   list ($target_file, $width, $height, $im,$imageFileType) = imagespec ($image); 
    
    

  for ($i = 0; $i < $width; $i++) 
      for ($j = 0; $j < $height; $j++) {
         
          $rgb = imagecolorat($im, $i, $j);

        list ($r, $b, $g) = colorcomponents ($rgb);

         $color = imagecolorallocate($im, round($r*0.5), round($g*0.5), round($b*0.5));  //lighter picture
       
       imagesetpixel($im, $i, $j, $color);
       }       
       
   outputimage($im, $imageFileType);
  }

  
  
  
  
  
  
function lighter ($image)
  {
  
  list ($target_file, $width, $height, $image_matrix,$imageFileType) = imagespec ($image); 
  $inc_factor = 1.25;
  for ($i = 0; $i < $width; $i++) 
      for ($j = 0; $j < $height; $j++) {
         $rgb = imagecolorat($image_matrix, $i, $j);

         list ($r, $b, $g) = colorcomponents ($rgb);
         
         $lighter_red = round($r*$inc_factor);
         $lighter_green = round($g*$inc_factor);
         $lighter_blue = round($b*$inc_factor);
         
         list ($lighter_red, $lighter_green, $lighter_blue) = EXAMPLE_LIGHTER($r, $g, $b);  //d
         $color = imagecolorallocate($image_matrix, $lighter_red, $lighter_green, $lighter_blue);   //d
        // $color = imagecolorallocate($image_matrix, (($lighter_red < 256)?$lighter_red:255), (($lighter_green< 256)?$lighter_green:255), (($lighter_blue< 256)?$lighter_blue:255));  //lighter picture
         
         //$color = imagecolorallocate($image_matrix, $lighter_red, $lighter_green, $lighter_blue);  //lighter picture
       
       imagesetpixel($image_matrix, $i, $j, $color);
       }       
       
   outputimage($image_matrix, $imageFileType);  
  }
  
  
  
  
  
  
  
  
  function negative ($image)
  {
  
  list ($target_file, $width, $height, $image_matrix,$imageFileType) = imagespec ($image); 
  
  for ($i = 0; $i < $width; $i++) 
      for ($j = 0; $j < $height; $j++) {
         $rgb = imagecolorat($image_matrix, $i, $j);

         list ($r, $b, $g) = colorcomponents ($rgb);
         

         $color = imagecolorallocate($image_matrix, 255-$r, 255-$g, 255-$b);  //lighter picture
         
         //$color = imagecolorallocate($image_matrix, $lighter_red, $lighter_green, $lighter_blue);  //lighter picture
       
       imagesetpixel($image_matrix, $i, $j, $color);
       }       
       
   outputimage($image_matrix, $imageFileType);  
  }
  
  
  

  
  
  function contrast ($image)
  {
  
    
   list ($target_file, $width, $height, $im,$imageFileType) = imagespec ($image); 
    
    $contrast_factor = 80;
    $factor = (259*($contrast_factor + 255))/(255*(259-$contrast_factor));

  for ($i = 0; $i < $width; $i++) 
      for ($j = 0; $j < $height; $j++) {
         
          $rgb = imagecolorat($im, $i, $j);

        list ($r, $b, $g) = colorcomponents ($rgb);

         $new_red = (abs(round($factor *($r-128)+128)) < 256)? abs(round($factor *($r-128)+128)): $r;
         $new_green = (abs(round($factor *($g-128)+128)) < 256)? abs(round($factor *($g-128)+128)) : $g ;
         $new_blue = (abs(round($factor *($b-128)+128) < 256))? abs(round($factor *($b-128)+128)): $b;
        
        $color = imagecolorallocate($im, $new_red, $new_green, $new_blue);  
       
       imagesetpixel($im, $i, $j, $color);
       }       
       
   outputimage($im, $imageFileType);
  }

  
  
 function mirror ($image)
  {
  list ($target_file, $width, $height, $im,$imageFileType) = imagespec ($image); 

for ($i = 0; $i < round ($width/2); $i++) 
    for ($j = 0; $j < $height; $j++) {
       $rgb = imagecolorat($im, $i, $j);
       
      list ($r, $b, $g) = colorcomponents ($rgb);
     
       $color = imagecolorallocate($im, $r, $g, $b);  
       imagesetpixel($im, $width - $i, $j, $color);    //vertical mirroring
   }         
       
   outputimage($im, $imageFileType);  
  }
  
  
  
  
function imageshuffle ($image)
  {
 list ($target_file, $width, $height, $im,$imageFileType) = imagespec ($image); 
 
for ($i = 0; $i < round($width/2)-1; $i++) 
    for ($j = 0; $j < round($height/2)-1; $j++) {
       $rgb1 = imagecolorat($im, $i, $j);        //top left part
       $part1[$i][$j]= $rgb1;
       
       $rgb2 =  imagecolorat($im, $i , $j + round($height/2) );   //bottom left part
       $part2[$i][$j]= $rgb2;
       
       $rgb3 = imagecolorat($im, $i + round($width/2), $j);        //top right part
       $part3[$i][$j]= $rgb3;
       
        $rgb4 =  imagecolorat($im, $i + round($width/2) , $j + round($height/2) );   //bottom right part
       $part4[$i][$j]= $rgb4;
   }         
       
  for ($i = 0; $i < round($width/2)-1; $i++) 
    for ($j = 0; $j < round($height/2)-1; $j++) {
        
       $rgb = $part4[$i][$j]; 
       list ($r, $b, $g) = colorcomponents ($rgb);
       $color = imagecolorallocate($im, $r, $g, $b);  
       imagesetpixel($im, $i, $j, $color);  
       
       $rgb = $part1[$i][$j]; 
       list ($r, $b, $g) = colorcomponents ($rgb);    
       $color = imagecolorallocate($im, $r, $g, $b);  
       imagesetpixel($im, $i+ round($width/2), $j+ round($height/2), $color); 
        
    } 
   

   outputimage($im, $imageFileType);
  }
  
  
  
  
  function rotating ($image)
  {
  list ($target_file, $width, $height, $im,$imageFileType) = imagespec ($image); 
  $rotated_img = imagecreatetruecolor ( $height, $width );
  
  for ($i = 0; $i < $width; $i++) 
    for ($j = 0; $j < $height; $j++) {
       $rgb = imagecolorat($im, $i, $j);
       
      list ($r, $b, $g) = colorcomponents ($rgb);
     
       $color = imagecolorallocate($rotated_img, $r, $g, $b);  
       imagesetpixel($rotated_img, $j, $i, $color);    //vertical mirroring
   }         
       
   outputimage($rotated_img, $imageFileType);  
   
  }
  
  
  
  function redeyeremoval ($image)
  {
  list ($target_file, $width, $height, $im,$imageFileType) = imagespec ($image); 
  
  //pure red color
  $redness = 255;
  $greenness = 0;
  $bluness = 0;
  $new_r = 0;
  $new_g = 0;
  $new_b = 0;
  
  
  //the left eye
  for ($i = 115; $i < 150; $i++) 
    for ($j = 150; $j < 194; $j++) {
       $rgb = imagecolorat($im, $i, $j);
       
       list ($r, $b, $g) = colorcomponents ($rgb);
       
       
        list($new_r, $new_g, $new_b) = red_eye_removal_pixel ($r, $g, $b);

                               
       $color = imagecolorallocate($im, $new_r, $new_g, $new_b);  
       
       imagesetpixel($im, $i, $j, $color);   
   }         
       
   //the right eye
   for ($i = 425; $i < 470; $i++) 
    for ($j = 150; $j < 194; $j++) {
       $rgb = imagecolorat($im, $i, $j);
       
      list ($r, $b, $g) = colorcomponents ($rgb);
       
      list($new_r, $new_g, $new_b) = red_eye_removal_pixel ($r, $g, $b);
                               
       $color = imagecolorallocate($im, $new_r, $new_g, $new_b);  
       
       imagesetpixel($im, $i, $j, $color);    
   }         
    
   outputimage($im, $imageFileType);  
   
  }
  
  
  
  
  
  function blurring ($image)
  {
  
   $new_red = 0;
   $new_green = 0;
   $new_blue = 0;
      list ($target_file, $width, $height, $im,$imageFileType) = imagespec ($image); 

  for ($i = 0; $i < $width; $i = $i+2) 
      for ($j = 0; $j < $height; $j= $j+2) {
         $rgb = imagecolorat($im, $i, $j);

         list ($r, $b, $g) = colorcomponents ($rgb);
         //list ($new_red, $new_blue, $new_red) =  ($r, $b, $g);
         $new_red = $r;
         $new_green = $g;
         $new_blue = $b;
         list ($new_red, $new_blue, $new_red) = blurring_pixel ($r, $g, $b);
         $color = imagecolorallocate($im, $new_red, $new_blue, $new_red);
       
       imagesetpixel($im, $i, $j, $color);
       }       
       
   outputimage($im, $imageFileType); 
  }
  
  
  function halfgrey ($image)
  {
   $new_red = 0;
   $new_green = 0;
   $new_blue = 0;
   list ($target_file, $width, $height, $im,$imageFileType) = imagespec ($image);

  for ($i = 0; $i < $width; $i++) 
      for ($j = 0; $j < $height/2; $j++) {
        $rgb = imagecolorat($im, $i, $j);
       
       list ($r, $b, $g) = colorcomponents ($rgb);
       $new_red = $r;
       $new_green = $g;
       $new_blue = $b; 
       list($new_red, $new_green,$new_blue)= grey_pixel ($r, $g, $b);
       $color = imagecolorallocate($im, round($new_red), round($new_green), round($new_blue));  //grey picture
       //list ($new_red, $new_green, $new_blue) = grey_pixel ($r, $b, $g);
       //$color = imagecolorallocate($im, round($new_red), round($new_green), round($new_blue));  //grey picture
       imagesetpixel($im, $i, $j, $color);
       }       
    
    //header("location:index.php?img=".$image);   
      outputimage($im, $imageFileType);
      
   
  }
  
  function halfdarker ($image)
  {
  
    $new_red = 0;
    $new_green = 0;
    $new_blue = 0;
   list ($target_file, $width, $height, $im,$imageFileType) = imagespec ($image); 
    
    

  for ($i = $width/2; $i < $width; $i++) 
      for ($j = 0; $j < $height; $j++) {
         
          $rgb = imagecolorat($im, $i, $j);

        list ($r, $b, $g) = colorcomponents ($rgb);
        $new_red = $r;
        $new_green = $g;
        $new_blue = $b; 
        list($new_red, $new_green, $new_blue) = darker_pixel ($r, $g, $b);
        $color = imagecolorallocate($im, $new_red, $new_green, $new_blue);  
       
       imagesetpixel($im, $i, $j, $color);
       }       
       
   outputimage($im, $imageFileType);
  }

  
  
    function halfnegative ($image)
  {
    $new_red = 0;
    $new_green = 0;
    $new_blue = 0;
  
  list ($target_file, $width, $height, $image_matrix,$imageFileType) = imagespec ($image); 
  
  for ($i = 0; $i < $width/2; $i++) 
      for ($j = 0; $j < $height; $j++) {
         $rgb = imagecolorat($image_matrix, $i, $j);

         list ($r, $b, $g) = colorcomponents ($rgb);
         $new_red = $r;
         $new_green = $g;
         $new_blue = $b; 
         list ($new_red, $new_green,$new_blue)= negative_pixel ($r, $g, $b);
         $color = imagecolorallocate($image_matrix,$new_red, $new_green,$new_blue);  //lighter picture
         
         //$color = imagecolorallocate($image_matrix, $lighter_red, $lighter_green, $lighter_blue);  //lighter picture
       
       imagesetpixel($image_matrix, $i, $j, $color);
       }       
       
   outputimage($image_matrix, $imageFileType);  
  }
  
  function halflighter ($image)
  {
   $lighter_red = 0;
   $lighter_green = 0;
   $lighter_blue = 0;
  list ($target_file, $width, $height, $image_matrix,$imageFileType) = imagespec ($image); 
  $inc_factor = 1.5;
  for ($i = 0; $i < $width; $i++) 
      for ($j = $height/2; $j < $height; $j++) {
         $rgb = imagecolorat($image_matrix, $i, $j);

         list ($r, $b, $g) = colorcomponents ($rgb);
         $lighter_red = $r;
         $lighter_green = $g;
         $lighter_blue = $b;
         list ($lighter_red, $lighter_green, $lighter_blue) = MAKE_LIGHTER_COMPONENTS($r, $g, $b);
         $color = imagecolorallocate($image_matrix, $lighter_red, $lighter_green, $lighter_blue);  //lighter picture
         
         //$color = imagecolorallocate($image_matrix, $lighter_red, $lighter_green, $lighter_blue);  //lighter picture
       
       imagesetpixel($image_matrix, $i, $j, $color);
       }       
       
   outputimage($image_matrix, $imageFileType);  
  }
  
  //make an image half darker half negative
  function darker_negative ($image)
  {
  
  list ($target_file, $width, $height, $image_matrix,$imageFileType) = imagespec ($image); 
     
       
  $new_image_matrix = HALFDARKER_HALFNEGATIVE($image_matrix,$width,$height);
   outputimage($new_image_matrix, $imageFileType);  
  }