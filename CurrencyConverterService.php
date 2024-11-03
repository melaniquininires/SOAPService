<?php

class CurrencyConverterService {

    /*
      Obtengo la tasa de cambio actual de una API externa.
     
     */
    private function getExchangeRate() {
        // URL de la API 
        $url = 'https://api.exchangerate-api.com/v4/latest/USD';
        
        // la respuesta de la API
        $response = file_get_contents($url);

        if ($response) {
            $data = json_decode($response, true);
            return $data['rates']['ARS']; // Retorna el valor en ARS
        } else {
            throw new Exception("No se pudo obtener el tipo de cambio.");
        }
    }

    /*
     Convierto una cantidad de dólares a pesos.
     */
    public function convertToPesos($amount) {
        $exchangeRate = $this->getExchangeRate(); // Obtiene el valor actual del dólar
        return $amount * $exchangeRate;
    }
}

// Configuración del servidor SOAP
$options = ['uri' => 'http://localhost:8001/soap_service'];
$server = new SoapServer(null, $options);
$server->setClass('CurrencyConverterService');
$server->handle();






/*
//aca habia probado hacer el soap con un monto fijo 
class CurrencyConverterService {
    private $exchangeRate;

    public function __construct() {
        // Aca defino una tasa fija de ejemplo 
        $this->exchangeRate = 1022; // Hoy $1 USD = 1022 ARS
    }


    public function convertToPesos($amount) {
        return $amount * $this->exchangeRate;
    }
}

// Configuración del servidor SOAP
$options = ['uri' => 'http://localhost:8001/soap_service'];
$server = new SoapServer(null, $options);
$server->setClass('CurrencyConverterService');
$server->handle();
*/