<?php

    require "db_connection.php";
    require "validator.php";

    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        $title    =  clear_input($_POST['title']);
        $content  =  clear_input($_POST['content']);
        
        
        $errors = [];

        #user name validation
        if(validate($title,'is_empty')) {
            $errors['The Title'] = 'required';
        } elseif(!validate($title,'is_string')) {
            $errors['The Title'] = 'must be a sting';
        }
        
        #content validation
        if(validate($content,'is_empty')) {
            $errors['The Content'] = 'required';
        } elseif(validate($content,'is_short',50)) {
            $errors['The Content'] = 'is less than 50 character';
        }

        #file settings and validation 
        if(!validate($_FILES['image']['name'],'is_empty')) {
            
            $img_tmp   = $_FILES['image']['tmp_name'];
            $img_name  = $_FILES['image']['name'];
            $img_type  = $_FILES['image']['type'];
            //---------------------------------------
            $allowed_types = ['jpg','jpeg','png'];
            $arr_type      = explode('/',$img_type);
            
            if(in_array($arr_type[1],$allowed_types)) {

                $final_name = rand(1,20).time().".".$arr_type[1];
                $dest_path  = './uploads/'.$final_name;

                if (move_uploaded_file($img_tmp,$dest_path)) {
                    
                    echo "Image uploaded";

                } else {
                    echo "Error Try again";
                }

            } else {

                echo "Not Allowed Type";

                exit();

            }

        } else {
            $errors['Image'] = 'required';
        }

        #in case there is validation errors
        if(count($errors) > 0) {
            echo "<ul>";
            foreach($errors as $f => $err) {
                echo "<li>".$f." ".$err."</li>";
            }
            echo "</ul>";
        }
        #in case no validation erros
        else {

            $sql = "insert into articles (title,content,image) values
             ('$title','$content','$final_name')";

            $op = mysqli_query($con,$sql);

            if($op) {
                echo "<h3>Data Inserted</h3>";
            } else {
                echo "Error!";
            }
            mysqli_close($con);

        }



    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Register</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>
      h2{
        margin-top:200px;
      }
      
  </style>
</head>
<body>

<div class="container">
  <h2>Register</h2>
  <form  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>"
     method="POST"   enctype ="multipart/form-data">
   <div class="form-group">
    <label for="exampleInputEmail1">Title</label>
    <input type="text"  name="title"  class="form-control" id="exampleInputName"
     aria-describedby="" placeholder="Enter the title">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Content</label>
    <input type="text"   name="content" class="form-control"
     id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter The Content">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Image</label>
    <input type="file"   name = "image"  
    id="exampleInputPassword1" placeholder="choose image">
  </div>
   <input type="submit" class="btn btn-primary">
</form>
</div>

</body>
</html>
