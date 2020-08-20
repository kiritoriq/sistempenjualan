<?php namespace App\Modules\masterdata\datastok\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\masterdata\datastok\Models\DatastokModel;
use Input,View, Request, Form, File;

/**
* Datastok Controller
* @var Datastok
* Generate from Custom Laravel 5.1 by Aa Gun. 
*
* Developed by Divisi Software Development - Dinustek. 
* Please write log when you do some modification, don't change anything unless you know what you do
* Semarang, 2016
*/

class DatastokController extends Controller {
    protected $datastok;

    public function __construct(DatastokModel $datastok){
        $this->datastok = $datastok;
    }

        public function getIndex(){
        cekAjax();
        if (Input::has('search')) {
            if(strlen(Input::has('search')) > 0){
                $datastoks = $this->datastok
                			->orWhere('kd_brg', 'LIKE', '%'.Input::get('search').'%')
			->orWhere('jml_stok', 'LIKE', '%'.Input::get('search').'%')
			->orWhere('hrg_satuan', 'LIKE', '%'.Input::get('search').'%')
			->orWhere('hrg_jual_satuan', 'LIKE', '%'.Input::get('search').'%')

                ->paginate($_ENV['configurations']['list-limit']);
            }else{
                $datastoks = $this->datastok->all();
            }
        }else{
            $datastoks = $this->datastok->all();
        }
        return View::make('datastok::index', compact('datastoks'));
    }


    

    //{controller-show}

    
	
    
}
