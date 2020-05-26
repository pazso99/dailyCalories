<?php 
require "include/header.php";
if (isset($_SESSION['username'])) : 
?>


<div class="container">
    <div class="command-panel">
        <a class ="button" href="./addfood.php">Add Food</a>
        <a class ="button" href="./deletefood.php">Delete Food</a>
        <a class ="button" href="#">111111</a>
        <a class ="button" href="#">111111</a>
    </div>

    <div>
        <h1 class="profile-name"><?php echo $_SESSION['username']; ?>'s profile</h1>
    </div>
 
</div>


<?php 
require "include/footer.php";
else: 
    header("Location: ./index.php"); endif;
?>
  