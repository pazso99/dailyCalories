<?php 
require "include/header.php";
if (isset($_SESSION['username'])) : 
?>

<div>
    <h1><?php echo $_SESSION['username']; ?>'s profile</h1>
</div>
<h3>Adatok</h3>
<a href="./addfood.php">ADdfood</a>
<ul> 
    <li><b>username: </b><?php echo $_SESSION["username"];?></li>
    <li><b>email: </b><?php echo $_SESSION["email"];?></li>
    <li><b>birth: </b><?php echo $_SESSION["birth"];?></li>
    <li><b>gender: </b><?php echo $_SESSION["gender"];?></li>
    <li><b>height: </b><?php echo $_SESSION["height"];?></li>
    <li><b>weight: </b><?php echo $_SESSION["weight"];?></li>
    <li><b>activity: </b><?php echo $_SESSION["activity"];?></li>
    <li><b>ideal: </b><?php echo $_SESSION["ideal"];?></li>
    <li><b>idealpercentage: </b><?php echo $_SESSION["idealpercentage"];?></li>
    <li><b>bmr: </b><?php echo $_SESSION["bmr"];?></li>
    <li><b>bmi: </b><?php echo $_SESSION["bmi"];?></li>
    <li><b>lbm: </b><?php echo $_SESSION["lbm"];?></li>
    <li><b>bodyfatweight: </b><?php echo $_SESSION["bodyfat"];?></li>
    <li><b>bodyfatpercentage: </b><?php echo $_SESSION["bodyfatpercentage"];?></li>
    <li><b>tdee: </b><?php echo $_SESSION["tdee"];?></li>
    <li><b>dailycalorie: </b><?php echo $_SESSION["dailycalorie"];?></li>
    <li><b>dailyprotein: </b><?php echo $_SESSION["dailyprotein"];?></li>
    <li><b>dailycarbs: </b><?php echo $_SESSION["dailycarbs"];?></li>
    <li><b>dailyprotein: </b><?php echo $_SESSION["dailyprotein"];?></li>
    <li><b>dailyfat: </b><?php echo $_SESSION["dailyfat"];?></li>
    <li><b>dailysugar: </b><?php echo $_SESSION["dailysugar"];?></li>

    
</ul>
<?php 
require "include/footer.php";
else: 
    header("Location: ./index.php"); endif;
?>
  