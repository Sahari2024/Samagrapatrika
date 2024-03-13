<?php

/*session_start();*/

include('lib/connection.php');

if(isset($_GET['email']) && isset($_GET['activation_code']) )

{
    $success="";
    $error1="";
    $error2="";
    $email=$_GET['email'];
    $activation_code=$_GET['activation_code'];
    /*$email=mysqli_escape_string($email);
    $activation_code=mysqli_escape_string($activation_code);*/
    $email=mysqli_escape_string($conn,filter_var(strip_tags($email),FILTER_SANITIZE_EMAIL));
    /*$activation_code=mysqli_escape_string($conn,filter_var(strip_tags($activation_code]),FILTER_SANITIZE_STRIPPED));*/
    
    
    $sql="SELECT email,activation_code FROM users WHERE email='$email' AND activation_code='$activation_code' AND active=0";

    $result=mysqli_query($conn,$sql);
    $rows=mysqli_num_rows($result);
    

    if($rows>0)
    { 
        $sql="UPDATE users SET active=1 WHERE email='$email' AND activation_code='$activation_code' AND active=0";
        $result=mysqli_query($conn,$sql);
        if($result)
        {
            
            $success="Your account has been activated. You can login now.";
        }
    }
    else{
        $error1="You have clicked an invalid link or your account has already been activated.";
    }


}
else {
    $error2="Please use the activation link sent to you in your email to activate your account.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css"/>
    <title>Verification Page</title>
</head>
<body>
    <div id="section">
        <?php 
        if(isset($success))
        {
            echo $success;
        }
        if(isset($erro1))
        {
            echo $error1;
        }
        if(isset($error2))
        {
            echo $error2;
        }
        ?>
    </div>
</body>
</html>