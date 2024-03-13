<?php 
session_start();

include('lib/connection.php');

$username=$_SESSION['username'];

$sql="SELECT * FROM users WHERE username='$username'";

$result = mysqli_query($conn,$sql);
$rows = mysqli_num_rows($result);
if($rows>0){
$array = mysqli_fetch_assoc($result);

}

?>

<!DOCTYPE html>
    <html lang="En">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=width-device" initial-scale="1.0">
       <link rel="stylesheet" href="sahari_styles.css">
        <style>  
           .main {
                position: relative;
                width: 100vw;
                height: 100vh;
                 }
            body{
                    background: linear-gradient(to top,rgb(0, 0, 0, 0),rgba(0, 0, 0, 0)),url(bkg-2.jpg);
                    background-position: center;
                    background-size: cover;
                }
               

        </style>
        
    <title>Profile Page</title>
    </head>
    <body>
    <div class="brand">
                    <img src="sahari-logo-2.png">
                </div>
    <h1 style="color:#f32a0ffb;text-shadow: 2px 2px #000; margin-top:10px; font-size:40px; margin-left:100px";>Welcome to Sahari Digital Magazines</h1>
        <div class="profile">
            <form method="post" action="profile.php" >
            
            
                <h2>Profile of Subscriber</h2>
                
                    <input type="text" value="<?php echo $array['username']?>" readonly>
                    <input type="email" value="<?php echo $array['email']?>" readonly>
                    <a href="changepassword.php"><button type="submit" name="submit"class="btn cp">Change Password</button></a>
                    
            </form>
            <button type="submit" class="btn lo">Log OUT</button>
        </div>

    </body>
</html>