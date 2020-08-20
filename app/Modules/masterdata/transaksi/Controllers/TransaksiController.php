<?php namespace App\Modules\masterdata\transaksi\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\masterdata\transaksi\Models\TransaksiModel;
use Input,View, Request, Form, File;

/**
* Transaksi Controller
* @var Transaksi
* Generate from Custom Laravel 5.1 by Aa Gun. 
*
* Developed by Divisi Software Development - Dinustek. 
* Please write log when you do some modification, don't change anything unless you know what you do
* Semarang, 2016
*/

class TransaksiController extends Controller {
    protected $transaksi;

    public function __construct(TransaksiModel $transaksi){
        $this->transaksi = $transaksi;
    }

        public function getIndex(){
        cekAjax();
        if (Input::has('search')) {
            if(strlen(Input::has('search')) > 0){
                $transaksis = $this->transaksi
                			->orWhere('kd_transk', 'LIKE', '%'.Input::get('search').'%')
			->orWhere('kd_kasir', 'LIKE', '%'.Input::get('search').'%')
			->orWhere('nama_kasir', 'LIKE', '%'.Input::get('search').'%')
			->orWhere('kd_plg', 'LIKE', '%'.Input::get('search').'%')
			->orWhere('nama_plg', 'LIKE', '%'.Input::get('search').'%')
			->orWhere('kd_brg', 'LIKE', '%'.Input::get('search').'%')
			->orWhere('nama_brg', 'LIKE', '%'.Input::get('search').'%')
			->orWhere('qty', 'LIKE', '%'.Input::get('search').'%')

                ->paginate($_ENV['configurations']['list-limit']);
            }else{
                $transaksis = $this->transaksi->all();
            }
        }else{
            $transaksis = \DB::table('tb_transaksi')
                        ->join('tb_pelanggan','tb_transaksi.no_plg','=','tb_pelanggan.no_plg')
                        ->select('tb_transaksi.*','tb_pelanggan.nama_plg as namapel')
                        ->paginate();
        }
        return View::make('transaksi::index', compact('transaksis'));
    }


        public function getCreate(){
        cekAjax();
        return View::make('transaksi::create');
    }

    public function postCreate(){
        cekAjax();
        $input = Input::all();
        $validation = \Validator::make($input, TransaksiModel::$rules);
        if ($validation->passes()){
            $input['user_id'] = \Session::get('user_id');
            $input['role_id'] = \Session::get('role_id');
            echo ($this->transaksi->create($input))?1:"Gagal Disimpan";
        }
        else{
            echo 'Input tidak valid';
        }
    }

    public function postSimpan(){
        cekAjax();
        $response['success'] = false;
        $response['message'] = "Gagal menyimpan data";
        \DB::beginTransaction();
        try{
            $transaksi = \DB::table('tb_transaksi')
                        ->insertGetId([
                            "kd_transk" => Input::get('kd_transk'),
                            "tgl" => Input::get('tgl'),
                            "kd_kasir" => \Session::get('user_id'),
                            "nama_kasir" => \Session::get('name'),
                            "no_plg" => Input::get('no_plg'),
                            "totalharga" => Input::get('totalharga'),
                            "totalbayar" => Input::get('totalbayar'),
                            "kembali" => Input::get('kembali'),
                            "role_id" => \Session::get('role_id'),
                            "user_id" => \Session::get('user_id'),
                            "created_at" => date('Y-m-d H:i:s'),
                        ]);
                    if(Input::has('kode_barang')){
                        foreach(Input::get('kode_barang') as $key => $barang){
                            $detailtransaksi = \DB::table('tb_dtl_transaksi')
                                            ->insert([
                                                "id_transk" => $transaksi,
                                                "kd_transk" => Input::get('kd_transk'),
                                                "kd_brg" => $barang,
                                                "nama_brg" => Input::get('nama_barang')[$key],
                                                "hrg_satuan" => Input::get('hargasatuan')[$key],
                                                "qty" => Input::get('jumlah')[$key],
                                                "diskon" => Input::get('diskon')[$key],
                                                "harga" => Input::get('total')[$key],
                                            ]);

                            $jml = (int)Input::get('jumlah')[$key];
                            $stok = \DB::table('tb_stok')
                                        ->select('jml_stok')
                                        ->where('kd_brg',$barang)
                                        ->first();
                            $stokdulu = $stok->jml_stok;            
                            $stokskrg = $stokdulu-$jml;

                            $updatestok = \DB::table('tb_stok')
                                        ->where('kd_brg',$barang)
                                        ->update([
                                            'jml_stok' => $stokskrg,
                                        ]);
                            $keluar = \DB::table('tb_barang_inout')
                                    ->insert([
                                        "kd_transk" => Input::get('kd_transk'),
                                        "kd_brg" => $barang,
                                        "tgl" => Input::get('tgl'),
                                        "keluar" => Input::get('jumlah')[$key],
                                    ]);

                        }
                    }

            //commit transaction
            \DB::commit();
            $response['success'] = true;
            $response['message'] = "Data berhasil disimpan";
        }catch (\Exception $e){
            \DB::rollback();
            \Log::error($e->getMessage());
            \Log::error($e->getTraceAsString());
        }
        return $response;
    }

