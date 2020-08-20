<?php

Route::group(['middleware' => 'auth'], function(){

Route::controller('/masterdata/datastok', 'App\Modules\masterdata\datastok\Controllers\DatastokController');

});