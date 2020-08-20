<?php namespace App\Modules\masterdata\transaksi\Models;
use Illuminate\Database\Eloquent\Model;


/**
* Transaksi Model
* @var Transaksi
* Generate from Custom Laravel 5.1 by Aa Gun. 
*
* Developed by Dinustek. 
* Please write log when you do some modification, don't change anything unless you know what you do
* Semarang, 2016
*/

class TransaksiModel extends Model {
	protected $guarded = array();
	
	protected $table = "tb_transaksi";

	public static $rules = array(
    		'kd_transk' => 'required',
		'kd_kasir' => 'required',
		'nama_kasir' => 'required',
		'kd_plg' => 'required',
		'nama_plg' => 'required',
		'kd_brg' => 'required',
		'nama_brg' => 'required',
		'qty' => 'required',

    );

	public static function all($columns = array('*')){
		$instance = new static;
		if (\PermissionsLibrary::hasPermission('mod-transaksi-listall')){
			return $instance->newQuery()->paginate($_ENV['configurations']['list-limit']);
		}else{
			return $instance->newQuery()
			->where('role_id', \Session::get('role_id'))
			->paginate($_ENV['configurations']['list-limit']);	
			
		}
	}

}
