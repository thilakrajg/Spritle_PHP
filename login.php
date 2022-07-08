<?php

    session_start();
    include('connection.php');


    if (isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $qry="select * from users  where username='".$username."' and password='".$password."'  ";
     
    $result=mysqli_query($conn,$qry);   
    
    if(mysqli_num_rows($result) > 0)
    { 
      $row=mysqli_fetch_assoc($result);

        $_SESSION['id']=$row['id'];
        $_SESSION['username']=$row['username'];
        $_SESSION['password']=$row['password']; 
        
      header( "Location:index.php");
      exit;
      } else {
                echo '<p class="error">Username password combination is wrong!</p>';
            }
        }
    
?> 
 
<div class="login">
  <div class="login-triangle"></div>
  
  <h2 class="login-header">Log in</h2>

  <form class="login-container" method="post" action="" name="signin-form">
    <p><input type="text" name="username" pattern="[a-zA-Z0-9]+" required placeholder="Username"></p>
    <p><input type="password" name="password" placeholder="Password"></p>
    <p><input type="submit" name="login" value="login" ></p>
  <p>Not a member? <a href="register.php">Register</a></p>
  </form>
</div>

<style> 
@import url(https://fonts.googleapis.com/css?family=Open+Sans:400,700);

body {
  background: #456;
  font-family: 'Open Sans', sans-serif;
}

.login {
  width: 400px;
  margin: 16px auto;
  font-size: 16px;
}

/* Reset top and bottom margins from certain elements */
.login-header,
.login p {
  margin-top: 0;
  margin-bottom: 0;
}

/* The triangle form is achieved by a CSS hack */
.login-triangle {
  width: 0;
  margin-right: auto;
  margin-left: auto;
  border: 12px solid transparent;
  border-bottom-color: #28d;
}

.login-header {
  background: #28d;
  padding: 20px;
  font-size: 1.4em;
  font-weight: normal;
  text-align: center;
  text-transform: uppercase;
  color: #fff;
}

.login-container {
  background: #ebebeb;
  padding: 12px;
}

/* Every row inside .login-container is defined with p tags */
.login p {
  padding: 12px;
}

.login input {
  box-sizing: border-box;
  display: block;
  width: 100%;
  border-width: 1px;
  border-style: solid;
  padding: 16px;
  outline: 0;
  font-family: inherit;
  font-size: 0.95em;
}

.login input[type="email"],
.login input[type="password"] {
  background: #fff;
  border-color: #bbb;
  color: #555;
}

/* Text fields' focus effect */
.login input[type="email"]:focus,
.login input[type="password"]:focus {
  border-color: #888;
}

.login input[type="submit"] {
  background: #28d;
  border-color: transparent;
  color: #fff;
  cursor: pointer;
}

.login input[type="submit"]:hover {
  background: #17c;
}

/* Buttons' focus effect */
.login input[type="submit"]:focus {
  border-color: #05a;
}

p.error {
    color: white;
    font-family: lato;
    background: yellowgreen;
    display: inline-block;
    padding: 2px 10px;
}
p.error {
    background: orangered;
}

</style>