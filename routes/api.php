<?php

use Illuminate\Support\Facades\Route;

Route::get('/report/{uriKey}', 'ReportController@index');
Route::get('/run/resource/{uriKey}', 'RunResourceController@index');
