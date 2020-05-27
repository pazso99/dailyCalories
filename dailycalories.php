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

    <table class="profile-table" style="margin-top:55px; margin-bottom:75px;">
        <tr>
            <th><b>Ideal: </b></th>
            <td><?php switch($_SESSION['ideal']) {
                case "-1" : echo "Lose weight"; break;
                case "0" : echo "Maintain weight"; break;
                case "1" : echo "Gain weight"; break;
            } echo " [" .$_SESSION['idealpercentage'] . "%]";
            ?></td>
        </tr>
        <tr>
            <th><b>Tdee: </b></th>
            <td><?php echo $_SESSION['tdee']; ?> kcal</td>
        </tr>
        <tr>
            <th><b>Dailycalorie: </b></th>
            <td><?php echo "<span class='daily'>" . $_SESSION['dailycalorie'] . " kcal </span>/ " . $_SESSION['f_dailycalorie']; ?> kcal</td>
        </tr>
        <tr>
            <th><b>Dailyprotein: </b></th>
            <td><?php echo "<span class='daily'>" . $_SESSION['dailyprotein'] . " g </span>/ " . $_SESSION['f_dailyprotein']; ?> g</td>
        </tr>
        <tr>
            <th><b>Dailycarbs: </b></th>
            <td><?php echo "<span class='daily'>" . $_SESSION['dailycarbs'] . " g </span>/ " . $_SESSION['f_dailycarbs']; ?> g</td>
        </tr>
        <tr>
            <th><b>Dailyfat: </b></th>
            <td><?php echo "<span class='daily'>" . $_SESSION['dailyfat'] . " g </span>/ " . $_SESSION['f_dailyfat']; ?> g</td>
        </tr>
        <tr>
            <th><b>Dailyfiber: </b></th>
            <td><?php echo "<span class='daily'>" . $_SESSION['dailyfiber'] . " g </span>"; ?> / 0 g</td>
        </tr>
        <tr>
            <th><b>Dailysugar: </b></th>
            <td><?php echo "<span class='daily'>" . $_SESSION['dailysugar']. " g </span>"; ?> / 0 g</td>
        </tr>
    </table>
    <hr class="line">

    <div class="eaten-foods">
    <?php
        require "include/db/db.inc.php";
        $date = date("Y-m-d");

        $sql = "SELECT * FROM dailyfoods WHERE `user.id`=" .$_SESSION['id']. " AND `date` LIKE '%" . $date . "%'";
        if($result = mysqli_query($conn, $sql)){
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_array($result)){
                    $date = $row['date'];
                    $foods = explode("-", $row['food.eaten']);
                    $foodName = $foods[0];
                    $foodQty = $foods[1];
                    $foodQuantity = $foods[2];
                    echo '
                    <div class="food">
                        <p class="food-date">'. $date .'</p>
                        <p class="food-info">'. $foodName .': '. $foodQty . '' . $foodQuantity .'</p>   
                    </div>
                    ';
                }
            } else{
                echo "No records matching your query were found.";
            }
        } else{
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
        }
    ?>
    </div>
    <hr class="line">
    <h1>DONE EATING TODAY</h1>
    <form method="POST" action="include/db/daily.inc.php">
        <div style="display:flex;"><input type="submit" class="done-button" name="doneeat-submit" value="DONE TODAY"></div>
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
