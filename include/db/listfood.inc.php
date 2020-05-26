<?php
if(isset($_REQUEST["name"])){

    require "db.inc.php";
    
    // Prepare a select statement
    $sql = "SELECT * FROM foods WHERE name LIKE ?"; 

    if($stmt = mysqli_prepare($conn, $sql)){
        // Set parameters
        $param_term = '%' .$_REQUEST["name"] . '%';

        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "s", $param_term);
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
            
            // Check number of rows in the result set
            if(mysqli_num_rows($result) > 0){
                // Fetch result rows as an associative array
                while($row = mysqli_fetch_assoc($result)){
                    echo "<div class='item'><a href='food.php?name=".$row['name'] ."'><p class='item-name'>". strtoupper($row['name']) ."</p><p class='item-info'><b>Kcal</b>: " . $row['calorie'] . "kcal  | <b>Carbs:</b> " . $row['carbs'] . "g  |  <b>Fiber:</b> " . $row['fiber'] . "g  |  <b>Sugar:</b> " . $row['sugar'] . "g  |  <b>Protein:</b> " . $row['protein'] . "g  |  <b>Fat:</b> " . $row['fat'] . "g</p></a></div>";
                }
            } else{
                echo "<p>No matches found</p>";
            }
        } else{
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
        }
    }
     
    // Close statement
    mysqli_stmt_close($stmt);
}


if(isset($_REQUEST["food"])){

    require "db.inc.php";
    
    // Prepare a select statement
    $sql = "SELECT * FROM foods WHERE name LIKE ?"; 

    if($stmt = mysqli_prepare($conn, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "s", $param_term);
        
        // Set parameters
        $param_term = '%' .$_REQUEST["food"] . '%';
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
            
            // Check number of rows in the result set
            if(mysqli_num_rows($result) > 0){
                // Fetch result rows as an associative array
                while($row = mysqli_fetch_assoc($result)){
                    echo "<p>" . $row["name"] . "</p>";
                }
            } else{
                echo "<p>No matches found</p>";
            }
        } else{
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
        }
    }
     
    // Close statement
    mysqli_stmt_close($stmt);
}

 
// close connection
mysqli_close($conn);
?>













<!-- 



/* 
if (isset($_POST["listfood-submit"])) {
    require "db.inc.php";

    // POST adatok
    $name = $_POST["name"];

    if (empty($name)){ 
        header("Location: ../../login.php?err=emptyfield");
        exit();

    } else {
        $sql = "SELECT * FROM foods WHERE name=?;";

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
                    
                    foreach($row as $col => $data) {    // session data
                        $_SESSION[$col] = $data;
                    }

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
} */ -->