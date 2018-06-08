<?php

use Illuminate\Database\Eloquent\Model;

Class Logs extends Eloquent {

	protected $table = 'logs';

	public function logs(){
		return $this->belongsTo('User', 'id', 'changer_id');
	}

	public function action(){
		return $this->hasOne('ActionLog', 'id', 'action_id');
	}

	public function changer(){
		return $this->hasOne('User', 'id', 'changer_id');
	}

	public function target(){
		return $this->hasOne('User', 'id', 'target_id');
	}
}

?>