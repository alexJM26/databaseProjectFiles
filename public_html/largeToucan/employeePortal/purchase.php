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

    <!-- begin wrapper -->
    <div class = "wrapper">

    <!-- form for purchases -->
    <p><h2>Purchase Logs</h2></p>
    <form action="purchase.php" method=get>
        <p>Enter Start Date: <input type=text placeholder="YYYY-MM-DD" size=10 name="start">
        <p>Enter End Date: <input type=text placeholder="YYYY-MM-DD" size=10 name="end">
            <p> <input type=submit class = "buttonSmall" value="Enter">
                    <input type="hidden" name="form_submitted" value="1" >
    </form>


    <!-- form not yet submitted -->
    <?php if (!isset($_GET["form_submitted"])) {
        echo "Enter a start date and an end date.";
    }

    // form has been submitted
    else {
        
        // start and end date have been filled out
        if (!empty($_GET["start"]) && !empty($_GET["end"])) {

            $startDate = $_GET["start"]; // gets the start date
            $endDate = $_GET["end"]; // get the end date

            // get all purchases between dates
            $sqlPurchases = $conn->prepare("SELECT * FROM purchase where purchase_date 
                                            BETWEEN ? AND ?"); 
            $sqlPurchases->bind_param("ss",$startDate,$endDate); 
            $sqlPurchases->execute(); 
            $resultPurchases = $sqlPurchases->get_result(); 
            $sqlPurchases->close();

            // get total profit
            $sqlProfit = $conn->prepare("SELECT sum(total_cost) AS profit FROM purchase 
                                        where purchase_date BETWEEN ? AND ?"); 
            $sqlProfit->bind_param("ss",$startDate,$endDate); 
            $sqlProfit->execute(); 
            $resultProfit = $sqlProfit->get_result(); 
            $sqlProfit->close();
        
            // one or more purchases were found
            if ($resultPurchases->num_rows > 0) {
                // display total profit
                $row = $resultProfit->fetch_assoc();
                echo "<b>Total Profit:</b> $".$row["profit"]."<br>"; ?>
                <!-- scrollbar box -->
                <div class = "wrapper" style="height: 35%; overflow: auto"><?php
                    // purchases table
                    echo "<b>All Sales</b>";
                    echo "<table><tr><th>Purchase ID</th><th>Customer ID</th><th>Total Cost</th><th>
                    Purchase Date</th><th>Additional Product Info</th></tr>";
                    while($row = $resultPurchases->fetch_assoc()) {
                        echo "<tr><td>".$row["purchase_ID"]."</td><td>".$row["customer_ID"]."</td><td>"
                            .$row["total_cost"]."</td><td>".$row["purchase_date"]."</td><td>
                            <a href=\"purchase.php?form_submitted=1&moreInfoID=".$row["purchase_ID"].
                            "\">See Product Info</a></td></tr>";
                    }
                    echo "</table>"; // close the table ?>
                </div> 
            <?php } 

            // no purchases were found
            else {
                echo "No purchases or profit recorded between ".$startDate." and ".$endDate.".";
            } 
        }

        // more info on products was requested
        elseif (!empty($_GET["moreInfoID"])) {

            // grab purchase ID
            $purchase = $_GET["moreInfoID"];

            // grab info on products within purchase
            $sqlProducts = $conn->prepare("SELECT * FROM contains where purchase_ID = ?");
            $sqlProducts->bind_param("s",$purchase); 
            $sqlProducts->execute(); 
            $resultProducts = $sqlProducts->get_result(); 
            $sqlProducts->close();

            // products were found inside of the purchase
            if ($resultProducts->num_rows > 0) {
                // display info
                echo "<b>Products Within Purchase ".$purchase."</b>";
                echo "<table><tr><th>Product ID</th><th>Quantity</th></tr>";
                while($row = $resultProducts->fetch_assoc()) {
                    echo "<tr><td>".$row["product_ID"]."</td><td>".$row["quantity"]."</td></tr>";
                }
                echo "</table>"; // close the table 
            }
            // no products were found within the purchase
            else {
                echo "No products found within purchase ".$purchase.".<br>";
            }

            // give user directions
            echo "<br>Hit the back button to return to the previous page, or enter a new start and end date.";
        }

        // start and end date were not both filled out (and no product info was requested)
        else {
            echo "Please enter a start date and an end date.";
        }
    }

    // close database connection
    $conn->close(); ?>

    <!-- option to return to home page -->
    <div class = "bottom">
        <p><input type="button" class = "buttonSmall" value="Employee Home" onclick="location='employee.php'"/>
    </div>

    <!-- end wrapper -->
    </div>

</body>

</html>