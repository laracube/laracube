<?php

use Illuminate\Support\Facades\Route;

Route::post('/report/{uriKey}', 'ReportController@index');
Route::post('/run/resource/{uriKey}', 'RunResourceController@index');
Route::post('/run/filter/{uriKey}', 'RunFilterController@index');
