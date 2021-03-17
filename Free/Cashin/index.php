<?php

//require_once 'cashin.php';

$request_method = $_SERVER["REQUEST_METHOD"];

	function PostCashin()
	{
		$url_cashin = 'https://gateway.free.sn/Live/Cashin';


		$input = json_decode(file_get_contents("php://input"));

		$data= array('amount'=>$input->amount,'currency'=>'XOF', 'agentmsisdn'=>'221761851129','customermsisdn'=>$input->customermsisdn,'username'=>'Marchand_651','password'=>'4674');
	

		$data = json_encode($data, JSON_PRETTY_PRINT);
	
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url_cashin);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Accept:application/json'));
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS,$data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$response  = curl_exec($ch);
		curl_close($ch); 
	
		if(!$response){	
			header('Content-Type: application/json');
			echo $response;	
		}
		
		header('Content-Type: application/json');
		echo $response;

	}
	
	switch($request_method)
	{
		
	
		
			
		case 'POST':
			// Ajouter un produit
			PostCashin();
			break;
		default:
			// Invalid Request Method
			header("HTTP/1.0 405 Method Not Allowed");
			break;

	}

?>