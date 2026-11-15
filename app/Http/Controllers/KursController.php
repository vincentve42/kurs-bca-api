<?php

namespace App\Http\Controllers;

use App\Service\ParsingService;
use Illuminate\Http\Request;

class KursController extends Controller
{
    public function index($currency,  ParsingService $parsingService)
    {
        $data = $parsingService->parse();
        $currency = strtoupper($currency);
        if(!isset($data[$currency]))
        {
            return response()->json("Not Found");
        }
        else
        {
            return response()->json($data[$currency]);
        }
    }
}
