<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

$merchant_key = 'gtKFFx';
$salt         = 'eCwWELxi';
include('PayUMoney.php');
$payUMoney = new PayUMoney(array(
	'merchant_key' => $merchant_key,
	'salt' => $salt,
	'env' => 'test'
));


if($payUMoney->validateTransaction($_POST)){
	echo "<h3>Thank You. Your order status is {$_POST['status']}.</h3>";
	echo "<h4>Your Transaction ID for this transaction is {$_POST['txnid']}.</h4>";
	echo "<h4>We have received a payment of Rs. {$_POST['amount']}. Your order will soon be shipped.</h4>";
} else {
	echo "Invalid Transaction. Please try again";
} 
?>