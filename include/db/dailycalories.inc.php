<?php
if(isset($_REQUEST["food"])){
    require "db.inc.php";
    
    // list all food
    if($_REQUEST["food"] == "*") {
        $sql = "SELECT * FROM foods";
        if($stmt = mysqli_prepare($conn, $sql)){
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
                if(mysqli_num_rows($result) > 0){
                    // Fetch result rows as an associative array
                    while($row = mysqli_fetch_assoc($result)){
                        echo "<div class='item'><p class='item-name'>". strtoupper($row['name']) . "</p><p class='item-info'>(". $row['quantity'] ."): <b>Kcal</b>: " . $row['calorie'] . "kcal  | <b>Carbs:</b> " . $row['carbs'] . "g  |  <b>Fiber:</b> " . $row['fiber'] . "g  |  <b>Sugar:</b> " . $row['sugar'] . "g  |  <b>Protein:</b> " . $row['protein'] . "g  |  <b>Fat:</b> " . $row['fat'] . "g</p></div>";
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
            $param_term = '%' .$_REQUEST["food"] . '%';

            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_term);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
                
                // Check number of rows in the result set
                if(mysqli_num_rows($result) > 0){
                    // Fetch result rows as an associative array
                    while($row = mysqli_fetch_assoc($result)){
                        echo "<div class='item'><p class='item-name'>". strtoupper($row['name']) . "</p><p class='item-info'>(". $row['quantity'] ."): <b>Kcal</b>: " . $row['calorie'] . "kcal  | <b>Carbs:</b> " . $row['carbs'] . "g  |  <b>Fiber:</b> " . $row['fiber'] . "g  |  <b>Sugar:</b> " . $row['sugar'] . "g  |  <b>Protein:</b> " . $row['protein'] . "g  |  <b>Fat:</b> " . $row['fat'] . "g</p></div>";
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
    mysqli_close($conn);


} else if (isset($_REQUEST["addfood"])) {
    require "db.inc.php";
    // Prepare a select statement
    $sql = "SELECT * FROM foods WHERE name=?;"; 
    if($stmt = mysqli_prepare($conn, $sql)){

        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "s", $_REQUEST["addfood"]);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);

        echo '
            <label for="name"><b>Food name</b></label>
            <input readonly type="text" name="name" value="'. $row['name'] .'">
            <label for="quantity"><b>Food quantity in '. $row['quantity'] .'</b></label>
            <input type="number" placeholder="Enter quantity" name="quantity"> 
            <input type="submit" class="form-button" name="eatfood-submit" value="EAT">
            '; 
     
                
    }
     
    // Close statement
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>