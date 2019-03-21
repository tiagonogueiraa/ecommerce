<?php 

function formatPrice(float $vlprice)
{
	// primeiro separado , e o outro .
	return number_format($vlprice, 2, ",", ".");
}


 ?>