<?php require("script.php"); 

    session_start();

    include('lib\connection.php');
    $error="";
    $success="";
    $pwd="";
   
   /* $message="Please click on the Activation link to verify your Email";*/
   
if (isset($_POST['submit']))
{
    $username=mysqli_escape_string($conn,filter_var(strip_tags($_POST['username']),FILTER_SANITIZE_STRIPPED));
    $password=mysqli_escape_string($conn,filter_var(strip_tags($_POST['password']),FILTER_SANITIZE_STRIPPED));
  
    $hash_password=hash('sha256',$password);
    
    $sql="SELECT * FROM users WHERE username ='$username'AND password_hash='$hash_password'";
   
    $result=mysqli_query($conn,$sql);
    $rows= mysqli_num_rows($result);
    if($rows>0)
    {
        $array = mysqli_fetch_assoc($result);
        if ($array['active']==0) 
        { 
            $error="Please activate your email First";
            }
        else
           { $success="Welcome to Sahari Digital Magazines"; 
            
           $_SESSION['username']= $username;
            
               header("location:profile.php");}
               if (isset($_POST['rememberme']))
            {
            setcookie("username", $_POST['username'], time()+365*24*60*60);
            setcookie("password", $_POST['password'], time()+365*24*60*60);
           }

    }
    else
       { $error="Please Sign Up First";
         }

}    
?>


<!DOCTYPE html>
<html lang="En">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=width-device" initial-scale="1.0">
        <title>Log in-Sahari </title> 
        <link rel="stylesheet" href="sahari_styles.css">
        <style>  
           .main {
                position: relative;
                width: 100vw;
                height: 100vh;
                }
            body {
                    background: linear-gradient(to bottom,rgb(0, 0, 0, 0.2),rgba(0, 0, 0, 0.4)),url(bkg-1.jpg);
                    background-position: center;
                    background-size: cover;
                }

        </style>
    </head>
    <body>
        <div class="main">
            <div class="header">
                <div class="icon">
                    <h2 class="logo";
                    title="Log In Page- Sahari Digital Magazines"> Sahari</h2>
                </div>
                <div class="nav">
                    <ul>
                        <li><a href="#">Home</a> </li>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Weeklies</a></li>
                        <li><a href="#">Monthlies</a></li>
                        <li><a href="#">Writers</a></li>
                       
                    </ul>
                </div>
                
                <div class="brand">
                    <img src="sahari-logo-2.png">
                </div>
            </div>
            <div class="content">
                <h1> అంతర్జాలంలో తొలి తెలుగు <br><span>డిజిటల్ ఫ్లిప్ మాగజైన్స్ </span> </h1>
                <p>* ఫ్లిప్ బుక్స్ - చేతిలో పుస్తకం ఉన్న అనుభూతి<br> 
                    * 6 కథలు<br>
                    * 4 సీరియళ్ళు<br>
                    * ఆధ్యాత్మికం<br>
                    * సైకాలజీ<br>
                    * బాలల కథలు, బాలల సీరియల్<br>
                    * యువతకు పోటీ పరీక్షల కోసం<br>
                    * అలనాటి అద్భుత చిత్రాల సమీక్షలు<br>
                    * ఇంకా ఎన్నెన్నో శీర్షికలు<br>
                    130 కి పైగా పేజీలతో వీక్లీ<br>
                    ప్రతి శుక్రవారం ఉదయం 6 గంటలకల్లా అందుబాటులోకి వచ్చే వీక్లీ.<br>
                    ప్రతి నెల మొదటి రోజున పూర్తి నవల, కథలు, శీర్షికలతో మాసపత్రిక.<br>
                    150 పేజీల పైన ఉండే మంత్లీ..<br>
                </p>
 
                <button class="btn cn_btn">Contact Us</button>
            </div>
            <div class="Signin">
                <h2> Log In </h2>
                <!--<a href="login.php"> <button type="submit" class="li btn">Sign In</button></a>-->
                <form method="post" action="login.php">
                
                <input  type="text" value="<?php if(isset($_COOKIE['username'])) {echo$_COOKIE['username'];}  ?>" name="username" placeholder="Enter your username"  required/>
                
                <input type="password"value="<?php if(isset($_COOKIE['password'])) {echo$_COOKIE['password'];} ?>" name="password" placeholder="Enter your password"  required/>
                <div class="li_btn"><br>
                    
                    <a href="forgot-password.php" Style="color:rgba(243, 106, 15, 0.986);margin-top:-15px; margin-left:-200px; ">Forgot Password</a>

                    <button type="submit" name="submit" class="btn li_btn">Sign In</button>
                </div>
                

                <span style="color:white;top:10px;"><?php if (isset($error)) {echo $error;}?></span>
                <span style="color:white;top:20px;"><?php if (isset($success)) {echo $success;}?></span>
                
              
               
                    <input type="checkbox" name="rememberme" id="rememberme" Onclick="setcookie()">  
                  Remember me 
                    <br><br>
                <p class="link">Don't have an account?<br><br><a href="index.php">Sign Up</a> here</p>
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
<script>
        function setcookie() {
            u=""; p="";
            var u = document.getElementById('username').value;
            var p = document.getElementById('password').value;
            document.cookie = "myusrname="+u+; path=http://localhost/sahari-exp/login.php";
            document.cookie = "mypaswrd="+p+; path=http://localhost/sahari-exp/login.php";
        }
</script>
    </body>
</html> 
            