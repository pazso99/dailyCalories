<?php 

// ha login-submit gomb megnyomva, amúgy indexre visz
if (isset($_POST["login-submit"])) {
    
    require "db.inc.php";

    // POST adatok
    $username = $_POST["username"];
    $password = $_POST["password"];

    // validálás
    if (isEmpty($username) || isEmpty($password)) { 
        header("Location: ../../login.php?err=emptyfields");
        exit();

    } else {
        // usert kiszedjük db-ből
        $sql = "SELECT * FROM users WHERE username=?;";

        $stmt = mysqli_stmt_init($conn);   

        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../../login.php?err=sqlerror");
            exit();

        } else {
            mysqli_stmt_bind_param($stmt, 's', $username);  
            mysqli_stmt_execute($stmt);

            $result = mysqli_stmt_get_result($stmt);
            if ($row = mysqli_fetch_assoc($result)) {   // user találva
               
                $pwdCheck = password_verify($password, $row["password"]);   // password check
                
                if ($pwdCheck == false) {   // rossz pw
                    header("Location: ../../login.php?err=wrongpassword");
                    exit();

                } else if ($pwdCheck == true) {
                    session_start();    // session start
                    
                    foreach($row as $col => $data) {    // db data to session data
                        $_SESSION[$col] = $data;
                    }
                    // kezdeti értékek
                    $_SESSION['s_dailycalorie'] = 0;
                    $_SESSION['s_dailycarbs'] = 0;
                    $_SESSION['s_dailyprotein'] = 0;
                    $_SESSION['s_dailyfat'] = 0;
                    $_SESSION['caneat'] = true;

                    header("Location: ../../profile.php");  // and go to the profile page
                    exit();

                } else { // rossz pw
                    header("Location: ../../login.php?err=wrongpassword");
                    exit();
                }

            } else {    //nincs ilyen user
                header("Location: ../../login.php?err=nouser");
                exit();
            }
        }
    }

} else {
    header("Location: ../../index.php");
    exit();
}