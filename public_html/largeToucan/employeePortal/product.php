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
    <style>
        table {
            border-collapse: collapse;
            width: 75%;
            margin: auto;
        }
        td, th {
            border: 2px solid black;
            padding: 8px;
        }
        tr:nth-child(even){background-color: #f2f2f2;}
        tr:hover {background-color: #ddd;}
        th {
            padding-top: 10px;
            padding-bottom: 10px;
            text-align: left;
            background-color: #96CC5A;
            color: black;
            position: sticky;
        }
        form {
            text-align: center;
            font-family: 'IBM Plex Sans';
        }
        .custom-select {
            min-width: 350px;
        }
        select {
            width: 22%;
            font-size: 18px;
            padding: 3px;
            background-color: #fff;
            border: 1px solid #caced1;
            border-radius: 0.25;
            color: #000;
            cursor: pointer;
            font-family: 'IBM Plex Sans';
        }
    </style>

    <!-- Fonts -->
    <link href='https://fonts.googleapis.com/css?family=IBM Plex Sans' rel='stylesheet'>

    <!-- size correctly -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>

<!-- PHP Constants and Database Connection-->
<?php
    // database info
    include '../../../phpconfig/config.inc';

    // create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
?>

<!-- Start of body  -->
<body>

    <!-- start main wrapper -->
    <div class = "wrapper">

    <!-- form for product search -->
    <p><h2><center>Product Search</center></h2></p>
    <form action="product.php" method=get>
        Enter Product Name: <input type=text size=15 name="name">
        <p>Enter Product ID: <input type=text size=15 name="id" placeholder="pr99999">
            <p> <input type=submit class = "buttonSmall" value="Enter">
                    <input type="hidden" name="form_submitted" value="1" >
    </form>

    <!-- before form is submitted -->
    <?php if (!isset($_GET["form_submitted"])) {
        echo "Enter either the product name or the product ID.";
    }

    // after form is submitted
    else {

        // name was filled out
        if (!empty($_GET["name"])) {

            // get name of product
            $productName = $_GET["name"]; 

            // get product informaiton
            $sqlProduct = $conn->prepare("SELECT * FROM product where product_name=?"); 
            $sqlProduct->bind_param("s",$productName); 
            $sqlProduct->execute(); 
            $resultProduct = $sqlProduct->get_result(); 
            $sqlProduct->close();

            // get info on discounts on product
            $sqlDiscount = $conn->prepare("SELECT * FROM discount where product_ID in (select 
                                        product_ID from product where product_name=?) 
                                        and CURRENT_DATE() BETWEEN start_date AND end_date"); 
            $sqlDiscount->bind_param("s",$productName); 
            $sqlDiscount->execute(); 
            $resultDiscount = $sqlDiscount->get_result(); 
            $sqlDiscount->close();
        }
    
        // id was filled out
        elseif (!empty($_GET["id"])) {

            // get id of product
            $productID = $_GET["id"];

            // get product informaiton
            $sqlProduct = $conn->prepare("SELECT * FROM product where product_ID=?"); 
            $sqlProduct->bind_param("s",$productID); 
            $sqlProduct->execute(); 
            $resultProduct = $sqlProduct->get_result(); 
            $sqlProduct->close();

            // get info on discounts on product
            $sqlDiscount = $conn->prepare("SELECT * FROM discount where product_ID in (select 
                                        product_ID from product where product_ID=?) 
                                        and CURRENT_DATE() BETWEEN start_date AND end_date"); 
            $sqlDiscount->bind_param("s",$productID); 
            $sqlDiscount->execute(); 
            $resultDiscount = $sqlDiscount->get_result(); 
            $sqlDiscount->close();
        }

        // search found a product
        if ($resultProduct->num_rows > 0) { ?>

            <!-- scrollbar box -->
            <div class = "wrapper" style="height: 50%; overflow: auto"> <?php

                // table holding basic product info
                echo "<b>Basic Information</b>";
                echo "<table><tr><th>Name</th><th>ID</th><th>Category</th><th>Quantity</th><th>
                    Aisle Number</th><th>Price</th></tr>";
                while($row = $resultProduct->fetch_assoc()) {
                    echo "<tr><td>".$row["product_name"]."</td><td>".$row["product_ID"]."</td><td> "
                        .$row["category"]."</td><td>".$row["quantity_in_stock"]."</td><td>".$row["aisle_location"]
                        ."</td><td> ".$row["price"]."</td></tr>";
                }
                echo "</table><br>"; // close the table and add breakline

                // table holding all current discounts on product
                if ($resultDiscount->num_rows > 0) {
                    echo "<b>Current Discounts</b>";
                    echo "<table><tr><th>Discount ID</th><th>Type</th><th>Value</th><th>Start Date</th><th>End Date</th></tr>";
                    while($row = $resultDiscount->fetch_assoc()) {
                        echo "<tr><td>".$row["discount_ID"]."</td><td>".$row["type"]."</td><td>"
                        .$row["value"]."</td><td>".$row["start_date"]."</td><td>".$row["end_date"]."</td></tr>";
                    }
                    echo "</table>"; // close the table
                } ?>

            <!-- end scrollbar box -->
            </div> 

        <?php } 

        // search did not find a product
        else {
            echo "No product found.";
        } 
    } 

    // close database connection
    $conn->close(); ?>

    <!-- option to return to home page -->
    <div class = "bottom">
        <p><input type="button" class = "buttonSmall" value="Employee Home" onclick="location='employee.php'" /> 
    </div>

    <!-- stop wrapper -->
    </div> 
 
</body>

</html>