<?php namespace App\Modules\laporan\laporanpenjualan\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\laporan\laporanpenjualan\Models\LaporanpenjualanModel;
use Input,View, Request, Form, File;

class LaporanpenjualanController extends Controller {

	/**
	 * Laporanpenjualan Repository
	 *
	 * @var Laporanpenjualan
	 */
	protected $laporanpenjualan;

	public function __construct()
	{
	
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		cekAjax();
		return View::make('laporanpenjualan::index');
	}

		/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getCreate()
	{
		return View::make('laporanpenjualan::create');
	}

	public function postData()
	{
		$bulan = Input::get('bulan');
		// $tgl = \DB::table('tb_barang_inout')
		// 		->selectRaw('MONTH("tgl") as month')
		// 		->first();
		// dd($tgl->month);
		$barangs = \DB::table('tb_barang_inout')
						->leftjoin('tb_dtl_transaksi','tb_barang_inout.kd_brg','=','tb_dtl_transaksi.kd_brg')
                        ->select('tb_barang_inout.*','tb_dtl_transaksi.harga','tb_dtl_transaksi.nama_brg')
                        ->where('tb_barang_inout.id_mast_barang',null)
                        ->whereRaw('MONTH(tb_barang_inout.tgl) = '.$bulan)
                        ->groupBy('tb_barang_inout.kd_brg')
                        ->get();
        return View::make('laporanpenjualan::tabel_bulanan', compact('barangs'));
	}
}
