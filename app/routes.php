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
	$data = Input::all();

	$rules = array (
		'url'=>'required|url'
		);
	$validator = Validator::make($data, $rules);

	if(true){

		$url = Input::get('url');

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
			return Redirect::route('home');
		}
	} 

	return Redirect::to('home')->withErrors($validator);
});

Route::get('/{url}', function($url){
	$record = Url::whereShortened($url)->first();
	if($record){
		return Redirect::to($record->url);
	} else {
		return Redirect::route('home');
	}
});