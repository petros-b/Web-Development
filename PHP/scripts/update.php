<?php
//update user's existing reg. slot to the new entry made from 'edit.php'
session_start();

$dates=$_SESSION['date'];
$strt=$_SESSION['s_time'];
$ends=$_SESSION['e_time'];
$dates_id=$_SESSION['dtid'];
$us_id=$_SESSION['UMID'];

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


        $query_up="UPDATE dates SET Date_ID=:dates_id, UMID=:us_id, Date=:dates, Time_Start=:strt, Time_End=:ends WHERE UMID=:us_id";
        $statement=$db->prepare($query_up);
        $statement->bindValue(':dates_id',$dates_id);
        $statement->bindValue(':us_id',$us_id);
        $statement->bindValue(':dates',$dates);
        $statement->bindValue(':strt',$strt);
        $statement->bindValue(':ends',$ends);
        $statement->execute();
        $statement->closeCursor();
    
       

?>

<!DOCTYPE html>

<head> 
        <title>
             UMD Registration
</title>
<link rel="stylesheet" href="../styles/date_sub.css"/>
</head>

<body>

<header>
<h1> Update Complete! </h1>
</header>
 
        <main> 
                <div id="btn"> 
                <button type="button" onclick="window.location= '../index.html';">Return back to Home Page</button> 
</div> 
</main> 

</body>

</html>
