<?php

//form validation by Ahmed Muhammed Abdullah Muhammed
   
    if($_SERVER["REQUEST_METHOD"]=="POST")
    {
        //cleaning the inputs from the html form               
        function clear_input($input)
        {
            $input = trim($input);
            $input = htmlspecialchars($input);
            $input= stripslashes($input);
            return $input;
        }

        // validation rules for the regular data
        function validate($input,$flag,$length=6)
        {
            $status = false;
            switch($flag)
            {
                case "is_empty":
                    if(empty($input)) {
                        $status = true;
                    }
                    break;

                case "is_string":
                   if(preg_match ("/^[a-zA-z ]*$/", $input)) {
                        $status = true;
                    }
                    break;

                case "is_email":
                    if(filter_var($input,FILTER_VALIDATE_EMAIL)) {
                        $status = true;
                    }
                    break;
                
                case "is_url":
                    if(filter_var($input,FILTER_VALIDATE_URL)) {
                        $status = true;
                    }
                    break;

                case "is_number":
                    if(is_numeric($input)) {
                        $status = true;
                    }
                    break;

                case "is_short":
                    if(strlen($input)<$length) {
                        $status = true;
                    }
                    break;             
            }

            return $status; 
        }

        // variables from the $_POST super global after cleaning
        $name = clear_input($_POST["name"]); 
        $email = clear_input($_POST["email"]);
        $pass = clear_input($_POST["password"]);
        $address = clear_input($_POST["address"]);
        $linkedin = clear_input($_POST["linkedin"]);

        //validations
        $errors =[];
      
        //validation of the cv file
        if(!empty($_FILES["cv"]["name"])) {

            $cv_name = $_FILES["cv"]["name"];
            $cv_tmp  = $_FILES["cv"]["tmp_name"];
            $cv_type = $_FILES["cv"]["type"];
            $allowed_types = ["pdf","docx"];
            $cv_type_arr = explode("/",$cv_type);

            if(in_array($cv_type_arr[1],$allowed_types)) {

                $final_name = rand(0,20).time().".".$cv_type_arr[1]; 
                $final_dest =  "./upload/".$final_name;
                move_uploaded_file($cv_tmp,$final_dest);
            } else {
                    echo "the extension must be pdf or docx";
                    exit();
            }
        } 



        else {
            $errors["C.V"] = "required";
        }

        //name validation
        if(validate($name,"is_empty"))
        {
            $errors["name"] = "required";
        }
        elseif(!(validate($name,"is_string")))
        {
            $errors["name"] = "must be a string";
        } 
        
        //email vaidation
        if(validate($email,"is_empty"))
        {
            $errors["email"] = "required";
        }
        elseif (!(validate($email,"is_email")))
        {
            $errors["email"] = "invalid email";
        }

        //password validation
        if(validate($pass,"is_empty"))
        {
            $errors["password"] = "required";
        }
        elseif(validate($pass,"is_short"))
        {
            $errors["password"]=" minimum length is 6";
        }

        //address validation
        if(validate($address,"is_empty"))
        {
            $errors["address"] = "required";
        }
        elseif(validate($address,"is_short",10))
        {
            $errors["address"]=" minimum length is 10";
        }
        
        //gender validation
        if(isset($_POST["gender"]))
        {
            $gender = clear_input($_POST["gender"]);
        }
        else {
            $errors["gender"] = "required";
        }
        

        //linked in url validation
        if(validate($linkedin,"is_empty"))
        {
            $errors["linkedin"] = "required";
        }
        elseif(!(validate($linkedin,"is_url")))
        {
            $errors["linkedin"]=" invalid URL";
        }
        
        //display the "required messages errors"
        if(count($errors)>0)
        {
            foreach($errors as $key=>$value)
            {
                echo "! ".$key.": ".$value."<br>";
            }
        } 


        //in case there is no required messages:
        else
        {
            echo "<strong>the registration is done <br> 
            Please wait until you are redirected to your profile</strong><br><br>";

            //cookies settings: 
            setcookie('User',$name,time()+43200,'/');
            setcookie('Email',$email,time()+43200,'/');
            setcookie('Address',$address,time()+43200,'/');
            setcookie('Gender',$gender,time()+43200,'/');
            setcookie('Linkedin',$linkedin,time()+43200,'/');
            //redirect to profile page
            header( "refresh:3;url=profile.php" );
            
        }
           

    }


    else
    {   
        //in case the request method not post
        echo " <h1> Error 405 </h1><br><strong>the server rejects your request.</strong>";
    }
