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
				'orderby'=> 'title', 
				'order' => 'ASC',
				'paged'  =>  true


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
					$lista_titulos .= "<li class='".$slug."'><a href=".get_the_permalink()."><h4>".$titu."</h4></a></li>";
					$lista_img .="<li class='".$slug." projeto col-sm-4 ' id='cliente-".$post->ID."'><a href='".get_the_permalink()."'>".get_the_post_thumbnail()."</a></li>";
										
					if ($count % 3 == 0){
						
						 $lista_img .="<div class='clearfix'></div>";
					}
				$count++;
				}//while
				?>
				<div id="primary" style="background-image:url('<?php echo $imagem[0]; ?>');" class="col-sm-9">
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

