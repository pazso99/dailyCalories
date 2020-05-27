<?php 

if(isset($_POST['signup-submit'])) {
	
	require 'db.inc.php';

	// POST adatok - signup
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $repeatPassword = $_POST['repeat-password'];
    $birth = $_POST['birth'];
	$gender = $_POST['gender'];
    $height = $_POST['height'];
    $weight = $_POST['weight'];
	$activity = $_POST['activity'];
	$ideal = $_POST['ideal'];
	$idealPercentage = $_POST['ideal-percentage'];
	
	// Form validation
	if (isEmpty($username) || isEmpty($email) || isEmpty($password) || isEmpty($repeatPassword) || isEmpty($birth) || $gender == "-1" || isEmpty($height) || isEmpty($weight) || $activity == "-1" || $ideal == "x" || $idealPercentage == "-1") { // ÜRES MEZŐK
		header("Location: ../../signup.php?err=emptyfields&username=".$username."&email=".$email."&birth=".$birth."&gender=".$gender."&height=".$height."&weight=".$weight."&activity=".$activity."&ideal=".$ideal."&idealpercentage=".$idealPercentage);
        exit();
        
	} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { // ROSSZ EMAIL
		header("Location: ../../signup.php?err=invalidemail&username=".$username."&birth=".$birth."&gender=".$gender."&height=".$height."&weight=".$weight."&activity=".$activity."&ideal=".$ideal."&idealpercentage=".$idealPercentage);
		exit();

	} else if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) { // ROSSZ USERNAME
		header("Location: ../../signup.php?err=invalidusername&email=".$email."&birth=".$birth."&gender=".$gender."&height=".$height."&weight=".$weight."&activity=".$activity."&ideal=".$ideal."&idealpercentage=".$idealPercentage);
		exit();

	} else if ($password !== $repeatPassword || strlen($password) < 6 || !preg_match("/^[a-zA-Z0-9]*$/", $password)) { // ROSSZ JELSZÓ
		header("Location: ../../signup.php?err=invalidpassword&username=".$username."&email=".$email."&birth=".$birth."&gender=".$gender."&height=".$height."&weight=".$weight."&activity=".$activity."&ideal=".$ideal."&idealpercentage=".$idealPercentage);
		exit();
		
	} else { // jó form adatok

		$sql = "SELECT id FROM users WHERE username=?";
		$stmt = mysqli_stmt_init($conn);

		if (!mysqli_stmt_prepare($stmt, $sql)) { // statement error kezelés
			header("Location: ../../signup.php?err=sqlerror");
			exit();
		} else {

			mysqli_stmt_bind_param($stmt, "s", $username);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_store_result($stmt);
			
			if (mysqli_stmt_num_rows($stmt) > 0) { // van ilyen user a db-be
				header("Location: ../../signup.php?err=usertaken&email=".$email."&birth=".$birth."&gender=".$gender."&height=".$height."&weight=".$weight."&activity=".$activity."&ideal=".$ideal."&idealpercentage=".$idealPercentage);
				exit();
			} else { // nincs ilyen user a db-be

				$sql = "INSERT INTO `users` (`username`, `email`, `password`, `birth`, `gender`, `height`, `weight`, `activity`, `ideal`, `idealpercentage`, `bmr`, `bmi`, `lbm`, `bodyfat`, `bodyfatpercentage`, `tdee`, `dailycalorie`, `dailyprotein`, `dailycarbs`, `dailyfat`, `dailyfiber`, `dailysugar`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";

				$stmt = mysqli_stmt_init($conn);
				if (!mysqli_stmt_prepare($stmt, $sql)) { // statement error kezelés
					header("Location: ../../signup.php?err=sqlerror");
					exit();
				} else { // Minden sikeres, számítások, majd user hozzáadása a db-be
                    
                    function nFormat($number) {
                        return number_format($number, 2, '.', '');
                    }
					
					if ($gender == "male") {
						$lbm = (0.407 * $weight) + (0.267 * $height) - 19.2; 
					} else {
						$lbm = (0.252 * $weight) + (0.473 * $height) - 48.3;
					}

					$bmr = 370 + (21.6 * $lbm);
					$bodyfatweight = $weight - $lbm;
					$bodyfatpercentage = ($bodyfatweight / $weight) * 100;
					$bmi = $weight / (($height / 100) * ($height / 100));
					$tdee = $bmr * $activity;

					if ($ideal == 1) {
						$dailyCalorie = $tdee + ($tdee/100 * $idealPercentage);   
					} else if ($ideal == -1) {
							$dailyCalorie = $tdee - ($tdee/100 * $idealPercentage);
					} else if ($ideal == 0) {
							$dailyCalorie = $tdee;
					} else {
							$dailyCalorie = -1;
					}

					$dailyProtein = ($dailyCalorie * 0.4) / 4.1;
					$dailyFat = ($dailyCalorie * 0.25) / 8.8;
					$dailyCarbs = ($dailyCalorie * 0.4) / 4.1;
					$dailySugar = 0;
					$dailyFiber = 0;
					
					$bmr = nFormat($bmr);
					$bmi = nFormat($bmi);
					$lbm = nFormat($lbm);
					$bodyfatweight = nFormat($bodyfatweight);
					$bodyfatpercentage = nFormat($bodyfatpercentage);
					$dailyFiber = nFormat($dailyFiber);
					$dailyCarbs = nFormat($dailyCarbs);
					$dailyProtein = nFormat($dailyProtein);
					$dailySugar = nFormat($dailySugar);
					$dailyFat = nFormat($dailyFat);

					//password hash
					$hashedPwd = password_hash($password, PASSWORD_DEFAULT);


					mysqli_stmt_bind_param($stmt, "sssssidssidddddiiddddd", $username, $email, $hashedPwd, $birth, $gender, $height, $weight, $activity, $ideal, $idealPercentage, $bmr, $bmi, $lbm, $bodyfatweight, $bodyfatpercentage, $tdee, $dailyCalorie, $dailyProtein, $dailyCarbs, $dailyFat, $dailyFiber,$dailySugar);
					mysqli_stmt_execute($stmt);
					header("Location: ../../login.php?signup=success");
				exit();
				}
			}
		}
	}
	// Lezárások
	mysqli_stmt_close($stmt);
	mysqli_close($conn);

}  else { 
	header("Location: ../../index.php");
	exit();
} 