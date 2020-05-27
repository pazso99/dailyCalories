<?php 
require "include/header.php";
if (isset($_SESSION['username'])) : 
?>

<div class="container">
    <div class="command-panel">
        <a class ="button" href="./addfood.php">Add Food</a>
        <a class ="button" href="./deletefood.php">Delete Food</a>
        <a class ="button" href="./listfood.php">Food data</a>
        <a class ="button" href="#">111111</a>
    </div>
    <h1>Add Food</h1>

    <?php
    if (isset($_GET['err'])) {
        switch($_GET['err']) {
            case "emptyfields" : echo '<p class="error">Please fill in all the forms to create a food.</p>'; break;
            case "foodexist" : echo '<p class="error">Food already exist.</p>'; break;
            case "sqlerror" : echo '<p class="error">Server error.</p>'; break;
        }
    } else if (isset($_GET['added'])) {
        echo '<p class="success"> ' . $_GET['added'] . ' successfully added to the database!</p>';
    }
    ?>

    <hr class="line">

    <form method="POST" action="include/db/addfood.inc.php">
        <div class="form-container">

            <label for="quantity"><b>Choose food quantity</b></label>
            <select id="quantity" name="quantity">
                    <option <?php if(isset($_GET['quantity']) && $_GET['quantity'] == '100g'){echo("selected");}?> value="100g">100g</option>
                    <option <?php if(isset($_GET['quantity']) && $_GET['quantity'] == 'db'){echo("selected");}?> value="db">db</option>
                    <option <?php if(isset($_GET['quantity']) && $_GET['quantity'] == 'pohár'){echo("selected");}?> value="pohár">pohár</option>
            </select>

            <label for="name"><b>Food name</b></label>
            <input type="text" placeholder="Enter Food name" name="name" value="<?php if (isset($_GET['name'])) echo $_GET['name'];?>">

            <label for="calorie"><b>Calorie</b></label>
            <input type="number" placeholder="Enter calorie" name="calorie" value="<?php if (isset($_GET['calorie'])) echo $_GET['calorie'];?>"> 

            <label for="carbs"><b>Carbs</b></label>
            <input type="number" placeholder="Enter carbs" name="carbs" value="<?php if (isset($_GET['carbs'])) echo $_GET['carbs'];?>">       

            <label for="fiber"><b>Fiber</b></label>
            <input type="number" placeholder="Enter fiber" name="fiber" value="<?php if (isset($_GET['fiber'])) echo $_GET['fiber'];?>">   

            <label for="sugar"><b>Sugar</b></label>
            <input type="number" placeholder="Enter sugar" name="sugar" value="<?php if (isset($_GET['sugar'])) echo $_GET['sugar'];?>">
    
            <label for="protein"><b>Protein</b></label>
            <input type="number" placeholder="Enter protein" name="protein" value="<?php if (isset($_GET['protein'])) echo $_GET['protein'];?>">       

            <label for="fat"><b>Fat</b></label>
            <input type="number" placeholder="Enter fat" name="fat" value="<?php if (isset($_GET['fat'])) echo $_GET['fat'];?>">   

            <input type="submit" class="form-button" name="addfood-submit" value="ADD">
        </div>
    </form>
</div>

<?php 
require "include/footer.php";
else: 
    header("Location: ./index.php"); endif;
?>
  