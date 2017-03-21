<?php
	//documentacao de criacao de plugin
	//https://codex.wordpress.org/pt-br:Escrevendo_um_Plugin

	//bloquear acesso direto
	defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

	/* 
	Plugin Name: Marvel Shortcode by Lennon Alves
	Description: Plugin criado com integração à Marvel API. Consulte a URL do plugin para encontrar a documentação de utilização do plugin.
	Version: beta
	Author: Lennon Alves
	Author URI: http://lennonalves.com
	*/

	//shortcode para exibir a lista de personagens // [sc_personagens_marvel]
	function shortcode_personagens_marvel ( ) {
		//variaveis
		$publickey = 'a80b3d6da752653db8e06bf115158301';
		$privatekey = 'de2d8bb7ce1de8f871318cf9e18dbf137d89f83e';
		$ts = '1';
		$hash = md5($ts.$privatekey.$publickey);

		$pagina = $_GET['pagina'];
		if (!$pagina) { $pagina = 1; }
		
		$limit = 20;
		$offset = ($pagina - 1) * $limit;		

		//requisicao
		$json = file_get_contents('http://gateway.marvel.com/v1/public/comics?apikey='.
			$publickey.'&ts='.$ts.'&hash='.$hash.'&offset='.$offset.'&limit='.$limit);
		$obj = json_decode($json);

		switch ($obj->code) {
			case '200': //ok
			escrevePersonagens($obj, $offset, $pagina);
			break;

			case '409':
			return "Erro em requisição com o servidor.";
			break;

			case '401': //invalid referer
			return "API Key inválida.";
			break;

			case '405': //method not allowed
			return "Método sem permissão de utilização.";
			break;

			case '403': //forbidden
			return "Sem acesso para utilizar esta requisição.";
			break;
			
			default:
			return "Requisição não parmitida.";
			break;
		}
	}

	function escrevePersonagens( $obj, $offset, $pagina ) {
		$total = $obj->data->total;
		$count = $obj->data->count;

		$personagens = $obj->data->results;

		echo "<div class='container'>";
			foreach ($personagens as $personagem) {
				echo "<div class='col-xs-6 col-sm-3'>";
					$imgurl = $personagem->thumbnail->path.".".$personagem->thumbnail->extension;
					echo "<img src='$imgurl' class='img-rounded' />";
					$nome = substr($personagem->title, 0, 20);
					echo "<h4>$nome</h4>";
				echo "</div>";
			}
		echo "</div>";				

		$anterior = $pagina - 1;
		$proxima = $pagina + 1;
		
		echo "<div class='container'>";
			echo "<div class='col-md-6'>";
			if ($offset >= $count) {
				echo "<div style='float:left;' class='btn btn-default btn-xs'><a href='?pagina=$anterior'>Página Anterior</a></div>";
			}
			echo "</div>";
			echo "<div class='col-md-6'>";
			if ($offset <= ($total - $count)) {
				echo "<div style='float:right;' class='btn btn-default btn-xs'><a href='?pagina=$proxima'>Próxima Página</a></div>";
			}
			echo "</div>";
		echo "</div>";
	}

	add_shortcode ('sc_personagens_marvel', 'shortcode_personagens_marvel');