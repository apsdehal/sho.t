<?php

class Url extends Eloquent {
	protected $guarded = array();

	public static $rules = array();

	public static function get_unique_shortened_url(){
		 	$shortened = base_convert(rand(10000,99999), 10, 36);

		 	if(static::whereShortened($shortened)->first()){
		 		static::get_unique_shortened_url();
		 	}
		 	return $shortened;
		}
}
