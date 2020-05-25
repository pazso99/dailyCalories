<?php
    require 'include/header.php';
?>

<div class="container">

<h1>Sign in</h1>

<?php
    if (isset($_GET['err'])) {
        switch($_GET['err']) {
            case "emptyfields" : echo '<p class="error">Please fill all the fields.</p>'; break;
            case "wrongpassword" : echo '<p class="error">Wrong password.</p>'; break;
        }
    } else if (isset($_GET['signup'])) {
        echo '<p class="success">Signup success!!!</p>';
    }
    
?>

<hr>

<form method="POST" action="include/db/login.inc.php">    
    <div class="form-container">     

    <label for="username"><b>Email</b></label>
    <input type="text" placeholder="Enter username" name="username">

    <label for="password"><b>Password</b></label>
    <input type="text" placeholder="Enter Password" name="password">
        
    <input type="submit" value="Login" name="login-submit" class="form-button">
    <div class="form-container signin">
        <p>Don't have an account? <a class="log-button" href="signup.php">Register</a></p>
    </div>


    </div>
</form>

<?php
    require 'include/footer.php';
?>