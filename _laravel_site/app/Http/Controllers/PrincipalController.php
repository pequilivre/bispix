<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Principal;

class PrincipalController extends Controller
{
    public function index()
	{
		return view('template.index');
	}

	public function resultados(Request $request)
	{
		$query = $request->input('query');
		$data = Principal::parametros('resultados', $query);
		$data['query'] = $query;
		
		return view('template.empty', $data);
	}
}
