<?php
/**
 * Template Name: Janelas
 *
 * 
 *
*/

get_header();
get_sidebar();
$odin_general_opts = get_option( 'config' );
$imagem = $odin_general_opts['bgimg'];
$imagem = wp_get_attachment_image_src( $imagem, 'full' );
$obj = get_post_type_object( 'janelas' ); 
?>

	<div id="primary"  class="col-sm-10">
		<div id="margem"></div>
		<div id="content" class="site-content" role="main">
			<div class="clearfix"></div>

			<h1 id="titulo-cpt" class="entry-header">
				<?php echo $obj->name;?>
			</h1>
			<div class="col-sm-1"></div>

			<div id="descricao" class="col-sm-10">
				<p><?php echo $obj->description;?></p>
			</div>
			<div class="clearfix"></div>
			<div class="col-sm-1"></div>

			<div class="col-sm-10">
				<?php
				$args_cat = array(
					'show_option_none' => __( 'Todas Categorias','odin' ),
					'show_count'       => 1,
					'orderby'          => 'name',
					'echo'             => 0,
					'taxonomy'		   => 'cat_janela',
					'id'			   => 'janelas',
					'class'            => 'seletor-categoria'
				);
				?>

				<?php 
				add_filter( 'wp_dropdown_cats', 'wp_dropdown_categories_attribute' );
				function wp_dropdown_categories_attribute( $output ){
				    return preg_replace( 
				        '^' . preg_quote( '<select ' ) . '^', 
				        '<select data-taxonomy="cat_janela" ', 
				        $output 
				    );
				}
				$select  = wp_dropdown_categories( $args_cat ); 
				?>
				
				<?php 
				echo $select; ?>
				
				
			</div>
			<div class="clearfix"></div>
			<div class="col-sm-1"></div>
			<?php 

			$args = array(
				'post_type' => 'janelas',
				'posts_per_page' => 999,
				'paged'  =>  true,
				'tax_query' => array(
						array(
							'taxonomy' => 'cat_janela',
							'field'    => 'slug',
							'terms'    => get_queried_object()->slug,
						),
					),


			);
			$janelas_query = new WP_Query( $args );
			// The Loop
			
			if ( $janelas_query->have_posts() ) {
				echo '<ul id="conteudo-filtro" class="sem-margem col-sm-10"> ';
				$count=1;
				while ( $janelas_query->have_posts() ) {
					$janelas_query->the_post();
					$titu =  get_the_title();
					$desc = get_the_content();
				
					?>
					
					<li class='janela col-sm-4 ' id="cliente-<?php echo $post->ID;?>">
						<a href="<?php the_permalink();?>">
								
									<?php 
								the_post_thumbnail('janelas');
									echo '<h4>'.$titu.'</h4>';
									?>
						</a>
					</li>
					<?php
					if ($count % 3 == 0){
						?>
						<div class="clearfix"></div>
						<?php
					}
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
<script>
	document.getElementById('jardins').value='<?php
	echo get_queried_object()->term_id;
	?>'
</script>