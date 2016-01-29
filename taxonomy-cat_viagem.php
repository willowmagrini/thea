<?php
/**
 * Template Name: Viagens
 *
 * 
 *
*/

get_header();
get_sidebar();
$odin_general_opts = get_option( 'config' );
$imagem = $odin_general_opts['bgimg'];
$imagem = wp_get_attachment_image_src( $imagem, 'full' );
$obj = get_post_type_object( 'viagens' ); 
?>

	<div id="primary"  class="col-sm-10">
		<div id="content" class="site-content" role="main">
			<div class="clearfix"></div>

			<h1 id="titulo-cpt" class="entry-header">
				<?php echo $obj->name." - ".get_queried_object()->name;?>
			</h1>
			<div class="col-sm-1"></div>

			<div id="descricao" class="col-sm-10">
				<p><?php echo $obj->description;?></p>
			</div>
			<div class="clearfix"></div>
			<div class="col-sm-1"></div>


			<div class="clearfix"></div>
			<div class="col-sm-1"></div>
			<?php 

			$args = array(
				'post_type' => 'viagens',
				'posts_per_page' => 99999,
				'paged'  =>  true,
				'tax_query' => array(
						array(
							'taxonomy' => 'cat_viagem',
							'field'    => 'slug',
							'terms'    => get_queried_object()->slug,
						),
					),


			);
			$viagens_query = new WP_Query( $args );
			// The Loop
			
			if ( $viagens_query->have_posts() ) {
				echo '<ul id="conteudo-filtro" class="sem-margem col-sm-10"> ';
				$count=1;
				while ( $viagens_query->have_posts() ) {
					$viagens_query->the_post();
					$titu =  get_the_title();
					$desc = get_the_content();
				
					?>
					
					<li class='viagem col-sm-12 ' id="cliente-<?php echo $post->ID;?>">
						<a href="<?php the_permalink();?>">
								<div class=" thumb_viagem">
									<?php 
								the_post_thumbnail('viagens');
									?>
								</div>
								<div class="viagem_div">
									<?php
									echo '<h4>'.$titu.'</h4>';									
									echo the_excerpt();
									?>
									
								</div>
								
									
						</a>
					</li>
					<div class="clearfix"></div>
					
					<?php
				$count++;
				}//while
				echo '</ul>';
			} else {
				// no posts found
			}
			?>

		</div><!-- #content -->
		
	</div><!-- #primary -->

<?php
get_footer();

?>
