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
'email' => $_SESSION['loggedInUserEmail'] 
 ];

//Find user
$cursor = $db->Users->find($findCriteria);

//Output the results as forms
echo "<h1>Edit User</h1>";   
foreach ($cursor as $cust){
    echo '<form class="form" action="saveUser.php" method="post">';
    echo 'Name: <input type="text" name="name" value="' . $cust['name'] . '" required><br>';
	echo 'email: <input type="text" name="email" value="' . $cust['email'] . '" required><br>';
    echo 'Password: <input type="password" name="password" value="' . $cust['password'] . '" required><br>';
    echo 'Postcode: <input type="text" name="postcode" value="' . $cust['postcode']	. '" required><br>';
	echo 'Contact: <input type="text" name="contact" value="' . $cust['contact'] . '" required><br>';
    echo '<input type="hidden" name="id" value="' . $cust['_id'] . '" required>'; 
    echo '<input type="submit">';
    echo '</form><br>';
}

//Close the connection
$mongoClient->close();
?>

<footer>Copyright &copy; iShop</footer>
</div>
</body>
</html>