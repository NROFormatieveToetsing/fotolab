<?php

function EXAMPLE_LIGHTER($original_red, $original_green, $original_blue) 
  // making a pixel color lighter
{
  $increasing_factor = 1.20;
  
  $lighter_red = $original_red;
  $lighter_green = $original_green;
  $lighter_blue = $original_blue;

/*
   
   write your code here 
   
   */

 return array(round($lighter_red), round($lighter_green), round($lighter_blue));
 }  



function MAKE_LIGHTER_COMPONENTS($original_red, $original_green, $original_blue) 
  // making a pixel color lighter
{
  $increasing_factor = 1.20;
  
  $lighter_red = $original_red;
  $lighter_green = $original_green;
  $lighter_blue = $original_blue;
  
/*
   
   write your code here 
   
   */


   
 return array(round($lighter_red), round($lighter_green), round($lighter_blue));
 }   

 
 
function blurring_pixel ($original_red, $original_green, $original_blue)
{
   $new_red = $original_red;
   $new_green = $original_green;
   $new_blue = $original_blue;
  /*
   
   write your code here 
   
   */

    
 return array($new_red, $new_green, $new_blue);
}



function grey_pixel ($original_red, $original_green, $original_blue)       
 {
   $new_red = $original_red;
   $new_green = $original_green;
   $new_blue = $original_blue;
   
    /*
      write your code here 
  */

     
 return array(round($new_red), round($new_green), round($new_blue));
 
 }       


 function negative_pixel ($original_red, $original_green, $original_blue)         
 {
  $negative_red = $original_red;
  $negative_green = $original_green;
  $negative_blue = $original_blue;

 /*
      write your code here 
  */
     
 return array($negative_red, $negative_green, $negative_blue);
 } 
 
 
 
 function darker_pixel ($original_red, $original_green, $original_blue) 
 {

  $decreasing_factor = 0.7;
  
  $darker_red = $original_red;
  $darker_green = $original_green;
  $darker_blue = $original_blue;

 /*
      write your code here 
  */

     
 return array(round($darker_red), round($darker_green), round($darker_blue));   
 } 
 
 
 
 
 
 
 function red_eye_removal_pixel ($original_red,$original_green,$original_blue) 
 {

  $t = colordistance (255,0,0,$original_red,$original_green,$original_blue); 
  $new_red = $original_red;
  $new_green = $original_green;
  $new_blue = $original_blue;
  
  /*
      write your code here 
   */ 

     return array($new_red, $new_green, $new_blue);
 }
 
 function HALFDARKER_HALFNEGATIVE($ImageMatrix,$width,$height)
 {
     //You can use functions below to write your code:
     // ImageColorAt ($ImageMatrix, $i, $j): which returns color of pixel at 
     // column $i and row $j of $ImageMatrix.
     // ColorComponents ($rgb):returns red, green and blue values of $rgb
     //ImageColorAllocate ($ImageMatrix, $r, $g, $b): encodes $r, $g, $b values
     // and returns a $rgb value 
     //IMAGESETPIXEL($ImageMatrix, $i, $j, $rgb): set color $rgb to pixel at 
     //column $i and row $j in $ImageMatrix
     
     $dark_factor = 0.6;
     
     /*
      write your code here 
     */ 
       
     return $ImageMatrix;
 }