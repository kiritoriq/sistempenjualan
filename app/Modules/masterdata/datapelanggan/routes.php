<?php

Route::group(['middleware' => 'auth'], function(){

Route::controller('/masterdata/datapelanggan', 'App\Modules\masterdata\datapelanggan\Controllers\DatapelangganController');

});