    public function postSimpanedit(){
        cekAjax();
        $id = Input::get('id');
        $response['success'] = false;
        $response['message'] = "Gagal menyimpan data";
        \DB::beginTransaction();
        try{
            $selecttransk = \DB::table('tb_transaksi')
                            ->where('id',$id)
                            ->first();
            if(!empty($selecttransk)){
                $delete = \DB::table('tb_transaksi')
                        ->where('id',$id)
                        ->delete();
            }

            $transaksi = \DB::table('tb_transaksi')
                        ->insertGetId([
                            "kd_transk" => Input::get('kd_transk'),
                            "tgl" => Input::get('tgl'),
                            "kd_kasir" => \Session::get('user_id'),
                            "nama_kasir" => \Session::get('name'),
                            "no_plg" => Input::get('no_plg'),
                            "totalharga" => Input::get('totalharga'),
                            "totalbayar" => Input::get('totalbayar'),
                            "kembali" => Input::get('kembali'),
                            "role_id" => \Session::get('role_id'),
                            "user_id" => \Session::get('user_id'),
                            "created_at" => date('Y-m-d H:i:s'),
                        ]);
                    if(Input::has('kode_barang')){
                        $selectbarang = \DB::table('tb_dtl_transaksi')
                                        ->where('kd_transk',Input::get('kd_transk'))
                                        ->get();
                        if(!empty($selectbarang)){
                            $deletebarang = \DB::table('tb_dtl_transaksi')
                                            ->where('kd_transk',Input::get('kd_transk'))
                                            ->delete();
                        }
                        foreach(Input::get('kode_barang') as $key => $barang){
                            $detailtransaksi = \DB::table('tb_dtl_transaksi')
                                            ->insert([
                                                "id_transk" => $transaksi,
                                                "kd_transk" => Input::get('kd_transk'),
                                                "kd_brg" => $barang,
                                                "nama_brg" => Input::get('nama_barang')[$key],
                                                "hrg_satuan" => Input::get('hargasatuan')[$key],
                                                "qty" => Input::get('jumlah')[$key],
                                                "diskon" => Input::get('diskon')[$key],
                                                "harga" => Input::get('total')[$key],
                                            ]);

                            $stok = \DB::table('tb_stok')
                                        ->select('kd_brg','jml_stok')
                                        ->where('kd_brg',$barang)
                                        ->first();
                            $inout = \DB::table('tb_barang_inout')
                                    ->select('kd_transk','kd_brg','keluar')
                                    ->where('kd_transk', Input::get('kd_transk'))
                                    ->first();
                            if(Input::get('kd_transk') == $inout->kd_transk  && $barang == $inout->kd_brg && Input::get('jumlah')[$key] == $inout->keluar){
                                if(Input::get('kd_transk') == $inout->kd_transk && $barang != $inout->kd_brg){
                                    $keluar = \DB::table('tb_barang_inout')
                                    ->insert([
                                        "kd_transk" => Input::get('kd_transk'),
                                        "kd_brg" => $barang,
                                        "tgl" => Input::get('tgl'),
                                        "keluar" => Input::get('jumlah')[$key],
                                    ]);
                                }
                                break;
                            }else{
                                $inout = \DB::table('tb_barang_inout')
                                        ->where('kd_transk',Input::get('kd_transk'))
                                        ->delete();
                                $jml = (int)Input::get('jumlah')[$key];
                                $stokdulu = $stok->jml_stok;            
                                $stokskrg = $stokdulu-$jml;

                                $updatestok = \DB::table('tb_stok')
                                            ->where('kd_brg',$barang)
                                            ->update([
                                                'jml_stok' => $stokskrg,
                                            ]);
                                $updateinout = \DB::table('tb_barang_inout')
                                            ->insert([
                                                "kd_transk" => Input::get('kd_transk'),
                                                "kd_brg" => $barang,
                                                "tgl" => Input::get('tgl'),
                                                "keluar" => Input::get('jumlah')[$key],
                                            ]);
                            }

                        }
                    }

            //commit transaction
            \DB::commit();
            $response['success'] = true;
            $response['message'] = "Data berhasil disimpan";
        }catch (\Exception $e){
            \DB::rollback();
            \Log::error($e->getMessage());
            \Log::error($e->getTraceAsString());
        }
        return $response;
    }

