<?php

class Url extends Eloquent {

	protected $guarded = array();

	public static $rules = array(
			'url'=> 'required|url'	
			);
	
	public static function validate($input){
		
		$validate = Validator::make($input,static::$rules);

		return $validate->fails()?$validate:"Passed";
	}

	public static function get_unique_shortened_url(){
		
		 	$shortened = base_convert(rand(10000,99999), 10, 36);

		 	if(static::whereShortened($shortened)->first()){
		
		 		return static::get_unique_shortened_url();
		
		 	}
		
		 	return $shortened;
		
		}

}
