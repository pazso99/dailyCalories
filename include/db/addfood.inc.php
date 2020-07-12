<?php 

if(isset($_POST['addfood-submit'])) {
	
	require 'db.inc.php';

	// POST adatok
    $name = $_POST['name'];
    $carbs = $_POST['carbs'];
    $fiber = $_POST['fiber'];
    $sugar = $_POST['sugar'];
    $protein = $_POST['protein'];
	$fat = $_POST['fat'];
	$calorie = $_POST['calorie'];
	$quantity = $_POST['quantity'];
	
	// Form validation
	if (isEmpty($name) || isEmpty($carbs) || isEmpty($fiber) || isEmpty($sugar) || isEmpty($protein) || isEmpty($fat) || isEmpty($calorie)) { // ÜRES MEZŐK
		header("Location: ../../addfood.php?err=emptyfields&name=".$name."&quantity=".$quantity."&carbs=".$carbs."&fiber=".$fiber."&sugar=".$sugar."&protein=".$protein."&fat=".$fat."&calorie=".$calorie);
        exit();
        
	} else {
		$sql = "SELECT id FROM foods WHERE name=?"; 
		$stmt = mysqli_stmt_init($conn);   
		if (!mysqli_stmt_prepare($stmt, $sql)) {
			header("Location: ../../addfood.php?err=sqlerror");
			exit();
		} else {

			mysqli_stmt_bind_param($stmt, "s", $name); 
			mysqli_stmt_execute($stmt);
			
			if (mysqli_stmt_num_rows($stmt) > 0) { // található a db-be
				header("Location: ../../addfood.php?err=foodexist&name=".$name."&quantity=".$quantity."&carbs=".$carbs."&fiber=".$fiber."&sugar=".$sugar."&protein=".$protein."&fat=".$fat."&calorie=".$calorie);
				exit();
			} else {  // nincs ilyen food, hozzáadás

				$sql = "INSERT INTO `foods` (`name`, `quantity`, `carbs`, `fiber`, `sugar`, `protein`, `fat`, `calorie`) VALUES (?,?,?,?,?,?,?,?);";

				$stmt = mysqli_stmt_init($conn); 
				if (!mysqli_stmt_prepare($stmt, $sql)) {
					header("Location: ../../addfood.php?err=sqlerror");
					exit();
				} else { // Minden sikeres
					
					$name = mb_strtolower($name);
					
					mysqli_stmt_bind_param($stmt, "ssdddddi", $name, $quantity, $carbs, $fiber, $sugar, $protein, $fat, $calorie);  //paraméter adás
					mysqli_stmt_execute($stmt); // execute
					header("Location: ../../addfood.php?added=".$name);
				    exit();
				}
			}
		}
	}
	// Lezárások
	mysqli_stmt_close($stmt);
	mysqli_close($conn);

}  else { 
	header("Location: ../../addfood.php");
	exit();
} 