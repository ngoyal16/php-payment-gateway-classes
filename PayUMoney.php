<?php
class PayUMoney {
	private $merchant_key = "gtKFFx";
	private $salt = "eCwWELxi";
	private $env = "test";
	private $hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
	public function __construct($config = array()){
		$this->env = isset($config['env']) ? $config['env'] : 'test';
		$this->merchant_key = isset($config['merchant_key']) ? $config['merchant_key'] : 'gtKFFx';
		$this->salt = isset($config['salt']) ? $config['salt'] : 'eCwWELxi';
	}

	public function getURL(){
		return (($this->env == 'live') ? 'https://secure.payu.in' : 'https://test.payu.in') . '/_payment';
	}
	public function generateHash($data = array()){
		$hashVarsSeq = explode('|', $this->hashSequence);
		$hash_string = '';
		foreach($hashVarsSeq as $hash_var){
			$hash_string .= isset($data[$hash_var]) ? $data[$hash_var] : '';
			$hash_string .= '|';
		}
		$hash_string .= $this->salt;
		return strtolower(hash('sha512', $hash_string));
	}	

	public function validateTransaction($data = array()){
		$status = $data["status"];
		$email = $data["email"];
		$firstname = $data["firstname"];
		$productinfo = $data["productinfo"];
		$amount = $data["amount"];
		$txnid = $data["txnid"];
		$key = $data["key"];
		$posted_hash = $data["hash"];
		$retHashSeq = (isset($data["additionalCharges"])) ? "{$data['additionalCharges']}|" : '';
		$retHashSeq .= $this->salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
		return (hash("sha512", $retHashSeq) == $posted_hash) ? true : false;

	}
}

?>