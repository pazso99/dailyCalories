<?php 
require "include/header.php";
// ha bevan jelentkezve, amugy elvisz indexbe
// adatbázis interakciók
if (isset($_SESSION['username'])) : 
?>


<div class="container">
    <div class="command-panel">
        <a class ="button" href="./addfood.php">Add Food</a>
        <a class ="button" href="./deletefood.php">Delete Food</a>
        <a class ="button" href="./listfood.php">Food data</a>
        <a class ="button" href="#">111111</a>
    </div>

    <div>
        <h1 class="profile-name"><?php echo $_SESSION['username']; ?>'s profile</h1>
    </div>
    <table class="profile-table">
        <tr>
            <th><b>Username: </b></th>
            <td><?php echo $_SESSION['username']; ?></td>
        </tr>
        <tr>
            <th><b>Email: </b></th>
            <td><?php echo $_SESSION['email']; ?></td>
        </tr>
        <tr>
            <th><b>Birth: </b></th>
            <td><?php echo $_SESSION['birth']; ?></td>
        </tr>
        <tr>
            <th><b>Gender: </b></th>
            <td><?php echo $_SESSION['gender']; ?></td>
        </tr>
        <tr>
            <th><b>Height: </b></th>
            <td><?php echo $_SESSION['height']; ?> cm</td>
        </tr>
        <tr>
            <th><b>Weight: </b></th>
            <td><?php echo $_SESSION['weight']; ?> kg</td>
        </tr>
        <tr>
            <th><b>Activity: </b></th>
            <td><?php switch($_SESSION['activity']) {
                case "1.2" : echo "Sedentary"; break;
                case "1.375" : echo "1-2 days/week"; break;
                case "1.55" : echo "3-5 days/week"; break;
                case "1.725" : echo "6-7 days/week"; break;
                case "1.9" : echo "2x/day"; break;
            }

            ?></td>
        </tr>
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
            <th><b>Bodyfat: </b></th>
            <td><?php echo $_SESSION['bodyfat']; ?> kg</td>
        </tr>
        <tr>
            <th><b>Bodyfat %: </b></th>
            <td><?php echo $_SESSION['bodyfatpercentage']; ?> %</td>
        </tr>
        <tr>
            <th><b>Bmr: </b></th>
            <td><?php echo $_SESSION['bmr']; ?></td>
        </tr>
        <tr>
            <th><b>Bmi: </b></th>
            <td><?php echo $_SESSION['bmi']; ?></td>
        </tr>
        <tr>
            <th><b>Lbm: </b></th>
            <td><?php echo $_SESSION['lbm']; ?> kg</td>
        </tr>
        <tr>
            <th><b>Tdee: </b></th>
            <td><?php echo $_SESSION['tdee']; ?> kcal</td>
        </tr>
    </table>  
    <table class="profile-table" style="margin-top:20px;">
        <tr>
            <th><b>Daily Calories: </b></th>
            <td><?php echo $_SESSION['s_dailycalorie'] . " kcal / " . $_SESSION['dailycalorie']; ?> kcal</td>
        </tr>
        <tr>
            <th><b>Daily Protein: </b></th>
            <td><?php echo $_SESSION['s_dailyprotein'] . " g / " . $_SESSION['dailyprotein']; ?> g</td>
        </tr>
        <tr>
            <th><b>Daily Carbohydrates: </b></th>
            <td><?php echo $_SESSION['s_dailycarbs'] . " g / " . $_SESSION['dailycarbs']; ?> g</td>
        </tr>
        <tr>
            <th><b>Daily Fat: </b></th>
            <td><?php echo $_SESSION['s_dailyfat'] . " g / " . $_SESSION['dailyfat']; ?> g</td>
        </tr>
        <tr>
            <th><b>Daily Fiber: </b></th>
            <td><?php echo $_SESSION['dailyfiber']; ?> g</td>
        </tr>
        <tr>
            <th><b>Daily Sugar: </b></th>
            <td><?php echo $_SESSION['dailysugar']; ?> g</td>
        </tr>
    </table>  
</div>


<?php 
require "include/footer.php";
else: 
    header("Location: ./index.php"); endif;
?>
  