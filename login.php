<?php 
session_start();

$username=$_POST['uname'];
$pass=$_POST['pass'];
$hashed_password=password_hash($pass,PASSWORD_DEFAULT);
$con=mysqli_connect('localhost','root','','websitelogins') or die(mysqli_connect_error());
$sql="SELECT password FROM users where username='$username'";
$query=$con->query($sql);
$row=$query->fetch_assoc();
$hash=$row['password'];
if (password_verify($pass,$hash)){
    $_SESSION['uname']=$username;
    if($username=='admin'){
        header('Location:http://localhost/Mywebsite/admin.php');
        exit();

    }
    else{
        header('Location:http://localhost/Mywebsite/dashboard.php');
        exit();
    }
}


else{
    echo "Incorrect Password or Username";
}
?>
