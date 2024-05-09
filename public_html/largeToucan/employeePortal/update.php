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
            width: 23%;
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

<!-- PHP Constants, Functions, and Database Connection-->
<?php
    // database info
    include '../../../phpconfig/config.inc';

    // create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 

    // function to display products (with removable values)
    function showProductTable() {
        // reference the global connection object (scope)
        global $conn; 
        // query to show all current products
        $sqlProducts = "SELECT product_ID, product_name, category FROM product";
        $result = $conn->query($sqlProducts);
        // products found
        if ($result->num_rows > 0) {
            echo "<br>Choose a product to delete.";?>
            <!-- scrollbar box -->
            <div class = "wrapper" style="height: 60%; overflow: auto"><?php
                // table to show all employees
                echo "<table><tr><th>ID</th><th>Name</th><th>Category</th><th>Click To Remove</th></tr>";
                while($row = $result->fetch_assoc()) {
                    echo "<tr><td>".$row["product_ID"]."</td><td>".$row["product_name"]."</td><td>".$row["category"].
                    "</td><td><a href=\"update.php?choice=removeProduct&form_submitted=1&deleteType=prod&deleteID="
                    .$row["product_ID"]."\">Remove</a></td></tr>";
                }
                echo "</table>"; // close the table ?>
            </div> 
        <?php } 
        // no products found
        else {
            echo "<br>0 products found.";
        }
    } 

    // function to display discounts (with removable values)
    function showDiscountTable() {
        // reference the global connection object (scope)
        global $conn; 
        // query to show all current discounts
        $sqlDiscounts = "SELECT * FROM discount";
        $result = $conn->query($sqlDiscounts);
        // discounts found
        if ($result->num_rows > 0) {
            echo "<br>Choose a discount to delete."; ?>
            <!-- scrollbar box -->
            <div class = "wrapper" style="height: 60%; overflow: auto"> <?php
                // table to show all discounts
                echo "<table><tr><th>ID</th><th>Product ID</th><th>Type</th><th>Value</th><th>Click To Remove</th></tr>";
                while($row = $result->fetch_assoc()) {
                    echo "<tr><td>".$row["discount_ID"]."</td><td>".$row["product_ID"]."</td><td>".$row["type"]."</td><td>"
                    .$row["value"]."</td><td><a href=\"update.php?choice=removeProduct&form_submitted=1&deleteType=disc&deleteID="
                    .$row["discount_ID"]."\">Remove</a></td></tr>";
                }
                echo "</table>"; // close the table ?>
            </div>
        <?php } 
        // no discounts found
        else {
            echo "<br>0 discounts found.";
        }
    } 

    // function to display coupons (with removable values)
    function showCouponTable() {
        // reference the global connection object (scope)
        global $conn; 
        // query to show all current coupons
        $sqlCoupons = "SELECT coupon_ID, description FROM coupon";
        $result = $conn->query($sqlCoupons);
        // coupons found
        if ($result->num_rows > 0) {
            echo "<br>Choose a coupon to delete."; ?>
            <!-- scrollbar box -->
            <div class = "wrapper" style="height: 60%; overflow: auto"> <?php
                // table to show all coupons
                echo "<table><tr><th>ID</th><th>Description</th><th>Click To Remove</th></tr>";
                while($row = $result->fetch_assoc()) {
                    echo "<tr><td>".$row["coupon_ID"]."</td><td>".$row["description"]."</td><td>".
                    "<a href=\"update.php?choice=removeProduct&form_submitted=1&deleteType=coup&deleteID="
                    .$row["coupon_ID"]."\">Remove</a></td></tr>";
                }
                echo "</table>"; // close the table ?>
            </div>
        <?php } 
        // no coupons found
        else {
            echo "<br>0 coupons found.";
        }
    } 
?>

