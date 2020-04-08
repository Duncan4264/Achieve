<?php
namespace App\Services\Utility;

use App\Services\Utility\AchieveLoggerService;
use Illuminate\Support\Facades\Log;

class AchievementLogger implements AchieveLoggerService
{
    public function debug($message, $data=array())
    {
        Log::debug($message . (count($data) . ($data != 0) ? ' with data of ' . print_r($data, true) : ""));
    }
    public function warning($message, $data=array())
    {
        Log::warning($message . (count($data). ($data != 0) ? ' with data of ' . print_r($data, true) : ""));
    }

    public function error($message, $data=array())
    {
        Log::error($message . (count($data) . ($data != 0) ? ' with data of ' . print_r($data, true) : ""));
    }

    public function info($message, $data=array())
    {
        Log::info($message . (count($data) . ($data != 0) ? ' with data of ' . print_r($data, true) : ""));
    }

    
}

