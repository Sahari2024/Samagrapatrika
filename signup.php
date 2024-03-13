<?php require("script.php"); 

    session_start();

    include('lib\connection.php');
    $error="";
    $success="";
    $pwd="";
   
   /* $message="Please click on the Activation link to verify your Email";*/
   
if (isset($_POST['submit']))
{
      
    $name=mysqli_escape_string($conn,filter_var(strip_tags($_POST['name']),FILTER_SANITIZE_STRIPPED));
    $username=mysqli_escape_string($conn,filter_var(strip_tags($_POST['username']),FILTER_SANITIZE_STRIPPED));
    $password=mysqli_escape_string($conn,filter_var(strip_tags($_POST['password']),FILTER_SANITIZE_STRIPPED));
    $email=mysqli_escape_string($conn,filter_var(strip_tags($_POST['email']),FILTER_SANITIZE_EMAIL));
    $hash_password=hash('sha256',$password);
    $activation_code=hash('sha256',rand(0,1000));
    $sql="SELECT * FROM users WHERE UserName ='$username'";
    $pwd=$password;
    $result=mysqli_query($conn,$sql);
    if(mysqli_num_rows($result)>0)
    {
        $error="UserName already exists";
    }
    $sql="SELECT * FROM users WHERE Email ='$email'";
    $result=mysqli_query($conn,$sql);
    if(mysqli_num_rows($result)>0)
    {
        $error.=" And Email already exists";
    }
    if (empty($error))

    {
        $sql="INSERT INTO users (Name,UserName,Email,Activation_Code,Password_hash) VALUES ('$name','$username','$email','$activation_code','$hash_password')";
        $result=mysqli_query($conn,$sql);
        if ($result)
        {
            $subject="Confirmation mail From Sahari";
            $message="You can log in using the credentials given below<br><br><br><br><br>
            Username = $username <br><br><br>
            Password = $pwd <br><br><br>
            Click here to activate your Account-------------------<br><br><br>
            http://localhost/sahari/verify.php?email=$email&activation_code=$activation_code";
            
            $response = sendMail($email, $subject, $message);
            
            $_SESSION['name']=$name;
            $_SESSION['username']=$username;
            $_SESSION['email']=$email;
            $_SESSION['password']=$password;
            $_SESSION['activation_code']=$activation_code;
            
                if(@$response == "success")
                {
       
                   /*echo $email;
                   echo $subject;
                   echo $message; */
              
                }
            else{
              
                  echo @$response; 
               
                }
                
            $success="Please check your mail and click confirmation link";
        }
    }
   
}


?>


<!DOCTYPE html>
<html lang="En">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=width-device" initial-scale="1.0">
        <title>Sahari Digital Magazines</title> 
        <link rel="stylesheet" href="sahari_styles.css">
        <style>  
           .main {
                position: relative;
                width: 100vw;
                height: 100vh;
                }
            body {
                    background: linear-gradient(to bottom,rgb(0, 0, 0, 0.1),rgba(0, 0, 0, 0.4)),url(bkg-4.jpg);
                    background-position: center;
                    background-size: cover;
                }
            ::placeholder{
                color:white;
            }
        </style>
   <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">-->
    </head>
    <body>
        <div class="main">
            <div class="header">
                <div class="icon">
                    <h2 class="logo";
                    title="Sign UP Sahari"> Sahari</h2>
                </div>
                <div class="nav">
                    <ul>
                        <li><a href="#">Home</a> </li>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Weeklies</a></li>
                        <li><a href="#">Monthlies</a></li>
                        <li><a href="#">Writers</a></li>
                        <!--<li><a href="#">Advertisers</a></li>-->
                    </ul>
                </div>
               
                <div class="brand">
                    <img src="sahari-logo-2.png">
                </div>
            </div>
            <div class="content">
                <h1> అంతర్జాలంలో తొలి తెలుగు <br><span>డిజిటల్ మాగజైన్స్ </span> </h1>
                <p>* ఫ్లిప్ బుక్స్ - చేతిలో పుస్తకం ఉన్న అనుభూతి<br> 
                    * 6 కథలు<br>
                    * 4 సీరియళ్ళు<br>
                    * బాలల కథలు, బాలల సీరియల్<br>
                    * యువతకు పోటీ పరీక్షల కోసం<br>
                    * అలనాటి అద్భుత చిత్రాల సమీక్షలు<br>
                    * ఆధ్యాత్మికం<br>
                    * సైకాలజీ<br>
                    * ఇంకా ఎన్నెన్నో శీర్షికలు<br>
                    130 కి పైగా పేజీలతో వీక్లీ<br>
                    ప్రతి శుక్రవారం ఉదయం 6 గంటలకల్లా అందుబాటులోకి వచ్చే వీక్లీ.<br>
                    ప్రతి నెల మొదటి రోజున పూర్తి నవల, కథలు, శీర్షికలతో మాసపత్రిక.<br>
                    150 పేజీల పైన ఉండే మంత్లీ..<br>
                </p>
 
                <button class="btn cn_btn">Contact Us</button>
            </div>
            <div class="Signup">
                <h2> Sign Up </h2>
                <!--<a href="login.php"> <button type="submit" class="li btn">Sign In</button></a>-->
                <form method="post" action="signup.php">
                <input type="text" name="name" placeholder="Enter your name" required/>
                <input type="text" name="username" placeholder="Enter your username" required/>
                <input type="email" name="email" placeholder="Enter valid email" required/>
                <input type="password" name="password" placeholder="Enter your password" required/>
               
                    <button Class="btn " type="submit" name="submit">Register</button><br><br>
               
                <span style="color:white;"><?php if (isset($error)) {echo $error;}?></span>
                <span style="color:white;"><?php if (isset($success)) {echo $success;}?></span>

                <p class="link">Already have an account?<br><br><a href="login.php">Sign in</a> here</p>
                <p class="liw">Or Login with</p>
                <div class="socialmediaicons">
                    <ion-icon name="logo-google"> </ion-icon>
                    <ion-icon name="logo-facebook"> </ion-icon>
                    <ion-icon name="logo-twitter"> </ion-icon>
                    <ion-icon name="logo-instagram"> </ion-icon>
                    <ion-icon name="logo-Linkedin"> </ion-icon>
                </div>
            </div>
        </div>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>