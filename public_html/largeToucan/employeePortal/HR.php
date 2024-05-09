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

    // function to display employee table (with removable values)
    function showEmployeeTable() {
        // reference the global connection object (scope)
        global $conn; 
        // query to show all current employees
        $sqlEmployees = "SELECT employee_ID, first_name, last_name, role_name FROM employee";
        $result = $conn->query($sqlEmployees);
        // employees found
        if ($result->num_rows > 0) {
            echo "<br>Choose an employee to delete."; ?>
            <!-- scrollbar box -->
            <div class = "wrapper" style="height: 60%; overflow: auto"> <?php
                // table to show all employees
                echo "<table><tr><th>ID</th><th>First Name</th><th>Last Name</th><th>Role</th><th>Click To Remove</th></tr>";
                while($row = $result->fetch_assoc()) {
                    echo "<tr><td>".$row["employee_ID"]."</td><td>".$row["first_name"]."</td><td> ".$row["last_name"].
                    "</td><td>".$row["role_name"]."</td><td><a href=\"HR.php?choice=removeEmployee&form_submitted=1&deleteID="
                    .$row["employee_ID"]."\">Remove</a></td></tr>";
                }
                echo "</table>"; // close the table ?>
            </div> 
        <?php } 
        // no employees found
        else {
            echo "0 employees found.";
        }
    } 
?>

