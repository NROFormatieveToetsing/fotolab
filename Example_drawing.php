<?php
   
session_start();
if (isset($_POST['drwBtn'])) {
   
    
    
    
    if (isset($_POST['wdth'])) 
       $w = intval($_POST['wdth']);
    
    if (isset($_POST['hght'])) 
       $h = intval($_POST['hght']);

    
    $image = imagecreatetruecolor($w, $h); 
    
    for ($x = 0; $x < $w; ++$x)
    {
        for ($y = 0; $y < $h; ++$y)
        {
            $r = intval(255 * $x / $w);
            $g = intval(255 * $y / $h);
            $b = 255 - intval(255 * ($x + $y) / ($w + $h));
            
            $color = imagecolorallocate($image, $r, $g, $b);
            
            imagesetpixel($image, $x, $y, $color);
        }
    }
    
    header("Content-type: image/png");
    imagepng($image);
  }  
?>


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
            width: 90px;
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
            padding-left: 55px;
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

    <form  action="Example_drawing.php"  method="post">

    <div>
        <label for="width">Width:</label>
        <input id="wdth" type="text" name="wdth" value="" width="5"/>
    </div>
    <div>
        <label for="height">Height:</label>
        <input id="hght" type="text" name="hght" value="" width="5"/>
    </div>
    
    <div class="button">
        <input type="submit" name="drwBtn" value="Upload inputs" style="color:white;background-color: orange; border-radius: 10px;font-size: small; padding:3px;border:0px solid #336600;"></button>
        <input type="reset"  name="resetBtn" value="Clear inputs" style="color:white;background-color: orange; border-radius: 10px;font-size: small; padding:3px;border:0px solid #336600;";"></button>
    </div>
    
</form>
    
</body>
</html>
