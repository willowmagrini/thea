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

	

		<?php
		if (is_page('contato')){
			?>
			<div class="col-sm-6 entry-content">
				<?php
				$odin_general_opts = get_option( 'config' );
				$contato = $odin_general_opts['contato'];
				echo $contato;
				echo "<div class=clearfix>";
				echo scf_html();
		}
		else{
			?>
			<div class="col-sm-7 entry-content">
			<?php
				the_content();
		?>
	</div>
	<!-- .entry-content -->
	<div class="col-sm-3 entry-img">
			<?php the_post_thumbnail();
		}
		?>
	</div>
	
	<div class=" clearfix"></div>
	
	
</article><!-- #post-## -->
