<?php 

if(isset($_POST['delete-submit'])) {
	
	require 'db.inc.php';

	// POST adatok
    $name = $_POST['name'];

	// Form validation
	if (isEmpty($name)) { // ÜRES MEZŐK
		header("Location: ../../deletefood.php?err=emptyfield");
        exit();
        
	} else {
		$sql = "SELECT id FROM foods WHERE name=?"; 
		$stmt = mysqli_stmt_init($conn);
		if (!mysqli_stmt_prepare($stmt, $sql)) {
			header("Location: ../../deletefood.php?err=sqlerror");
			exit();
		} else {

			mysqli_stmt_bind_param($stmt, "s", $name);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_store_result($stmt);
			
			if (mysqli_stmt_num_rows($stmt) > 0) { // található a db-be
				
				$sql = "DELETE FROM `foods` WHERE `foods`.`name` = ?";

				$stmt = mysqli_stmt_init($conn);  
				if (!mysqli_stmt_prepare($stmt, $sql)) { 
					header("Location: ../../deletefood.php?err=sqlerror");
					exit();
				} else { // Minden sikeres
					
					$name = mb_strtolower($name);
					
					mysqli_stmt_bind_param($stmt, "s", $name);
					mysqli_stmt_execute($stmt);
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