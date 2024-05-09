<!--TODO:
context nav to signup/signin when you mess w the nest, see your page, etc
if we really feel like getting crazy get a pfp thing up and running. db extension shouldnt be too hard
depts should just return search with their department. if we have time we can make them custom pages but we wont so
our story page. idk i'll make some stuff up
make the search results page good god what is wrong with you
link all the bars + buttons to their actual things
-->

<!DOCTYPE html> <!--this shouldn't be here but if i get rid of it, it explodes my padding. and i like my padding-->

<?php
include '../../phpconfig/config.inc';
?>

<html lang="en-US">
<head>
	<link rel="stylesheet" href="style.css" type="text/css">
	<link rel="icon" href="squid.png" type="image/x-icon">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
	<title>Large Toucan</title>
</head>
<body>
<main>
<?php echo $html = file_get_contents('header.html')?>
	<div id="deptNav">
		<div><a href="search.php">Fruit</a></div>
		<div><a href="search.php">Vegetable</a></div>
		<div><a href="search.php">Grain</a></div>
		<div><a href="search.php">Dairy</a></div>
		<div><a href="search.php">Protein</a></div>
	</div>
	<div id="splash">
	<div id="splashGradient">
		<div id="splashContent">
			<p>We're not just Food Guys.<br>We're Family Guys.</p>
			<a href="search.php">Explore ➤</a>
		</div>
		</div>
	</div>
	<div id="deals">
		<div id="dailyDealsHeader">
			<div>Daily Deals</div>
			<div id="dealsViewAll"><a href="search.php?d=true">View all ➤</a></div>
		</div>
		<hr id ="dealsSeperator">
		<div id="dealsContainer">


		<?php
		// Create connection

		$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($conn->connect_error) { //if there is a connection error so be it. congrats the only deal is peanut
									//this is terrible for a grocery store, but for a fake project, ensures there's SOMETHING. also i think it is funny. in the old format because it is not worth my time to update the peanut bit
			for ($i = 0; $i < 10; $i++) {
				echo "<div class=\"dealBox\">
				<a href=\"search.php\">
				<div class=\"dealPic\"><img src=\"img/peanut.jpg\"></div>
				<hr>
				<div class=\"dealItemName\">peanuts</div>
				<div class=\"dealPrice\">$1.99 <s>$2.00</s></div>
				</a>
				</div>";
			}
		}
		else { //you're not seeing reviews on here. i don't care. i couldn't make it modular and i'm not doing it now
			$sqlstatement = "SELECT product.product_ID, type, value, product_name, category, aisle_location, price, quantity_in_stock FROM discount JOIN product ON discount.product_ID = product.product_ID";
			$result = $conn->query($sqlstatement); //doesn't need validation since not interacting w/ input

			while($row = $result->fetch_assoc()) { //fetch_assoc gets next row
				echo "<div class=\"resultBox\"><p class=\"resultName\">".$row["product_name"]."</p>"; //product name
				echo "<p class=\"resultLocation\">".$row["category"]." | Aisle ".$row["aisle_location"]."</p>"; //location

				$newPrice = null; //discount handler
					if($row["type"] == "new_value") {
						$newPrice = $row["value"];
					}
					else if($row["type"] == "percent_off"){
						$newPrice = number_format(round(
													   ($row["price"] - ($row["value"] * $row["price"])) //og price - (-changeinprice * og price)
													    , 2),
									              2, '.', ''); //if anyone can figure out a better way to ensure prices are x.xx let me know. i hate this
				}
				//display price
				if ($newPrice == null) {
					echo "<p class=\"resultPrice\">$".$row["price"]."</p>"; //not discounted
				}
				else {
					echo "<p class=\"resultPrice\">$".$newPrice." <s>$".$row["price"]."</s></p>"; //discounted
				}
				

				echo "<hr><div class=\"resultStock\"><p>"; //stock
				if ($row["quantity_in_stock"] > 0) {
					echo "In Stock";
					if ($row["quantity_in_stock"] < 20) {
						echo "</p><p class=\"resultLimited\">Only ".$row["quantity_in_stock"]." left!"; //less than 10 gets a special warning
					}
				}
				else {
					echo "Out of Stock!";
				}
				echo "</p></div></div>";
			}	
		}

		$conn->close();
		?>
	</div>
	</div>
	<?php echo $html = file_get_contents('footer.html')?>
</main>
</body>
</html>

<!--
Resources:
	google fonts: https://fonts.google.com/
	fontawesome: https://fontawesome.com/
	stupid bird im using as a pfp: https://unsplash.com/@andreusphoto/
	filter to convert svg colors: https://codepen.io/sosuke/pen/Pjoqqp/
-->