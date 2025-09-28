<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class IndiceInvertido extends Model
{
    protected $table = 'indice';

	private static function prepararBanco()
	{
		$nomeTabela = (new self)->getTable();

		if( ! Schema::hasTable($nomeTabela) ){
			Artisan::call('migrate:refresh');
			Artisan::call('db:seed');
		}
		else if(self::count() != 0){
			self::truncate();
		}
	}
	public static function tokenizer($nomeDiretorio)
	{
		$endAbsoluto = base_path().'/data/colecoes/'.$nomeDiretorio;
		$lista = self::listaDiretorio($endAbsoluto);
		$tam = count($lista);

		$log = base_path().'/data/colecoes/log.txt';

		$i=1;
		foreach($lista as $arq){

			$logFile = fopen($log,'w');
			$data = $i."-".$tam."-".$arq;
			fwrite($logFile, $data);
			fclose($logFile);
			$i++;

			$pont = fopen($endAbsoluto.'/'.$arq,'r');
			if($pont){
				$posicao = 0;
				while(true) {
					$linha = fgets($pont);
					if ($linha==null) break;

					$termos = explode(' ', $linha);

					foreach($termos as $t){

						$tripla = new IndiceInvertido;
						$valor = trim($t);

						if( strlen($valor) ){
							$posicao++;
							$tripla->termo = $t;
							$tripla->documento = $arq;
							$tripla->posicao = $posicao;
							$tripla->save();
						}
					}
				}
				fclose($pont);
			}
		}

		//Limpando o log do arquivo
		$logFile = fopen($log,'w');
		$data = "";
		fwrite($logFile, $data);
		fclose($logFile);
	}
	private static function listaDiretorio($nomeDiretorio)
	{

		$lista = scandir($nomeDiretorio);
		$chave = array_search(".", $lista);
		unset($lista[$chave]);
		$chave = array_search("..", $lista);
		unset($lista[$chave]);

		return $lista;
	}
	public static function normalizacao()
	{
		$triplas = self::all();
		$tam = $triplas->count();
		$log = base_path().'/data/colecoes/log.txt';

		$i = 1;
		foreach ($triplas as $t) {
			$logFile = fopen($log,'w');
			$data = $i."-".$tam;
			fwrite($logFile, $data);
			fclose($logFile);
			$i++;

			$termo = $t->termo;
			$termo = self::normalizar($termo);

			$t->termo = $termo;
			$t->save();
		}

		//Limpando o log do arquivo
		$logFile = fopen($log,'w');
		$data = "";
		fwrite($logFile, $data);
		fclose($logFile);
	}
	private static function normalizar($termo)
	{
		$simbolosRemocao =
			array(
				"?", "!", ",", ";", "(",
				")", "\"", ":", "."
			);
		$termoNormalizado = str_replace($simbolosRemocao, "", $termo);
		$termoNormalizado = mb_strtolower($termoNormalizado);

		return $termoNormalizado;
	}
	public static function postings($query)
	{
		$postings = IndiceInvertido::select('documento')
						->where('termo', $query)
						->distinct()
						->lists('documento');
		return $postings;
	}
	public static function parametros($nomeMetodo)
	{
		switch($nomeMetodo){
			case 'passo-1':
				return self::parametrosPasso1();
				break;
			case 'passo-2':
				return self::parametrosPasso2();
				break;
			case 'passo-3':
				return self::parametrosPasso3();
				break;
			case 'passo-4':
				return self::parametrosPasso4();
				break;
			case 'fim':
				return self::parametrosFim();
				break;
		}
	}
	private static function parametrosPasso1()
	{
		self::prepararBanco();

		$data['viewName'] = 'site.gerar-indice.index';
		$data['panelName'] = 'site.gerar-indice.passo-1.index';
		$data['scriptName'] = 'block.script';

		$data['navAtivo'] = 'passo-1';
		$data['panelUrl'] = url('/gerar-indice/passo-2');
        $data['panelId'] = 'colecaoForm';
        $data['panelNext'] = 'Próximo';
        $data['panelIcon'] = 'forward';

        return $data;
	}
	private static function parametrosPasso2()
	{
		$data['viewName'] = 'site.gerar-indice.index';
		$data['panelName'] = 'site.gerar-indice.passo-2.index';
		$data['scriptName'] = 'site.gerar-indice.passo-2.script';

		$data['navAtivo'] = 'passo-2';
		$data['panelUrl'] = url('/gerar-indice/passo-3');
        $data['panelId'] = 'colecaoForm';
        $data['panelNext'] = 'Próximo';
        $data['panelIcon'] = 'forward';

        return $data;
	}
	private static function parametrosPasso3()
	{
		$data['viewName'] = 'site.gerar-indice.index';
		$data['panelName'] = 'site.gerar-indice.passo-3.index';
		$data['scriptName'] = 'site.gerar-indice.passo-3.script';

		$data['navAtivo'] = 'passo-3';
		$data['panelUrl'] = url('/gerar-indice/passo-4');
        $data['panelId'] = 'colecaoForm';
        $data['panelNext'] = 'Próximo';
        $data['panelIcon'] = 'forward';

        return $data;
	}
	private static function parametrosPasso4()
	{
		$data['viewName'] = 'site.gerar-indice.index';
		$data['panelName'] = 'site.gerar-indice.passo-4.index';
		$data['scriptName'] = 'block.script';

		$data['navAtivo'] = 'passo-4';
		$data['panelUrl'] = url('/gerar-indice/fim');
        $data['panelId'] = 'colecaoForm';
        $data['panelNext'] = 'Próximo';
        $data['panelIcon'] = 'forward';

        return $data;
	}
	private static function parametrosFim()
	{
		$data['viewName'] = 'site.gerar-indice.index';
		$data['panelName'] = 'site.gerar-indice.fim.index';
		$data['scriptName'] = 'block.script';

		$data['navAtivo'] = 'fim';
		$data['panelUrl'] = url('/');
        $data['panelId'] = 'colecaoForm';
        $data['panelNext'] = 'OK';
        $data['panelIcon'] = 'ok';

        return $data;
	}
}
