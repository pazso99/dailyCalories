<?php 
require "include/header.php";
if (isset($_SESSION['username'])) : 
?>

<div class="container">
    <h1>Daily Calories</h1>

    <hr class="line">
    <div class="add-food">
        <input type="text" autocomplete="off" placeholder="Search food..." />
        <div class="result"></div>
    </div>
    <?php
    if (isset($_GET['err'])) {
        switch($_GET['err']) {
            case "emptyfield" : echo '<p class="error">Please fill the quantity.</p>'; break;
            case "sqlerror" : echo '<p class="error">Server error.</p>'; break;
        }
    } else if (isset($_GET['added'])) {
        echo '<p class="success"> ' . $_GET['added'] . ' successfully eated!</p>';
    }
    ?>
    <h2>Add food from above</h2>
    <form method="POST" action="include/db/daily.inc.php">
        <div class="form-container"></div>
    </form>
</div>

<?php 

else: 
?>

<div class="container">
    <div>
        <h1> Sorry, you have to logged in to use this page</h1>
    </div>
    <hr class="line">
    <div class="welcome">
        <a href="signup.php" class="start-button">Let's get started!</a>
    </div>
</div>

<?php
endif;
require "include/footer.php";
?>
