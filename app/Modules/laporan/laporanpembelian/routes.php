<?php

Route::group(['middleware' => 'auth'], function(){

Route::controller('/laporan/laporanpembelian', 'App\Modules\laporan\laporanpembelian\Controllers\LaporanpembelianController');

});