<?php
/**
 * Template Name: Página inicial
 *
 *
 */

get_header();
get_sidebar();
$odin_general_opts = get_option( 'config' );
$imagem = $odin_general_opts['bgimg'];
$imagem = wp_get_attachment_image_src( $imagem, 'full' );

?>
	
	<div id="primary" style="background-image:url('<?php echo $imagem[0]; ?>');" class="col-sm-10">
		
	</div><!-- #primary -->

<?php
get_footer();
