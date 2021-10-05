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

        function is_string_contains_number($input)
        {
            $contains_number = false;
            for($i=0;$i<strlen($input);$i++)
            {
                if(ctype_digit($input[$i]))
                {
                    $contains_number = true;
                    break;
                }
            }
            return $contains_number;
        }

        // variables from the $_POST super global after cleaning
        $name = clear_input($_POST["name"]); 
        $email = clear_input($_POST["email"]);
        $pass = clear_input($_POST["password"]);
        $address = clear_input($_POST["address"]);
        $gender = clear_input($_POST["gender"]);
        $linkedin = clear_input($_POST["linkedin"]);

        //validations
        $errors =[];

        //name validation
        if(empty($name))
        {
            $errors["name"] = "required";
        }
        elseif(is_string_contains_number($name))
        {
            $errors["name"] = "must be a string";
        } 
        
        //email vaidation
        if(empty($email))
        {
            $errors["email"] = "required";
        }
        elseif (!filter_var($email,FILTER_VALIDATE_EMAIL))
        {
            $errors["email"] = "invalid email";
        }

        //password validation
        if(empty($pass))
        {
            $errors["password"] = "required";
        }
        elseif(strlen($pass)<6)
        {
            $errors["password"]=" minimum length is 6";
        }

        //address validation
        if(empty($address))
        {
            $errors["address"] = "required";
        }
        elseif(strlen($address)<10)
        {
            $errors["address"]=" minimum length is 10";
        }
        
        //gender validation
        if(empty($gender))
        {
            $errors["gender"] = "required";
        }
        

        //linked in url validation
        if(empty($linkedin))
        {
            $errors["linkedin"] = "required";
        }
        elseif(!filter_var($linkedin,FILTER_VALIDATE_URL))
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
            echo "<strong>the registration is done</strong>";
        }
      

    }


    else
    {   
        //in case the request method not post
        echo " <h1> Error 405 </h1><br><strong>the server rejects your request.</strong>";
    }
