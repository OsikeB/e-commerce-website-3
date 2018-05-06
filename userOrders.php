<?php
	include('common.php');
	outputHead();
?>

<body>

<div class="container">

<?php
	outputHeader();
?>

<?php
	outputNav();
?>

<?php
//Start session management
    session_start();
	
//Connect to MongoDB
$mongoClient = new MongoClient();

//Select a database
$db = $mongoClient->phoneDB;

echo $_SESSION['loggedInUserEmail'] ;

//Search using logged in email
$findCriteria = [
'custEmail' => $_SESSION['loggedInUserEmail'] 
 ];

//Find order
$cursor = $db->Orders->find($findCriteria);

//Output the results as forms
echo "<h1>Past Orders</h1>";   
foreach ($cursor as $document){
    echo '<div id="order">';

				echo '<div class="orderdetail">' . $document["_id"] . '</div>';
				echo '<div class="orderdetail">' . $document["date"] . '</div>';
				
				echo '<div class="orderdetail">' . $document["custEmail"] . '</div>';
				echo '<div class="orderdetail">' . implode("<br>", $document["productNames"]) . '</div>';
				echo '<div class="orderdetail">£' . $document["totalPrice"] . '</div>';

				echo '</div>';
}

//Close the connection
$mongoClient->close();
?>

<footer>Copyright &copy; iShop</footer>
</div>
</body>
</html>