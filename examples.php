<?php


// Check if image file is a actual image or fake image
if(isset($_POST["uploadimageBtn"])) {
    $target_dir = "images/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 5000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
        $im = imagecreatefrompng($target_file);
        header('Content-Type: image/jpeg');
        imagepng($im);
        
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

if (isset($_POST['GrayBtn'])) {
   $filePath = 'images/gorila.jpg';
//if($fileExt == 'jpg'){
  $im = imagecreatefromjpeg($filePath);
  list($width, $height) = getimagesize($filePath);  
/*
 $width = imagesx($im);
 $height = imagesy ($im);
 * 
 */

//echo $width;
    //if ($im !== false) {
       

//$red = imagecolorallocate($im, 255, 0, 0);        
  for ($i = 0; $i < $width; $i++) 
      for ($j = 0; $j < $height; $j++) {
         $rgb = imagecolorat($im, $i, $j);
       //$color = $color - 50;
         $r = ($rgb >> 16) & 0xFF;
         $g = ($rgb >> 8) & 0xFF;
         $b = $rgb & 0xFF;
      // $color = imagecolorallocate($im, 255-$r, 255-$g, 255-$b);  //creating a negative of a picture
      // $color = imagecolorallocate($im, round($r*1.5), round($g*1.5), round($b*1.5));  //darker picture
      // $color = imagecolorallocate($im, round($r*0.5), round($g*0.5), round($b*0.5));  //lighter picture
         $grey = ($r+$g+$b)/3;
       $color = imagecolorallocate($im, round($grey), round($grey), round($grey));  //lighter picture
       imagesetpixel($im, $i, $j, $color);
}       
header('Content-Type: image/jpeg');
       imagepng($im);
  //  }
}
?>



<html>
<head>
    <meta charset="UTF-8">
    <title></title>
    
    <style>
        form {
            margin: 0 auto;
            margin-top: 5em;
            width: 400px;
            padding: 1em;
            border: 1px solid #CCC;
            border-radius: 1em;
            background-color:#E6E6FA;
        }

        form div + div {
            margin-top: 1em;
        }

        label {
            display: inline-block;
            width: 350px;
        }

        input:focus, textarea:focus {
            border-color: #000;
        }

        textarea {
            vertical-align: top;
            height: 14em;
            resize: vertical;
            width: 99%;
            box-sizing: border-box;
            padding: 3%;
        }
        .assinment_s {
            padding-left: 10px;
                        position:relative;
            transition: .5s ease;
            left:2%
        }

        assinment_s {
            margin-left: .05em;
        }    
        .button {
            padding-left: 15px;
                        position:relative;
            transition: .5s ease;
            left:8%
        }

        button {
            margin-left: .5em;
        }
        .button1 {
            padding-left: 40px;
            position:relative;
            transition: .5s ease;
            left:8%
        }

        button1 {
            margin-left: .5em;
        }
    </style>
</head>
<body>

<form action="examples.php" method="post" enctype="multipart/form-data"     id="form1" >
    <div style="visibility:'hidden';" class="imageholder"> <!-- a gif image to show that the process wasn't finished -->
    </div>
        <input type="file" name="fileToUpload" id="fileToUpload">
            <br/>
        <input type="submit" name="uploadimageBtn" value="Upload Image" style="color:white;background-color: forestgreen; border-radius: 10px;font-size: small; padding:3px;border:0px solid #336600;"></button>
        
    </div>
    <br/>
        <hr>
        <input type="submit" name="LightenBtn" value="Lighter" style="color:white;background-color: lightblue; border-radius: 10px;font-size: small; padding:3px;border:0px solid #336600;"></button>
        <input type="submit" name="DarkenBtn" value="Darker" style="color:white;background-color: forestgreen; border-radius: 10px;font-size: small; padding:3px;border:0px solid #336600;"></button>
        <input type="submit" name="GrayBtn" value="Grey" style="color:white;background-color: forestgreen; border-radius: 10px;font-size: small; padding:3px;border:0px solid #336600;"></button>
        <input type="submit" name="MirrorBtn" value="Horizontal Mirroring" style="color:white;background-color: forestgreen; border-radius: 10px;font-size: small; padding:3px;border:0px solid #336600;"></button>
 
    </div>
    
    
    

    
    
    
</body>
</html>
