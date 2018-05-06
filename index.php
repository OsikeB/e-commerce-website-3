<?php
	include('common.php');
	outputHead();
?>
<script src="basket.js"></script>
<body>

<div class="container">

<?php
	outputHeader();
?>

<?php
	outputNav();
?>

<article>
	<h1>Shop</h1>
	<br>
	<br>
	<script src="cusrecom.js">
                </script>
	<form action="search.php" method="get" onsubmit="return search()">
            Find product: <input type="text" name="name" id="SearchBar" required>
            <input type="submit">           
        </form>
		
		<script>
            
            //Create recommender object - it loads its state from local storage
            var recommender = new Recommender();
            
            //Display recommendation
            window.onload = showRecommendation;
            
            //Searches for products in database
            function search(){
                //Extract the search text
                var searchText = document.getElementById("SearchBar").value;
                
                //Add the search keyword to the recommender
                recommender.addKeyword(searchText);
                showRecommendation();
                
                //#FIXME# PERFORM SEARCH FOR PRODUCTS
                //return false;
            }


            
            //Display the recommendation in the document
            function showRecommendation(){
                
                console.log("top keyword: " + recommender.getTopKeyword());


                var xmlRequest = new XMLHttpRequest();
                    xmlRequest.onload = function(){
                    
                     if(xmlRequest.status === 200){

                       var prodObject = xmlRequest.responseText;
                         
                         console.log(prodObject);
                       var htmlStr = "";

                       htmlStr += "<p>" + prodObject + "</p>";

                       document.getElementById("test").innerHTML = htmlStr;
                     
                     
                     }

                }

                xmlRequest.open("POST", "find_products.php", false);
                xmlRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xmlRequest.send("name=" + recommender.getTopKeyword());
                
            }
            </script>
  
  
  
  <?php

        //Connect to MongoDB and select database
        $mongoClient = new MongoClient();
        $db = $mongoClient->phoneDB;
        
        //Find all products
        $phones = $db->Phones->find();

        //Output results onto page
        if($phones->count() > 0){
            
            
            foreach ($phones as $document) {
                echo '<div class="items">';
				echo '<div class="item">';
				echo '<div class="itemimage">';
				echo '<img src="images/' . $document["image"] . '"' .  'height="137px" width="270px;">';
				echo '</div>';
				echo '<div class="itemdesc">';
				
                echo $document["name"] . " - " . "£" . $document["price"] ;
				echo '</div>';
				echo '<div class="addto">';
				echo '<a href="#" onclick=\'addToBasket("' . $document["_id"] . '", "' . $document["name"] . '", "' . $document["price"] . '");\'>ADD TO BASKET</a>';
				echo '</div>';
				echo '</div>';
				echo '</div>';	
              
            }
            
        }

        //Close the connection
        $mongoClient->close();

        ?>

  <div id="test">
            </div> 
  	
</article>

<footer>Copyright &copy; iShop</footer>



</div>

</body>
</html>
