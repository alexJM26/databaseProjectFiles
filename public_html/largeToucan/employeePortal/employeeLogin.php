<!-- Initialize the session -->
<?php session_start();
 
// Check if the user is already logged in, if yes then redirect them to welcome page
if(isset($_SESSION["eloggedin"]) && $_SESSION["eloggedin"] === true) {
    header("location: employee.php");
    exit;
}
 
// Include config file
require_once "../../../phpconfig/config.inc";
 
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
        $sql = "SELECT employee_ID, email, password FROM employee WHERE email = ?";
        
        if($stmt = $mysqli->prepare($sql)){
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
                            $_SESSION["eloggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["email"] = $email;                            
                            
                            // Redirect user to welcome page
                            header("location: employee.php");
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
    
    // Close connection
    $mysqli->close();
}
?>

<!-- HTML Start -->
<html>

<!-- Head Start -->
<head>

    <!-- styling -->
    <link rel="stylesheet" href="employeeStyle.css" type="text/css">

    <!-- Size correctly -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Fonts -->
    <link href='https://fonts.googleapis.com/css?family=IBM Plex Sans' rel='stylesheet'>

</head>

<!-- Body Start -->
<body>

    <div class="wrapper">

        <!-- Website Header -->
        <img src="../img/toucanSmashVariant.svg" width="30%" height="30%">
        <div div class = "upper">
            <h2>Employee Login</h2>

            <!-- Email and Password Form -->
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

                <!-- Email -->
	            Enter Email: &nbsp &nbsp &nbsp &nbsp &nbsp
                <input type="text" name="email" size=30 class="form-control 
                <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
                
                <!-- Password -->
                <p>Enter Password: &nbsp 
                <input type="password" name="password" size=30 class="form-control 
                <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                
                <!-- Enter Button -->
                <p><input type = "submit" class = "buttonSmall" value = "Enter">

                <!-- Return to Home Button -->
                <div class = "bottom">
                    <p><input type = "button" class = "buttonSmall" value = "Return to Homepage" onclick="location='../index.php'">
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

</body>

</html>