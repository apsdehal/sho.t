<?php

class IndexController extends BaseController{
	
	public function get()
	{
		return View::make('hello');
	}

	public function post()
	{
		$url = Input::get('url');

		$validate = Url::validate(array('url'=>$url));

		if($validate == "Passed"){

			return static::create_view($url);

		 			}

		return Redirect::to('/')->withErrors($validate);

	}
	private static function create_view($url)
	{
		$check = static::check_records($url) ;

		 if($check){
	
			return $check;
	
	 	} else {
	
	 		return static::create_url_row($url);
	
	  	}
	}

	private static function check_records($url)
	{

		$record = Url::whereUrl($url)->first();

			if($record){

			return View::make('results')->with('shortened',$record->shortened);
			
				}
	}

	private static function create_url_row($url)
	{
		$shortened = URL::get_unique_shortened_url();

			$success = Url::create(array(
				'url'=>$url,
				'shortened'=>$shortened
				));
			
			if($success){

				return View::make('results')->with('shortened',$shortened);
			
			} else {
			
				return "failed";
			}
	}
}