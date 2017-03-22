<?php

$endereco = $_SERVER ['REQUEST_URI'];
//echo $endereco;

$urlLP = get_option("urlListaPersonagens");
$urlEP = get_option("urlExibePersonagem");

if ( isset( $_POST['urllistagem']) ) 
{
	$urlLP = $_POST['urllistagem'];
	update_option("urlListaPersonagens", $urlLP);
}

if ( isset( $_POST['urlpersonagem']) ) 
{
	$urlEP = $_POST['urlpersonagem'];
	update_option("urlExibePersonagem", $urlEP);
}

?>

<html>
<header>
</header>
<body>
	<div class="header">
		<h1>Marvel Shortcode by Lennon Alves </h1>
		<p><a href="https://github.com/lennonalvesdias/la-marvel-shortcode">Ler documentação do plugin.</a></p>
	</div>

	<div class="container">

		<form action="<?=$endereco?>" method="post">
			<div class="form-group">
				<p>Insira a URL da página de listagem dos personagens:</p>
				<input type="text" id="urllistagem" name="urllistagem" class="form-control" value="<?=$urlLP?>" />
			</div>
			<input type="submit" name="enviar" value="Enviar" class="btn" />
		</form>

		<form action="<?=$endereco?>" method="post">
			<div class="form-group">
				<p>Insira a URL da página de informacoes de um personagem:</p>
				<input type="text" id="urlpersonagem" name="urlpersonagem" class="form-control" value="<?=$urlEP?>" />
			</div>
			<input type="submit" name="enviar" value="Enviar" class="btn" />
		</form>
	</div>
</body>
</html>