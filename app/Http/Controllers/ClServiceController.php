<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\ClService;
use App\User;

class ClServiceController extends Controller{
	
	public function index()
	{
		$cl_services = ClService::all();
		return view ('cl_services.list_all', [
            'cl_services' => $cl_services,
            ]);
	}
}