<?php
/**
 * The template for displaying all pages.
 *
 *
 */

get_header();
get_sidebar();
$odin_general_opts = get_option( 'config' );
$imagem = $odin_general_opts['bgimg'];
$imagem = wp_get_attachment_image_src( $imagem, 'full' );

?>

	<div id="primary"  class="col-sm-9">
		<div id="content" class="site-content" role="main">
			<div class="clearfix"></div>
			<?php
			
			
				// Start the Loop.
				while ( have_posts() ) : the_post();

					// Include the page content template.
					get_template_part( 'content', 'page' );

					
				endwhile;
			
			?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php
get_footer();

