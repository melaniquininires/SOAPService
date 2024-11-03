<?php
// CurrencyConverterService.php

class CurrencyConverterService {
    private $exchangeRate;

    public function __construct() {
        // Aca defino una tasa fija de ejemplo 
        $this->exchangeRate = 1170; // Hoy $1 USD = 1170 ARS
    }

    /**
     * Convierto una cantidad de dólares a pesos.
     * @param float $amount Monto en dólares.
     * @return float Monto convertido en pesos.
     */
    public function convertToPesos($amount) {
        return $amount * $this->exchangeRate;
    }
}

// Configuración del servidor SOAP
$options = ['uri' => 'http://localhost:8001/soap_service'];
$server = new SoapServer(null, $options);
$server->setClass('CurrencyConverterService');
$server->handle();
