<?php namespace App\Modules\masterdata\masterbarang\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\masterdata\masterbarang\Models\MasterbarangModel;
use Input,View, Request, Form, File;

/**
* Masterbarang Controller
* @var Masterbarang
* Generate from Custom Laravel 5.1 by Aa Gun. 
*
* Developed by Divisi Software Development - Dinustek. 
* Please write log when you do some modification, don't change anything unless you know what you do
* Semarang, 2016
*/

class MasterbarangController extends Controller {
    protected $masterbarang;

    public function __construct(MasterbarangModel $masterbarang){
        $this->masterbarang = $masterbarang;
    }

        public function getIndex(){
        cekAjax();
        if (Input::has('search')) {
            if(strlen(Input::has('search')) > 0){
                $masterbarangs = $this->masterbarang
                			->orWhere('kd_barang', 'LIKE', '%'.Input::get('search').'%')
			->orWhere('nm_barang', 'LIKE', '%'.Input::get('search').'%')
			->orWhere('id_jns_brg', 'LIKE', '%'.Input::get('search').'%')
			->orWhere('hrg_beli', 'LIKE', '%'.Input::get('search').'%')
			->orWhere('qty', 'LIKE', '%'.Input::get('search').'%')

                ->paginate($_ENV['configurations']['list-limit']);
            }else{
                $masterbarangs = $this->masterbarang->all();
            }
        }else{
            $masterbarangs = $this->masterbarang->all();
        }
        return View::make('masterbarang::index', compact('masterbarangs'));
    }


        public function getCreate(){
        cekAjax();
        return View::make('masterbarang::create');
    }

    // public function postCreate(){
    //     cekAjax();
    //     $input = Input::all();
    //     $destinationPath = base_path().'/packages/upload/gambar/';    
    //     if(\Input::hasFile('foto')){          
    //         @unlink($destinationPath.$gambar->logo);            
    //         $gambars = \Input::file('foto');                      
    //         $tipefile = $gambars->getClientOriginalExtension();         
    //         $filename = str_random(7).'.'.$tipefile;            
    //         $file = $gambars;           
    //         //debug($destinationPath);      
    //         $uploadSuccess  = $file->move($destinationPath, $filename);         
    //         $input['foto'] = $filename;
    //     }

    //     $validation = \Validator::make($input, MasterbarangModel::$rules);
    //     if ($validation->passes()){
    //         $input['user_id'] = \Session::get('user_id');
    //         $input['role_id'] = \Session::get('role_id');
    //         $input['created_at'] = date('Y-m-d h:i:s');
    //         echo ($this->masterbarang->create($input))?1:"Gagal Disimpan";
    //     }
    //     else{
    //         echo 'Input tidak valid';
    //     }
    // }

    public function postCaridata(){
        cekAjax();
        $keyword = Input::get('keyword');
        $per_page = intval(Input::get('per_page'));
        $start = (intval(Input::get('page'))-1)*$per_page;
        $page = intval(Input::get('page'));

        $rs = \DB::table('mast_barang')
        ->select(\DB::raw('kd_barang, nm_barang, kd_barang as id, CONCAT(kd_barang, " - ", nm_barang) as text'))
        ->where('kd_barang', 'like', '%'.$keyword.'%')
        ->orWhere('nm_barang','like', '%'.$keyword.'%')
        ->orderBy('nm_barang','asc');

        $arr['result'] = count($rs->get());
        $arr['per_page'] = $per_page;
        $arr['page'] = (($page>0)?$page:1);
        $arr['rows'] = $rs->skip($start)->take($per_page)->get();
        echo json_encode($arr);
    }

