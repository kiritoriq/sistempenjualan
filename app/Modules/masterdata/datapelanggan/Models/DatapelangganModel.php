<?php namespace App\Modules\masterdata\datapelanggan\Models;
use Illuminate\Database\Eloquent\Model;


/**
* Datapelanggan Model
* @var Datapelanggan
* Generate from Custom Laravel 5.1 by Aa Gun. 
*
* Developed by Dinustek. 
* Please write log when you do some modification, don't change anything unless you know what you do
* Semarang, 2016
*/

class DatapelangganModel extends Model {
	protected $guarded = array();
	
	protected $table = "tb_pelanggan";

	public static $rules = array(
    		'no_plg' => 'required',
		'nama_plg' => 'required',
		'alamat' => 'required',
		'no_telp' => 'required',

    );

	public static function all($columns = array('*')){
		$instance = new static;
		if (\PermissionsLibrary::hasPermission('mod-datapelanggan-listall')){
			return $instance->newQuery()->paginate($_ENV['configurations']['list-limit']);
		}else{
			return $instance->newQuery()
			->where('role_id', \Session::get('role_id'))
			->paginate($_ENV['configurations']['list-limit']);	
			
		}
	}

}
