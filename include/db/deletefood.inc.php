<?php 

if(isset($_POST['delete-submit'])) {
	
	require 'db.inc.php';

	// POST adatok
    $name = $_POST['name'];

	// Form validation
	if (empty($name)) { // ÜRES MEZŐK
		header("Location: ../../deletefood.php?err=emptyfield");
        exit();
        
	} else {
		$sql = "SELECT id FROM foods WHERE name=?"; 
		$stmt = mysqli_stmt_init($conn);    //statement init
		if (!mysqli_stmt_prepare($stmt, $sql)) { // statement prepare kezelés
			header("Location: ../../deletefood.php?err=sqlerror");
			exit();
		} else {

			mysqli_stmt_bind_param($stmt, "s", $name);  // parameteradás
			mysqli_stmt_execute($stmt); // execute
			mysqli_stmt_store_result($stmt);   // result store   
			
			if (mysqli_stmt_num_rows($stmt) > 0) { // található a db-be
				
				$sql = "DELETE FROM `foods` WHERE `foods`.`name` = ?";

				$stmt = mysqli_stmt_init($conn);  //statement init
				if (!mysqli_stmt_prepare($stmt, $sql)) { // statement error kezelés
					header("Location: ../../deletefood.php?err=sqlerror");
					exit();
				} else { // Minden sikeres
					
					$name = mb_strtolower($name);
					
					mysqli_stmt_bind_param($stmt, "s", $name);  //paraméter adás
					mysqli_stmt_execute($stmt); // execute
					header("Location: ../../deletefood.php?deleted=".$name);
				    exit();
				}
			} else {  // nincs ilyen food

                header("Location: ../../deletefood.php?err=notexist&name=".$name);
				exit();
			}
		}
	}
	// Lezárások
	mysqli_stmt_close($stmt);
	mysqli_close($conn);

}  else { 
	header("Location: ../../deletefood.php");
	exit();
} 