<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

function apiResponse($status = true, $message = "Success", $data = [], $extra = null, $pagination = null, $errors = [], $responseStatus = 200)
{
    $json['status'] = $status;
    $json['message'] = $message;
    $json['data'] = (object) $data;
    if ($extra) {
        $json['extra'] = [];
        foreach ($extra as $key => $value) {
            $json['extra'][$key] = $value;
        }
    }
    if ($pagination) {
        $json['pagination'] = $pagination;
    }
    $json['errors'] = (object) $errors;
    return response()->json($json, $responseStatus, [], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
}

function adminResponse($route, $message = 'Message', $type = 'success')
{
    return redirect($route)->with([
        'alert-message' => __($message),
        'alert-type' => __($type),
    ]);
}

function generateUniqueCode($model, $column, $length = 10)
{
    $columnArr = $model::pluck($column)->toArray();
    $code = Str::upper(Str::random($length));
    if (in_array($code, $columnArr)) {
        generateUniqueCode($model, $column, $length);
    }
    return $code;
}

function dateFormat($date)
{
    return Carbon::parse($date)->format(LaravelLocalization::getCurrentLocale() == 'ar' ? 'Y/m/d' : 'd/m/Y');
}

function dateTimeFormat($date)
{
    return [
        'date' => Carbon::parse($date)->format(LaravelLocalization::getCurrentLocale() == 'ar' ? 'Y/m/d' : 'd/m/Y'),
        'time' => Carbon::parse($date)->translatedFormat('H:i A'),
    ];
}

function dateTableFormat($date, $spector = '<br />', $checkTime = true, $checkHuman = false)
{
    $_day = Carbon::parse($date)->translatedFormat('l');
    $_month = Carbon::parse($date)->translatedFormat(LaravelLocalization::getCurrentLocale() == 'ar' ? 'Y/m/d' : 'd/m/Y');
    $_time = Carbon::parse($date)->translatedFormat('h:i:s A');
    $_humanTime = $checkHuman ? $date->diffForHumans() : '';
    return $_day . $spector . $_month . ($checkTime ? $spector . $_time : '') . ($checkHuman ? $spector . $_humanTime : '');
}

function checkActive($url)
{
    return Route::currentRouteNamed($url);
}

function checkActiveMulti($urlArray)
{
    foreach ($urlArray as $url) {
        if (checkActive($url)) {
            return true;
        }
    }

    return false;
}

function arrayCheck($array)
{
    foreach ($array as $key => $singleArray) {
        if (is_array($singleArray)) {
            return true;
        }
    }

    return false;
}
