<?php namespace App\Modules\masterdata\masterbarang\Models;
use Illuminate\Database\Eloquent\Model;


/**
* Masterbarang Model
* @var Masterbarang
* Generate from Custom Laravel 5.1 by Aa Gun. 
*
* Developed by Dinustek. 
* Please write log when you do some modification, don't change anything unless you know what you do
* Semarang, 2016
*/

class MasterbarangModel extends Model {
	protected $guarded = array();
	
	protected $table = "mast_barang";

	public static $rules = array(
    		'kd_barang' => 'required',
		'nm_barang' => 'required',
		'id_jns_brg' => 'required',
		'hrg_beli' => 'required',
		'qty' => 'required',

    );

	public static function all($columns = array('*')){
		$instance = new static;
		if (\PermissionsLibrary::hasPermission('mod-masterbarang-listall')){
			return $instance->newQuery()->paginate($_ENV['configurations']['list-limit']);
		}else{
			return $instance->newQuery()
			->where('role_id', \Session::get('role_id'))
			->paginate($_ENV['configurations']['list-limit']);	
			
		}
	}

}
