<?php

Route::group(['middleware' => 'auth'], function(){

Route::controller('/laporan/laporanpenjualan', 'App\Modules\laporan\laporanpenjualan\Controllers\LaporanpenjualanController');

});