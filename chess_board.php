
   
   <!DOCTYPE html>
   <html lang="en">
   <head>
         <meta charset="UTF-8">
         <meta http-equiv="X-UA-Compatible" content="IE=edge">
         <meta name="viewport" content="width=device-width, initial-scale=1.0">
         <title>Chess Board</title>
   </head>
   <body>
   <table width="300px" cellspacing="0px" cellpadding="0px" >
      <?php
      for($row=1;$row<=8;$row++)
	  {
          echo "<tr>";
          for($column=1;$column<=8;$column++)
		  {
          $sum=$row+$column;
          if($sum%2==0)
		  {
          echo "<td height=50px width=50px bgcolor=white></td>";
          }
		  else
		  {
          echo "<td height=50px width=50px bgcolor=black></td>";
          }
          }
          echo "</tr>";
    }
          ?> 
   
   </body>
   </html>
