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
    <h1>Food data</h1>

    <hr class="line">
    
    <div class="search-box">
        <input type="text" autocomplete="off" placeholder="Search food..." />
        <div class="result">
        
        </div>
    </div>

</div>

<?php 
require "include/footer.php";
else: 
    header("Location: ./index.php"); endif;
?>