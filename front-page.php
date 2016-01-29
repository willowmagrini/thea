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
	<!-- style="background-image:url('<?php echo $imagem[0]; ?>');"  -->
	<div id="primary" class="col-sm-10">
		
	</div><!-- #primary -->

<?php
get_footer();
