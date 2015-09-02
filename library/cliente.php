<?php

	require_once("nusoap/lib/nusoap.php");
	$wsdl = "http://".IP_WS."/wsPhpBibliotecaFup/server.php?wsdl";
	$client = new nusoap_client($wsdl, 'wsdl');

	$client->soap_defencoding = 'UTF-8';
	$client->decode_utf8 = false;
	
	//////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////

?>