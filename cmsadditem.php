<?php
//Connect to database
$mongoClient = new MongoClient();

//Select a database
$db = $mongoClient->phoneDB;

//Select a collection 
$collection = $db->Phones;

//Extract the data that was sent to the server
$name= filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
$price = filter_input(INPUT_POST, 'price', FILTER_SANITIZE_STRING);
$stock = filter_input(INPUT_POST, 'stock', FILTER_SANITIZE_STRING);
$key = filter_input(INPUT_POST, 'key', FILTER_SANITIZE_STRING);

//Check file data has been sent
    if(!array_key_exists("imageToUpload", $_FILES)){
        echo 'File missing.';
        return;
    }
    if($_FILES["imageToUpload"]["name"] == "" || $_FILES["imageToUpload"]["name"] == null){
        echo 'File missing.';
        return;
    }
    $uploadFileName = $_FILES["imageToUpload"]["name"];

	/*  Check if image file is a actual image or fake image
        tmp_name is the temporary path to the uploaded file. */
    if(getimagesize($_FILES["imageToUpload"]["tmp_name"]) === false) {
        echo "File is not an image.";
        return;
    }
	
	// Check that the file is the correct type
    $imageFileType = pathinfo($uploadFileName, PATHINFO_EXTENSION);
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        return;
    }
    
    //Specify where file will be stored
    $target_file = 'images/' . $uploadFileName;

	/* Files are uploaded to a temporary location. 
        Need to move file to the location that was set earlier in the script */
    if (move_uploaded_file($_FILES["imageToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["imageToUpload"]["name"]). " has been uploaded.";
        echo '<p>Uploaded image: <img src="' . $target_file . '"></p>';//Include uploaded image on page
    } 
    else {
        echo "Sorry, there was an error uploading your file.";
    }


	

//Convert to PHP array
$dataArray = [
    "name" => $name, 
    "price" => $price, 
    "stock" => floatval($stock),
	"image" => $uploadFileName, 
    "key" => $key
 ];
 
//Add the new product to the database
$returnVal = $collection->insert($dataArray);

//Echo result back to user
if($returnVal['ok']==1){
    header("Location: cmsedit.php");
	
	//Makes sure code doesnt run when redirected
	exit;
}
else {
    echo 'Error adding item';
}

//Close the connection
$mongoClient->close();