<?php

Route::group(['middleware' => 'auth'], function(){

Route::controller('/masterdata/transaksi', 'App\Modules\masterdata\transaksi\Controllers\TransaksiController');

});