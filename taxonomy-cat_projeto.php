<?php
/**
 * Template Name: Projetos
 *
 * 
 *
*/
get_header();
get_sidebar();
$odin_general_opts = get_option( 'config' );
$imagem = $odin_general_opts['bgimg'];
$imagem = wp_get_attachment_image_src( $imagem, 'full' );
$obj = get_post_type_object( 'projetos' ); 
?>

	
		

			<?php 

			$args = array(
				'post_type' => 'projetos',
				'posts_per_page' => 999,
				'paged'  =>  true,
				'tax_query' => array(
						array(
							'taxonomy' => 'cat_projeto',
							'field'    => 'slug',
							'terms'    => get_queried_object()->slug,
						),
					),


			);
			$projetos_query = new WP_Query( $args );
			// The Loop
			$lista_img= '';
			if ( $projetos_query->have_posts() ) {
				$count=1;
				while ( $projetos_query->have_posts() ) {
					$projetos_query->the_post();
					$titu =  get_the_title();
					$slug = $post->post_name;
					$desc = get_the_content();
					$lista_titulos .= "<li ><a href=".get_the_permalink()."><h4 class='".$slug."'>".$titu."</h4></a></li>";
					$lista_img .="<li class=' projeto col-sm-4 ' id='cliente-".$post->ID."'><a href='".get_the_permalink()."'>".get_the_post_thumbnail($post->ID, 'thumbnail',array('id'	=> $slug, 'class'=>'attachment-post-thumbnail')
					)."</a></li>";
										
					if ($count % 3 == 0){
						
						 $lista_img .="<div class='clearfix'></div>";
					}
				$count++;
				}//while
				?>
				<div id="primary"  class="col-sm-10">
					<div id="content" class="site-content" role="main">
						<div class="clearfix"></div>

						<h1 id="titulo-cpt" class="entry-header">
							<?php echo $obj->name;?>
						</h1>
						<div class="col-sm-1"></div>

						<div id="descricao" class="col-sm-4">
							<?php echo '<p>'.$obj->description.'</p>';
							echo '<ul id="lista_titulos" class="sem-margem ">';
							echo $lista_titulos;
							echo '</ul>';?>
						</div>
						
							<div class="col-sm-7">
								<?php
								$args_cat = array(
									'show_option_none' => __( 'Todas Categorias','odin' ),
									'show_count'       => 1,
									'orderby'          => 'name',
									'echo'             => 0,
									'taxonomy'		   => 'cat_projeto',
									'id'			   => 'projetos',
									'class'            => 'seletor-categoria'
								);
								?>

								<?php 
								add_filter( 'wp_dropdown_cats', 'wp_dropdown_categories_attribute' );
								function wp_dropdown_categories_attribute( $output ){
								    return preg_replace( 
								        '^' . preg_quote( '<select ' ) . '^', 
								        '<select data-taxonomy="cat_projeto" ', 
								        $output 
								    );
								}
								$select  = wp_dropdown_categories( $args_cat ); 
								?>

								<?php 
								echo $select; ?>


							</div>
				<?php 
				
				echo '<ul id="lista_img" class="sem-margem col-sm-7"> ';
				echo $lista_img;
				echo '</ul>';
				
				
			} else {
				// no posts found
			}
			?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php
get_footer();
 print_r(get_queried_object());

?>
<script>
	document.getElementById('projetos').value='<?php
	echo get_queried_object()->term_id;
	?>'
</script>