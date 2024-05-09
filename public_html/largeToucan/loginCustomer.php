<!-- Initialize the session -->
<?php session_start(); //alex & https://www.tutorialrepublic.com/php-tutorial/php-mysql-login-system.php did all the work on this.
include '../../phpconfig/config.inc';
$conn = new mysqli($servername, $username, $password, $dbname);
 
// Check if the user is already logged in, if yes then redirect them to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: userPage.php");
    exit;
}

// Define variables and initialize with empty values
$email = $password = "";
$email_err = $password_err = $login_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if email is empty
    if(empty(trim($_POST["email"]))){
        $email_err = "Please enter email.";
    } else{
        $email = trim($_POST["email"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($email_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT customer_ID, email, password FROM customer WHERE email = ?";
        
        if($stmt = $conn->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_email);
            
            // Set parameters
            $param_email = $email;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Store result
                $stmt->store_result();
                
                // Check if email exists, if yes then verify password
                if($stmt->num_rows == 1){  

                    // Bind result variables
                    $stmt->bind_result($id, $email, $hashed_password);
                    if($stmt->fetch()){

                        if(($password == $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["customer_ID"] = $id;
                            $_SESSION["email"] = $email;                            
                            
                            // Redirect user to welcome page
                            header("location: userPage.php");
                        } else {
                            // Password is not valid, display a generic error message
                            $login_err = "Invalid email or password.";
                        }
                    }
                } else {
                    // email doesn't exist, display a generic error message
                    $login_err = "Invalid email or password.";
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            $stmt->close();
        }
    }
}
?>

<html lang="en-US" class=" ilpng idc0_350"><head>
	<link rel="stylesheet" href="style.css" type="text/css">
	<link rel="icon" href="squid.png" type="image/x-icon">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
	<link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&amp;display=swap" rel="stylesheet">
	<title>Large Toucan</title>
<link rel="preconnect" href="https://fonts.googleapis.com" crossorigin="true"><link rel="preconnect" href="https://fonts.gstatic.com"><link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Mulish:wght@200;300;400;500;600;700;800;900&amp;display=swa"></head>
<body>
<main>
<?php echo $html = file_get_contents('header.html')?>

    <div id="loginWrapperOverflow">
    <div id="loginWrapper"><!--get wack overflow issues without a parent wrapper dude idk-->
            <h2>Welcome back to The Nest.</h2>
            <hr id="loginHR">
            <p>Feel free to roost!</p>

            <!-- Email and Password Form -->
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div id="loginInput">
                <!-- Email -->
                <div class="loginRow">
	            Enter Email:
                <input type="text" name="email" size=30 class="form-control loginIn
                <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
                </div>
                <!-- Password -->
                <div class="loginRow">
                Enter Password:
                <input type="password" name="password" size=30 class="form-control loginIn 
                <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                </div>
                <!-- Enter Button -->
                <input type = "submit" id="loginButton" value = "Go!">
            </div>
            </form>

            <!-- Error Messages -->
            <?php if (!empty($email_err) || !empty($password_err) || !empty($login_err)) { ?>

                <div class = "errorWrapper">

                    <!-- Missing Email -->
                    <?php if (!empty($email_err)) {
                        echo '<span class="invalid-feedback">'.$email_err.'</span>'; 
                    } 

                    // missing password
                    if (!empty($password_err)) {
                        // add new line if email is also missing
                        if (!empty($email_err)) {
                            echo '<br>';
                        }
                        echo '<span class="invalid-feedback">'.$password_err.'</span>';
                    } 

                    // login error
                    if (!empty($login_err)) {
                        echo $login_err;
                    } ?>

                </div>

            <?php } ?>
    </div>           
    </div>
<?php echo $html = file_get_contents('footer.html')?>
</main>
</body>
</html>