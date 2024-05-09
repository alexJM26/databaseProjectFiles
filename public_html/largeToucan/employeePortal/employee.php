<!-- Initialize the session -->
<?php session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["eloggedin"]) || $_SESSION["eloggedin"] !== true){
    header("location: employeeLogin.php");
    exit;
} ?>

<!-- HTML Start -->
<html>

<!-- Head Start -->
<head>

    <!-- styling -->
    <link rel="stylesheet" href="employeeStyle.css" type="text/css">

    <!-- Fonts -->
    <link href='https://fonts.googleapis.com/css?family=IBM Plex Sans' rel='stylesheet'>

    <!-- size correctly -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>

<!-- Body Start -->
<body>

    <div class="wrapper">

        <!-- Website Header -->
        <img src="../img/toucanSmashVariant.svg" width="30%" height="30%">
        <div class = "upper">

            <h2>Employee Hub</h2></p>

            <!-- Website Button Options -->
            <p><input type="button" button class="button buttonBig" value="Product Information" onclick="location='product.php'" /> 
            <p><input type="button" button class="button buttonBig" value="Update Information" onclick="location='update.php'" /> 
            <p><input type="button" button class="button buttonBig" value="Purchase Log" onclick="location='purchase.php'" /> 
            <p><input type="button" button class="button buttonBig" value="HR Information" onclick="location='HR.php'" /> 

        </div>

        <!-- Logout Page -->
        <div class = "bottom">

            <p><input type="button" button class="button buttonSmall" value="Logout" onclick="location='employeeLogout.php'" /> 
            
        </div>

    </div>

</body>

</html>