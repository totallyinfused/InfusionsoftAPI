<?php


require_once("old-source/src/isdk.php");

$app = new iSDK;

if ($app->cfgCon("lo233")) {
    $contactId = (int)$_POST["contactId"];
    $description = (string)$_POST["description"];
    $productId = (int)$_POST['productId'];
    $type = (int)$_POST['type'];
    $price = (double)$_POST['price'];
    $quantity = (int)$_POST['quantity'];
    $curDate = date('d-m-Y');
    $curDate = $app->infuDate($curDate);
    echo "retrieved info<br/>";
    echo "Contact: $contactId; Description: $description; ProductID: $productId; Type: $type; Price: $price; Quantity: $quantity; Date: $curDate;";
    
	// Create Blank Order
	$invoiceId = $app->blankOrder($contactId,$description, $curDate, 0, 0);
	$invoiceId = (int)$invoiceId;
		echo "Invoice Made $invoiceId<br/>";
	// Add Item to Order	
	$result = $app->addOrderItem($invoiceId, $productId, $type, $price, $quantity, $description, $description);
	echo "Item Added<br/>";
	// Mark Item as Paid
	$result = $app->manualPmt($invoiceId,$price,$curDate,"Paid by Stripe","Stripe Payment via Clickfunnels",false);
	echo "Marked As Paid<br/>";
    
} else {
    echo "connection failed";
}


?>