<!-- Start of Body  -->
<body> 

    <!-- start of wrapper -->
    <div class = "wrapper">

    <!-- before main form is submitted -->
    <?php if (!isset($_GET["form_submitted"]) && !isset($_GET["subform_submitted"])) { ?>

        <!-- form to get what needs to be updated -->
        <form action="update.php" method=get>
            <div class = "custom-select">
                <br>What information would you like to update?
                <select name="choice">
                    <option value="addProd">Add New Product</option>
                    <option value="removeProd">Remove Product</option>
                    <option value="addDisc">Add New Discount</option>
                    <option value="removeDisc">Remove Discount</option>
                    <option value="addCoupon">Add New Coupon</option>
                    <option value="removeCoupon">Remove Coupon</option>
                </select>
            </div>
            <p> <input type=submit class = "buttonSmall" value="Enter">
                    <input type="hidden" name="form_submitted" value="1" >
        </form>

    <?php }


    // main form is submitted but subform is not 
    elseif (isset($_GET["form_submitted"]) && !isset($_GET["subform_submitted"]) && !isset($_GET["deleteID"])) {

        // adding a product
        if ($_GET["choice"] == "addProd") { ?>

            <!-- form to add product -->
            <form action="update.php" method=get>
                <br>Enter Product Name: <input type=text size=15 name="name">
                <p>Enter Product ID: <input type=text size=15 name="id" placeholder="pr99999">
                <p>Enter Product Category: <input type=text size=15 name="category">
                <p>Enter Product Quantity: <input type=text size=15 name="quantity">
                <p>Enter Product Aisle Location: <input type=text size=15 name="aisle">
                <p>Enter Product Price: <input type=text size=15 name="price" placeholder="0.00">
                <p> <input type=submit class = "buttonSmall" value="Add Product">
                    <input type="hidden" name="subform_submitted" value="1" >
            </form>

            <!-- option to cancel adding product -->
            <p> <input type="button" class = "buttonSmall" value="Cancel" onclick="location='update.php'" />

        <?php }

        // removing a product
        elseif ($_GET["choice"] == "removeProd") {

            // display current product table
            showProductTable();

            // options to leave page
            ?> <p> <input type="button" class = "buttonSmall" value="Done" onclick="location='update.php'" />

        <?php } 

        // adding a discount
        elseif ($_GET["choice"] == "addDisc") { ?>

            <!-- form to add discount -->
            <form action="update.php" method=get>
                <br>Enter Discount ID: <input type=text size=15 name="disc_id" placeholder = "d99999">
                <p>Enter Product ID: <input type=text size=15 name="prod_id" placeholder = "pr99999">
                <p>Select Type:
                    <select name="type">
                        <option value="percent_off">Percentage Off</option>
                        <option value="new_value">New Value</option>
                    </select>
                <p>Enter Value: <input type=text size=15 name="value" placeholder = "0.00">
                <p>Enter Start Date: <input type=text placeholder="YYYY-MM-DD" size=15 name="start_date">
                <p>Enter End Date: <input type=text placeholder="YYYY-MM-DD" size=15 name="end_date">
                <p> <input type=submit class = "buttonSmall" value="Add Discount">
                    <input type="hidden" name="subform_submitted" value="1" >
            </form>

            <!-- option to cancel adding discount -->
            <p> <input type="button" class = "buttonSmall" value="Cancel" onclick="location='update.php'" />

        <?php }

        // removing a discount
        elseif ($_GET["choice"] == "removeDisc") { 

            // display current discount table
            showDiscountTable();

            // options to leave page
            ?> <p> <input type="button" class = "buttonSmall" value="Done" onclick="location='update.php'" />

        <?php }

        // adding a coupon
        elseif ($_GET["choice"] == "addCoupon") { ?>

            <!-- form to add coupon -->
            <form action="update.php" method=get>
                <br>Enter Coupon ID: <input type=text size=15 name="coupon_id" placeholder = "cp99999">
                <p>Enter Reward Point Cost: <input type=text size=15 name="reward_point_cost">
                <p>Enter Description: <input type=text size=15 name="description">
                <p> <input type=submit class = "buttonSmall" value="Add Coupon">
                    <input type="hidden" name="subform_submitted" value="1" >
            </form>

            <!-- option to cancel adding coupon -->
            <p> <input type="button" class = "buttonSmall" value="Cancel" onclick="location='update.php'" />

        <?php }

        // removing a coupon
        elseif ($_GET["choice"] == "removeCoupon") { 

            // display current coupon table
            showCouponTable();

            // options to leave page
            ?> <p> <input type="button" class = "buttonSmall" value="Done" onclick="location='update.php'" />

        <?php }

        // no options chosen 
        else {
            echo "An error has occured. Please reselect a choice from the dropdown menu.";
        }

    }


    // main form submitted and subform submitted (deletion specified)
    elseif (isset($_GET["form_submitted"]) && isset($_GET["deleteID"])) {

        // deleting a product
        if ($_GET["deleteType"] == "prod") {

            // remove employee with deleteID from database
            $productID = $_GET["deleteID"]; 
            $sqlstatement = $conn->prepare("DELETE FROM product where product_ID = ?"); 
            $sqlstatement->bind_param("s",$productID); 
            $sqlstatement->execute(); 
            $error = $sqlstatement->error; 
            $sqlstatement->close();

            // display updated table
            showProductTable();

            // display any removal errors
            if ($error) {
                echo "<br><div class = \"errorWrapper\">WARNING: Product deletion failed due to foreign key constraint.<br></div>";
            }

            // options to leave page
            ?> <p> <input type="button" class = "buttonSmall" value="Done" onclick="location='update.php'" />

        <?php }

        // deleting a discount
        elseif ($_GET["deleteType"] == "disc") {

            // remove discount with deleteID from database
            $discountID = $_GET["deleteID"]; 
            $sqlstatement = $conn->prepare("DELETE FROM discount where discount_ID = ?"); 
            $sqlstatement->bind_param("s",$discountID); 
            $sqlstatement->execute(); 
            $error = $sqlstatement->error; 
            $sqlstatement->close();

            // display updated table
            showDiscountTable();

            // display any removal errors
            if ($error) {
                echo "<br><div class = \"errorWrapper\">WARNING: Discount deletion failed due to foreign key constraint.<br></div>";
            }

            // options to leave page
            ?> <p> <input type="button" class = "buttonSmall" value="Done" onclick="location='update.php'" />

        <?php }

        // deleting a coupon
        elseif ($_GET["deleteType"] == "coup") {

            // remove employee with deleteID from database
            $couponID = $_GET["deleteID"]; 
            $sqlstatement = $conn->prepare("DELETE FROM coupon where coupon_ID = ?"); 
            $sqlstatement->bind_param("s",$couponID); 
            $sqlstatement->execute(); 
            $error = $sqlstatement->error; 
            $sqlstatement->close();

            // display updated table
            showCouponTable();

            // display any removal errors
            if ($error) {
                echo "<br><div class = \"errorWrapper\">WARNING: Coupon deletion failed due to foreign key constraint.<br></div>";
            }

            // options to leave page
            ?> <p> <input type="button" class = "buttonSmall" value="Done" onclick="location='update.php'" />

        <?php }

    }


    // main form and subform have been submitted (no deletion)
    else {

        // check for info necessary to add product
        if (!empty($_GET["name"]) && !empty($_GET["id"]) && !empty($_GET["category"]) && 
            !empty($_GET["quantity"]) && !empty($_GET["aisle"]) && !empty($_GET["price"])) {

            // get variables for product
            $productName = $_GET["name"]; 
            $productID = $_GET["id"]; 
            $category = $_GET["category"]; 
            $quantity = $_GET["quantity"]; 
            $aisle = $_GET["aisle"]; 
            $price = $_GET["price"]; 

            // insert variables as a product
            $sqlstatement = $conn->prepare("INSERT INTO product values (?, ?, ?, ?, ?, ?)"); 
            $sqlstatement->bind_param("sssiid",$productID, $productName, $category, 
                                    $quantity, $aisle, $price); 
            $sqlstatement->execute(); 
            $errorVal = $sqlstatement->error;
            $sqlstatement->close();

        }

        // check for info necessary to add discount
        elseif (!empty($_GET["disc_id"]) && !empty($_GET["prod_id"]) && !empty($_GET["type"]) 
                && !empty($_GET["value"]) && !empty($_GET["start_date"]) && !empty($_GET["end_date"])) {

            // get variables for discount
            $discountID = $_GET["disc_id"]; 
            $productID = $_GET["prod_id"]; 
            $type = $_GET["type"]; 
            $value = $_GET["value"];
            $start_date = $_GET["start_date"]; 
            $end_date = $_GET["end_date"]; 

            // insert variables as a discount
            $sqlstatement = $conn->prepare("INSERT INTO discount values (?, ?, ?, ?, ?, ?)"); 
            $sqlstatement->bind_param("sssdss",$discountID, $productID, $type, $value, 
                                    $start_date, $end_date);
            $sqlstatement->execute(); 
            $errorVal = $sqlstatement->error;
            $sqlstatement->close();
        }      

        // check for info necessary to add coupon
        elseif (!empty($_GET["coupon_id"]) && !empty($_GET["reward_point_cost"]) && 
                !empty($_GET["description"])) {
            
            // get variables for coupon
            $couponID = $_GET["coupon_id"]; 
            $reward_point_cost = $_GET["reward_point_cost"]; 
            $description = $_GET["description"]; 

            // insert variables as a coupon
            $sqlstatement = $conn->prepare("INSERT INTO coupon values (?, ?, ?)"); 
            $sqlstatement->bind_param("sis",$couponID, $reward_point_cost, $description); 
            $sqlstatement->execute(); 
            $errorVal = $sqlstatement->error;
            $sqlstatement->close();

        }   

        // necessary fields must be missing
        else {
            $missing = True;
        } 

        // error or success message
        if ($errorVal || $missing) {
            echo "<br><div class = \"errorWrapper\">
                An error has occured with your inputs. Please try again.
            </div>"; 
        }
        else {
            echo "<br>Change Successfully Submitted.";
        } ?>

        <!-- options to return to home or main HR page -->
        <p> <input type="button" class = "buttonSmall" value="Make Another Change" onclick="location='update.php'"/>

    <?php }

    // close database connection
    $conn->close();?>

    <!-- option to return to home page -->
    <div class = "bottom" >
        <p><input type="button" class = "buttonSmall" value="Employee Home" onclick="location='employee.php'" /> 
    </div>

    <!-- stop wrapper -->
    </div>

</body>

</html>
