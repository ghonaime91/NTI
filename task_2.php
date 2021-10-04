<?php
// task 2 written by Ahmed Muhammed Abdullah Muhammed


// 1) Implementation of task 2 part 1 "print next charachter function":

//input
$input_char='z';

    function print_next_char($any_char) {
           if($any_char != 'Z' && $any_char != 'z')
           {
                $any_char++;
                echo $any_char;
           } 
           else if($any_char == 'z')
           {
               echo 'a';
           }   
           else {
               echo 'A';
           }
           
    }
    //output (calling the function)
    echo "The next character is: ";
    print_next_char($input_char);

    echo'<br><br><br>';

//2) implementation of task 2 part 2 "print all values using echo function":

    $students = [
        ['name'=>'Root','age'=>20],
        ['name'=>'Root2','age'=>25,'gpa'=>3.4],
        ['name'=>'Root3','age'=>30]
    ];

    for($i=0;$i<count($students);$i++)
    {
        foreach($students[$i] as $key => $value)
        {
            echo '* '.$key.': '.$value.'<br>'; 
        }
        echo "<br>";
    }


?>