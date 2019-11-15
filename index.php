<?php

session_start();
 
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'functions.php';  
include 'uploadfile.php';

$initialimage = "images/gorila.jpg";

if (isset($_GET['uploadedfile']))
    $_SESSION["currentpicture"] = filter_input(INPUT_GET, 'uploadedfile');
    //echo $_SESSION["currentpicture"];
if (isset($_POST['uploadimageBtn'])) {
    //echo $_FILES["fileToUpload"]["name"];
    //echo $_FILES["fileToUpload"]["size"];
    fileuploading ($_FILES["fileToUpload"]["name"], $_FILES["fileToUpload"]["tmp_name"], $_FILES["fileToUpload"]["size"]); 

}
if (isset($_POST['LighterBtn'])) {
    lighter($_SESSION["currentpicture"]); 

}

if (isset($_POST['DarkerBtn'])) {
    darker($_SESSION["currentpicture"]); 
}


if (isset($_POST['GreyBtn'])) {
    //echo $_SESSION["currentpicture"];
    grey($_SESSION["currentpicture"]); 
}

if (isset($_POST['NegativeBtn'])) {
    negative($_SESSION["currentpicture"]); 
}

if (isset($_POST['ContrastBtn'])) {
    contrast($_SESSION["currentpicture"]); 
}
if (isset($_POST['MirroringBtn'])) {
    mirror($_SESSION["currentpicture"]); 
}    
if (isset($_POST['ShuffleBtn'])) {
    imageshuffle($_SESSION["currentpicture"]); 
}
if (isset($_POST['RotateBtn'])) {
    //colorcircles ();
    rotating($_SESSION["currentpicture"]); 
}
if (isset($_POST['redeyeromovalBtn'])) {
    redeyeremoval($_SESSION["currentpicture"]); 
}
if (isset($_POST['whitelineBtn'])) {
    blurring($_SESSION["currentpicture"]); 
}
if (isset($_POST['halfgreyBtn'])) {
    halfgrey($_SESSION["currentpicture"]); 
}
if (isset($_POST['halfdarkerBtn'])) {
    halfdarker($_SESSION["currentpicture"]); 
}
if (isset($_POST['halfnegativeBtn'])) {
    halfnegative($_SESSION["currentpicture"]); 
}
if (isset($_POST['halflighterBtn'])) {
    halflighter($_SESSION["currentpicture"]); 
}
if (isset($_POST['halfdarkerhalfnegativeBtn'])) {
    darker_negative($_SESSION["currentpicture"]); 
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title></title>
    
    <script type="text/javascript">
      window.onload= function ()
       {
         
         //var myPHPVar= "";
         //if _isset($_GET['uploadedfile'])
        //alert('imagesebi.JPG');   
        //document.getElementById("myimage").src = 'images/'+'ebi.JPG';
        
     
	//alert(ok);
        
	if (<?php echo intval(isset($_GET['uploadedfile'])); ?>!=0) {
            
          
            document.getElementById("myimage").src = "<?php echo filter_input(INPUT_GET, 'uploadedfile'); ?>";
       }   
           
       if (<?php echo intval(isset($_GET['convertedfile'])); ?>!=0) 
 
           document.getElementById("myimage").src = "<?php echo filter_input(INPUT_GET, 'convertedfile'); ?>";
       //else {
          //{
          // var myPHPVar= 
          // document.getElementById("myimage").src= "images/"+myPHPVar;
           //document.getElementsByTagName('batteryID').src = 'battery9.png'
      // }   
      // else{
           //alert ('in javascript');
         
          // document.getElementById("myimage").src= "images/gorila.jpg";
         //alert("hi"+myPHPVar);
       //}
       }
       window.onunload= function ()
       {
       
       }    
</script>

    
    
    <style>
        form {
            text-align: center;
            margin: 0 auto;
            margin-top: 5em;
            width: 700px;
            height: 650px;
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


        input {
          font-size: 13px;
        }
        
       .button {
            padding-left: 5px;
            position:relative;
            transition: .5s ease;
            /*left:8%;*/
 
            position:relative;
            transition: .5s ease;
            /*left:8%;*/
            color:white;
            /*background-color: forestgreen; */
            border-radius: 10px;
            font-size: large; 
            padding:3px;
            margin-left: .5em;
            /*border:0px solid #336600;*/
        }
            assinments {
            margin-left: .5em;
            
        } 
        
        .custom-file-upload {
           border: 1px solid #ccc;
           display: inline-block;
           padding: 6px 12px;
           cursor: pointer;
        }
    </style>
</head>
<body>

<form id="form" action="index.php" enctype="multipart/form-data" method="post">
    
    
    <div>
        
        <img   id = "myimage" onclick="showCoords(event)" onmousemove="clearCoords(event)" src="<?php echo $initialimage;?>"   align="middle" style="width:550px;height:450px;"  border ="1">
    
    
    </div>    
   <p   id="demo"  style="font-size:smaller;color:red;" ></p>

    <script> 
      function showCoords(event) {
          var x = event.pageX;
          var y = event.pageY;
          
          var offtop = document.getElementById('myimage').offsetTop;
          var offleft = document.getElementById('myimage').offsetLeft;
          var coords = "X coords: " + (x-offleft) + ", Y coords: " + (y-offtop);
          document.getElementById("demo").innerHTML = coords;
      }
       function clearCoords(event) {
          
          document.getElementById("demo").innerHTML = "";
      }
    
    </script>
    
    
    <div class="button">
        <input type="file" name="fileToUpload" id="fileToUpload">
        
        <input type="submit" name="uploadimageBtn" value="Upload Image">
        
   </div>  
    
    <hr>
    
    <div class="button">
          <!--  <input type="submit" name="LighterBtn" value="Lighter">   -->
        <input type="submit" name="DarkerBtn" value="Darker">
        <input type="submit" name="GreyBtn" value="Grey">
       
        <input type="submit" name="NegativeBtn" value="Negative">
        <input type="submit" name="ContrastBtn" value="Contrast">
        <input type="submit" name="MirroringBtn" value="Mirroring">    
        <input type="submit" name="ShuffleBtn" value="Shuffling">
        <input type="submit" name="RotateBtn" value="Rotating">
    
    </div>
    <hr>
        <div class="button">

        <input type="submit" name="LighterBtn" value="Lighter" style ="color:white;background-color: green; border-radius: 10px;font-size: small; padding:3px;border:0px solid #336600;">
        </div>
    <hr>
    <div>
        <input type="submit" name="redeyeromovalBtn" value="Red Eye Removal" style ="color:white;background-color: blue; border-radius: 10px;font-size: small; padding:3px;border:0px solid #336600;">
        <input type="submit" name="whitelineBtn" value="Image Blurring" style ="color:white;background-color: blue; border-radius: 10px;font-size: small; padding:3px;border:0px solid #336600;">
        <input type="submit" name="halfgreyBtn" value="Half Grey" style ="color:white;background-color: blue; border-radius: 10px;font-size: small; padding:3px;border:0px solid #336600;">   

        <input type="submit" name="halfdarkerBtn" value="Half Darker" style ="color:white;background-color: blue; border-radius: 10px;font-size: small; padding:3px;border:0px solid #336600;">
        <input type="submit" name="halfnegativeBtn" value="Half Negative" style ="color:white;background-color: blue; border-radius: 10px;font-size: small; padding:3px;border:0px solid #336600;">
        <input type="submit" name="halflighterBtn" value="Half Lighter" style ="color:white;background-color: blue; border-radius: 10px;font-size: small; padding:3px;border:0px solid #336600;"> 
        <input type="submit" name="halfdarkerhalfnegativeBtn" value="Darker Negative" style ="color:white;background-color: blue; border-radius: 10px;font-size: small; padding:3px;border:0px solid #336600;"> 

    </div>
</form>
    
  
?>  
    <!-- <iframe name="resultFrame" style="width:550px;height:450px;"  border ="2"></iframe>  -->
</body>
</html>
