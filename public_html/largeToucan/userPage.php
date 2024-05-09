<!-- Initialize the session -->
<?php session_start(); //alex & https://www.tutorialrepublic.com/php-tutorial/php-mysql-login-system.php did all the work on this.
include '../../phpconfig/config.inc';
$conn = new mysqli($servername, $username, $password, $dbname);
session_start();
 
error_reporting(E_ALL); //LIGHT OF MY LIFE ENABLES DEBUGGING AND ALSO LOVE AND KINDNESS
ini_set('display_errors', 1);

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: loginCustomer.php");
    exit;
}

//userinfo
$currentUserID = $_SESSION["customer_ID"];
$sql = "SELECT first_name, reward_points FROM customer where customer_ID = '$currentUserID'";
$userInfo = $conn->query($sql);
$userInfo = $userInfo->fetch_assoc();

//coupon info
$sql = "SELECT coupon_ID FROM uses WHERE customer_ID = '$currentUserID'";
$couponInfo = $conn->query($sql);

//purchase info
$sql = "SELECT purchase_date, total_cost FROM purchase WHERE customer_ID = '$currentUserID'";
$purchaseInfo = $conn->query($sql);
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

<div id="profileWrapper">

    <h2>Welcome to The Nest, <?php echo $userInfo['first_name'];?>!</h2>

    <div id="coinBalance">NestCoin™ Balance:  
    <?php echo $userInfo['reward_points'];?>
    </div>

    <hr class="profileHR">

    <div id="userInfoWrapper">
    <div id="userCoupons">
    <p class ="userInfoHeader">Available Coupons:</p>
    <?php 
    while($row = $couponInfo->fetch_assoc()) {
        echo "<hr class=\"userInfoHR\"><div class=\"userRow\">";
        $currentCouponID = $row['coupon_ID'];
        $sql = "SELECT reward_point_cost, description FROM coupon WHERE coupon_ID = '$currentCouponID'";
        $currentCouponInfo = $conn->query($sql);
        $currentCouponInfo = $currentCouponInfo->fetch_assoc();;
        echo $currentCouponInfo['description'];
        echo "</div>";
    }
    ?>
    </div>
    <div id="userLine"></div>
    <div id="userOrders">
    <p class ="userInfoHeader">Past orders:</p>

    <?php 
    while($row = $purchaseInfo->fetch_assoc()) {
        echo "<hr class=\"userInfoHR\"><div class=\"userRow\">";
        echo " $".$row['total_cost']." | "; 
        echo $row['purchase_date'];
        echo "</div>";
    }
    ?>

    </div>
    </div>
    <div><input type="button" button id="logoutButton" value="Logout" onclick="location='logoutCustomer.php'" /></div>

</div>


<?php echo $html = file_get_contents('footer.html')?> 


</main>
</body>
</html>