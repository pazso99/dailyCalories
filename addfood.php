<?php 
require "include/header.php";
if (isset($_SESSION['username'])) : 
?>

<div class="container">
    <h1>Add Food</h1>

    <?php
    if (isset($_GET['err'])) {
        switch($_GET['err']) {
            case "emptyfields" : echo '<p class="error">Please fill in all the forms to create an account.</p>'; break;
            case "invalidemail" : echo '<p class="error">Please enter a valid email.</p>'; break;
            case "emptyfields" : echo '<p class="error">Please fill in all the forms to create an account.</p>'; break;
        }
    }
    ?>
    <hr>

    <form method="POST" action="include/db/addfood.inc.php">
        <div class="form-container">
        
    
        <label for="username"><b>Username</b></label>
        <input type="number" placeholder="Enter Username" name="username" value="<?php if (isset($_GET['err'])) echo $_GET['username'];?>">
    


        <input type="submit" class="form-button" name="addfood-submit" value="ADD">
        </div>
    </form>
</div>

<?php 
require "include/footer.php";
else: 
    header("Location: ./index.php"); endif;
?>
  