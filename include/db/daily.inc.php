<?php 
// when clicked on food in dailycal
if (isset($_POST["eatfood-submit"])) {
    require "db.inc.php";
    session_start();

    // ha ma még ehet
    if ($_SESSION['caneat']) {

        $userid = $_SESSION["id"];  // user id
        $foodname = $_POST["name"]; // a food neve
        $foodqty = $_POST["quantity"];  // food quantity
        $date = date("Y-m-d H:i:s");    // mai dátum

        if (empty($foodqty)) { // ha nincs kitöltve a food adag
            header("Location: ../../dailycalories.php?err=emptyfield");
            exit();

        } else {

            // get food datas
            $sql = "SELECT * FROM foods WHERE name = ?"; 
            if($stmt = mysqli_prepare($conn, $sql)){
                
                mysqli_stmt_bind_param($stmt, "s", $foodname);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                $row = mysqli_fetch_assoc($result);
                $foodid = $row['id'];
                $foodquantity = $row['quantity'];
                $foodcarbs = $row['carbs'];
                $foodfiber = $row['fiber'];
                $foodsugar = $row['sugar'];
                $foodprotein = $row['protein'];
                $foodfat = $row['fat'];
                $foodcalorie = $row['calorie'];
            }

            if ($foodquantity == "g") {
                $eatencalorie = $foodcalorie * ($foodqty / 100);
                $eatenprotein = $foodprotein * ($foodqty / 100);
                $eatencarbs = $foodcarbs * ($foodqty / 100);
                $eatenfat = $foodfat * ($foodqty / 100);
                $eatensugar = $foodsugar * ($foodqty / 100);
                $eatenfiber = $foodfiber * ($foodqty / 100);
            } else {
                $eatencalorie = $foodcalorie * $foodqty;
                $eatenprotein = $foodprotein * $foodqty;
                $eatencarbs = $foodcarbs * $foodqty;
                $eatenfat = $foodfat * $foodqty;
                $eatensugar = $foodsugar * $foodqty;
                $eatenfiber = $foodfiber * $foodqty;
            }

            
                $_SESSION['s_dailycalorie'] += $eatencalorie;
                $_SESSION['s_dailyprotein'] += $eatenprotein;
                $_SESSION['s_dailycarbs'] += $eatencarbs;
                $_SESSION['s_dailyfat'] += $eatenfat;
                $_SESSION['dailysugar'] += $eatensugar;
                $_SESSION['dailyfiber'] += $eatenfiber;

            // user eated this food this time
            $sql = "INSERT INTO `dailyfoods` (`date`, `user.id`, `food.eaten`) VALUES (?, ?, ?);";
            $stmt = mysqli_stmt_init($conn);   
            if (!mysqli_stmt_prepare($stmt, $sql)) { 
                header("Location: ../../dailycalories.php?err=sqlerror");
                exit();
            } else {
                $foodeaten = mb_strtolower($foodname)."-".$foodqty."-".$foodquantity; // alma-200-g
                        
                mysqli_stmt_bind_param($stmt, "sis", $date, $userid, $foodeaten);
                mysqli_stmt_execute($stmt);
                header("Location: ../../dailycalories.php?added=".$foodname);
                exit();
            }  
        }

        // Lezárások
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        } else {
            header("Location: ../../dailycalories.php?now=canteat");
            exit();
        }
// ma már többet nem eszünk, (logout login)
} else if (isset($_POST["doneeat-submit"])) {
    session_start();
    $_SESSION['caneat'] = false;
    header("Location: ../../dailycalories.php?now=canteat");
    exit();
} else {
    header("Location: ../../dailycalories.php?now=canteat");
    exit();
}