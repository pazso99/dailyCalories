<?php 

if (isset($_POST["login-submit"])) {
    require "db.inc.php";

    $username = $_POST["username"];
    $password = $_POST["password"];

    if (empty($username) || empty($password)) {
        header("Location: ../../login.php?err=emptyfields");
        exit();
    } else {
        $sql = "SELECT * FROM users WHERE username=?;";

        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../../login.php?err=sqlerror");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, 's', $username);
            mysqli_stmt_execute($stmt);

            $result = mysqli_stmt_get_result($stmt);
            if ($row = mysqli_fetch_assoc($result)) {
                $pwdCheck = password_verify($password, $row["password"]);
                if ($pwdCheck == false) {
                    header("Location: ../../login.php?err=wrongpassword");
                    exit();
                } else if ($pwdCheck == true) {
                    session_start();
                    
                    foreach($row as $col => $data) {
                        $_SESSION[$col] = $data;
                    }
                    header("Location: ../../profile.php");
                    exit();
                } else {
                    header("Location: ../../login.php?err=wrongpassword");
                    exit();
                }

            } else {
                header("Location: ../../login.php?err=nouser");
                exit();
            }
        }
    }

} else {
    header("Location: ../../index.php");
    exit();
}