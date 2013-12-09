<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/',array('as'=>'home', function()
{
	return View::make('hello');
}));

Route::post('/',function()
{	
	$url = Input::get('url');

	$validate = Url::validate(array('url'=>$url));

	if($validate == "Passed"){

		$record = Url::whereUrl($url)->first();

		if($record){

		return View::make('results')->with('shortened',$record->shortened);
		
			}		

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

	return Redirect::route('home')->withErrors($validate);
});

Route::get('/{url}', function($url){
	
	$record = Url::whereShortened($url)->first();
	
	if($record){
	
		return Redirect::to($record->url);
	
	} else {
	
		return Redirect::route('home');
	
	}
});