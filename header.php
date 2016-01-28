<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till #main div
 *
 * @package Odin
 * @since 2.2.0
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="no-js ie ie7 lt-ie9 lt-ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="no-js ie ie8 lt-ie9" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8) ]><!-->
<html class="no-js" <?php language_attributes(); ?>>
<!--<![endif]-->
<?php
global $odin_general_opts;
$odin_general_opts = get_option( 'config' );
$corex = $odin_general_opts['cor'];
$imagem = $odin_general_opts['bgimg'];
$imagem = wp_get_attachment_image_src( $imagem, 'full' );?>


<head>
	<meta name='theme-color' content='<?php echo $corex;?>'>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<?php 
	if (is_post_type_archive('jardins')){
		?>
		<title>Meu Jardim | Thea Standerski</title>
		
		<?php 
	}
	elseif (is_post_type_archive('viagens')){
		?>
	
		<title>Viagens | Thea Standerski</title>
		<?php 
	}
	else{
		?>
		<title><?php wp_title( '|', true, 'right' ); ?></title>
	<?php
	}?>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<link href="<?php echo get_template_directory_uri(); ?>/assets/images/favicon.ico" rel="shortcut icon" />
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/assets/js/html5.js"></script>
	<![endif]-->
	<?php wp_head(); ?>

</head>
<style>
		
		.nav li a, a, #conteudo-filtro  a:hover{
			transition: color 0.7s ease;
			color:
			<?php
				$cor = hex2rgb($corex);
				echo "rgba(".$cor.",1)";			
			?>
		}
		.nav li a:hover, .nav li a:focus,  input[type="submit"]:hover	{
			background-color:
			<?php
				echo "rgba(".$cor.",0.3)";
			?>
			;
		
		}
		::-webkit-input-placeholder {
		   color: 	<?php
				echo "rgba(".$cor.",1)";
			?>;
		}

		:-moz-placeholder { /* Firefox 18- */
		   color: 	<?php
					echo "rgba(".$cor.",1)";
				?>;  
		}

		::-moz-placeholder {  /* Firefox 19+ */
		   color: 	<?php
					echo "rgba(".$cor.",1)";
				?>;  
		}

		:-ms-input-placeholder {  
		   color: 	<?php
					echo "rgba(".$cor.",1)";
				?>;  
		}
		
		 h1, .navbar-toggle{
			color: 	<?php
						echo "rgba(".$cor.",1)";
					?>;
		}
		.attachment-post-thumbnail, .attachment-thumbnail, .attachment-janelas, .attachment-viagens  {
			border-color: transparent;
			transition: border-color 0.7s ease;
			border-style: solid;
			border-width:4px;
		}
		a:hover .attachment-post-thumbnail, a:hover .attachment-thumbnail, a:hover .attachment-janelas, a:hover .attachment-viagens  	{
			border-color: 	<?php
						echo "rgba(".$cor.",1)";
					?>;
			border-style: solid;
		}
	
		a h4, a h1{
			transition: border-color 0.7s ease;
			border-width: 3px;
			border-bottom-style: solid;
			border-color:transparent;
			display: inline-block;
			padding:3px 2px;
		}
		a:hover h4, .borda, .search-results article a:hover h1, input
		{border-color:<?php
					echo "rgba(".$cor.",1)";
				?>;
		}
		svg
		{fill:<?php
					echo "rgba(".$cor.",1)";
				?>;
		}
		#lista_titulos li {
		    color: 	<?php
						echo "rgba(".$cor.",1)";
					?>;
		}
		.form-group input, .form-group textarea{
			color: 	<?php
						echo "rgba(".$cor.",1)";
					?>;
		}
		.btn-default, input[type="submit"], input[type="reset"], button{
			background-color: 	<?php
						echo "rgba(".$cor.",1)";
					?>;
		}
		#faixa{
/*			background-color:<?php echo "rgba(".$cor.",1)";?>*/
		}
		#social a i{
			color:
				<?php
					echo "rgba(".$cor.",1)";			
				?>
		}
		#social a:hover i, #paginacao{
			color: 	<?php
						echo "rgba(".$cor.",0.3)";
					?>;
		}
		#linha-single{
			border-top: 1px solid 	<?php
						echo "rgba(".$cor.",0.3)";
					?>;
		}
		#main{
			background-image:url('<?php echo $imagem[0]; ?>');
		}
		@media screen and (max-width: 767px){
			#primary {
				background-image: none;
			}
			.home #primary {
				background-image: url('http://theas.com.br/wp-content/uploads/2015/01/bgimg.png');
				height: calc( 100vh - 271px);
			}	
			
		}	
		#conteudo-filtro a {
			color:#848182;
			transition: color 0.7s ease;
			
		}
		
		
</style>
<body id="<?php  
	if (!is_archive_pageglobal){ $post; $page_slug=$post->post_name; echo $post_slug;} ?>" <?php body_class(); ?>>
	<div class="container">
		
		<div id="main" class="site-main row">
