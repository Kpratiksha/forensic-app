<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;

class HomeController extends Controller {
	public function index() {
		$routeUri = Route::getFacadeRoot()->current()->uri();

		return view('pages.home');
	}
}
