<?php

/* DB csatlakozásához szükséges adatok */
$serverName = "localhost";
$userName = "root";
$password = "";
$dbName = "healthv1";

/* ez a db csatija, erre hivatkozunk */
$conn = mysqli_connect($serverName, $userName, $password, $dbName);


if (!$conn) {
	die("Connect failed: " . mysqli_connect_error());
}