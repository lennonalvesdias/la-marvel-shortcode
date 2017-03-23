<?php

$endereco = $_SERVER ['REQUEST_URI'];

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


// receber paginas do blog


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