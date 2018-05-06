//Globals#
window.onload = loadBasket;

//Displays basket in page.
function loadBasket(){
    //Get basket from local storage or create one if it does not exist
    var basketArray;
    if(sessionStorage.basket === undefined || sessionStorage.basket === ""){
        basketArray = [];
    }
    else {
        basketArray = JSON.parse(sessionStorage.basket);
    }
    
    //Build string with basket HTML
  	
    var htmlStr = "<form action='checkout.php' class='form' style='margin:0px;' method='post'>";
    var prodNames = [];
	var prodIDs = [];
	var total = 0;
    for(var i=0; i<basketArray.length; ++i){
		htmlStr += "<div class=" + "product" + ">";
		htmlStr += "<div class=" + "productsinfo" + ">";
        htmlStr += basketArray[i].name;
		htmlStr += "</div>";
		htmlStr += "<div class=" + "productsinfo" + ">";
		htmlStr += "£" + basketArray[i].price;
		htmlStr += "</div>";
        prodNames.push(basketArray[i].name);//Add to product array
		prodIDs.push({id: basketArray[i].id, count: 1});//Add to product array
		total = total + parseInt(basketArray[i].price);
		
		
    }
    //Add hidden field to form that contains stringified version of product ids and a hidden form field with total price
    htmlStr += "<input type='hidden' name='prodNames' value='" + JSON.stringify(prodNames) + "'>";
	htmlStr += "<input type='hidden' name='prodIDs' value='" + JSON.stringify(prodIDs) + "'>";
	htmlStr += "<input type='hidden' name='tPrice' value='" + total + "'>";
    
    //Add checkout and empty basket buttons and show total price
	

	htmlStr += "<div id=" + "total" + ">";
	htmlStr += "<div style=" + "'float: left'" + ">Total:</div>";
 	htmlStr += "<div style=" + "'float: right'" + "> £" + total + "</div>";
    htmlStr += "<input type='submit' value='Checkout'></form>";
    htmlStr += "<br><button onclick='emptyBasket()'>Empty Basket</button>";
    
    //Display nubmer of products in basket
    document.getElementById("basketDiv").innerHTML = htmlStr;
}

//Adds an item to the basket
function addToBasket(prodID, prodName, prodPrice){
    //Get basket from local storage or create one if it does not exist
    var basketArray;
    if(sessionStorage.basket === undefined || sessionStorage.basket === ""){
        basketArray = [];
    }
    else {
        basketArray = JSON.parse(sessionStorage.basket);
    }
    
    //Add product to basket
    basketArray.push({id: prodID, name: prodName, price: prodPrice});
    
    //Store in local storage
    sessionStorage.basket = JSON.stringify(basketArray);
    
    //Display basket in page.
    loadBasket();      
}

//Deletes all products from basket
function emptyBasket(){
    sessionStorage.clear();
    loadBasket();
}
