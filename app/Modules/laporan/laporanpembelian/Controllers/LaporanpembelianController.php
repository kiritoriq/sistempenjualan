<?php namespace App\Modules\laporan\laporanpembelian\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\laporan\laporanpembelian\Models\LaporanpembelianModel;
use Input,View, Request, Form, File;

class LaporanpembelianController extends Controller {

	/**
	 * Laporanpembelian Repository
	 *
	 * @var Laporanpembelian
	 */
	protected $laporanpembelian;

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
		return View::make('laporanpembelian::index');
	}

		/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getCreate()
	{
		return View::make('laporanpembelian::create');
	}

	public function postData()
	{
		$bulan = Input::get('bulan');
		// $tgl = \DB::table('tb_barang_inout')
		// 		->selectRaw('MONTH("tgl") as month')
		// 		->first();
		// dd($tgl->month);
		$barangs = \DB::table('tb_barang_inout')
						->join('mast_barang','tb_barang_inout.id_mast_barang','=','mast_barang.id')
                        ->select('mast_barang.nm_barang as nama','mast_barang.hrg_beli as beli','tb_barang_inout.*')
                        ->whereRaw('MONTH(tb_barang_inout.tgl) = '.$bulan)
                        ->get();
        return View::make('laporanpembelian::tabel_bulanan', compact('barangs'));
	}
}
