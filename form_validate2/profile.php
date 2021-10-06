<?php    

    $data_from_cookie = [
        $_COOKIE["User"],$_COOKIE["Email"],$_COOKIE["Address"],
        $_COOKIE["Gender"],$_COOKIE["Linkedin"]
    ];
    
    $strings = ["Your name is ","Your email is ","Your address is ",
            "Your Gender is ","Your linked in is "    
    ]    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <style> 

        body {
            padding-top:100px;
            text-align:center;
        }
        ul {
            list-style:none;
        }
        .list li {
            font-size: 20px;
            padding: 10px;
            color:blue;
        }
</style>
</head>
<body>
    <?php 
        echo "<ul class='list'>";
        for ($i=0; $i<count($data_from_cookie);$i++)
        {
            echo "<li>".$strings[$i].$data_from_cookie[$i]."</li>";
        }  
       echo "</ul>";  
    ?>
</body>
</html>