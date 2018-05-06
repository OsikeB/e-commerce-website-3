<?php

function outputHead(){
	echo '<!DOCTYPE html>';
	echo '<html>';
	echo '<head>';
	echo '<meta charset="utf-8">';
	echo '<link href="style/Style.css" rel="stylesheet" type="text/css">';
	echo '<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Raleway">';
	echo '</head>';
}

function outputHeader(){
	echo '<header>';
	echo '<div class="logo">';
	echo '<a href="index.php"><img src="images/logo.png" height="90px" width="120px;"></a>';
	echo '</div>';
	echo '</header>';
}

function outputNav(){
	echo '<nav>';
	echo '<ul>';
    echo '<li><a href="index.php">Shop</a></li>';
    echo '<li><a href="account.php">Account</a></li>';
    echo '<li><a href="basket.php">Basket</a></li>';
	echo '</ul>';
	echo '</nav>';
}
