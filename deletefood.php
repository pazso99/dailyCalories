<?php 
require "include/header.php";
if (isset($_SESSION['username'])) : 
?>

<div class="container" style="min-height: 550px;">
    <div class="command-panel">
        <a class ="button" href="./addfood.php">Add Food</a>
        <a class ="button" href="./deletefood.php">Delete Food</a>
        <a class ="button" href="./listfood.php">Food data</a>
        <a class ="button" href="#">111111</a>
    </div>
    <h1>Delete Food</h1>

    <?php
    if (isset($_GET['err'])) {
        switch($_GET['err']) {
            case "emptyfield" : echo '<p class="error">Please fill the field to delete a food.</p>'; break;
            case "notexist" : echo '<p class="error">' . $_GET['name'] . ' not in the database.</p>'; break;
            case "sqlerror" : echo '<p class="error">SQL error.</p>'; break;
        }
    } else if (isset($_GET['deleted'])) {
        echo '<p class="success"> ' . $_GET['deleted'] . ' successfully deleted from the database!</p>';
    }
    ?>
    
    <hr class="line">

    <form method="POST" action="include/db/deletefood.inc.php">
        <div class="form-container">
        
            <label for="name"><b>Food name</b></label>
            <input type="text" placeholder="Enter Food name" name="name">

            <input type="submit" class="form-button" name="delete-submit" value="DELETE">
        </div>
    </form>
</div>

<?php 
require "include/footer.php";
else: 
    header("Location: ./index.php"); endif;
?>
  