<?php

get_header();
get_sidebar();
$odin_general_opts = get_option( 'config' );
$imagem = $odin_general_opts['bgimg'];
$imagem = wp_get_attachment_image_src( $imagem, 'full' );
?>

	<div id="primary"  class="col-sm-10">
		<div id="content" class="site-content" role="main">
			<div class="clearfix"></div>

			<?php if ( have_posts() ) : ?>
				<h1 id="titulo-cpt" class="entry-header">
				<?php printf( __( 'Resultado da busca por: %s', 'odin' ), get_search_query() ); ?>
				</h1>
				
					<?php
						// Start the Loop.
						while ( have_posts() ) : the_post();

							/*
							 * Include the post format-specific template for the content. If you want to
							 * use this in a child theme, then include a file called called content-___.php
							 * (where ___ is the post format) and that will be used instead.
							 */
							get_template_part( 'content', 'search' );

						endwhile;

						// Post navigation.

					else :
						// If no content, include the "No posts found" template.
						?>
						<header class='entry-header'>
							<h1 id="titulo-cpt"><?php printf( __( 'Nenhum resultado encontrado: %s', 'odin' ), get_search_query() ); ?>
							</h1>
						</header>
						<?php

				endif;
			?>
		</div><!-- #content -->
		
	</div><!-- #primary -->

<?php
get_footer();