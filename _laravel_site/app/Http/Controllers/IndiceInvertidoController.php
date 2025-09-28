<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\IndiceInvertido;
use App\Colecao;

class IndiceInvertidoController extends Controller
{
    public function passo1()
	{
		$data = IndiceInvertido::parametros('passo-1');
		return view('template.empty', $data);
	}
	public function passo2(Request $request)
	{
		$data = IndiceInvertido::parametros('passo-2');
		$request
			->session()
			->put(
				"nome-colecao", 
				$request->input("colecao")
			);

		return view('template.empty', $data);
	}
	public function passo3(Request $request)
	{
		$nomeColecao = $request->session()->get('nome-colecao');

        IndiceInvertido::tokenizer($nomeColecao);

		$data = IndiceInvertido::parametros('passo-3');
		return view('template.empty', $data);
	}
	public function passo4()
	{
		IndiceInvertido::normalizacao();

		$data = IndiceInvertido::parametros('passo-4');
		return view('template.empty', $data);
	}
	public function fim(Request $request)
	{
		$nomeColecao = $request->session()->get('nome-colecao');
		Colecao::setNomeColecaoAtual($nomeColecao);
		
		$data = IndiceInvertido::parametros('fim');
		return view('template.empty', $data);
	}	
	public function colecao($colecao, $id)
	{
		if(is_numeric($id)){
			if(0 <= $id && $id <= 99){
				echo file_get_contents(base_path().'/data/colecoes/'.$colecao.'/'.$id.'.txt');
				return;
			}
		}
		return Redirect::to('/');

	}
	public function toklog()
	{
		echo file_get_contents(base_path().'/data/colecoes/log.txt');

	}
}
