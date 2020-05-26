<?php 
session_start();

if (isset($_POST["daily-submit"])) {
    require "db.inc.php";


    $dailycalorie = $_POST["sss"];
    $dailyprotein = $_POST["ssssss"];
    $dailycarbs = $_POST["ssssss"];
    $dailyfat = $_POST["ssssss"];
    $dailysugar = $_POST["ssssss"]; 


    if (isEmpty($dailycalorie) || isEmpty($dailyprotein) || isEmpty($dailycarbs) || isEmpty($dailyfat) || isEmpty($dailysugar)) {
        header();
        exit();
    } else {

        $sql = "UPDATE `users` SET `dailycalorie` = ?, `dailyprotein` = ?, `dailycarbs` = ?, `dailyfat` = ?, `dailysugar` = ? WHERE `username` = ?;";

        $stmt = mysqli_stmt_init($conn);
        
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../../login.php?err=sqlerror");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, 'idddds', $dailycalorie, $dailyprotein, $dailycarbs, $dailyfat, $dailysugar, $_SESSION['username']);
            mysqli_stmt_execute($stmt);
        }

    }

} else {
    header("Location: ../../dailycalorie.php");
    exit();
}