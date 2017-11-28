<?php 
//prompt new user to choose a registration slot 
session_start();
$id1=1;
$id2=2;
$id3=3;
$id4=4;
$id5=5;
$id6=6;

$s_user =$_SESSION['UMID'];

$db_con= 'mysql: host=localhost; dbname=students';
$db_usnme='root';
$db_pswd='';
$ids=0;

//get post from user's radio button submission 
 if(isset($_POST['submit']))
{
    
$answer=$_POST['option'];
    
//parse radio button value based on user's selection 

if($answer=="12/9/17 6:00PM to 7:00PM")
{
    $ids=1;
    $_SESSION['dtid']=$ids;
$filt=explode(" ",$answer);
$_SESSION['date']=$filt[0];
$_SESSION['s_time']=$filt[1];
$_SESSION['e_time']=$filt[3];

header("Location: date_sub.php");
exit;
}
else if($answer =="12/9/17 7:00PM to 8:00PM")
{
    $ids=2;
    $_SESSION['dtid']=$ids;
    $filt=explode(" ",$answer);
    $_SESSION['date']=$filt[0];
    $_SESSION['s_time']=$filt[1];
    $_SESSION['e_time']=$filt[3];
    header("location: date_sub.php");
    exit;
}
else if($answer =="12/9/17 8:00PM to 9:00PM")
{
    $ids=3;
    
    $_SESSION['dtid']=$ids;
    $filt=explode(" ",$answer);
    $_SESSION['date']=$filt[0];
    $_SESSION['s_time']=$filt[1];
    $_SESSION['e_time']=$filt[3];
    header("location: date_sub.php");
    exit;
}

else if($answer =="12/10/17 6:00PM to 7:00PM")
{
    $ids=4;
    $_SESSION['dtid']=$ids;
    $filt=explode(" ",$answer);
    $_SESSION['date']=$filt[0];
    $_SESSION['s_time']=$filt[1];
    $_SESSION['e_time']=$filt[3];
    header("location: date_sub.php");
    exit;
}

else if($answer =="12/10/17 7:00PM to 8:00PM")
{
    $ids=5;
    $_SESSION['dtid']=$ids;
    $filt=explode(" ",$answer);
    $_SESSION['date']=$filt[0];
    $_SESSION['s_time']=$filt[1];
    $_SESSION['e_time']=$filt[3];
    header("location: date_sub.php");
    exit;
}

else if($answer =="12/10/17 8:00PM to 9:00PM")
{
    $ids=6;
    $_SESSION['dtid']=$ids;
    $filt=explode(" ",$answer);
    $_SESSION['date']=$filt[0];
    $_SESSION['s_time']=$filt[1];
    $_SESSION['e_time']=$filt[3];
    header("location: date_sub.php");
    exit;
}

}

try{
    
    $db= new PDO($db_con,$db_usnme,$db_pswd);
    }
    catch(PDOException $e){
        $error=$e->getMessage();
        echo'error: Database Connection error .</p>';
    }

    $query1="SELECT COUNT(UMID) as num FROM dates where Date_ID=:id1";
    $result= $db->prepare($query1);
    $result->bindValue(':id1',$id1);
    $result->execute();
    $rows= $result->fetch();
    $result->closeCursor();
    
    $query1="SELECT COUNT(UMID) as num FROM dates where Date_ID=:id2";
    $result= $db->prepare($query1);
    $result->bindValue(':id2',$id2);
    $result->execute();
    $rows2= $result->fetch();
    $result->closeCursor();
    
    $query1="SELECT COUNT(UMID) as num FROM dates where Date_ID=:id3";
    $result= $db->prepare($query1);
    $result->bindValue(':id3',$id3);
    $result->execute();
    $rows3= $result->fetch();
    $result->closeCursor();
    
    $query1="SELECT COUNT(UMID) as num FROM dates where Date_ID=:id4";
    $result= $db->prepare($query1);
    $result->bindValue(':id4',$id4);
    $result->execute();
    $rows4= $result->fetch();
    $result->closeCursor();
    
    $query1="SELECT COUNT(UMID) as num FROM dates where Date_ID=:id5";
    $result= $db->prepare($query1);
    $result->bindValue(':id5',$id5);
    $result->execute();
    $rows5= $result->fetch();
    $result->closeCursor();
    
    $query1="SELECT COUNT(UMID) as num FROM dates where Date_ID=:id6";
    $result= $db->prepare($query1);
    $result->bindValue(':id6',$id6);
    $result->execute();
    $rows6= $result->fetch();
    $result->closeCursor();
?>

<!--displaly time registration slots w/ remaining seats avail.-->

<!Doctype html>

<head> <title> Registration Slot Selection</title> 
<link rel="stylesheet" href="../styles/date_select.css"/>
</head> 

<body> 
    <main> 
       <h1>Choose the following available registration slots:</h1> 
       <div id="date_sub">
<form action="" method="post">
       <input type="radio" name="option" value="12/9/17 6:00PM to 7:00PM"<?php if(6-$rows['num']==0){echo "disabled";}?>>12/9/17, 6:00 PM – 7:00 PM<p>spots remaining:<?php echo 6-$rows['num']?></p><br> 

      <input type="radio" name="option" value="12/9/17 7:00PM to 8:00PM"<?php if(6-$rows2['num']==0){echo "disabled";}?>>12/9/17, 7:00 PM – 8:00 PM<p>seats available: <?php echo 6- $rows2['num'];?></p><br>

      <input type="radio" name="option" value="12/9/17 8:00PM to 9:00PM"<?php if(6-$rows3['num']==0){echo "disabled";}?>>12/9/17, 8:00 PM – 9:00 PM<p>seats available: <?php echo 6- $rows3['num'];?></p><br>

      <input type="radio" name="option" value="12/10/17 6:00PM to 7:00 PM"<?php if(6-$rows4['num']==0){echo "disabled";}?>>12/10/17, 6:00 PM – 7:00 PM<p>seats available: <?php echo 6- $rows4['num'];?></p><br>

      <input type="radio" name="option" value="12/10/17 7:00PM to 8:00PM"<?php if(6-$rows5['num']==0){echo "disabled";}?>>12/10/17, 7:00 PM – 8:00 PM<p>seats available: <?php echo 6- $rows5['num'];?></p><br>

      <input type="radio" name="option" value="12/10/17 8:00PM to 9:00PM"<?php if(6-$rows6['num']==0){echo "disabled";}?>>12/10/17, 8:00 PM – 9:00 PM<p>seats available: <?php echo 6- $rows6['num'];?></p><br>

</div>
<div id=submit> <input type="submit" name="submit" value="submit">
</div>
</form>

    </main> 
</body> 

</html> 