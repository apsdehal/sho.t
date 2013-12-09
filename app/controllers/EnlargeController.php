<?php

class EnlargeController extends BaseController{

	public function enlargeurl($url)
	{

		$record = Url::whereShortened($url)->first();
	
		if($record){
		
			return Redirect::to($record->url);
		
		} else {
		
			return Redirect::route('home');
		
		}
	}
}
?>