    public function postCaripelanggan(){
        $kd = \Input::get('no_plg');
        $rs = \DB::table('tb_pelanggan')
            ->select('nama_plg')
            ->where('no_plg', $kd)
            ->take('1');

        $row = $rs->first();
        // echo $row->nama_plg;
        // $ret['no_plg'] = isset($row->no_plg)?$row->no_plg:'';
        $ret['nama'] = isset($row->nama_plg)?$row->nama_plg:'';

        echo json_encode($ret);
        
    }

    public function postCaribarang()
    {
        cekAjax();
        $keyword = Input::get('keyword');
        $per_page = intval(Input::get('per_page'));
        $start = (intval(Input::get('page'))-1)*$per_page;
        $page = intval(Input::get('page'));

        $rs = \DB::table('mast_barang')
        ->join('tb_stok','mast_barang.id','=','tb_stok.id_mast_brg')
        ->select(\DB::raw('mast_barang.kd_barang, mast_barang.nm_barang, tb_stok.hrg_jual_satuan, mast_barang.kd_barang as id, CONCAT(mast_barang.kd_barang, " - ", mast_barang.nm_barang, "@ Rp ",tb_stok.hrg_jual_satuan) as text, tb_stok.hrg_jual_satuan as dtvalue'))
        // ->where('kd_barang', 'like', '%'.$keyword.'%')
        ->orWhere('mast_barang.nm_barang','like', '%'.$keyword.'%')
        ->orderBy('mast_barang.nm_barang','asc');

        $arr['result'] = count($rs->get());
        $arr['per_page'] = $per_page;
        $arr['page'] = (($page>0)?$page:1);
        $arr['rows'] = $rs->skip($start)->take($per_page)->get();
        echo json_encode($arr);
    }

    public function getLihat($id = false){
        cekAjax();
        // $id = Input::get('id');
        $id = ($id == false)?Input::get('id'):'';
        $transaksi = $this->transaksi->find($id);
        return View::make('transaksi::edit', compact('transaksi'));
    }

    public function getCetak($id = false){
        $transaksi = \DB::table('tb_transaksi')
                    ->select('*')
                    ->where('kd_transk',$id)
                    ->first();
        $contents = view('transaksi::transaksi_print', compact('transaksi'));
        $response = \Response::make($contents);
        $response->header('Content-Type', 'application/pdf');
        return $response;

    }

    //{controller-show}

        public function getEdit($id = false){
        cekAjax();
        $id = ($id == false)?Input::get('id'):'';
        $transaksi = $this->transaksi->find($id);
        //if (is_null($transaksi)){return \Redirect::to('masterdata/transaksi/index');}
        return View::make('transaksi::edit', compact('transaksi'));
    }
    
    public function postEdit(){
        cekAjax();
        $id = Input::get('id');
        $input = Input::all();
        $validation = \Validator::make($input, TransaksiModel::$rules);
        
        if ($validation->passes()){
            $transaksi = $this->transaksi->find($id);
            echo ($transaksi->update($input))?4:"Gagal Disimpan";
        }
        else{
            echo 'Input tidak valid';
        }
    }


        // public function getHitung(){
        //     if(Input::has('id_bahan')){
        //         $hrg = \DB::table('tb_stok')
        //                 ->select('hrg_jual_satuan')
        //                 ->where('')
        //         foreach(Input::get('id_bahan') as $key => $jumlah){

        //         }
        //     }
        // }

	
        public function postDelete(){
        cekAjax();
        $ids = Input::get('id');
        if (is_array($ids)){
            foreach($ids as $id){
                $this->transaksi->find($id)->delete();
                \DB::table('tb_dtl_transaksi')
                ->where('id_transk','=',$id)
                ->delete();
                
            }
            echo 'Data berhasil dihapus';
        }
        else{
            \DB::table('tb_dtl_transaksi')
            ->where('id_transk','=',$ids)
            ->delete();
            echo ($this->transaksi->find($ids)->delete())?9:'Gagal Dihapus';
        }
    }

}
