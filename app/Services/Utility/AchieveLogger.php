<?php
namespace App\Services\Utility;

use App\Services\Utility\Logger;
use Illuminate\Support\Facades\Log;

class AchieveLogger implements Logger
{
    public static function debug($message, $data=array())
    {
        Log::debug($message . (count($data) . ($data != 0) ? ' with data of ' . print_r($data, true) : ""));
    }

    public static function getLogger()
    {
        
    }
    

    public static function warning($message, $data=array())
    {
        Log::warning($message . (count($data). ($data != 0) ? ' with data of ' . print_r($data, true) : ""));
    }

    public static function error($message, $data=array())
    {
        Log::error($message . (count($data) . ($data != 0) ? ' with data of ' . print_r($data, true) : ""));
    }

    public static function info($message, $data=array())
    {
        Log::info($message . (count($data) . ($data != 0) ? ' with data of ' . print_r($data, true) : ""));
    }

    
}

