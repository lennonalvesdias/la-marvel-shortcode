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

	//adicionar menu
	add_action( 'admin_menu', 'my_plugin_menu' );

	//inserir plugin ao menu
	function my_plugin_menu() {
		add_options_page( 'Opções do Plugin', 'Marvel SC', 'manage_options', 'my-unique-identifier', 'my_plugin_options' );
	}

	//pagina do plugin
	function my_plugin_options() {
		if ( !current_user_can( 'manage_options' ) )  {
			wp_die( __( 'Você não tem permissão suficiente para acessar as configurações deste plugin.' ) );
		}
		
		include('admin.php');

		echo '</div>';
	}

	//funcao de inicializacao
	function sc_register_activation() {
		add_option("pageListaPersonagens");
		add_option("pageExibePersonagem");
	}

	//funcao de desinstalacao
	function sc_register_deactivation() {
		delete_option("pageListaPersonagens");
		delete_option("pageExibePersonagem");
	}

	//shortcode para exibir a lista de personagens // [sc_personagens_marvel]
	function shortcode_personagens_marvel ( ) {
		//variaveis
		$publickey = 'a80b3d6da752653db8e06bf115158301';
		$privatekey = 'de2d8bb7ce1de8f871318cf9e18dbf137d89f83e';
		$ts = '1';
		$hash = md5($ts.$privatekey.$publickey);

		$token = 'apikey='.$publickey.'&ts='.$ts.'&hash='.$hash;

		$pagina = $_GET['pagina'];
		if (!$pagina) { $pagina = 1; }
		
		$limit = 20;
		$offset = ($pagina - 1) * $limit;		

		//requisicao
		$json = file_get_contents('http://gateway.marvel.com/v1/public/characters?'.$token
			.'&offset='.$offset.'&limit='.$limit);
		$obj = json_decode($json);

		switch ($obj->code) {
			case '200': //ok
			exibeListaPersonagens($obj, $offset, $pagina);
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
			return "Requisição não permitida.";
			break;
		}
	}

	function exibeListaPersonagens( $obj, $offset, $pagina ) {
		$total = $obj->data->total;
		$count = $obj->data->count;

		$personagens = $obj->data->results;

		$urlEP = get_option("pageExibePersonagem");

		$organizer = 1;
		echo "<div class='container'>";
		foreach ($personagens as $personagem) {
			if ($organizer%4 == 1) echo "<div class='col-md-12'>";
			echo "<div class='col-xs-6 col-sm-3'>";
			$idPersonagem = $personagem->id;
			echo "<a href='$urlEP?id=$idPersonagem' >";
			$imgurl = $personagem->thumbnail->path.".".$personagem->thumbnail->extension;
			echo "<img src='$imgurl' class='img-rounded' />";
			$nome = substr($personagem->name, 0, 40);
			echo "<h4>$nome</h4>";
			echo "</a>";
			echo "</div>";
			if ($organizer%4 == 0) echo "</div>";
			$organizer++;
		}
		if ($organizer%4 != 1) echo "</div>";
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

	//shortcode para exibir a lista de personagens // [sc_personagem_marvel]
	function shortcode_personagem_marvel( ){

		$idPersonagem = $_GET['id'];
		if (!$idPersonagem) { $idPersonagem = 1011334; }

		//variaveis
		$publickey = 'a80b3d6da752653db8e06bf115158301';
		$privatekey = 'de2d8bb7ce1de8f871318cf9e18dbf137d89f83e';
		$ts = '1';
		$hash = md5($ts.$privatekey.$publickey);

		$token = 'apikey='.$publickey.'&ts='.$ts.'&hash='.$hash;

		//requisicao
		$json = file_get_contents('http://gateway.marvel.com/v1/public/characters/'.$idPersonagem.'?'.$token);
		$obj = json_decode($json);

		switch ($obj->code) {
			case '200': //ok
			exibePersonagem($obj);
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
			return "Requisição não permitida.";
			break;
		}
	}

	function exibePersonagem ( $obj ) {
		$urlLP = get_option("pageListaPersonagens");

		$personagem = $obj->data->results[0];
		echo "<div class='container'>";
		echo "<div class='col-md-4'>";
		echo "<h3>$personagem->name</h3>";
		$imgurl = $personagem->thumbnail->path.".".$personagem->thumbnail->extension;
		echo "<img src='$imgurl' class='img-rounded' />";
		echo "<h5>$obj->attributionHTML</h5>";
		echo "</div>";
		echo "<div class='col-md-12'>";
		echo "<a href='$urlLP'>Voltar para a lista de personagens</a>";
		echo "</div>";
		echo "</div>";
	}

	add_shortcode ('sc_personagens_marvel', 'shortcode_personagens_marvel');
	add_shortcode ('sc_personagem_marvel', 'shortcode_personagem_marvel');