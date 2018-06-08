<?php

use Illuminate\Database\Eloquent\Model;

Class ActionLog extends Eloquent {

	protected $table = 'action_logs';

	public function actionLogs(){
		return $this->hasMany('Logs');
	}

	public function action(){
		return $this->belongsTo('Logs', 'id');
	}

}

?>