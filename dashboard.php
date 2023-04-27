<?php
session_start(); 
echo "Hello,  " .$_SESSION['uname'];
?>
<html>
    <link rel="stylesheet" href="style2.css">
    <h1>DASHBOARD</h1>
    <label>Update Your Email</label>
    <form action="dashboard.php" method='POST'>
        <input type="email" name="up_email">
        <input type="submit" name="update" value="Update">
        <input type="submit" name="logout" value="Logout">
    </form>
</html>

<?php 
$con=mysqli_connect('localhost','root','','websitelogins') or die(mysqli_connect_error());
$username=$_SESSION['uname'];
if(isset($_POST["update"])){
    $uemail=$_POST['up_email'];
    $sql="UPDATE users SET email='$uemail' where username='$username' ";
    $query=mysqli_query($con,$sql);
    mysqli_commit($con);
    if($query){
        echo "updated successfully";
    }    
    else{
        echo "unsuccessful updation";
    }
}
if(isset($_POST["logout"])){
    session_destroy();
    header('refresh:1;URL=http://localhost/Mywebsite/Login.html');
    exit();
}


?>



