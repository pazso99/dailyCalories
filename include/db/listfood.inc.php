<?php
if(isset($_REQUEST["name"])){

    require "db.inc.php";
    
    // list all food
    if($_REQUEST["name"] == "*") {
        $sql = "SELECT * FROM foods";
        if($stmt = mysqli_prepare($conn, $sql)){
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
                if(mysqli_num_rows($result) > 0){
                    // Fetch result rows as an associative array
                    while($row = mysqli_fetch_assoc($result)){
                        echo "<div class='item'><a href='food.php?id=". $row['id'] . "&name=".$row['name'] . "&quantity=".$row['quantity'] ."&calorie=".$row['calorie'] ."&carbs=".$row['carbs'] ."&fiber=".$row['fiber'] ."&sugar=".$row['sugar'] ."&protein=".$row['protein'] ."&fat=".$row['fat'] ."'><p class='item-name'>". strtoupper($row['name']) . " (". $row['quantity'] .")" ."</p><p class='item-info'><b>Kcal</b>: " . $row['calorie'] . "kcal  | <b>Carbs:</b> " . $row['carbs'] . "g  |  <b>Fiber:</b> " . $row['fiber'] . "g  |  <b>Sugar:</b> " . $row['sugar'] . "g  |  <b>Protein:</b> " . $row['protein'] . "g  |  <b>Fat:</b> " . $row['fat'] . "g</p></a></div>";
                    }
                } else{
                    echo "<p>No matches found</p>";
                }
            }
        }

    } else {
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
                        echo "<div class='item'><a href='food.php?id=". $row['id'] . "&name=".$row['name'] . "&quantity=".$row['quantity'] ."&calorie=".$row['calorie'] ."&carbs=".$row['carbs'] ."&fiber=".$row['fiber'] ."&sugar=".$row['sugar'] ."&protein=".$row['protein'] ."&fat=".$row['fat'] ."'><p class='item-name'>". strtoupper($row['name']) . " (". $row['quantity'] .")"."</p><p class='item-info'><b>Kcal</b>: " . $row['calorie'] . "kcal  | <b>Carbs:</b> " . $row['carbs'] . "g  |  <b>Fiber:</b> " . $row['fiber'] . "g  |  <b>Sugar:</b> " . $row['sugar'] . "g  |  <b>Protein:</b> " . $row['protein'] . "g  |  <b>Fat:</b> " . $row['fat'] . "g</p></a></div>";
                    }
                } else{
                    echo "<p>No matches found</p>";
                }
            } else{
                echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
            }
        }
    }
     
    // Close statement
    mysqli_stmt_close($stmt);
}
?>