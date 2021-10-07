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
        $DB_file = fopen("profile.txt","r") or die("something went wrong!");

            echo "<ul class='list'>";
        while (!feof($DB_file))
            {
                echo "<li>".fgets($DB_file)."</li>";
            }  
        echo "</ul>";  
        fclose($DB_file);
    ?>
</body>
</html>