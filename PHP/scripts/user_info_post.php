<?php
//determine if user's entry exists already, if not, store as new record in student_info table 
session_start();

  
$fname=htmlspecialchars($_POST['f_name']);      
$lname=htmlspecialchars($_POST['l_name']);
$UMID=htmlspecialchars($_POST['s_ID']);                
$email=htmlspecialchars($_POST['email']);   
$phoneNum=htmlspecialchars($_POST['p_num']);               
$projTitle=htmlspecialchars($_POST['p_title']);

$_SESSION['UMID']=$UMID;
$_SESSION['f_name']=$fname;
$_SESSION['l_name']=$lname;
$_SESSION['email']=$email;
$_SESSION['p_num']=$phoneNum;
$_SESSION['p_title']=$projTitle;

$db_con= 'mysql: host=localhost; dbname=students';
$db_usnme='root';
$db_pswd='';

//attempt to connect to db:
try{

$db= new PDO($db_con,$db_usnme,$db_pswd);
}
catch(PDOException $e){
    $error=$e->getMessage();
    echo'error: Database Connection error .</p>';
}

$find=false;

$query1= "SELECT * FROM student_info WHERE UMID=:UMID";
$statement=$db->prepare($query1);
$statement->bindValue(':UMID',$UMID);
$statement->execute();
$result=$statement->fetch();
//$result->closeCursor();

if(! $result) // if user's entry does not exists in dB, store it in
{
   echo 'record not found';
//Query to insert student info in student_info table 

$query= "INSERT INTO student_info(UMID,First_name,Last_name,Project,Email,Phone_num)
        VALUES (:UMID, :fname, :lname, :projTitle, :email, :phoneNum)";

        $statement= $db->prepare($query);
        $statement->bindValue(':UMID',$UMID);
        $statement->bindValue(':fname',$fname);
        $statement->bindValue(':lname',$lname);
        $statement->bindValue(':projTitle',$projTitle);
        $statement->bindValue(':email',$email);
        $statement->bindValue(':phoneNum',$phoneNum);
        $statement->execute();
        $statement->closeCursor();
 
        header("Location: date_select.php");    
        exit;
      

}

else{ //if user info found in db, then prompt to second php file to change reg. date 
    header('Location: ../found.html');
    exit;
    

    //cue php file to allow user to change their time slot and shit 
}
?>