    public function postSimpan(){
        cekAjax();
        $response['success'] = false;
        $response['message'] = "Gagal menyimpan data";
        $destinationPath = base_path().'/packages/upload/gambar/';    
        if(\Input::hasFile('foto')){          
            @unlink($destinationPath.$gambar->logo);            
            $gambars = \Input::file('foto');                      
            $tipefile = $gambars->getClientOriginalExtension();         
            $filename = str_random(7).'.'.$tipefile;            
            $file = $gambars;           
            //debug($destinationPath);      
            $uploadSuccess  = $file->move($destinationPath, $filename);         
            $input['foto'] = $filename;
        }
        \DB::beginTransaction();
        try{
            //input mast_barang
            $master = \DB::table('mast_barang')
                    ->insertGetId([
                        "kd_barang" => Input::get('kd_barang'),
                        "nm_barang" => Input::get('nm_barang'),
                        "id_jns_brg" => Input::get('id_jns_brg'),
                        "hrg_beli" => Input::get('hrg_beli'),
                        "qty" => Input::get('qty'),
                        "id_satuan" => Input::get('id_satuan'),
                        "hrgjual" => Input::get('hrgjual'),
                        "foto" => $filename,
                        "user_id" => \Session::get('user_id'),
                        "role_id" => \Session::get('role_id'),
                        "created_at" => date('Y-m-d H:i:s'),
                    ]);
            if(Input::get('id_satuan') == '2'){
                $qty = Input::get('qty');
                $hrgb = Input::get('hrg_beli');
                $hrgj = Input::get('hrgjual');
                $jmls = (int)$qty*40;
                $jmla = (int)$hrgb/$jmls;
                $jmlb = (int)$hrgj/$jmls;
            }
            else if(Input::get('id_satuan') == '4'){
                $qty = Input::get('qty');
                $hrgb = Input::get('hrg_beli');
                $hrgj = Input::get('hrgjual');
                $jmls = (int)$qty*12;
                $jmla = (int)$hrgb/$jmls;
                $jmlb = (int)$hrgj/$jmls;
            }
            else{
                $jmls = Input::get('qty');
                $hrgb = Input::get('hrg_beli');
                $hrgj = Input::get('hrgjual');
                // $jmls = (int)$qty*40;
                $jmla = (int)$hrgb/$jmls;
                $jmlb = (int)$hrgj/$jmls;
            }
            $stok = \DB::table('tb_stok')
                    ->insert([
                        "kd_brg" => Input::get('kd_barang'),
                        "id_mast_brg" => $master,
                        "jml_stok" => $jmls,
                        "hrg_satuan" => $jmla,
                        "hrg_jual_satuan" => $jmlb,
                        "tgl" => date('Y-m-d'),
                        "created_at" => date('Y-m-d H:i:s'),
                    ]);
            $masuk = \DB::table('tb_barang_inout')
                    ->insert([
                        "id_mast_barang" => $master,
                        "kd_brg" => Input::get('kd_barang'),
                        "tgl" => date('Y-m-d'),
                        "masuk" => $jmls,
                        "keluar" => 0,
                    ]);
            \DB::commit();
            $response['success'] = true;
            $response['message'] = "Data berhasil disimpan";
        } catch (\Exception $e) {
            // dd($jmls);
            \DB::rollback();
            \Log::error($e->getMessage());
            \Log::error($e->getTraceAsString());
        }
        return $response;
    }



    //{controller-show}

        public function getEdit($id = false){
        cekAjax();
        $id = ($id == false)?Input::get('id'):'';
        $masterbarang = $this->masterbarang->find($id);
        //if (is_null($masterbarang)){return \Redirect::to('masterdata/masterbarang/index');}
        return View::make('masterbarang::edit', compact('masterbarang'));
    }
    
    public function postEdit(){
        cekAjax();
        $id = Input::get('id');
        $input = Input::all();
        $validation = \Validator::make($input, MasterbarangModel::$rules);
        
        if ($validation->passes()){
            $masterbarang = $this->masterbarang->find($id);
            echo ($masterbarang->update($input))?4:"Gagal Disimpan";
        }
        else{
            echo 'Input tidak valid';
        }
    }


	
        public function postDelete(){
        cekAjax();
        $ids = Input::get('id');
        // $kd_barangs = Input::get('kd_barang');
        if (is_array($ids)){
            foreach($ids as $id){
                $this->masterbarang->find($id)->delete();
                \DB::table('tb_stok')
                ->where('id_mast_brg', '=', $id)
                ->delete();
            }
            echo 'Data berhasil dihapus';
        }
        else{
            \DB::table('tb_stok')
            ->where('id_mast_brg','=',$ids)
            ->delete();
            echo ($this->masterbarang->find($ids)->delete())?9:'Gagal Dihapus';
        }
    }

}
