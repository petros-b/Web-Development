<?php
//submit registration slot from user into 'dates' db table
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
    
        //store registration slot entry 

        $query= "INSERT INTO dates(Date_ID, UMID, Date, Time_Start, Time_End)
        VALUES (:dates_id, :us_id, :dates, :strt, :ends)";

        $statement= $db->prepare($query);
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
<h1> Submission Complete! </h1>
</header> 
<body> 
        <main> 
                <div id="btn">
                <button type="button" onclick="window.location= '../index.html';">Return to Home Page</button> </div> 
</main> 

</body>

</html>
