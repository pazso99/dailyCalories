<?php
    session_start();
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <script src="script/responsive.js" defer></script>
    <script src="script/search.js" defer></script>
    <script src="script/addFood.js" defer></script>
</head>

<body>
    <header>
        <div class="header-logo"><a href="index.php"><img src="./img/logo.png" alt=""></a></div>
    </header>

    <nav class="navbar">
        
        <div class="logo"><a href="index.php"><img src="./img/logo.png" alt=""></a></div>
        <div class="togglebutton">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </div>

        <ul class="nav-links">
            <li><a href="index.php">Home</a></li>
            <li><a href="dailycalories.php">DailyCalories</a></li>
            <li><a href="#">Recipes</a></li>
            <li><a href="#">Workouts</a></li>
        </ul>
<?php
        if (isset($_SESSION['username'])) {
            echo '
            <ul class="nav-links">
                <li><a class="profile-button" href="profile.php">Profile</a></li>
                <li><a class="logout-button" href="include/db/logout.inc.php">Logout</a></li>
            </ul> 
            ';
        } else {
            echo '
            <ul class="nav-links">
                <li><a class="login-button" href="login.php">Log in</a></li>
                <li><a class="signup-button" href="signup.php">Sign up</a></li>
            </ul> 
            ';
        }
?>
    </nav>
    