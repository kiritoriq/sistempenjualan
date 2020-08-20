<?php namespace App\Modules\masterdata\datastok\Models;
use Illuminate\Database\Eloquent\Model;


/**
* Datastok Model
* @var Datastok
* Generate from Custom Laravel 5.1 by Aa Gun. 
*
* Developed by Dinustek. 
* Please write log when you do some modification, don't change anything unless you know what you do
* Semarang, 2016
*/

class DatastokModel extends Model {
	protected $guarded = array();
	
	protected $table = "tb_stok";

	public static $rules = array(
    		'kd_brg' => 'required',
		'jml_stok' => 'required',
		'hrg_satuan' => 'required',
		'hrg_jual_satuan' => 'required',

    );

	public static function all($columns = array('*')){
		$instance = new static;
		if (\PermissionsLibrary::hasPermission('mod-datastok-listall')){
			return $instance->newQuery()->paginate($_ENV['configurations']['list-limit']);
		}else{
			return $instance->newQuery()
			->where('role_id', \Session::get('role_id'))
			->paginate($_ENV['configurations']['list-limit']);	
			
		}
	}

}
