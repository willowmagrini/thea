<?php
/**
 * Para single
 *
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
		<div id="margem"></div>
		<div id="content" class="site-content" role="main">
			<div class="clearfix"></div>

			<?php
				// Start the Loop.
				while ( have_posts() ) : the_post();

					/*
					 * Include the post format-specific template for the content. If you want to
					 * use this in a child theme, then include a file called called content-___.php
					 * (where ___ is the post format) and that will be used instead.
					 */
					get_template_part( 'content', 'single' );
					
					// If comments are open or we have at least one comment, load up the comment template.
					
				endwhile;
				
			?>
		</div><!-- #content -->
	</div><!-- #primary -->
	<div id="fundo-modal">	<img id="ajax-loader" style="display:none" src="<?php echo get_template_directory_uri(); ?>/assets/images/ajax-loader.gif">
	</div>
	<div id="modal-conteudo">
		<a href="#">
			<div style="display:none" id="botao-fechar">x</div>
		</a>
		<div style="display:none;" class="animated fadeIn" id="html">
		</div>		
	</div>

<?php
get_footer();

