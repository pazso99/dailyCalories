<?php 
    require "include/header.php";
?>
   
   <div class="container">
        <h1>Sign up</h1>

        <?php
        // error display
        if (isset($_GET['err'])) {
            switch($_GET['err']) {
                case "emptyfields" : echo '<p class="error">Please fill in all the forms to create an account.</p>'; break;
                case "invalidemail" : echo '<p class="error">Please enter a valid email.</p>'; break;
                case "invalidusername" : echo '<p class="error">Please enter a valid username.</p>'; break;
                case "invalidpassword" : echo '<p class="error">Please enter a valid password.</p>'; break;
                case "usertaken" : echo '<p class="error">User already taken.</p>'; break;
                case "sqlerror" : echo '<p class="error">Server error happened.</p>'; break;
            }
        }
        ?>

        <hr class="line">
        
        <form method="POST" action="include/db/signup.inc.php">
            <div class="form-container">
        
                <label for="username"><b>Username</b></label>
                <input type="text" placeholder="Enter Username" name="username" value="<?php if (isset($_GET['username'])) echo $_GET['username'];?>">

                <label for="email"><b>Email</b></label>
                <input type="text" placeholder="Enter Email" name="email" value="<?php if (isset($_GET['email'])) echo $_GET['email']; ?>">
            
                <label for="password"><b>Password</b></label>
                <input type="text" placeholder="Enter Password" name="password">
            
                <label for="password-repeat"><b>Repeat Password</b></label>
                <input type="text" placeholder="Repeat Password" name="repeat-password">

                <label for="birth"><b>Birth</b></label>
                <input type="date" placeholder="Enter birth" name="birth" value="<?php if (isset($_GET['birth'])) echo $_GET['birth']; ?>">

                <label for="gender"><b>Choose your gender:</b></label>
                <select id="gender" name="gender">
                    <option <?php if(isset($_GET['gender']) && $_GET['gender'] == '-1'){echo("selected");}?> value="-1">Choose your gender</option>
                    <option <?php if(isset($_GET['gender']) && $_GET['gender'] == 'male'){echo("selected");}?> value="male">Male</option>
                    <option <?php if(isset($_GET['gender']) && $_GET['gender'] == 'female'){echo("selected");}?> value="female">Female</option>
                </select>
                
                <label for="height"><b>Height</b></label>
                <input type="number" min="120" max="250" placeholder="Enter your height (cm)" name="height" value="<?php if (isset($_GET['err'])) echo $_GET['height']; ?>">

                <label for="weight"><b>Weight</b></label>
                <input type="number" min="30" max="300" placeholder="Enter your weight (kg)" name="weight" value="<?php if (isset($_GET['err'])) echo $_GET['weight']; ?>">

                <label for="activity"><b>Choose your activity level:</b></label>
                <select id="activity" name="activity">
                    <option <?php if(isset($_GET['activity']) && $_GET['activity'] == '-1'){echo("selected");}?> value="-1">Choose your activity level</option>
                    <option <?php if(isset($_GET['activity']) && $_GET['activity'] == '1.2'){echo("selected");}?> value="1.2">Sedentary</option>
                    <option <?php if(isset($_GET['activity']) && $_GET['activity'] == '1.375'){echo("selected");}?> value="1.375">1-2days/week</option>
                    <option <?php if(isset($_GET['activity']) && $_GET['activity'] == '1.55'){echo("selected");}?> value="1.55">3-5day/week</option>
                    <option <?php if(isset($_GET['activity']) && $_GET['activity'] == '1.725'){echo("selected");}?> value="1.725">6-7day/week</option>
                    <option <?php if(isset($_GET['activity']) && $_GET['activity'] == '1.9'){echo("selected");}?> value="1.9">2x/day</option>
                </select>

                <label for="ideal"><b>Do you want to:</b></label>
                <select id="ideal" name="ideal">
                    <option <?php if(isset($_GET['ideal']) && $_GET['ideal'] == 'x'){echo("selected");}?> value="x">Choose your ideal</option>
                    <option <?php if(isset($_GET['ideal']) && $_GET['ideal'] == '-1'){echo("selected");}?> value="-1">Lose weight</option>
                    <option <?php if(isset($_GET['ideal']) && $_GET['ideal'] == '0'){echo("selected");}?> value="0">Maintain weight</option>
                    <option <?php if(isset($_GET['ideal']) && $_GET['ideal'] == '1'){echo("selected");}?> value="1">Gain weight</option>
                </select>

                <label for="ideal-percentage"><b>Enter ideal percentage</b></label>
                <input type="number" min="0" max="25" placeholder="Enter ideal percentage" name="ideal-percentage" value="<?php if (isset($_GET['idealpercentage'])) echo $_GET['idealpercentage']; ?>">

                <hr class="line">

                <p class="terms">By creating an account you agree to our <a href="#">Terms & Privacy</a>.</p>
            
                <input type="submit" class="form-button" name="signup-submit" value="Register">

                <div class="form-container goto">
                    <p>Already have an account? </p><a class="log-button" href="login.php">Sign in</a>
                </div>
            </div>
        </form>
    </div>

<?php 
    require "include/footer.php";
?>