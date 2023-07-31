<?php

namespace App\helpers;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use DB;

class Helper 
{
    public static function dateThai($date)
    {
        return date('d/m/Y, H:i',strtotime($date));
    }
}