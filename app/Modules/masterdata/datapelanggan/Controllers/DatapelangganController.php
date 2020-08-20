<?php namespace App\Modules\masterdata\datapelanggan\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\masterdata\datapelanggan\Models\DatapelangganModel;
use Input,View, Request, Form, File;

/**
* Datapelanggan Controller
* @var Datapelanggan
* Generate from Custom Laravel 5.1 by Aa Gun. 
*
* Developed by Divisi Software Development - Dinustek. 
* Please write log when you do some modification, don't change anything unless you know what you do
* Semarang, 2016
*/

class DatapelangganController extends Controller {
    protected $datapelanggan;

    public function __construct(DatapelangganModel $datapelanggan){
        $this->datapelanggan = $datapelanggan;
    }

        public function getIndex(){
        cekAjax();
        if (Input::has('search')) {
            if(strlen(Input::has('search')) > 0){
                $datapelanggans = $this->datapelanggan
                			->orWhere('no_plg', 'LIKE', '%'.Input::get('search').'%')
			->orWhere('nama_plg', 'LIKE', '%'.Input::get('search').'%')
			->orWhere('alamat', 'LIKE', '%'.Input::get('search').'%')
			->orWhere('no_telp', 'LIKE', '%'.Input::get('search').'%')

                ->paginate($_ENV['configurations']['list-limit']);
            }else{
                $datapelanggans = $this->datapelanggan->all();
            }
        }else{
            $datapelanggans = $this->datapelanggan->all();
        }
        return View::make('datapelanggan::index', compact('datapelanggans'));
    }


        public function getCreate(){
        cekAjax();
        return View::make('datapelanggan::create');
    }

    public function postCreate(){
        cekAjax();
        $input = Input::all();
        $validation = \Validator::make($input, DatapelangganModel::$rules);
        if ($validation->passes()){
            $input['user_id'] = \Session::get('user_id');
            $input['role_id'] = \Session::get('role_id');
            echo ($this->datapelanggan->create($input))?1:"Gagal Disimpan";
        }
        else{
            echo 'Input tidak valid';
        }
    }



    //{controller-show}

        public function getEdit($id = false){
        cekAjax();
        $id = ($id == false)?Input::get('id'):'';
        $datapelanggan = $this->datapelanggan->find($id);
        //if (is_null($datapelanggan)){return \Redirect::to('masterdata/datapelanggan/index');}
        return View::make('datapelanggan::edit', compact('datapelanggan'));
    }
    
    public function postEdit(){
        cekAjax();
        $id = Input::get('id');
        $input = Input::all();
        $validation = \Validator::make($input, DatapelangganModel::$rules);
        
        if ($validation->passes()){
            $datapelanggan = $this->datapelanggan->find($id);
            echo ($datapelanggan->update($input))?4:"Gagal Disimpan";
        }
        else{
            echo 'Input tidak valid';
        }
    }


	
        public function postDelete(){
        cekAjax();
        $ids = Input::get('id');
        if (is_array($ids)){
            foreach($ids as $id){
                $this->datapelanggan->find($id)->delete();
            }
            echo 'Data berhasil dihapus';
        }
        else{
            echo ($this->datapelanggan->find($ids)->delete())?9:'Gagal Dihapus';
        }
    }

}
