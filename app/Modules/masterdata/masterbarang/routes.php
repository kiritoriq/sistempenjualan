<?php

Route::group(['middleware' => 'auth'], function(){

Route::controller('/masterdata/masterbarang', 'App\Modules\masterdata\masterbarang\Controllers\MasterbarangController');

});