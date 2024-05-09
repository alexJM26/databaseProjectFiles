<!DOCTYPE php>
<?php
include '../../phpconfig/config.inc';
$conn = new mysqli($servername, $username, $password, $dbname);
$searchQuery = $_GET["q"];
error_reporting(E_ALL); //LIGHT OF MY LIFE ENABLES DEBUGGING AND ALSO LOVE AND KINDNESS
ini_set('display_errors', 1);
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
    <div id="searchWrapper">
		<form>
		<div id="filters">
			<div><h3>Filter by:</h3>
				<div id="activeFilters">
					<!--<div class="activeFilters"><div>Peanut<img src="img/x.svg"></div></div>-->
				</div>
			</div>
			<hr>
			<div><h4>Department</h4>
				<div>Fruit</div>
				<div>Vegetable</div>
				<div>Grain</div>
				<div>Dairy</div>
				<div>Protein</div>
			</div>
			<hr>
			<div><h4>Price Range</h4>
				<div>< $5</div>
				<div>$5 - $10</div>
				<div>$10 - $25</div>
				<div>$25 - $50</div>
				<div>$50 <</div>
				<div id="filterPriceContainer"><form action="/search.php" id="filterPrice" method="get">
					From<input type="text" name="min" placeholder="$0" class="customFilterPriceIn"></input>
					To <input type="text" name="max" placeholder="$100" class="customFilterPriceIn"></input>
					<input type="submit" value="Go" id="filterPriceSubmit"></input>
				</form></div>
			</div>
			<hr>
			<div><h4>In Stock</h4>
				<div>In Stock</div>
				<div>Limited</div>
				<div>Out of Stock</div>
			</div>
			<hr>
			<div><h4>Discount</h4>
				<div>Full Price</div>
				<div>Discounted</div>

			</div>
		</div>
		</form>
		<div id="resultContainer">
			<div id ="searchHeader">
			<?php
			if ($conn->connect_error) {
				echo "<h1>Connection error. Please try again later.</h1>";
			}
			if (!empty($_GET["q"])) { 
				echo "Showing results for \"".$searchQuery."\":";
			}
			?>
			</div>
			<div id="results">
			<?php
			//gets products
			//i'd like to figure out how to use multiple statements and not 1 gargantuan statement... oh well
			$sqlstatement = $conn->prepare("SELECT product.product_ID, product_name, category, aisle_location, price, quantity_in_stock, value, type, review.review_ID FROM product
											LEFT JOIN discount ON discount.product_ID = product.product_ID
											LEFT JOIN review ON review.product_ID = product.product_ID WHERE product.product_name LIKE ?
											ORDER BY product.product_ID"); //prepare the statement
			$toBind = "%".$searchQuery."%"; //concatenation is dots in php. on a related note i am turning into a tormented fish
			$sqlstatement->bind_param("s", $toBind);  //put real query into prepared statement
			if ($searchQuery == "") {
				$sqlstatement = $conn->prepare("SELECT product.product_ID, product_name, category, aisle_location, price, quantity_in_stock, value, type, review.review_ID FROM product
												LEFT JOIN discount ON discount.product_ID = product.product_ID
												LEFT JOIN review ON review.product_ID = product.product_ID
												ORDER BY product.product_ID"); //if no search, return all
			}
			$sqlstatement->execute(); //execute the query
			$result = $sqlstatement->get_result(); //return the results
			$sqlstatement->close();

			//gets discounts
			//$sqlstatement = "SELECT product.product_ID, type, value, product_name, category, aisle_location, price, quantity_in_stock FROM discount RIGHT JOIN product ON discount.product_ID = product.product_ID";
			//$result = $conn->query($sqlstatement); //doesn't need validation since not interacting w/ input
			while($row = $result->fetch_assoc()) { //fetch_assoc gets next row
			


				echo "<div class=\"resultBox\" onclick=\"review()\">";
				//ok don't tell anybody but i am realizing right now that multiple reviews will not show for a product
				//if there are, it makes multiple product boxes appear. oh well. one review per item this is life
				echo "<div class=\"reviewBox\">Showing reviews:";
				if($row["review_ID"] != null) {
					$currentReviewID = $row["review_ID"];
					$sql = "SELECT star_rating, text, submission_date FROM review where review_ID = '$currentReviewID'";
					$reviewInfo = $conn->query($sql);
					$reviewInfo = $reviewInfo->fetch_assoc();
					echo "<div class=\"reviewHeader\">";
					echo "<div class=\"reviewName\">";
					echo $row["product_name"];
					echo "</div><div class=\"reviewDate\">";
					echo $reviewInfo["submission_date"];
					echo "</div></div>";
					echo "<hr class=\"reviewHR\"><div class=\"reviewBody\"><star>";
					for ($i = 0; $i < $reviewInfo["star_rating"]; $i++) {echo "★";}
					for ($i = 0; $i < 5 - $reviewInfo["star_rating"]; $i++) {echo "☆";}
					echo "  </star>";
					echo $reviewInfo["text"];
					echo "</div>";
				}
				else {
					echo "<div class=\"reviewHeader\">No reviews for this product!</div>";
				}
				echo "</div>";

				echo "<p class=\"resultName\">".$row["product_name"]."</p>"; //product name
				
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
					if ($row["quantity_in_stock"] <= 20) {
						echo "</p><p class=\"resultLimited\">Only ".$row["quantity_in_stock"]." left!"; //less than 10 gets a special warning
					}
				}
				else {
					echo "Out of Stock!";
				}
				echo "</p></div>";
				echo "</div>";
			}	
			
			?>
			</div>
		</div>
	</div>
	<?php echo $html = file_get_contents('footer.html')?>
	
</main>


</body>
<script src="review.js"></script>
<script src="search.js"></script>
</html>