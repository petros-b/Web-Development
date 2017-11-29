<?php
//print queried results to separate html page to the user 
$db_con= 'mysql: host=localhost; dbname=students';
$db_usnme='root';
$db_pswd='';

try{
        $db= new PDO($db_con,$db_usnme,$db_pswd);
        }
        catch(PDOException $e){
            $error=$e->getMessage();
            echo'error: Database Connection error .</p>';
        }

        $current_q="SELECT * FROM student_info INNER JOIN dates ON student_info.UMID=dates.UMID";
        $statement=$db->prepare($current_q);
        $statement->execute();
        $get=$statement->fetchAll();
        
?>


<!DOCTYPE html>

    <head> 
        <title> 
            UMD Students Registered
         </title> 
        <link rel="stylesheet" href="../styles/results.css"/> 
    </head> 
 <body> 
   
    <h2> List of registered students with accommodating time slots:</h2>
        <table> 
        <tr>    
        <th> UMID</th> 
            <th>First Name</th> 
            <th>Last Name</th> 
            <th>Project</th> 
            <th>Email</th>
            <th>Phone Number</th>  
            <th>Date</th> 
            <th> Start Time</th> 
            <th> End Time</th> 
        </tr> 
        <?php foreach($get as $t)
        {
     ?>
        <tr> 
            <td><?php echo $t['UMID'];?></td> 
            <td> <?php echo $t['First_name'];?></td> 
            <td> <?php echo $t['Last_name'];?></td> 
            <td> <?php echo $t['Project'];?> </td> 
            <td> <?php echo $t['Email'];?> </td> 
            <td> <?php echo $t['Phone_num'];?> </td> 
            <td> <?php  echo $t['Date'];?> </td> 
            <td> <?php  echo $t['Time_Start'];?> </td> 
            <td> <?php   echo $t['Time_End']; ?> </td> 
    </tr>   
    <br>
    <?php }
        ?>
    </table> 
    <br> 
        <div class="div3"> 
        <button type="button" onclick="window.location= '../index.html'"> Return to Home</button> 
        </div> 
 
    </body> 
    </html> 