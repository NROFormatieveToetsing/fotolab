<!DOCTYPE html>
<html>
<head>
   
    <title></title>
    <style>
        .box{
    width: 550px;
    height: 200px;
    background-color: blanchedalmond;
    border: solid 2px purple;
    position: relative;
    left: 30%;
    top: 30%;
}
    </style>
   
</head>
<body>
    <div class="box">
        <p align="center" style="font-size:36px;color:blue" >   Email recognition 
         <p align="center" style="font-size:36px;color:red" >
            <?php
            session_start();
            include 'functions.php';
            lighter ($_SESSION["currentpicture"])
         ?>
       </p>
    </div>
   
</body>
</html>






