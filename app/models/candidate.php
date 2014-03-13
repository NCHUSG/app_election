<?php

class candidate extends Eloquent {

	protected $table = 'candidate';
	protected $primaryKey   = 'id';

	public $timestamps = false;

	protected $fillable = array('regis_type', 'type_data', 'name', 'sex', 'depart', 'exp', 'politics', 'phone', 'email', 'agree', 'code');
}
