<?php 

if(isset($_POST['updatefood-submit'])) {
	
	require 'db.inc.php';
    // POST adatok
    $id = $_POST['id'];
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
		header("Location: ../../food.php?err=emptyfields&id=". $id ."&name=".$name."&quantity=".$quantity."&carbs=".$carbs."&fiber=".$fiber."&sugar=".$sugar."&protein=".$protein."&fat=".$fat."&calorie=".$calorie);
        exit();
        
	} else {
		$sql = "UPDATE `foods` SET `name` = ?, `quantity` = ?, `carbs` = ?, `fiber` = ?, `sugar` = ?, `protein` = ?, `fat` = ?, `calorie` = ? WHERE id = ?;"; 
		$stmt = mysqli_stmt_init($conn);    //statement init
		if (!mysqli_stmt_prepare($stmt, $sql)) { // statement prepare kezelés
			header("Location: ../../food.php?err=sqlerror");
			exit();
		} else {
			mysqli_stmt_bind_param($stmt, "ssdddddis", $name, $quantity, $carbs, $fiber, $sugar, $protein, $fat, $calorie, $id);  // parameteradás
			mysqli_stmt_execute($stmt); // execute
			header("Location: ../../food.php?updated=".$name);
			exit();	
		}
	}
	// Lezárások
	mysqli_stmt_close($stmt);
	mysqli_close($conn);

}  else { 
	header("Location: ../../food.php");
	exit();
} 