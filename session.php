<?php session_start();


 include('connection.php');

        $_SESSION['id']=$row['id'];
        $_SESSION['username']=$row['username'];
        $_SESSION['password']=$row['password']; 

?>