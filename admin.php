<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style3.css">
</head>
<body>
    <?php 
        echo "Welcome Admin"; 
        session_start();
        $con = mysqli_connect('localhost','root','','websitelogins') or die(mysqli_connect_error());
        $sql = "SELECT * FROM users";
        $query = mysqli_query($con,$sql);
    ?>
    <table>
        <thead>
            <tr>
                <th>Username</th>
                <th>Password</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                while ($row = mysqli_fetch_assoc($query)) {
                    echo "<tr>";
                    echo "<td>" . $row['username'] . "</td>";
                    echo "<td>" . $row['password'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "<td><form method='post'><input type='hidden' name='uname' value='" . $row['username'] . "'><input type='submit' name='Del' value='Delete'></form></td>";
                    echo "</tr>";
                }
            ?>
        </tbody>
    </table>
    <?php
        if(isset($_POST["Del"]) && $_POST["uname"]!="admin"){
            $delname=$_POST['uname'];
            $del="DELETE FROM users where username='$delname'";
            $res=mysqli_query($con,$del);
            if($res){
                echo $delname." deleted successfully";
            }
            else{
                echo "Try Again!";
            }
        }
    ?>
    <form method="post">
        <input type="submit" name="logout" value="Logout">
    </form>
</body>
</html>
<?php
    if(isset($_POST["logout"])){
        session_destroy();
        header('location:http://localhost/Mywebsite/Login.html');
        exit();
    }
?>
