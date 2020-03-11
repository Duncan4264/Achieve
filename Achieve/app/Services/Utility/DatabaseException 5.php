<?php
// Cyrus Duncan
// CST - 256
// This is my own work
namespace App\Services\Utility;

use Exception;



class DatabaseException  extends Exception
{
    // Constructor that iniizalises the parametors provided by exteding Exception class
    public function __construct($message, $code = 0, Exception $previous = null)
    {
        // Call super class
        parent:: construct($message, $code, $previous);
    }
}

