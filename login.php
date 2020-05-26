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
            case "nouser" : echo '<p class="error">User not found.</p>'; break;
        }
    } else if (isset($_GET['signup'])) {
        echo '<p class="success">Signup success!!!</p>';
    }
    
?>

<hr class="line">

<form method="POST" action="include/db/login.inc.php">    
    <div class="form-container">     

        <label for="username"><b>Email</b></label>
        <input type="text" placeholder="Enter username" name="username">

        <label for="password"><b>Password</b></label>
        <input type="text" placeholder="Enter Password" name="password">

        <hr class="line">

        <input type="submit" value="Login" name="login-submit" class="form-button">

        <div class="form-container goto">
            <p>Don't have an account?</p><a class="log-button" href="signup.php">Register</a>
        </div>
    </div>
</form>
</div>
<?php
    require 'include/footer.php';
?>