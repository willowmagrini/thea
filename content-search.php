<?php
/**
 * The template used for displaying page content.
 *
 * @package Odin
 * @since 2.2.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<a href="<?php the_permalink();?>">
	
	<?php the_title( '<header class="entry-header"><h4 class="entry-title">', '</h4></header><!-- .entry-header -->' ); ?>
	<div class="col-sm-1 "></div>
	<div class="col-sm-10 entry-content">
		<div class="col-sm-5 entry-img">
			<?php the_post_thumbnail('thumbnail');?>
		</div>
		<?php the_excerpt();?>
	</div>
	</a>
	<div class=" clearfix"></div>
	<div class="col-sm-1 "></div>
	<div id="tags"><?php the_tags( 'Tags: ', ' , ', '<br />' ); ?></div>
	<div class="col-sm-1 "></div>
	
	<hr class="col-sm-10" id="linha-single">
	<div class="col-sm-1 "></div>
	
	<div class=" clearfix"></div>

	
	
	
</article><!-- #post-## -->
