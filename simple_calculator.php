<?php

/*
    Simple calculator program written by Ahmed Muhammed Abdullah Muhammed
*/

    //inputs:
    $first_number = 10;
    $second_number=20;
    $operation="Addition";
    $result;
    //outpouts:
    switch($operation){
        case "Addition":
            $result = $first_number + $second_number;
            echo $result;
            break;

        case "Subtraction":
            $result = $first_number - $second_number;  
            echo $result;
            break;

        case "Multiplication":
            $result = $first_number * $second_number;  
            echo $result;
            break;  

        case "Division":
            $result = $first_number / $second_number;  
            echo $result;
            break; 

        default :
        echo "Please write a correct operation :<br>". "[ Addition or Subtraction". 
             " or Multiplication or Division ]";   
    }




?>