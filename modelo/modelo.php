<?php

ini_set("soap.wsdl_cache_enabled",0);
ini_set('soap.wsdl_cache_ttl',0);

class Conexion{


  private $cliente;

  public function conectar()
  {
      $this->cliente = new SoapClient("https://test.placetopay.com/soap/pse/?wsdl",array('exceptions' => 0));

      $obj = $this->cliente->__getFunctions();

      $seed = (string)date('c');
      $hashString = sha1($seed.'024h1IlD', false);

      $response = $this->cliente->__soapCall('getBankList', array(
        'login'=> "6dd490faf9cb87a9862245da41170ff2",
        'tranKey'=> $hashString,
        'seed'=> $seed
      ));

      if (is_soap_fault($response)) {
          trigger_error("SOAP Fault: (faultcode: {$response->faultcode}, faultstring: {$response->faultstring})", E_USER_ERROR);
      } 

   }

}

      