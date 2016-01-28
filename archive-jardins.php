<?php
/**
 * Template Name: Meu Jardim
 *
 * 
 *
*/

get_header();
get_sidebar();
$odin_general_opts = get_option( 'config' );
$imagem = $odin_general_opts['bgimg'];
$imagem = wp_get_attachment_image_src( $imagem, 'full' );
$obj = get_post_type_object( 'jardins' ); 
?>

	<div id="primary"  class="col-sm-9">
		<div id="margem"></div>
		<div id="content" class="site-content" role="main">
			<div class="clearfix"></div>

			<h1 id="titulo-cpt" class="entry-header">
				<?php 
				echo  $obj->labels->singular_name;
					// echo $obj->name;
				?>
			</h1>
			<div class="col-sm-1"></div>

			<div id="descricao" class="col-sm-10">
				<p><?php echo $obj->description;?></p>
			</div>
			<div class="clearfix"></div>
			<?php
			$categories = get_terms( 'cat_jardim', array(
			 	'orderby'    => 'count',
			 	'hide_empty' => 1,
			 ) );
		if (!empty($categories)){
			?>
			<div class="col-sm-1"></div>

			<div class="col-sm-10">
				<?php
				$args_cat = array(
					'show_option_none' => __( 'Todas Categorias','odin' ),
					'show_count'       => 1,
					'orderby'          => 'name',
					'echo'             => 0,
					'taxonomy'		   => 'cat_jardim',
					'id'			   => 'jardins',
					'class'            => 'seletor-categoria'
				);
				?>

				<?php 
				add_filter( 'wp_dropdown_cats', 'wp_dropdown_categories_attribute' );
				function wp_dropdown_categories_attribute( $output ){
				    return preg_replace( 
				        '^' . preg_quote( '<select ' ) . '^', 
				        '<select data-taxonomy="cat_jardim" ', 
				        $output 
				    );
				}
				$select  = wp_dropdown_categories( $args_cat ); 
				?>
				
				<?php 
				echo $select; ?>
				
				
			</div>
		<?php
		}
		?>
			<div class="clearfix"></div>
			<div class="col-sm-1"></div>
			
			<?php 

			$args = array(
				'post_type' => 'jardins',
				'posts_per_page' => 9999,
				'paged'  =>  false


			);
			$jardim_query = new WP_Query( $args );
			// The Loop
			
			if ( $jardim_query->have_posts() ) {
				echo '<ul id="conteudo-filtro" class="sem-margem col-sm-10"> ';
				$count=1;
				while ( $jardim_query->have_posts() ) {
					$jardim_query->the_post();
					$titu =  get_the_title();
					$desc = get_the_content();
				
					?>
					
					<li class='jardim col-sm-2 ' id="id-<?php echo $post->ID;?>">
						<a href="<?php the_permalink();?>">
								
									<?php 
								the_post_thumbnail('thumbnail');
									?>
						</a>
					</li>
					<?php
					if ($count % 6 == 0){
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