<!-- Start of body -->
<body> 

    <!-- begin wrapper -->
    <div class = "wrapper">

    <!-- before main form is submitted -->
    <?php if (!isset($_GET["form_submitted"]) && !isset($_GET["subform_submitted"])) { ?>

        <!-- name or id search form -->
        <form action="HR.php" method=get>
            <br>What would you like to do?
            <select name="choice">
                <option value="searchEmployee">Search Employee</option>
                <option value="addEmployee">Add Employee</option>
                <option value="removeEmployee">Remove Employee</option>
            </select>
            <p> <input type=submit class = "buttonSmall" value="Enter">
                <input type="hidden" name="form_submitted" value="1" >
        </form>

    <?php }


    // after main form is submitted, no subform, no deletion
    elseif (isset($_GET["form_submitted"]) && !isset($_GET["subform_submitted"]) && !isset($_GET["deleteID"])) {

        // chose search for employee
        if ($_GET["choice"] == "searchEmployee") { ?>

            <!-- search for employee for -->
            <p><h2>Employee Search:</h2></p>
            <form action="HR.php" method=get>
                Enter Employee Last Name: <input type=text size=15 name="searchName">
                <p>Enter Employee ID: <input type=text size=15 name="searchID" placeholder="e99999">
                <p> <input type=submit class="buttonSmall" value="Enter">
                    <input type="hidden" name="subform_submitted" value="1" >
            </form>

        <?php }

        // chose to add an employee
        elseif ($_GET["choice"] == "addEmployee") { ?>

            <!-- scrollbar box -->
            <br><div class = "wrapper" style="height: 83%; overflow: auto">

                <!-- form to add an employee -->
                <form action="HR.php" method=get>
                    Enter Employee ID: <input type=text size=15 name="id" placeholder = "e99999">
                    <p>Enter Role: <input type=text size=15 name="role">
                    <p>Enter First Name: <input type=text size=15 name="first_name">
                    <p>Enter Middle Name: <input type=text size=15 name="middle_name">
                    <p>Enter Last Name: <input type=text size=15 name="last_name">
                    <p>Enter Street: <input type=text size=15 name="street">
                    <p>Enter City: <input type=text size=15 name="city">
                    <p>Enter State: <input type=text size=15 name="state">
                    <p>Enter Zipcode: <input type=text size=15 name="zip">
                    <p>Enter Email: <input type=text size=15 name="email">
                    <p>Create Password: <input type=text size=15 name="password">
                    <p>Enter Phone: <input type=text size=15 name="phone" placeholder = "1234567890">
                    <p>Enter Date of Birth: <input type=text placeholder="YYYY-MM-DD" size=15 name="dob">
                    <p>Enter Start Date: <input type=text placeholder="YYYY-MM-DD" size=15 name="start_date">
                    <p> <input type=submit class = "buttonSmall" value="Add Employee">
                        <input type="hidden" name="subform_submitted" value="1" >
                </form> 

                <!-- cancel adding an employee -->
                <p> <input type="button" class = "buttonSmall" value="Cancel" onclick="location='HR.php'" />

            </div>

        <?php }

        // chose to delete an employee
        elseif ($_GET["choice"] == "removeEmployee") {

            // display current employee table
            showEmployeeTable(); ?>

            <!-- options to leave page -->
            <p> <input type="button" class = "buttonSmall" value="Done" onclick="location='HR.php'" />

        <?php }

        // no option selected
        else {
            echo "An error has occured. Please reselect a choice from the dropdown menu.";
        }
    } 


    // main form is submitted and removal is specified
    elseif (isset($_GET["form_submitted"]) && isset($_GET["deleteID"])) {

        // remove employee with deleteID from database
        $employeeID = $_GET["deleteID"]; 
        $sqlstatement = $conn->prepare("DELETE FROM employee where employee_ID = ?"); 
        $sqlstatement->bind_param("s",$employeeID); 
        $sqlstatement->execute(); 
        echo $sqlstatement->error; 
        $sqlstatement->close();

        // display updated table
        showEmployeeTable(); ?>

        <!-- options to leave page -->
        <p> <input type="button" class = "buttonSmall" value="Done" onclick="location='HR.php'" />

    <?php }


    // main form and subform are submitted (no removal)
    else {

        // check for info necessary to add employee
        if (!empty($_GET["id"]) && !empty($_GET["role"]) && !empty($_GET["first_name"]) && 
            !empty($_GET["middle_name"]) && !empty($_GET["last_name"]) && !empty($_GET["street"]) && 
            !empty($_GET["city"]) && !empty($_GET["state"]) && !empty($_GET["zip"]) && 
            !empty($_GET["email"]) && !empty($_GET["password"]) && !empty($_GET["phone"]) && 
            !empty($_GET["dob"]) && !empty($_GET["start_date"])) {

            // get employee varaibles
            $employeeID = $_GET["id"]; 
            $role = $_GET["role"];
            $first_name = $_GET["first_name"]; 
            $middle_name = $_GET["middle_name"]; 
            $last_name = $_GET["last_name"]; 
            $street = $_GET["street"]; 
            $city = $_GET["city"]; 
            $state = $_GET["state"];
            $zip = $_GET["zip"]; 
            $email = $_GET["email"]; 
            $password = $_GET["password"];
            $phone = $_GET["phone"]; 
            $dob = $_GET["dob"]; 
            $start_date = $_GET["start_date"]; 

            // insert these variables as an employee
            $sqlstatement = $conn->prepare("INSERT INTO employee values (?, ?, ?, ?, ?, ?, ?, ?, ?, 
                                            ?, ?, ?, ?, ?)"); 
            $sqlstatement->bind_param("ssssssssississ",$employeeID, $role, $first_name, $middle_name, 
                                    $last_name, $street, $city, $state, $zip, $email, $password,
                                    $phone, $dob, $start_date); 
            $sqlstatement->execute(); 
            $errorVal = $sqlstatement->error;
            $sqlstatement->close();
        }

        // check for info necessary to search for an employee
        elseif (!empty($_GET["searchName"]) || !empty($_GET["searchID"])) {

            // name was prodvided
            if (!empty($_GET["searchName"])) {
                $employeeName = $_GET["searchName"];
                $sql = "SELECT * FROM employee where last_name='$employeeName'";
                $result = $conn->query($sql);
            }
            // id was provided
            elseif (!empty($_GET["searchID"])) {
                $employeeID = $_GET["searchID"];
                $sql = "SELECT * FROM employee where employee_ID ='$employeeID'";
                $result = $conn->query($sql);
            }

            // employee was found
            if ($result->num_rows > 0) {

                // output table with employee information
                echo "<br>".$result->num_rows." Employees Found"; ?> 
                <div class = "wrapper" style="height: 70%; overflow: auto"> <?php
                    while($row = $result->fetch_assoc()) { ?>
                        <table>
                            <tr><th>Employee ID</th><td><?php echo $row["employee_ID"] ?></td></tr>
                            <tr><th>First Name</th><td><?php echo $row["first_name"] ?></td></tr>
                            <tr><th>Middle Name</th><td><?php echo $row["middle_name"] ?></td></tr>
                            <tr><th>Last Name</th><td><?php echo $row["last_name"] ?></td></tr>
                            <tr><th>Role</th><td><?php echo $row["role_name"] ?></td></tr>
                            <tr><th>Street</th><td><?php echo $row["street"] ?></td></tr>
                            <tr><th>City</th><td><?php echo $row["city"] ?></td></tr>
                            <tr><th>State</th><td><?php echo $row["state"] ?></td></tr>
                            <tr><th>Zipcode</th><td><?php echo $row["zip"] ?></td></tr>
                            <tr><th>Email</th><td><?php echo $row["email"] ?></td></tr>
                            <tr><th>Password</th><td><?php echo $row["password"] ?></td></tr>
                            <tr><th>Phone Number</th><td><?php echo $row["phone"] ?></td></tr>
                            <tr><th>Birth Date</th><td><?php echo $row["date_of_birth"] ?></td></tr>
                            <tr><th>Start Date</th><td><?php echo $row["start_date"] ?></td></tr>
                        </table><br>
                    <?php }
                echo "</table>"; // close the table ?>
                </div>
            <?php }

            // no employee was found
            else {
                echo "No employee found.";
            }
        }

        // necessary fields must be missing
        else {
            $missing = True;
        } 

        // error or success message
        if ($errorVal || $missing) {
            echo "<br><div class = \"errorWrapper\">An error has occured with your inputs. Please try again.</div>";
        }
        elseif (empty($_GET["searchName"]) && empty($_GET["searchID"])) {
            echo "<br>Employee Added Successfully.";
        } ?>

        <!-- options to return to home or main HR page -->
        <p><center> <input type="button" class = "buttonSmall" value="HR Home" onclick="location='HR.php'" /> </center>

    <?php }

    // close database connection
    $conn->close(); ?> 

    <!-- option to leave page -->
    <div class = "bottom">
        <p> <input type="button" class = "buttonSmall" value="Employee Home" onclick="location='employee.php'" /> 
    </div>

    <!-- stop wrapper -->
    </div>

</body>

</html>