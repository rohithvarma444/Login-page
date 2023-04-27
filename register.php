<?php
 $username=$_POST['n_username'];
 $pass=$_POST['n_password'];
 $hashed_password = password_hash($pass, PASSWORD_DEFAULT);
 $email=$_POST['n_email'];

 #Sql connection
 $con=new mysqli('localhost','root','','websitelogins');
 if($con->connect_error){
    die('connection failed:'.$con->connect_error);
 }
 else{
   $sql="INSERT INTO users (username,password,email) values('$username','$hashed_password','$email')";
   $sqll="SELECT * FROM users where username='$username'";
   $queryy=mysqli_query($con,$sqll);
   if(mysqli_num_rows($queryy)>0){
      echo "Try again with a diffrent username";
      header('refresh:1;URL=http://localhost/Mywebsite/register.html');
   }
   else{
      $query=mysqli_query($con,$sql);
      if($query){
         echo "registered successfully";
         header('refresh:1;URL=http://localhost/Mywebsite/Login.html');
      }
   }
 }
?>