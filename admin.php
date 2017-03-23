<?php

$endereco = $_SERVER ['REQUEST_URI'];

$mPublicK = get_option("marvelPublicKey");
$mPrivateK = get_option("marvelPrivateKey");

if ( isset( $_POST['marvel-public-key']) ) 
{
	$pageLP = $_POST['marvel-public-key'];
	update_option("marvelPublicKey", $pageLP);
}

if ( isset( $_POST['marvel-private-key']) ) 
{
	$pageEP = $_POST['marvel-private-key'];
	update_option("marvelPrivateKey", $pageEP);
}

$pageLP = get_option("pageListaPersonagens");
$pageEP = get_option("pageExibePersonagem");

if ( isset( $_POST['page-listagem']) ) 
{
	$pageLP = $_POST['page-listagem'];
	update_option("pageListaPersonagens", $pageLP);
}

if ( isset( $_POST['page-personagem']) ) 
{
	$pageEP = $_POST['page-personagem'];
	update_option("pageExibePersonagem", $pageEP);
}

?>

<html>
<header>
</header>
<body>

	<div class="header">
		<h1>Marvel Shortcode by Lennon Alves </h1>
		<p><a href="https://github.com/lennonalvesdias/la-marvel-shortcode" target="_blank">Ler documentação</a></p>
	</div>

	<hr style="height:1px; border:none; color:#c2c2c2; background-color:#c2c2c2; margin-top: 2px; margin-bottom: 10px;" />

	<h3> Configurações da API </h3>

	<div class="container">

		<form action="<?=$endereco?>" method="post">
			<div class="form-group">
				<p>Marvel Public Key:</p>
				<input type="text" name="marvel-public-key" value="<?=$mPublicK?>" required="required" />
				<input type="submit" name="enviar" value="Enviar" class="btn"/>
			</div>
		</form>
		<form action="<?=$endereco?>" method="post">
			<div class="form-group">
				<p>Marvel Private Key:</p>
				<input type="text" name="marvel-private-key" value="<?=$mPrivateK?>" required="required" />
				<input type="submit" name="enviar" value="Enviar" class="btn"/>
			</div>
			
		</form>

	</div>

	<p>Não tem as chaves? <a href="https://developer.marvel.com/" target="_blank">Clique aqui</a> e adquira as suas gratuitamente.</p>

	<hr style="height:1px; border:none; color:#c2c2c2; background-color:#c2c2c2; margin-top: 15px; margin-bottom: 10px;" />

	<h3> Configurações do Plugin </h3>

	<div class="container">

		<form action="<?=$endereco?>" method="post">
			<div class="form-group">
				<li>Selecione a página configurada com o <i>shortcode</i> <b>[sc_personagens_marvel]</b></li>
				<select name="page-listagem">
					<option value=""><?php echo esc_attr( __( 'Escolha a página' ) ); ?></option> 
					<?php 
					$pages = get_pages(); 
					foreach ( $pages as $page ) {
						$option = '<option value="' . get_page_link( $page->ID ) . '">';
						$option .= $page->post_title;
						$option .= '</option>';
						echo $option;
					}
					?>
				</select>
				<input type="submit" name="enviar" value="Selecionar" class="btn" />
			</div>
		</form>

		<p><b>Página selecionada:</b> <?=$pageLP?></p>

		<hr style="height:1px; border:none; color:#c2c2c2; background-color:#c2c2c2; margin-top: 2px; margin-bottom: 10px;" />

		<form action="<?=$endereco?>" method="post">
			<div class="form-group">
				<li>Selecione a página configurada com o <i>shortcode</i> <b>[sc_personagens_marvel]</b></li>
				<select name="page-personagem" > 
					<option value=""><?php echo esc_attr( __( 'Escolha a página' ) ); ?></option> 
					<?php 
					$pages = get_pages(); 
					foreach ( $pages as $page ) {
						$option = '<option value="' . get_page_link( $page->ID ) . '">';
						$option .= $page->post_title;
						$option .= '</option>';
						echo $option;
					}
					?>
				</select>
				<input type="submit" name="enviar" value="Selecionar" class="btn" />
			</div>
		</form>

		<p><b>Página selecionada:</b> <?=$pageEP?></p>

	</div>
</body>
</html>