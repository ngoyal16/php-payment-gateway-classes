<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

$merchant_key = 'gtKFFx';
$salt         = 'eCwWELxi';
echo 1;exit();
include('PayUMoney.php');
$payUMoney = new PayUMoney(array(
	'merchant_key' => $merchant_key,
	'salt' => $salt,
	'env' => 'test'
));

if($payUMoney->validateTransaction($_POST)){
    echo "<h3>Your order status is {$_POST['status']}.</h3>";
    echo "<h4>Your transaction id for this transaction is {$_POST['txnid']}. You may try making the payment by clicking the link below.</h4>";
} else {
	echo "Invalid Transaction. Please try again";
}
?>