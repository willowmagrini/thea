<?php
/**
 * The template used for displaying page content.
 *
 * @package Odin
 * @since 2.2.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php the_title( '<header class="entry-header"><h1 class="entry-title">', '</h1></header><!-- .entry-header -->' ); ?>
	<div class="col-sm-1 "></div>
	<div class="col-sm-10 entry-content">
		<?php the_content();?>
	</div>
	<div class=" clearfix"></div>
	<div class="col-sm-1 "></div>
	<div id="tags"><?php the_tags( 'Tags: ', ' , ', '<br />' ); ?></div>
	<div class="col-sm-1 "></div>
	
	<hr class="col-sm-10" id="linha-single">
	<div class="col-sm-1 "></div>
	<div class=" clearfix"></div>
	
	<div id="paginacao">
    	<?php 
		next_post_link('%link','Anterior');
		echo "<div id='barra'>  |  </div>";
		previous_post_link('%link','Próximo ');
		?>
	</div>

			
			
	<!-- .entry-content -->
	<div class=" clearfix"></div>
	
	
</article><!-- #post-## -->
